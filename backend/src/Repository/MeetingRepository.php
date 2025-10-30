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


    /**
     * Find Meeting By Contact
     * @param Contact contact
     * @return Contact[]
     */
    public function findByContact(Contact $contact): array
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->select("meeting")
            ->from(Meeting::class, "meeting")
            ->andWhere(":contact MEMBER OF meeting.participants")
            ->setParameter("contact", $contact)
            ->getQuery()->getResult();
    }


    /**
     * Get Count of Meetings By Participant
     * @param Contact participant
     * @return int
     */
    public function getCountByParticipant(Contact $participant): int
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->select("COUNT(DISTINCT meeting.id)")
            ->from(Meeting::class, "meeting")
            ->andWhere(":participant MEMBER OF meeting.participants")
            ->setParameter("participant", $participant)
            ->getQuery()->getSingleScalarResult();
    }


    /**
     * Find By ID and Participant
     * @param int id
     * @param Contact participant
     * @return ?Meeting
     */
    public function findByIdAndParticipant(int $id, Contact $participant): ?Meeting
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->select("meeting")
            ->from(Meeting::class, "meeting")
            ->andWhere("meeting.id = :id")
            ->andWhere(":participant MEMBER OF meeting.participants")
            ->setParameter("id", $id)
            ->setParameter("participant", $participant)
            ->getQuery()->getOneOrNullResult();
    }


    /**
     * Create Meeting
     * @param Contact[] participants
     * @param string appointment
     * @param string place
     * @return Meeting
     */
    public function create(array $participants, string $appointment, string $place): Meeting
    {
        $meeting = new Meeting($participants, new \DateTimeImmutable($appointment), $place);
        $this->persistMeeting($meeting);
        return $meeting;
    }

    
    /**
     * Persist Meeting
     * @param Meeting item
     */
    public function persistMeeting(Meeting $item)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($item);
        $entityManager->flush();
    }

    
    /**
     * Delete Meeting
     * @param Meeting item
     */
    public function deleteMeeting(Meeting $item)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($item);
        $entityManager->flush();
    }

}
