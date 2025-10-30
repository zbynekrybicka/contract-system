<?php
namespace App\Controller;

use App\Entity\Call;
use App\Repository\CallRepository;
use App\Repository\ContactRepository;
use App\Repository\UserRepository;
use App\Repository\MeetingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/call')]
class CallController extends AbstractController
{

    private $callRepository;
    private $userRepository;
    private $contactRepository;
    private $meetingRepository;

    public function __construct(
        CallRepository $callRepository, 
        UserRepository $userRepository, 
        ContactRepository $contactRepository, 
        MeetingRepository $meetingRepository)
    {
        $this->callRepository = $callRepository;
        $this->userRepository = $userRepository;
        $this->contactRepository = $contactRepository;
        $this->meetingRepository = $meetingRepository;
    }


    /**
     * POST /call
     * Request For Create Result of Call
     * @param Request request
     * @param SerializerInterface serializer
     * @return JsonResponse
     */
    #[Route('', methods: ['POST'])]
    public function create(
        Request $request, 
        SerializerInterface $serializer
    ): JsonResponse
    {
        /**
         * Get User By Auth Token
         */
        $user = $this->userRepository->findByToken();


        /**
         * Get Data From Request
         */
        $data = json_decode($request->getContent(), true);


        /**
         * Find Both Sender And Receiver of Call
         */
        $sender = $user->getContact();
        $contactId = $data['contact_id'];
        $receiver = $this->contactRepository->findWithSuperior($sender, $contactId);


        /**
         * Purpose
         * Successful
         * Type
         * Description
         * Meeting Appointment
         * Meeting Place
         * Next Call
         */
        $purpose = $data['purpose'];
        $successful = $data['successful'];
        $type = $data['type'];
        $description = $successful ? $data['description'] : "";
        $meetingAppointment = $type === "meeting" && $successful && $data['meetingAppointment'] ?: null;
        $place = $data['place'];
        $nextCall = $data['nextCall'] ? new \DateTime($data['nextCall']) : null;


        /**
         * Send Error If Next Call Is In Past
         */
        if ($nextCall && $nextCall < new \DateTime()) {
            return $this->json("Next call can not be in past", 400);
        }


        /**
         * If Appointment
         */
        $meeting = null;
        if ($type === "meeting") {

            
            /**
             * Send Error If Meeting Appointment Is Not Set
             */
            if (!$meetingAppointment) {
                return $this->json("Meeting appointment is required", 400);
            }


            /**
             * Send Error It Meeting Appointment Is In Past
             */
            if (new \DateTimeImmutable($meetingAppointment) < new \DateTimeImmutable()) {
                return $this->json("Meeting appointment can not be in past", 400);
            }


            /**
             * If Input Is Correct, Create Meeting
             */
            $meeting = $this->meetingRepository->create([$sender, $receiver], $meetingAppointment, $place);
        }


        /**
         * Create Call Result
         */
        $call = $this->callRepository->create($sender, $receiver, $purpose, $successful, $type, $description, $nextCall);


        /**
         * Format Structure of Call for output
         */
        $callData = $serializer->normalize($call, context: [
            'attributes' => [ 'id', 'purpose', 'realizedAt', 'successful', 'description', 'nextCall'],
            'circular_reference_handler' => fn($o) => $o->getId()
        ]);


        /**
         * Format Structure of Meeting for output
         */
        $meetingData = $serializer->normalize($meeting, context: [
            'attributes' => ['id', 'appointment', 'place',
                'participants' => [ 'id', 'firstName', 'middleName', 'lastName', 'email', 'dialNumber', 'phoneNumber' ]
            ],
            'circular_reference_handler' => fn($o) => $o->getId()
        ]);


        /**
         * Send Successful result
         */
        return $this->json([ 'call' => $callData, 'meeting' => $meetingData ], 201);
    }

    /*#[Route('/{id}', methods: ['PUT'])]
    public function update(Call $call, CallRepository $callRepository): JsonResponse
    {
        $callRepository->persist($call);
        return $this->json(null, 204);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    public function delete(Call $call, CallRepository $callRepository): JsonResponse
    {
        $callRepository->delete($call);
        return $this->json(null, 204);
    }*/

}
