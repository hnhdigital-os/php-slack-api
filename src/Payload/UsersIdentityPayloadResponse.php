<?php

/*
 * This file is part of the Slack API library.
 *
 * (c) Rocco Howard <rocco@hnh.digital>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CL\Slack\Payload;

/**
 * @author Rocco Howard <rocco@hnh.digital>
 *
 * @link Official documentation at https://api.slack.com/methods/users.identity
 */
class UsersIdentityPayloadResponse extends AbstractPayloadResponse
{
    /**
     * @var User[]
     */
    private $user;

    /**
     * @var Team[]
     */
    private $team;

    /**
     * @return User|null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return User[Id]|null
     */
    public function getUserId()
    {
        return $this->user['id'];
    }

    /**
     * @return User[Name]|null
     */
    public function getUserName()
    {
        return $this->user['name'];
    }

    /**
     * @return User[Email]|null
     */
    public function getUserEmail()
    {
        return isset($this->user['email']) ? $this->user['email'] : '';
    }

    /**
     * @return User[Image_*]|null
     */
    public function getUserAvatar($size)
    {
        return isset($this->user['image_' . $size]) ? $this->user['image_' . $size] : '';
    }

    /**
     * @return User[Image_24]|null
     */
    public function getUserAvatar24()
    {
        return $this->getUserAvatar(24);
    }

    /**
     * @return User[Image_32]|null
     */
    public function getUserAvatar32()
    {
        return $this->getUserAvatar(32);
    }

    /**
     * @return User[Image_48]|null
     */
    public function getUserAvatar48()
    {
        return $this->getUserAvatar(48);
    }

    /**
     * @return User[Image_72]|null
     */
    public function getUserAvatar72()
    {
        return $this->getUserAvatar(72);
    }

    /**
     * @return User[Image_192]|null
     */
    public function getUserAvatar192()
    {
        return $this->getUserAvatar(192);
    }

    /**
     * @return Team|null
     */
    public function getTeam()
    {
        return $this->user;
    }

    /**
     * @return Team[Id]|null
     */
    public function getTeamId()
    {
        return $this->team['id'];
    }

    /**
     * @return Team[Name]|null
     */
    public function getTeamName()
    {
        return isset($this->team['name']) ? $this->team['name'] : '';
    }
}
