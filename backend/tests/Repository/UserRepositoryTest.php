<?php
namespace App\Tests\Repository;

use App\Entity\UserEntity;
use App\Repository\UserRepository;

final class UserRepositoryTest extends DatabaseTestCase
{
    /**
     * @dataProvider dataFindByEmail
     */
    public function testFindByEmail(string $email, bool $exists): void
    {
        /** @var UserRepository $userRepository */
        $userRepository = static::getContainer()->get(UserRepository::class);

        /** @var UserEntity $user */
        $user = $userRepository->findByEmail($email);

        // Final check
        if ($exists) {
            $this->assertNotNull($user);
            $this->assertSame($email, $user->getEmail());
        } else {
            $this->assertNull($user);
        }
    }

    public static function dataFindByEmail(): array
    {
        return [
            ["test@demo.cz", true],
            ["a@b.cz", false]
        ];
    }


    /**
     * @dataProvider dataFind
     */
    public function testFind(int $id, int $contactId): void
    {
        /** @var UserRepository $userRepository */
        $userRepository = static::getContainer()->get(UserRepository::class);

        /** @var User $user */
        $user = $userRepository->find($id);

        // Final check
        // $this->assertNotNull();
        $this->assertSame($user->getId(), $id);
        $this->assertSame($user->getContact()->getId(), $contactId);
    }

    public static function dataFind(): array
    {
        return [
            [ 1, 1 ]
        ];
    }

}