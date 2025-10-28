<?php
namespace App\Tests\Entity;

use App\Entity\User;
use App\Entity\Contact;
use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{

    /**
     * @dataProvider dataSetPassword
     */
    public function testSetPassword($firstName, $middleName, $lastName, $dialNumber, $phoneNumber, $email, $password): void
    {
        $contact = new Contact(null, $firstName, $middleName, $lastName, $dialNumber, $phoneNumber, $email);
        $user = new User($contact);
        $this->assertSame($email, $user->getEmail());
        $user->setPassword($password);
        $this->assertTrue($user->verifyPassword($password));
    }

    public static function dataSetPassword(): array
    {
        return [
            ["Zbynek", "Kossai", "Rybicka", 420, "727815483", "a@b.cz", "myPassword12345"]
        ];
    }
}
