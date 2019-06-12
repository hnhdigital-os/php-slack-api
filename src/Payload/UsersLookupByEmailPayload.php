<?php
/**
 * @author  nediam
 * @date    2019-06-12 22:05
 */

declare(strict_types=1);

namespace CL\Slack\Payload;


class UsersLookupByEmailPayload extends AbstractPayload
{
    /** @var string */
    private $email;

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getMethod()
    {
        return 'users.lookupByEmail';
    }
}
