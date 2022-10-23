<?php

namespace App\Entity\ValueObject;

use App\Exception\InvalidEmailException;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;

#[Embeddable]
class Email
{
    #[Column(type: "string")]
    private string $email;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            throw new InvalidEmailException(sprintf("Не верный Email %s", $email));
        }

        $this->email = $email;

        return $this;
    }
}