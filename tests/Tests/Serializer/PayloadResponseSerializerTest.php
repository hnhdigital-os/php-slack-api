<?php

/*
 * This file is part of the Slack API library.
 *
 * (c) Cas Leentfaar <info@casleentfaar.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CL\Slack\Tests\Serializer;

use CL\Slack\Serializer\PayloadResponseSerializer;
use CL\Slack\Test\Payload\MockPayloadResponse;
use PHPUnit\Framework\TestCase;

/**
 * @author Cas Leentfaar <info@casleentfaar.com>
 */
class PayloadResponseSerializerTest extends TestCase
{
    /**
     * @var PayloadResponseSerializer
     */
    private $payloadResponseSerializer;

    protected function setUp(): void
    {
        $this->payloadResponseSerializer = new PayloadResponseSerializer();
    }

    /**
     * @test
     */
    public function it_can_be_deserialized()
    {
        $payloadResponse = [
            'ok' => true,
            'error' => null,
            'result' => [],
        ];

        $mockResponseClass = MockPayloadResponse::class;
        $serializedPayload = $this->payloadResponseSerializer->deserialize(
            $payloadResponse,
            $mockResponseClass
        );

        self::assertInstanceOf($mockResponseClass, $serializedPayload);
        self::assertTrue($serializedPayload->isOk());
        self::assertNull($serializedPayload->getError());
        self::assertNull($serializedPayload->getErrorExplanation());
    }
}
