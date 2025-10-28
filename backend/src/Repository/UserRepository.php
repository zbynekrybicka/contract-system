<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{

    private $jwtManager;
    private $tokenStorage;

    public function __construct(ManagerRegistry $registry, JWTTokenManagerInterface $jwtManager, TokenStorageInterface $tokenStorage)
    {
        parent::__construct($registry, User::class);
        $this->jwtManager = $jwtManager;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }



    /**
     * Find By Token
     * @return ?User
     */
    public function findByToken(): ?User {
        $token = $this->tokenStorage->getToken();
        $decodedToken = $this->jwtManager->decode($token);
        $userId = $decodedToken['username'];
        return $this->find($userId);
    }


    /**
     * Find By Email
     * @param string email
     * @return ?User
     */
    public function findByEmail(string $email): ?User
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->select("u")
            ->from("\App\Entity\User", "u")
            ->andWhere('u.email = :email')
            ->setParameter("email", $email)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

}
