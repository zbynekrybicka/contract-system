<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\Contact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contact::class);
    }

    public function getAll(): array
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->select("contact")
            ->from("\App\Entity\Contact", "contact")
            ->getQuery()
            ->getResult();
    }


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


    public function findById(int $id): ?array
    {
        $row = $this->getEntityManager()->createQueryBuilder()
            ->select("contact")
            ->from("\App\Entity\Contact", "contact")
            ->andWhere("contact.id = :contactId")
            ->setParameter("contactId", $id)
            ->getQuery()
            ->getAssociativeArray();

        return $row ?: null;
    }


    public function findWithSuperior(Contact $superior, int $contactId): ?Contact
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->select("contact")
            ->from("\App\Entity\Contact", "contact")
            ->andWhere("contact.id = :contactId")
            ->andWhere("contact.superior = :superior")
            ->setParameter("contactId", $contactId)
            ->setParameter("superior", $superior)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function newContact(): Contact
    {
        return new Contact();
    }

    public function insert(Contact $superior, array $data): Contact
    {
        $entityManager = $this->getEntityManager();
        $contact = new Contact($superior, ...$data);
        $entityManager->persist($contact);
        $entityManager->flush();
        return $contact;
    }

    public function update(Contact $contact)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($contact);
        $entityManager->flush();
    }

    public function delete(Contact $contact)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($contact);
        $entityManager->flush();
    }

    
}
