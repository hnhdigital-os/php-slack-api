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

use CL\Slack\Serializer\PayloadSerializer;
use CL\Slack\Test\Payload\PayloadMock;

/**
 * @author Cas Leentfaar <info@casleentfaar.com>
 */
class PayloadSerializerTest extends \PHPUnit\Framework\TestCase
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
        $payload = new PayloadMock();
        $payload->setFruit('apple');

        $serializedPayload = $this->payloadSerializer->serialize($payload);

        $this->assertIsArray($serializedPayload);
        $this->assertArrayHasKey('fruit', $serializedPayload);
        $this->assertEquals($payload->getFruit(), $serializedPayload['fruit']);
    }
}
