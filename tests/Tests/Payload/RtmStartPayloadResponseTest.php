<?php

/*
 * This file is part of the Slack API library.
 *
 * (c) Cas Leentfaar <info@casleentfaar.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CL\Slack\Tests\Payload;

use CL\Slack\Payload\PayloadResponseInterface;
use CL\Slack\Payload\RtmStartPayloadResponse;

/**
 * @author Travis Raup <info@travisraup.com>
 */
class RtmStartPayloadResponseTest extends AbstractPayloadResponseTestCase
{
    /**
     * {@inheritdoc}
     */
    public function createResponseData()
    {
        return [
            'url' => 'wss://ms111.slack-msgs.com/websocket/',
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @param array                   $responseData
     * @param RtmStartPayloadResponse $payloadResponse
     */
    protected function assertResponse(array $responseData, PayloadResponseInterface $payloadResponse)
    {
        self::assertEquals($responseData['url'], $payloadResponse->getUrl());
    }
}
