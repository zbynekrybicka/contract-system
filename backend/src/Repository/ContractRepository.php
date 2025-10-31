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
     * @param Contact salesman
     * @param Contract[]
     */
    public function findBySalesman(Contact $salesman): array
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->select("contract")
            ->from(Contract::class, "contract")
            ->andWhere("contract.salesman = :salesman")
            ->setParameter("salesman", $salesman)
            ->getQuery()->getResult();
    }



    /**
     * @param Contact salesman
     * @param Contact client
     * @param int price
     * @return Contract
     */
    public function create(Contact $salesman, Contact $client, int $price): Contract
    {
        $contract = new Contract($salesman, $client, $price);
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
