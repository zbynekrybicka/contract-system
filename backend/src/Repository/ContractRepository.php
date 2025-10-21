<?php

namespace App\Repository;

use App\Entity\Contract;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ContractRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contract::class);
    }


    public function findOne(int $id): ?array
    {
        $row = $this->db->executeQuery(
            'SELECT * FROM %TableName% WHERE id = :id',
            ['id' => $id],
            ['id' => \PDO::PARAM_INT]
        )->fetchAssociative();

        return $row ?: null;
    }

    public function newContract(): Contract
    {
        return new Contract();
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
