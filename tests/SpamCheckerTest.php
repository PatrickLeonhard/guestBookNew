<?php

namespace App\Tests;

use App\Entity\Comment;
use App\SpamChecker;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Contracts\HttpClient\ResponseInterface;

class SpamCheckerTest extends TestCase
{
   public function testSpamScoreWithInvalidRequest(): void
   {
       $comment = new Comment();
       $comment->setCreatedAtValue();
       $context = [];

       $client = new MockHttpClient([new MockResponse('invalid', ['response_headers' => ['x-akismet-debug-help: Invalid key']])]);
       $checker = new SpamChecker($client, 'abcde');

       $this->expectException(\RuntimeException::class);
       $this->expectExceptionMessage('Unable to check for spam: invalid (Invalid key).');
       $checker->getSpamScore($comment, $context);
   }

   public function testSpamScore(int $expectedScore, ResponseInterface $response, Comment $comment, array $context): void
   {

   }
}
