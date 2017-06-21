<?php

/*
 * This file is part of the Slack API library.
 *
 * (c) Rocco Howard <rocco@hnh.digital>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CL\Slack\Model;

/**
 * @author Rocco Howard <rocco@hnh.digital>
 *
 * @link Official documentation at https://api.slack.com/docs/message-buttons
 */
class ActionConfirm extends AbstractModel
{
    /**
     * The required title for the pop up window.
     *
     * @var string
     */
    protected $title;

    /**
     * The required description.
     *
     * @var string
     */
    protected $text;

    /**
     * The text label for the OK button.
     *
     * @var string
     */
    protected $okText;

    /**
     * The text label for the Cancel button.
     *
     * @var string
     */
    protected $dismissText;

    /**
     * @param string $name
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $text
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
     * @param string $okText
     */
    public function setOkText($okText)
    {
        $this->okText = $okText;

        return $this;
    }

    /**
     * @return string
     */
    public function getOkText()
    {
        return $this->okText;
    }

    /**
     * @param string $dismissText
     */
    public function setDismissText($dismissText)
    {
        $this->dismissText = $dismissText;

        return $this;
    }

    /**
     * @return string
     */
    public function getDismissText()
    {
        return $this->dismissText;
    }
}
