<?php
namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{
    /**
     * @dataProvider dataCreate
     */
    public function testCreate($email): void
    {
        $user = new User($email);
        $this->assertSame($email, $user->getEmail());
    }

    
    public static function dataCreate(): array
    {
        return [
            ["a@b.cz"]
        ];
    }


    /**
     * @dataProvider dataSetPassword
     */
    public function testSetPassword($email, $password): void
    {
        $user = new User($email);
        $this->assertSame($email, $user->getEmail());
        $user->setPassword($password);
        $this->assertTrue($user->verifyPassword($password));
    }

    public static function dataSetPassword(): array
    {
        return [
            ["a@b.cz", "myPassword12345"]
        ];
    }
}
