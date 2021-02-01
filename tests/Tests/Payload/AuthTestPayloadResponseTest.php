<?php

/*
 * This file is part of the Slack API library.
 *
 * (c) Cas Leentfaar <info@casleentfaar.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CL\Slack\Tests\Payload;

use CL\Slack\Payload\AuthTestPayloadResponse;
use CL\Slack\Payload\PayloadResponseInterface;

/**
 * @author Cas Leentfaar <info@casleentfaar.com>
 */
class AuthTestPayloadResponseTest extends AbstractPayloadResponseTestCase
{
    /**
     * @inheritdoc
     */
    public function createResponseData()
    {
        return [
            'user' => 'acme_user',
            'user_id' => 'U1234567',
            'team' => 'acme_team',
            'team_id' => 'T1234567',
            'url' => 'https://acme.slack.com/user/U1234567',
        ];
    }

    /**
     * @inheritdoc
     *
     * @param array                   $responseData
     * @param AuthTestPayloadResponse $payloadResponse
     */
    protected function assertResponse(array $responseData, PayloadResponseInterface $payloadResponse)
    {
        self::assertEquals($payloadResponse->getUserId(), $responseData['user_id']);
        self::assertEquals($payloadResponse->getUsername(), $responseData['user']);
        self::assertEquals($payloadResponse->getTeamId(), $responseData['team_id']);
        self::assertEquals($payloadResponse->getTeam(), $responseData['team']);
        self::assertEquals($payloadResponse->getUrl(), $responseData['url']);
    }
}
