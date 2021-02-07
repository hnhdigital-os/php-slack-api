<?php

/*
 * This file is part of the Slack API library.
 *
 * (c) Cas Leentfaar <info@casleentfaar.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CL\Slack\Model;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @author Cas Leentfaar <info@casleentfaar.com>
 *
 * @link Official documentation at https://api.slack.com/docs/attachments
 */
class Attachment extends AbstractModel
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $titleLink;

    /**
     * @var string
     */
    private $imageUrl;

    /**
     * @var string
     */
    private $authorName;

    /**
     * @var string
     */
    private $authorLink;

    /**
     * @var string
     */
    private $authorIcon;

    /**
     * @var string
     */
    private $pretext;

    /**
     * @var string
     */
    private $text;

    /**
     * @var string
     */
    private $color;

    /**
     * @var string
     */
    private $fallback;

    /**
     * @var string
     */
    private $callbackId;

    /**
     * @var AttachmentField[]|ArrayCollection
     */
    private $fields;

    /**
     * @var AttachmentAction[]|ArrayCollection
     */
    private $actions;

    /**
     * @var array
     */
    private $mrkdwnIn;

    /**
     * @var string
     */
    private $footer;

    public function __construct()
    {
        $this->fields = new ArrayCollection();
        $this->actions = new ArrayCollection();
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $titleLink
     */
    public function setTitleLink($titleLink)
    {
        $this->titleLink = $titleLink;
    }

    /**
     * @return string
     */
    public function getTitleLink()
    {
        return $this->titleLink;
    }

    /**
     * @param string $imageUrl
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     * @return string
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * @param string $authorName
     */
    public function setAuthorName($authorName)
    {
        $this->authorName = $authorName;
    }

    /**
     * @return string
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * @param string $authorLink
     */
    public function setAuthorLink($authorLink)
    {
        $this->authorLink = $authorLink;
    }

    /**
     * @return string
     */
    public function getAuthorLink()
    {
        return $this->authorLink;
    }

    /**
     * @param string $authorIcon
     */
    public function setAuthorIcon($authorIcon)
    {
        $this->authorIcon = $authorIcon;
    }

    /**
     * @return string
     */
    public function getAuthorIcon()
    {
        return $this->authorIcon;
    }

    /**
     * @param string $fallback Required text summary of the attachment that is shown by clients that understand attachments
     *                         but choose not to show them.
     */
    public function setFallback($fallback)
    {
        $this->fallback = $fallback;
    }

    /**
     * @return string Text summary of the attachment that is shown by clients that understand attachments
     *                but choose not to show them.
     */
    public function getFallback()
    {
        return $this->fallback;
    }

    /**
     * @param string $callbackId Required value for interactive messages.
     */
    public function setCallbackId($callbackId)
    {
        $this->callbackId = $callbackId;
    }

    /**
     * @return string
     */
    public function getCallbackId()
    {
        return $this->callbackId;
    }

    /**
     * @param string|null $pretext Optional text that should appear above the formatted data.
     */
    public function setPretext($pretext = null)
    {
        $this->pretext = $pretext;
    }

    /**
     * @return string|null Optional text that should appear above the formatted data.
     */
    public function getPretext()
    {
        return $this->pretext;
    }

    /**
     * @param string|null $text Optional text that should appear within the attachment.
     */
    public function setText($text = null)
    {
        $this->text = $text;
    }

    /**
     * @return string|null Optional text that should appear within the attachment.
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string|null $color Can either be one of 'good', 'warning', 'danger', or any hex color code
     */
    public function setColor($color = null)
    {
        $this->color = $color;
    }

    /**
     * @return string|null Can either be one of 'good', 'warning', 'danger', or any hex color code
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param AttachmentField $field
     */
    public function addField(AttachmentField $field)
    {
        $this->fields->add($field);
    }

    /**
     * @return AttachmentField[]|ArrayCollection
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param AttachmentAction $action
     */
    public function addAction(AttachmentAction $action)
    {
        $this->actions->add($action);
    }

    /**
     * @return AttachmentAction[]|ArrayCollection
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * @param array Valid values for mrkdwn_in are: ["pretext", "text", "fields"]. Setting "fields" will enable markup formatting for the value of each field
     */
    public function setMrkdwnIn(array $mrkdwnIn)
    {
        $this->mrkdwnIn = $mrkdwnIn;
    }

    /**
     * @return array Valid values for mrkdwn_in are: ["pretext", "text", "fields"]. Setting "fields" will enable markup formatting for the value of each field
     */
    public function getMrkdwnIn()
    {
        return $this->mrkdwnIn;
    }

    /**
     * @param string|null $text Optional footer that should appear within the attachment.
     */
    public function setFooter($footer = null)
    {
        $this->footer = $footer;
    }

    /**
     * @return string|null Optional footer that should appear within the attachment.
     */
    public function getFooter()
    {
        return $this->footer;
    }
}
