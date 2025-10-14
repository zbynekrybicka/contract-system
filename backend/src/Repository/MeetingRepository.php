<?php

namespace App\Repository;

use App\Entity\Meeting;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MeetingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Meeting::class);
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

    public function newMeeting(): Meeting
    {
        return new Meeting();
    }

    public function persistMeeting(Meeting $item)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($item);
        $entityManager->flush();
    }

    public function deleteMeeting(Meeting $item)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($item);
        $entityManager->flush();
    }

}
