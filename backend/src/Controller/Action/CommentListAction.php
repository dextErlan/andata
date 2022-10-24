<?php

namespace App\Controller\Action;

use Doctrine\ORM\EntityManagerInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CommentListAction implements RequestHandlerInterface
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $comments = $this->entityManager->getRepository('App\Entity\Comment')->findAll();

        return new JsonResponse(
            array_map(
                function($comment) {
                    return [
                        'username' => $comment->getUsername(),
                        'email' => $comment->getEmail()->getEmail(),
                        'commentTitle' => $comment->getTitle(),
                        'commentText' => $comment->getText(),
                        'created' => $comment->getCreated()->format('Y-m-d H:i:s'),
                    ];
                },
                $comments
            )
        );
    }
}