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

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @author Rocco Howard <rocco@hnh.digital>
 *
 * @link Official documentation at https://api.slack.com/docs/message-buttons
 */
class AttachmentAction extends AbstractModel
{
    const TYPE_BUTTON = 'button';

    const STYLE_DEFAULT = 'default';
    const STYLE_PRIMARY = 'primary';
    const STYLE_DANGER = 'danger';

    /**
     * The required name field of the action. The name will be returned to your Action URL.
     *
     * @var string
     */
    protected $name;

    /**
     * The required label for the action.
     *
     * @var string
     */
    protected $text;

    /**
     * Button style.
     *
     * @var string
     */
    protected $style;

    /**
     * The required type of the action.
     *
     * @var string
     */
    protected $type = self::TYPE_BUTTON;

    /**
     * Optional value. It will be sent to your Action URL.
     *
     * @var string
     */
    protected $value;

    /**
     * Confirmation field.
     *
     * @var AttachmentAction[]|ArrayCollection
     */
    protected $confirm;

    public function __construct()
    {
        $this->confirm = new ArrayCollection();
    }

    /**
     * Make button.
     *
     * @return AttachmentAction
     */
    public function button($text)
    {
        $this->setText($text)
            ->setType(self::TYPE_BUTTON);

        return $this;
    }

    /**
     * Set button.
     *
     * @return AttachmentAction
     */
    public function defaultStyle()
    {
        $this->setStyle(self::STYLE_DEFAULT);

        return $this;
    }

    /**
     * Set button.
     *
     * @return AttachmentAction
     */
    public function primaryStyle()
    {
        $this->setStyle(self::STYLE_PRIMARY);

        return $this;
    }

    /**
     * Set button.
     *
     * @return AttachmentAction
     */
    public function dangerStyle()
    {
        $this->setStyle(self::STYLE_DANGER);

        return $this;
    }

    /**
     * @param string $name
     *
     * @return AttachmentAction
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $text
     *
     * @return AttachmentAction
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
     * @param string $style
     *
     * @return AttachmentAction
     */
    public function setStyle($style)
    {
        $this->style = $style;

        return $this;
    }

    /**
     * @return string
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * @param string $type
     *
     * @return AttachmentAction
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $value
     *
     * @return AttachmentAction
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $confirm
     *
     * @return AttachmentAction
     */
    public function addConfirm(ActionConfirm $confirm)
    {
        $this->confirm->add($confirm);

        return $this;
    }

    /**
     * @return string
     */
    public function getConfirm()
    {
        return $this->confirm;
    }
}
