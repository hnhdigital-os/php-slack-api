<?php

/*
 * This file is part of the Slack API library.
 *
 * (c) Cas Leentfaar <info@casleentfaar.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CL\Slack\Transport;

use CL\Slack\Exception\SlackException;
use CL\Slack\Payload\PayloadInterface;
use CL\Slack\Payload\PayloadResponseInterface;
use CL\Slack\Serializer\PayloadResponseSerializer;
use CL\Slack\Serializer\PayloadSerializer;
use CL\Slack\Transport\Events\RequestEvent;
use CL\Slack\Transport\Events\ResponseEvent;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * @author Cas Leentfaar <info@casleentfaar.com>
 */
class ApiClient implements ApiClientInterface
{
    /**
     * The (base) URL used for all communication with the Slack API.
     */
    const API_BASE_URL = 'https://slack.com/api/';

    /**
     * Event triggered just before it's sent to the Slack API
     * Any listeners are passed the request data (array) as the first argument.
     */
    const EVENT_REQUEST = 'EVENT_REQUEST';

    /**
     * Event triggered just before it's sent to the Slack API
     * Any listeners are passed the response data (array) as the first argument.
     */
    const EVENT_RESPONSE = 'EVENT_RESPONSE';

    /**
     * @var string|null
     */
    private $token;

    /**
     * @var string|null
     */
    private $endpoint;

    /**
     * @var bool
     */
    private $logNotOk = false;

    /**
     * @var PayloadSerializer
     */
    private $payloadSerializer;

    /**
     * @var PayloadResponseSerializer
     */
    private $payloadResponseSerializer;

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @param string|null                   $token
     * @param ClientInterface|null          $client
     * @param EventDispatcherInterface|null $eventDispatcher
     */
    public function __construct(
        $token = null,
        ClientInterface $client = null,
        EventDispatcherInterface $eventDispatcher = null
    ) {
        $this->token = $token;
        $this->endpoint = null;
        $this->payloadSerializer = new PayloadSerializer();
        $this->payloadResponseSerializer = new PayloadResponseSerializer();
        $this->client = $client ?: new Client();
        $this->eventDispatcher = $eventDispatcher ?: new EventDispatcher();
    }

    /**
     * Set logging of error explanations when response is not ok.
     *
     * @param bool $logNotOk
     *
     * @return ApiClient
     */
    public function setLogNotOk($logNotOk)
    {
        $this->logNotOk = $logNotOk;

        return $this;
    }

    /**
     * Get the boolean of  logging of error explanations when response is not ok.
     *
     * @param string $endpoint
     *
     * @return string
     */
    public function isLogNotOk()
    {
        return $this->logNotOk;
    }

    /**
     * Get the endpoint for this payload.
     *
     * @param string $endpoint
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * Set the endpoint for this payload.
     *
     * @param string $endpoint
     *
     * @return ApiClient
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * Reset the endpoint for this payload.
     *
     * @return ApiClient
     */
    public function resetEndpoint()
    {
        $this->endpoint = null;

        return $this;
    }

    /**
     * @param PayloadInterface $payload The payload to send
     * @param string|null      $token   Optional token to use during the API-call,
     *                                  defaults to the one configured during construction
     *
     * @throws SlackException If the payload could not be sent
     *
     * @return PayloadResponseInterface Actual class depends on the payload used,
     *                                  e.g. chat.postMessage will return an instance of ChatPostMessagePayloadResponse
     */
    public function send(PayloadInterface $payload, $token = null)
    {
        try {
            if ($token === null && $this->token === null) {
                throw new \InvalidArgumentException('You must supply a token to send a payload, since you did not provide one during construction');
            }

            $serializedPayload = $this->payloadSerializer->serialize($payload);
            $responseData = $this->doSend($payload->getMethod(), $serializedPayload, $token);

            $response = $this->payloadResponseSerializer->deserialize($responseData, $payload->getResponseClass());

            if ($this->isLogNotOk() && !$response->isOk()) {
                error_log($response->getErrorExplanation());
            }

            return $response;
        } catch (\Exception $e) {
            throw new SlackException(sprintf('Failed to send payload: %s', $e->getMessage()), null, $e);
        }
    }

    /**
     * @param callable $callable
     */
    public function addRequestListener($callable)
    {
        $this->eventDispatcher->addListener(self::EVENT_REQUEST, $callable);

        return $this;
    }

    /**
     * @param callable $callable
     */
    public function addResponseListener($callable)
    {
        $this->eventDispatcher->addListener(self::EVENT_RESPONSE, $callable);

        return $this;
    }

    /**
     * @param string      $method
     * @param array       $data
     * @param string|null $token
     *
     * @throws SlackException
     *
     * @return array
     */
    private function doSend($method, array $data, $token = null)
    {
        try {
            $data['token'] = $token ?: $this->token;

            $this->eventDispatcher->dispatch(new RequestEvent($data), self::EVENT_REQUEST);

            $request = $this->createRequest($method, $data);

            /** @var ResponseInterface $response */
            $response = $this->client->send($request);
        } catch (\Exception $e) {
            throw new SlackException('Failed to send data to the Slack API', null, $e);
        }

        if (!is_null($this->endpoint)) {
            return [];
        }

        try {
            $responseData = json_decode($response->getBody()->getContents(), true);
            if (!is_array($responseData)) {
                throw new \Exception(sprintf(
                    'Expected JSON-decoded response data to be of type "array", got "%s"',
                    gettype($responseData)
                ));
            }

            $this->eventDispatcher->dispatch(new ResponseEvent($responseData), self::EVENT_RESPONSE);

            return $responseData;
        } catch (\Exception $e) {
            throw new SlackException('Failed to process response from the Slack API', null, $e);
        }
    }

    /**
     * @param string $method
     * @param array  $payload
     *
     * @return RequestInterface
     */
    private function createRequest($method, array $payload)
    {
        // Override the endpoint for this payload.
        if (!is_null($this->endpoint)) {
            $token = $payload['token'];
            unset($payload['token']);

            // Convert payload back to an array.
            foreach ($payload as &$value) {
                $value = json_decode($value);
            }

            // Encode payload.
            $payload = json_encode($payload, JSON_UNESCAPED_UNICODE);

            return new Request(
                'POST',
                $this->endpoint,
                ['Content-Type' => 'application/json'],
                $payload
            );
        }

        return new Request(
            'POST',
            self::API_BASE_URL . $method,
            ['Content-Type' => 'application/x-www-form-urlencoded'],
            http_build_query($payload)
        );
    }
}
