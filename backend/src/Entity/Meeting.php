<?php
namespace App\Entity;

use App\Repository\MeetingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: MeetingRepository::class)]
#[ORM\Table(
    name: 'meeting',
    // indexes: [new ORM\Index(name: 'idx_%TableName%_%Column%', columns: ['%Column%'])],
    // uniqueConstraints: [new ORM\UniqueConstraint(name: 'uniq_%TableName%_%Column%', columns: ['%Column%'])]
)]
// #[UniqueEntity(fields: ['%Column%'], message: '%Column% already used.')]
// #[ORM\HasLifecycleCallbacks]
final class Meeting
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $appointment;

    #[ORM\Column(length: 160)]
    #[Assert\NotBlank]
    private string $place;

    #[ORM\ManyToMany(targetEntity: Contact::class)]
    #[ORM\JoinTable(name: 'contact_meeting')]
    #[ORM\JoinColumn(name: 'meeting_id', referencedColumnName: 'id', onDelete: 'RESTRICT')]
    #[ORM\InverseJoinColumn(name: 'contact_id', referencedColumnName: 'id', onDelete: 'RESTRICT')]
    private Collection $participants;

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

    public function __construct(array $participants, \DateTimeImmutable $appointment, string $place)
    {
        $this->participants = new ArrayCollection($participants);
        $this->appointment = $appointment;
        $this->place = $place;
        // $this->%Column% = new \DateTimeImmutable();
        // $this->%Column% = new ArrayCollection();
    }

    // ---- OnUpdate
    /*#[ORM\PreUpdate]
    public function touchUpdatedAt(): void { 
        $this->updatedAt = new \DateTime();
    }
    */

    public function getId(): ?int
    {
        return $this->id; 
    }


    public function getAppointment(): \DateTimeImmutable 
    {
        return $this->appointment;
    }


    public function getPlace(): string 
    {
        return $this->place;
    }


    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function getParticipantIds(): array {
        return array_map(fn($p) => $p->getId(), $this->participants->toArray());
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
