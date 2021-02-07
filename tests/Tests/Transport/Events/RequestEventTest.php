<?php

/*
 * This file is part of the Slack API library.
 *
 * (c) Cas Leentfaar <info@casleentfaar.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CL\Slack\Tests\Transport\Events;

use CL\Slack\Test\Model\ModelTrait;
use CL\Slack\Transport\Events\RequestEvent;
use PHPUnit\Framework\TestCase;

/**
 * @author Cas Leentfaar <info@casleentfaar.com>
 */
class RequestEventTest extends TestCase
{
    use ModelTrait;

    /**
     * @test
     */
    public function it_can_return_a_raw_payload()
    {
        $expectedPayload = [];
        $event = new RequestEvent($expectedPayload);
        $actualPayload = $event->getRawPayload();

        self::assertEquals($expectedPayload, $actualPayload);
    }
}
