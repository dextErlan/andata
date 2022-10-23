<?php

namespace Tests\Integration\Controller\Action;

use Laminas\Diactoros\ServerRequestFactory;
use Tests\TestCase;

class CommentCreateActionTest extends TestCase
{
    public function testCreateComment()
    {
        $httpKernel = $this->getHttpKernel();

        $request = ServerRequestFactory::fromGlobals(
            [
                'REQUEST_METHOD' => 'POST',
                'REQUEST_URI' => '/comment'
            ],
            [],
            [
                'username' => 'My Name',
                'email' => 'first@user.test',
                'commentTitle' => 'Comment title!',
                'commentText' => 'Comment text.'
            ]);
        $response = $httpKernel->handle($request);

        $this->assertJson($response->getBody());
    }
}