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

use CL\Slack\Payload\PayloadInterface;
use CL\Slack\Serializer\PayloadSerializer;
use PHPUnit\Framework\TestCase;

/**
 * @author Cas Leentfaar <info@casleentfaar.com>
 */
abstract class AbstractPayloadTestCase extends TestCase
{
    /**
     * @var PayloadSerializer
     */
    private $payloadSerializer;

    protected function setUp(): void
    {
        $this->payloadSerializer = new PayloadSerializer();
    }

    /**
     * @test
     */
    public function it_can_be_serialized()
    {
        $payload = $this->createPayload();

        self::assertIsString($payload->getMethod());
        self::assertTrue(class_exists($payload->getResponseClass()));

        $expectedPayloadSerialized = json_encode($this->getExpectedPayloadData($payload));
        $actualPayloadSerialized = json_encode($this->payloadSerializer->serialize($payload));

        self::assertEquals(
            json_decode($expectedPayloadSerialized, true),
            json_decode($actualPayloadSerialized, true)
        );
    }

    /**
     * @return PayloadInterface
     */
    abstract protected function createPayload();

    /**
     * @param PayloadInterface $payload
     *
     * @return array
     */
    abstract protected function getExpectedPayloadData(PayloadInterface $payload);
}
