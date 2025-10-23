<?php
namespace App\Entity;

use App\Repository\CallRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: CallRepository::class)]
#[ORM\Table(
    name: 'realized_call',
    // indexes: [new ORM\Index(name: 'idx_%TableName%_%Column%', columns: ['%Column%'])],
    // uniqueConstraints: [new ORM\UniqueConstraint(name: 'uniq_%TableName%_%Column%', columns: ['%Column%'])]
)]
// #[UniqueEntity(fields: ['%Column%'], message: '%Column% already used.')]
// #[ORM\HasLifecycleCallbacks]
final class Call
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\ManyToOne(targetEntity: Contact::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'RESTRICT')]
    private Contact $sender;

    #[ORM\ManyToOne(targetEntity: Contact::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'RESTRICT')]
    private Contact $receiver;

    #[ORM\Column(name: "purpose", type: Types::TEXT, nullable: false)]
    private string $purpose = "";

    #[ORM\Column(name: "realized_at", type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $realizedAt;

    #[ORM\Column(name: "successful", type: "boolean", nullable: false, options: ['default' => 0])]
    private bool $successful = false;

    #[Column(name: "result_type", type: "string", columnDefinition: "ENUM('meeting', 'rejected', 'postponed')")]
    #[Assert\NotBlank]
    private string $type;

    #[ORM\Column(name: "description", type: Types::TEXT, nullable: true)]
    private string $description = "";

    #[ORM\Column(name: "next_call", type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTime $nextCall = null;

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

    public function __construct(Contact $sender, Contact $receiver, string $purpose, bool $successful, string $type, string $description, ?\DateTime $nextCall)
    {
        $this->realizedAt = new \DateTimeImmutable();
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->purpose = $purpose;
        $this->successful = $successful;
        $this->type = $type;
        $this->description = $description;
        $this->nextCall = $nextCall;
    }

    // ---- OnUpdate
    /*#[ORM\PreUpdate]
    public function touchUpdatedAt(): void { 
        $this->updatedAt = new \DateTime();
    }
    */

    public function getId(): ?int { 
        return $this->id; 
    }


    public function getRealizedAt(): \DateTimeImmutable
    {
        return $this->realizedAt;
    }


    public function getReceiver(): Contact
    {
        return $this->receiver;
    }


    public function isSuccessful(): bool
    {
        return $this->successful;
    }


    public function getType(): string
    {
        return $this->type;
    }


    public function getDescription(): string
    {
        return $this->description;
    }


    public function getNextCall(): ?\DateTimeImmutable
    {
        return $this->nextCall;
    }


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
