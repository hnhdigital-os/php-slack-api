<?php

/*
 * This file is part of the Slack API library.
 *
 * (c) Cas Leentfaar <info@casleentfaar.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CL\Slack\Payload;

/**
 * @author Cas Leentfaar <info@casleentfaar.com>
 */
class ChatPostMessagePayloadResponse extends AbstractPayloadResponse
{
    /**
     * @var string|null
     */
    private $channel;

    /**
     * @var string|null
     */
    private $ts;

    /**
     * @var string|null
     */
    private $message;

    /**
     * The Slack channel ID on which your message has been posted, or null if the call failed.
     *
     * @return string|null
     */
    public function getChannelId()
    {
        return $this->channel;
    }

    /**
     * The Slack timestamp on which your message has been posted, or null if the call failed.
     *
     * @return string|null
     */
    public function getTs()
    {
        return $this->ts;
    }

    /**
     * @return srray The original message
     */
    public function getMessage()
    {
        return $this->message;
    }
}
