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
#[ORM\Table(name: 'realized_call')]
final class Call
{
    /**
     * ID
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['contact:read'])]
    private ?int $id = null;


    /**
     * Sender
     */
    #[ORM\ManyToOne(targetEntity: Contact::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'RESTRICT')]
    #[Groups(['contact:read'])]
    private Contact $sender;

 
   /**
     * Receiver
     */
    #[ORM\ManyToOne(targetEntity: Contact::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'RESTRICT')]
    #[Groups(['contact:read'])]
    private Contact $receiver;

 
    /**
     * Purpose of Call
     */
    #[ORM\Column(name: "purpose", type: Types::TEXT, nullable: false)]
    #[Groups(['contact:read'])]
    private string $purpose = "";

 
    /**
     * Realized At
     */
    #[ORM\Column(name: "realized_at", type: Types::DATETIME_IMMUTABLE)]
    #[Groups(['contact:read'])]
    private \DateTimeImmutable $realizedAt;

 
    /**
     * Call was Successful
     */
    #[ORM\Column(name: "successful", type: "boolean", nullable: false, options: ['default' => 0])]
    #[Groups(['contact:read'])]
    private bool $successful = false;

 
    /**
     * Type of result
     */
    #[Column(name: "result_type", type: "string", columnDefinition: "ENUM('meeting', 'rejected', 'postponed')")]
    #[Assert\NotBlank]
    #[Groups(['contact:read'])]
    private string $type;

 
    /**
     * Description of result
     */
    #[ORM\Column(name: "description", type: Types::TEXT, nullable: true)]
    #[Groups(['contact:read'])]
    private string $description = "";

 
    /**
     * Next time of Call 
     */
    #[ORM\Column(name: "next_call", type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['contact:read'])]
    private ?\DateTime $nextCall = null;


 
    public function __construct(
        Contact $sender, 
        Contact $receiver, 
        string $purpose, 
        bool $successful, 
        string $type, 
        string $description, 
        ?\DateTime $nextCall
    ) {
        $this->realizedAt = new \DateTimeImmutable();
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->purpose = $purpose;
        $this->successful = $successful;
        $this->type = $type;
        $this->description = $description;
        $this->nextCall = $nextCall;
    }

    
    /**
     * ID
     * 
     * @return ?int
     */
    public function getId(): ?int { 
        return $this->id; 
    }


    /**
     * Purpose
     * 
     * @return string
     */
    public function getPurpose(): string
    {
        return $this->purpose;
    }


    /**
     * Realized At
     * 
     * @return \DateTimeImmutable
     */
    public function getRealizedAt(): \DateTimeImmutable
    {
        return $this->realizedAt;
    }


    /**
     * Receiver
     * 
     * @return Contact
     */
    public function getReceiver(): Contact
    {
        return $this->receiver;
    }


    /**
     * Call Is Successful
     * 
     * @return bool
     */
    public function isSuccessful(): bool
    {
        return $this->successful;
    }


    /**
     * Type of result
     * 
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }


    /**
     * Description of result
     * 
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }


    /**
     * Time of Next Call
     * 
     * @return ?\DateTime
     */
    public function getNextCall(): ?\DateTime
    {
        return $this->nextCall;
    }

}
