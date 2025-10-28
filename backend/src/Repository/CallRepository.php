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


    /**
     * Get Count Of Calls By Sender
     * @param Contact sender
     * @return int
     */
    public function getCountBySender(Contact $sender): int
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->select("COUNT(DISTINCT call.id)")
            ->from(Call::class, "call")
            ->andWhere("call.sender = :sender")
            ->setParameter("sender", $sender)
            ->getQuery()->getSingleScalarResult();
    }


    /**
     * Create Call
     * @param Contact sender
     * @param Contact receiver
     * @param string purpose
     * @param bool successful
     * @param string type
     * @param string description
     * @param ?\DateTime nextCall
     * @return Call
     */
    public function create(Contact $sender, Contact $receiver, string $purpose, bool $successful, string $type, string $description, ?\DateTime $nextCall): Call
    {
        /**
         * Create Call Entity
         */
        $call = new Call($sender, $receiver, $purpose, $successful, $type, $description, $nextCall);


        /**
         * Save Call to Database
         */
        $this->persistCall($call);


        /**
         * Send Entity
         */
        return $call;
    }


    /**
     * Save Call
     * @param Call
     */
    public function persistCall(Call $item)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($item);
        $entityManager->flush();
    }


    /**
     * Delete Call
     * @param Call
     */
    public function deleteCall(Call $item)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($item);
        $entityManager->flush();
    }


}
