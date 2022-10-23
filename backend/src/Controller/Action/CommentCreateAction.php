<?php

namespace App\Controller\Action;

use App\Entity\Comment;
use App\Entity\ValueObject\Email;
use App\Exception\InvalidEmailException;
use Doctrine\ORM\EntityManagerInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CommentCreateAction implements RequestHandlerInterface
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $parsedBody = $request->getParsedBody();

        if (
            empty($parsedBody['username'])
            || empty($parsedBody['email'])
            || empty($parsedBody['commentTitle'])
            || empty($parsedBody['commentText'])
        ) {
            return new JsonResponse(['error' => ['Не переданы все параметры!']], 400);
        }

        $email = new Email();
        try {
            $email->setEmail($parsedBody['email']);
        } catch (InvalidEmailException $e) {
            return new JsonResponse(['error' => ['Не верный Email!']], 400);
        }

        $comment = new Comment();
        $comment->setUsername($parsedBody['username']);
        $comment->setEmail($email);
        $comment->setTitle($parsedBody['commentTitle']);
        $comment->setText($parsedBody['commentText']);

        $this->entityManager->persist($comment);
        $this->entityManager->flush();

        return new JsonResponse($comment);
    }
}