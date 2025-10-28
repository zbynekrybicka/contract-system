<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'user')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class User implements UserInterface
{
    /**
     * ID
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    /**
     * Email
     */
    #[ORM\Column(length: 180)]
    private string $email;


    /**
     * Password
     */
    #[ORM\Column]
    private ?string $password = null;


    /**
     * Contact
     */
    #[ORM\ManyToOne(targetEntity: Contact::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'RESTRICT')]
    private Contact $contact;


    /**
     * Contact is absolutely necessary
     * 
     * @param Contact $contact
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
        $this->email = $contact->getEmail();
    }


    /**
     * ID
     * 
     * @return ?int
     */
    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * Email
     * 
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }


    /**
     * Contact
     * 
     * @return Contact
     */
    public function getContact(): Contact
    {
        return $this->contact;
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


    /**
     * Roles
     * Data for Auth Token
     * 
     * @return string[]
     */
    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }


    /**
     * ID
     * Data for Auth Token
     * 
     * @return string
     */
    public function getUserIdentifier(): string
    {
        return strval($this->getId());
    }


    /**
     * 
     */
    public function eraseCredentials(): void {}

}
