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

use CL\Slack\Payload\PayloadResponseInterface;
use CL\Slack\Payload\SearchAllPayloadResponse;

/**
 * @author Cas Leentfaar <info@casleentfaar.com>
 */
class SearchAllPayloadResponseTest extends AbstractPayloadResponseTestCase
{
    /**
     * @inheritdoc
     */
    public function createResponseData()
    {
        return [
            'files' => $this->createFileResult(),
            'messages' => $this->createMessageResult(),
        ];
    }

    /**
     * @inheritdoc
     *
     * @param array                    $responseData
     * @param SearchAllPayloadResponse $payloadResponse
     */
    protected function assertResponse(array $responseData, PayloadResponseInterface $payloadResponse)
    {
        $fileResult = $payloadResponse->getFileResult();
        $messageResult = $payloadResponse->getMessageResult();

        self::assertInstanceOf(\CL\Slack\Model\FileResult::class, $fileResult);
        self::assertInstanceOf(\CL\Slack\Model\MessageResult::class, $messageResult);
        self::assertCount(1, $fileResult->getMatches());
        self::assertCount(1, $messageResult->getMatches());

        foreach ($fileResult->getMatches() as $x => $file) {
            $this->assertFileResultItem($responseData['files']['matches'][$x], $file);
        }

        foreach ($messageResult->getMatches() as $x => $message) {
            $this->assertMessageResultItem($responseData['messages']['matches'][$x], $message);
        }
    }
}
