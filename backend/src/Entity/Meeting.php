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
#[ORM\Table(name: 'meeting')]
final class Meeting
{
    /**
     * ID
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    /**
     * Appointment
     */
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $appointment;


    /**
     * Place
     */
    #[ORM\Column(length: 160)]
    #[Assert\NotBlank]
    private string $place;


    /**
     * Participants
     */
    #[ORM\ManyToMany(targetEntity: Contact::class)]
    #[ORM\JoinTable(name: 'contact_meeting')]
    #[ORM\JoinColumn(name: 'meeting_id', referencedColumnName: 'id', onDelete: 'RESTRICT')]
    #[ORM\InverseJoinColumn(name: 'contact_id', referencedColumnName: 'id', onDelete: 'RESTRICT')]
    private Collection $participants;


    /**
     * @param Contact[] participants
     * @param \DateTimeImmutable appointment
     * @param string place
     */
    public function __construct(
        array $participants, 
        \DateTimeImmutable $appointment, 
        string $place
    ) {
        $this->participants = new ArrayCollection($participants);
        $this->appointment = $appointment;
        $this->place = $place;
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
     * Appointment
     * 
     * @return \DateTimeImmutable
     */
    public function getAppointment(): \DateTimeImmutable 
    {
        return $this->appointment;
    }


    /**
     * Place
     * 
     * @return string
     */
    public function getPlace(): string 
    {
        return $this->place;
    }


    /**
     * Participants
     * 
     * @return Collection<Contact>
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }


    /**
     * Participantd ID
     * Helper
     * 
     * @return int[]
     */
    public function getParticipantIds(): array {
        return array_map(fn($p) => $p->getId(), $this->participants->toArray());
    }

}
