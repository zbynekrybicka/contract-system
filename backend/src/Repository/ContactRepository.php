<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\Contact;
use App\Entity\Call;
use App\Entity\Meeting;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contact::class);
    }


    /**
     * Get Contacts By Superior
     * @param Contact superior
     * @return Contact[]
     */
    public function getBySuperior(Contact $superior): array
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->select("contact")
            ->from("\App\Entity\Contact", "contact")
            ->andWhere("contact.superior = :superior")
            ->setParameter("superior", $superior)
            ->getQuery()
            ->getResult();
    }


    /**
     * Find One Contact With Superior
     * @param Contact superior
     * @param int contactId
     * @return ?Contact
     */
    public function findWithSuperior(Contact $superior, int $contactId): ?Contact
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->select("contact")
            ->from(Contact::class, "contact")
            ->andWhere("contact.id = :contactId")
            ->andWhere("contact.superior = :superior")
            ->setParameter("contactId", $contactId)
            ->setParameter("superior", $superior)
            ->getQuery()->getOneOrNullResult();
    }


    /**
     * Get Count of Contacts By Superior
     * @param Contact superior
     * @return int
     */
    public function getCountByContact(Contact $superior): int
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->select("COUNT(DISTINCT contact.id)")
            ->from(Contact::class, "contact")
            ->andWhere("contact.superior = :superior")
            ->setParameter("superior", $superior)
            ->getQuery()->getSingleScalarResult();
    }



    /**
     * Find Second Participant
     * @param Meeting meeting
     * @param Contact participant
     */
    public function findSecondParticipant(Meeting $meeting, Contact $participant): ?Contact
    {
        $id = array_find($meeting->getParticipants()->toArray(), function(Contact $item) use ($participant) {
            return $item->getId() !== $participant->getId();
        });
        return $this->findOneById($id);
    }



    /**
     * Create New Contact Entity
     * @param Contact superior
     * @param string firstName
     * @param string middleName
     * @param string lastName
     * @param int dialNumber
     * @param string phoneNumber
     * @param string email
     * @return Contact
     */
    public function create(Contact $superior, string $firstName, string $middleName, string $lastName, int $dialNumber, string $phoneNumber, string $email): Contact
    {
        $contact = new Contact($superior, $firstName, $middleName, $lastName, $dialNumber, $phoneNumber, $email);
        $this->persistContact($contact);
        return $contact;
    }


    /**
     * Update Contact
     * @param Contact contact
     */
    public function persistContact(Contact $contact)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($contact);
        $entityManager->flush();
    }


    /**
     * Delete Contact
     * @param Contact contact
     */
    public function deleteContact(Contact $contact)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($contact);
        $entityManager->flush();
    }

    
}
