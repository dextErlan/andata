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
        $comments = $this->entityManager->getRepository('Comment')->findAll();

        return new JsonResponse($comments);
    }
}