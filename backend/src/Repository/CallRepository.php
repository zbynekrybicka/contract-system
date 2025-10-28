<?php

namespace App\Repository;

use App\Entity\Call;
use App\Entity\Contact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CallRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Call::class);
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


    public function getCountBySender(Contact $sender): int
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->select("COUNT(DISTINCT call.id)")
            ->from(Call::class, "call")
            ->andWhere("call.sender = :sender")
            ->setParameter("sender", $sender)
            ->getQuery()->getSingleScalarResult();
    }

    public function create(Contact $sender, Contact $receiver, string $purpose, bool $successful, string $type, string $description, ?\DateTime $nextCall): Call
    {
        $call = new Call($sender, $receiver, $purpose, $successful, $type, $description, $nextCall);
        $this->persistCall($call);
        return $call;
    }

    public function persistCall(Call $item)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($item);
        $entityManager->flush();
    }

    public function deleteCall(Call $item)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($item);
        $entityManager->flush();
    }


}
