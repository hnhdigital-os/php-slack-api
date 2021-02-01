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
 * @link Official documentation at https://api.slack.com/methods/chat.postMessage
 */
class ChatPostMessagePayload extends AbstractPayload implements AdvancedSerializeInterface
{
    /**
     * @var string
     */
    private $channel;

    /**
     * @var string
     */
    private $text;

    /**
     * @var string
     */
    private $parse;

    /**
     * @var bool
     */
    private $linkNames;

    /**
     * @var Attachment[]|ArrayCollection
     */
    private $attachments;

    /**
     * @var string
     */
    private $attachmentsJson;

    /**
     * @var bool
     */
    private $unfurlLinks;

    /**
     * @var bool
     */
    private $unfurlMedia;

    /**
     * @var string
     */
    private $username;

    /**
     * @var bool
     */
    private $asUser;

    /**
     * @var string
     */
    private $iconUrl;

    /**
     * @var string
     */
    private $iconEmoji;

    /**
     * @var string
     */
    private $threadTs;

    /**
     * @var string
     */
    private $replyBroadcast;

    /**
     * Set attachments variable to array collection.
     */
    public function __construct()
    {
        $this->attachments = new ArrayCollection();
    }

    /**
     * Sets the channel to send the message to.
     * Channel, private group, or IM channel to send message to. Can be an encoded ID, or a name.
     *
     * @param string $channel
     *
     * @return ChatPostMessagePayload
     *
     * @see https://api.slack.com/methods/chat.postMessage#channels
     */
    public function setChannel($channel)
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * @return string
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * Text of the message to send. See below for an explanation of formatting.
     * This field is usually required, unless you're providing only attachments instead.
     *
     * @param string $text Actual text to send.
     *
     * @return ChatPostMessagePayload
     *
     * @see https://api.slack.com/methods/chat.postMessage#formatting
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return string Actual text to send.
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Change how messages are treated. Defaults to none.
     *
     * @param string $parse full, none
     *
     * @return ChatPostMessagePayload
     *
     * @see https://api.slack.com/methods/chat.postMessage#formatting
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
     * Find and link channel names and usernames.
     *
     * @param bool $linkNames
     *
     * @return ChatPostMessagePayload
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
     * Structured message attachments.
     *
     * @param Attachment $attachment
     *
     * @return ChatPostMessagePayload
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
     * Pass true to enable unfurling of primarily text-based content.
     *
     * @param bool $unfurlLinks
     *
     * @see https://api.slack.com/docs/unfurling
     */
    public function setUnfurlLinks($unfurlLinks)
    {
        $this->unfurlLinks = $unfurlLinks;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getUnfurlLinks()
    {
        return $this->unfurlLinks;
    }

    /**
     * Pass false to disable unfurling of media content.
     *
     * @param bool $unfurlMedia
     *
     * @see https://api.slack.com/docs/unfurling
     */
    public function setUnfurlMedia($unfurlMedia)
    {
        $this->unfurlMedia = $unfurlMedia;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getUnfurlMedia()
    {
        return $this->unfurlMedia;
    }

    /**
     * Set your bot's user name. Must be used in conjunction with as_user set to false, otherwise ignored.
     *
     * @param string $username
     *
     * @return ChatPostMessagePayload
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Pass true to post the message as the authed user, instead of as a bot. Defaults to false.
     *
     * @param bool $asUser
     *
     * @return ChatPostMessagePayload
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
     * URL to an image to use as the icon for this message.
     * Must be used in conjunction with as_user set to false, otherwise ignored.
     *
     * @param string|null $iconUrl
     */
    public function setIconUrl($iconUrl)
    {
        $this->iconUrl = $iconUrl;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getIconUrl()
    {
        return $this->iconUrl;
    }

    /**
     * Emoji to use as the icon for this message. Overrides icon_url.
     * Must be used in conjunction with as_user set to false, otherwise ignored.
     *
     * @param string|null
     *
     * @see https://{YOURSLACKTEAMHERE}.slack.com/customize/emoji
     */
    public function setIconEmoji($iconEmoji)
    {
        if (substr($iconEmoji, 0, 1) !== ':') {
            $iconEmoji = sprintf(':%s:', $iconEmoji);
        }

        $this->iconEmoji = $iconEmoji;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getIconEmoji()
    {
        return $this->iconEmoji;
    }

    /**
     * Provide another message's ts value to make this message a reply.
     * Avoid using a reply's ts value; use its parent instead.
     *
     * @param string $threadTs
     */
    public function setThreadTs($threadTs)
    {
        $this->threadTs = $threadTs;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getThreadTs()
    {
        return $this->threadTs;
    }

    /**
     * Used in conjunction with thread_ts and indicates whether reply should be made visible
     * to everyone in the channel or conversation. Defaults to false.
     *
     * @param string $replyBroadcast
     */
    public function setReplyBroadcast($replyBroadcast)
    {
        $this->replyBroadcast = $replyBroadcast;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getReplyBroadcast()
    {
        return $this->replyBroadcast;
    }

    /**
     * @inheritdoc
     */
    public function getMethod()
    {
        return 'chat.postMessage';
    }

    /**
     * @inheritdoc
     */
    public function beforeSerialize(Serializer $serializer)
    {
        $this->attachmentsJson = $serializer->serialize($this->attachments, 'json');
    }
}
