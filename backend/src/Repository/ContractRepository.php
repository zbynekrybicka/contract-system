<?php

namespace App\Repository;

use App\Entity\Contract;
use App\Entity\Contact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ContractRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contract::class);
    }


    /**
     * @param Contact client
     * @param int price
     * @return Contract
     */
    public function create(Contact $client, int $price): Contract
    {
        $contract = new Contract($client, $price);
        $this->persistContract($contract);
        return $contract;
    }

    public function persistContract(Contract $item)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($item);
        $entityManager->flush();
    }

    public function deleteContract(Contract $item)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($item);
        $entityManager->flush();
    }

}
