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
     * Create Meeting
     * @param Contact[] participants
     * @param \DateTimeImmutable appointment
     * @param string place
     * @return Meeting
     */
    public function create(array $participants, \DateTimeImmutable $appointment, string $place): Meeting
    {
        $meeting = new Meeting($participants, $appointment, $place);
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
