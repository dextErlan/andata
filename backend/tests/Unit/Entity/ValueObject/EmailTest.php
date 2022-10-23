<?php

namespace Tests\Unit\Entity\ValueObject;

use App\Entity\ValueObject\Email;
use App\Exception\InvalidEmailException;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    public function testValidEmail()
    {
        $emailStr = 'example@site.com';
        $email = new Email();

        $email->setEmail($emailStr);

        $this->assertEquals($emailStr, $email->getEmail());
    }

    public function testNotValidEmail()
    {
        $emailStr = 'example.site.com';
        $email = new Email();

        $this->expectException(InvalidEmailException::class);

        $email->setEmail($emailStr);
    }
}