<?php
namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
#[ORM\Table(name: 'contact')]
class Contact
{
    /**
     * ID
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    /**
     * Superior
     */
    #[Ignore]
    #[ORM\ManyToOne(targetEntity: Contact::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'RESTRICT')]
    private ?Contact $superior;


    /**
     * First Name
     */
    #[ORM\Column(name: "first_name", length: 160)]
    private string $firstName;


    /**
     * Middle Name
     */
    #[ORM\Column(name: "middle_name", length: 160)]
    private string $middleName;


    /**
     * Last Name
     */
    #[ORM\Column(name: "last_name", length: 160)]
    #[Assert\NotBlank]
    private string $lastName;


    /**
     * Email
     */
    #[ORM\Column(length: 180)]
    #[Assert\Email]
    private string $email;


    /**
     * Dial Number
     */
    #[ORM\Column(name: "dial_number", type: Types::INTEGER, options: [ 'default' => 420 ])]
    private int $dialNumber = 0;


    /**
     * Phone Number
     */
    #[ORM\Column(name: "phone_number", length: 9)]
    private string $phoneNumber;


    /**
     * Realized Calls
     */
    #[ORM\OneToMany(targetEntity: Call::class, mappedBy: "receiver")]
    private Collection $calls;


    /**
     * Meetings
     */
    #[ORM\ManyToMany(targetEntity: Meeting::class, mappedBy: 'participants')]
    private Collection $meetings;


    /**
     * @param ?Contact superior
     * @param string firstName
     * @param string middleName
     * @param string lastName
     * @param int dialNumber
     * @param string phoneNumber
     * @param string email
     */
    public function __construct(
        ?Contact $superior, 
        string $firstName, 
        string $middleName, 
        string $lastName, 
        int $dialNumber, 
        string $phoneNumber, 
        string $email
    ) {
        $this->superior = $superior;
        $this->hydrate($firstName, $middleName, $lastName, $dialNumber, $phoneNumber, $email);
    }


    /**
     * @param string firstName
     * @param string middleName
     * @param string lastName
     * @param int dialNumber
     * @param string phoneNumber
     * @param string email
     */
    public function hydrate(string $firstName, string $middleName, string $lastName, int $dialNumber, string $phoneNumber, string $email)
    {
        $this->firstName = $firstName;
        $this->middleName = $middleName;
        $this->lastName = $lastName;
        $this->dialNumber = $dialNumber;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
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
     * First Name
     * 
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }


    /**
     * Middle Name
     * 
     * @return string
     */
    public function getMiddleName(): string
    {
        return $this->middleName;
    }


    /**
     * Last Name
     * 
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
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
     * Superior
     * 
     * @return ?Contact
     */
    public function getSuperior(): ?Contact
    {
        return $this->superior;
    }


    /**
     * Dial Number
     * 
     * @return int
     */
    public function getDialNumber(): int
    {
        return $this->dialNumber;
    }


    /**
     * Phone Number
     * 
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }


    /**
     * Realized Calls
     * 
     * @return Collection<Call>
     */
    public function getCalls(): Collection
    {
        return $this->calls;
    }


    /**
     * Meetings
     * 
     * @return Collection<Meeting>
     */
    public function getMeetings(): Collection
    {
        return $this->meetings;
    }

}
