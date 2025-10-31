<?php
namespace App\Entity;

use App\Entity\Contact;
use App\Repository\ContractRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ContractRepository::class)]
#[ORM\Table(name: 'contract')]
final class Contract
{
    /**
     * ID
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    /**
     * Salesman
     */
    #[ORM\ManyToOne(targetEntity: Contact::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'RESTRICT')]
    private Contact $salesman;


    /**
     * Client
     */
    #[ORM\ManyToOne(targetEntity: Contact::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'RESTRICT')]
    private Contact $client;


    /**
     * Price
     */
    #[ORM\Column(type: Types::INTEGER, options: ['default' => 0])]
    private int $price = 0;


    /**
     * Paid
     */
    #[ORM\Column(type: Types::BOOLEAN, options: ['default' => false])]
    private bool $paid = false;

    
    /**
     * @param Contact salesman
     * @param Contact client
     * @param int price
     */
    public function __construct(Contact $salesman, Contact $client, int $price)
    {
        $this->salesman = $salesman;
        $this->client = $client;
        $this->price = $price;
    }


    /**
     * @param int price
     * @param bool paid
     */
    public function setPriceAndPaid(int $price, bool $paid)
    {
        $this->price = $price;
        $this->paid = $paid;
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
     * Salesman
     * 
     * @return Contact
     */
    public function getSalesman(): Contact
    {
        return $this->salesman;
    }


    /**
     * Client
     * 
     * @return Contact
     */
    public function getClient(): Contact
    {
        return $this->client;
    }


    /**
     * Price
     * 
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }


    /**
     * Paid
     * 
     * @return bool
     */
    public function getPaid(): bool
    {
        return $this->paid;
    }


}
