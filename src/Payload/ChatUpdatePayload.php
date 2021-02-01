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

use CL\Slack\Model\Attachment;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Serializer;

/**
 * @author Cas Leentfaar <info@casleentfaar.com>
 *
 * @link Official documentation at https://api.slack.com/methods/chat.delete
 */
class ChatUpdatePayload extends AbstractPayload implements AdvancedSerializeInterface
{
    /**
     * @var string
     */
    private $ts;

    /**
     * @var string
     */
    private $channel;

    /**
     * @var string
     */
    private $text;

    /**
     * @var Attachment[]|ArrayCollection
     */
    private $attachments;

    /**
     * @var string
     */
    private $attachmentsJson;

    /**
     * @var string
     */
    private $parse;

    /**
     * @var bool
     */
    private $linkNames;

    /**
     * @var bool
     */
    private $asUser;

    /**
     * Set attachments variable to array collection.
     */
    public function __construct()
    {
        $this->attachments = new ArrayCollection();
    }

    /**
     * Timestamp of the message to be updated.
     *
     * @param string $timestamp
     *
     * @return ChatUpdatePayload
     */
    public function setTs($timestamp)
    {
        $this->ts = $timestamp;

        return $this;
    }

    /**
     * @return string
     */
    public function getTs()
    {
        return $this->ts;
    }

    /**
     * Channel (ID only!) containing the message to be updated.
     *
     * @param string $channel
     *
     * @return ChatUpdatePayload
     */
    public function setChannelId($channel)
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * @return string
     */
    public function getChannelId()
    {
        return $this->channel;
    }

    /**
     * New text for the message, using the default formatting rules.
     *
     * @param string $text
     *
     * @return ChatUpdatePayload
     *
     * @see https://api.slack.com/docs/formatting
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Structured message attachments.
     *
     * @param Attachment $attachment
     *
     * @return ChatUpdatePayload
     */
    public function addAttachment(Attachment $attachment)
    {
        $this->attachments->add($attachment);

        return $this;
    }

    /**
     * @param Attachment $attachment
     */
    public function attach(Attachment $attachment)
    {
        return $this->addAttachment($attachment);
    }

    /**
     * @return Attachment[]|ArrayCollection
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * Use for serialization.
     *
     * @return string
     */
    public function getAttachmentsJson()
    {
        return $this->attachmentsJson;
    }

    /**
     * Change how messages are treated. Defaults to client, unlike chat.postMessage.
     *
     * @param string $parse
     *
     * @return ChatUpdatePayload
     *
     * @see https://api.slack.com/methods/chat.update#formatting
     */
    public function setParse($parse)
    {
        $this->parse = $parse;

        return $this;
    }

    /**
     * @return string
     */
    public function getParse()
    {
        return $this->parse;
    }

    /**
     * Find and link channel names and usernames. Defaults to none.
     * This parameter should be used in conjunction with parse.
     * To set link_names to 1, specify a parse mode of full.
     *
     * @param bool $linkNames
     *
     * @return ChatUpdatePayload
     */
    public function setLinkNames($linkNames)
    {
        $this->linkNames = $linkNames;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getLinkNames()
    {
        return $this->linkNames;
    }

    /**
     * Pass true to post the message as the authed user, instead of as a bot. Defaults to false.
     *
     * @param bool $asUser
     *
     * @return ChatUpdatePayload
     */
    public function setAsUser($asUser)
    {
        $this->asUser = $asUser;

        return $this;
    }

    /**
     * @return bool
     */
    public function getAsUser()
    {
        return $this->asUser;
    }

    /**
     * @inheritdoc
     */
    public function getMethod()
    {
        return 'chat.update';
    }

    /**
     * @inheritdoc
     */
    public function beforeSerialize(Serializer $serializer)
    {
        $this->attachmentsJson = $serializer->serialize($this->attachments, 'json');
    }
}
