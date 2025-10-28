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
