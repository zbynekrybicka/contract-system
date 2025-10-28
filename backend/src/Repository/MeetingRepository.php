<?php

namespace App\Repository;

use App\Entity\Meeting;
use App\Entity\Contact;
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


    public function findByContact(Contact $contact): array
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->select("meeting")
            ->from(Meeting::class, "meeting")
            ->andWhere(":contact MEMBER OF meeting.participants")
            ->setParameter("contact", $contact)
            ->getQuery()->getResult();
    }

    public function getCountByParticipant(Contact $participant): int
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->select("COUNT(DISTINCT meeting.id)")
            ->from(Meeting::class, "meeting")
            ->andWhere(":participant MEMBER OF meeting.participants")
            ->setParameter("participant", $participant)
            ->getQuery()->getSingleScalarResult();
    }

    public function create(array $participants, \DateTimeImmutable $appointment, string $place): Meeting
    {
        $meeting = new Meeting($participants, $appointment, $place);
        $this->persistMeeting($meeting);
        return $meeting;
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
