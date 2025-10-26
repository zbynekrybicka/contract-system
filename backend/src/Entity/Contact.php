<?php
namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
#[ORM\Table(
    name: 'contact',
    // indexes: [new ORM\Index(name: 'idx_%TableName%_%Column%', columns: ['%Column%'])],
    // uniqueConstraints: [new ORM\UniqueConstraint(name: 'uniq_%TableName%_%Column%', columns: ['%Column%'])]
)]
// #[UniqueEntity(fields: ['%Column%'], message: '%Column% already used.')]
// #[ORM\HasLifecycleCallbacks]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Ignore]
    #[ORM\ManyToOne(targetEntity: Contact::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'RESTRICT')]
    private ?Contact $superior;

    #[ORM\Column(name: "first_name", length: 160)]
    private string $firstName;

    #[ORM\Column(name: "middle_name", length: 160)]
    private string $middleName;

    #[ORM\Column(name: "last_name", length: 160)]
    #[Assert\NotBlank]
    private string $lastName;

    #[ORM\Column(length: 180)]
    #[Assert\Email]
    private ?string $email;

    #[ORM\Column(name: "dial_number", type: Types::INTEGER, options: [ 'default' => 420 ])]
    private int $dialNumber = 0;

    #[ORM\Column(name: "phone_number", length: 9)]
    private string $phoneNumber;

    #[ORM\OneToMany(targetEntity: Call::class, mappedBy: "receiver")]
    #[ORM\JoinColumn(onDelete: 'RESTRICT')]
    private Collection $calls;

    #[ORM\ManyToMany(targetEntity: Meeting::class)]
    #[ORM\JoinTable(name: 'contact_meeting')]
    #[ORM\JoinColumn(name: 'contact_id', referencedColumnName: 'id', onDelete: 'RESTRICT')]
    #[ORM\InverseJoinColumn(name: 'meeting_id', referencedColumnName: 'id', onDelete: 'RESTRICT')]
    private Collection $meetings;


    public function __construct(?Contact $superior, string $firstName, string $middleName, string $lastName, int $dialNumber, string $phoneNumber, string $email = "")
    {
        $this->superior = $superior;
        $this->hydrate($firstName, $middleName, $lastName, $dialNumber, $phoneNumber, $email);
    }


    public function hydrate(string $firstName, string $middleName, string $lastName, int $dialNumber, string $phoneNumber, string $email = "")
    {
        $this->firstName = $firstName;
        $this->middleName = $middleName;
        $this->lastName = $lastName;
        $this->dialNumber = $dialNumber;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
    }


    public function getId(): ?int { 
        return $this->id; 
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getMiddleName(): string
    {
        return $this->middleName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getSuperior(): ?Contact
    {
        return $this->superior;
    }

    public function getDialNumber(): int
    {
        return $this->dialNumber;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function getCalls(): Collection
    {
        return $this->calls;
    }

    public function getMeetings(): Collection
    {
        return $this->meetings;
    }


    // ---- required field (string with length)
    /*#[ORM\Column(length: 160)]
    #[Assert\NotBlank]
    private string $%Column%;
    */

    // ---- unique email
    /*#[ORM\Column(length: 180, unique: true)]
    #[Assert\NotBlank, Assert\Email]
    private string $email;
    */

    // ---- optional field (TEXT)
    /*#[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $note = null;
    */

    // ---- number field
    /*#[ORM\Column(type: Types::INTEGER, options: ['default' => 0])]
    private string $%column% = 0;
    */

    // ---- date/time
    /*#[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $%Column%;
    */
    
    /*#[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTime $updatedAt = null;
    */

    // ---- relation ManyToOne
    /*#[ORM\ManyToOne(targetEntity: %ForeignEntityName%::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'RESTRICT')]
    private %ForeignEntityName% $%Column%;
    */

    // ---- relation ManyToMany
    /*#[ORM\ManyToMany(targetEntity: %ForeignEntityName%::class)]
    #[ORM\JoinTable(name: '%ForeignTableName%')]
    #[ORM\JoinColumn(name: '%ForeignColumn%', referencedColumnName: 'id', onDelete: 'RESTRICT')]
    #[ORM\InverseJoinColumn(name: '%Column%', referencedColumnName: 'id', onDelete: 'RESTRICT')]
    private Collection $tags;
    */

    // ---- OnUpdate
    /*#[ORM\PreUpdate]
    public function touchUpdatedAt(): void { 
        $this->updatedAt = new \DateTime();
    }
    */

    /*
    public function get%ForeignEntityName%s(): array 
    { 
        return $this->%Column%->toArray(); 
    }
    */

    /*
    public function add%ForeignEntityName%(%ForeignEntityName% $item): void { 
        if (!$this->%Column%->contains($item)) {
            $this->%Column%->add($item);
        }
    }
    */

    /*
    public function remove%ForeignEntityName%(%ForeignEntityName% $item): void { 
        $this->%Column%->removeElement($item); 
    }
    */
}
