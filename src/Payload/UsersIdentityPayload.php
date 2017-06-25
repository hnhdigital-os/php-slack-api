<?php

/*
 * This file is part of the Slack API library.
 *
 * (c) Rocco Howard <rocco@hnh.digital
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
class UsersIdentityPayload extends AbstractPayload
{
    /**
     * @var string
     */
    private $token;

    /**
     * Authentication token.
     *
     * @param string $token
     *
     * @return UsersIdentityPayload
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @inheritdoc
     */
    public function getMethod()
    {
        return 'users.identity';
    }
}
