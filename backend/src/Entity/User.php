<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
final class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private string $email;

    #[ORM\Column]
    private ?string $password = null;


    /**
     * Email is absolutely necessary
     * 
     * @param string $email
     */
    public function __construct(string $email)
    {
        $this->email = $email;
    }


    /**
     * 
     * @return ?int
     */
    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * 
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }


    /**
     * Save password hash
     * Not only plain-text
     * 
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT, ["cost" => 13]);
    }


    /**
     * Only verify password
     * Original password in plain-text is not available
     * 
     * @param string $password
     * @return bool
     */
    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->password);
    }

}
