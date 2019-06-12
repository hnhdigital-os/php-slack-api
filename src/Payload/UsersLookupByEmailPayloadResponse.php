<?php
/**
 * @author  nediam
 * @date    2019-06-12 22:05
 */

declare(strict_types=1);

namespace CL\Slack\Payload;


class UsersLookupByEmailPayloadResponse extends AbstractPayloadResponse
{
    /**
     * @var User|null
     */
    private $user;

    /**
     * @return User|null
     */
    public function getUser()
    {
        return $this->user;
    }
}
