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

    public function __construct(CallRepository $callRepository, UserRepository $userRepository, ContactRepository $contactRepository, MeetingRepository $meetingRepository)
    {
        $this->callRepository = $callRepository;
        $this->userRepository = $userRepository;
        $this->contactRepository = $contactRepository;
        $this->meetingRepository = $meetingRepository;
    }

    #[Route('', methods: ['POST'])]
    public function create(Request $request, SerializerInterface $serializer): JsonResponse
    {
        $user = $this->userRepository->findByToken();
        $data = json_decode($request->getContent(), true);

        $sender = $user->getContact();
        $receiver = $this->contactRepository->findWithSuperior($sender, $data['contact_id']);

        $purpose = $data['purpose'];
        $successful = $data['successful'];

        $nextCall = $data['nextCall'] ? new \DateTime($data['nextCall']) : null;
        if ($nextCall && $nextCall < new \DateTime()) {
            return $this->json("Next call can not be in past", 400);
        }

        $description = $successful ? $data['description'] : "";

        $type = $data['type'];
        $meeting = null;
        if ($type === "meeting") {
            $meetingAppointment = $successful && $data['meetingAppointment'] ? new \DateTimeImmutable($data['meetingAppointment']) : null;
            if (!$meetingAppointment) {
                return $this->json("Meeting appointment is required", 400);
            }
            if ($meetingAppointment && $meetingAppointment < new \DateTimeImmutable()) {
                return $this->json("Meeting appointment can not be in past", 400);
            }
            $meeting = $this->meetingRepository->create([$sender, $receiver], $meetingAppointment, $data['place']);
        }

        $call = $this->callRepository->create($sender, $receiver, $purpose, $successful, $type, $description, $nextCall);

        $callData = $serializer->normalize($call, context: [
            'attributes' => [ 'id', 'purpose', 'realizedAt', 'successful', 'description', 'nextCall'],
            'circular_reference_handler' => fn($o) => $o->getId()
        ]);

        $meetingData = $serializer->normalize($meeting, context: [
            'attributes' => ['id', 'appointment', 'place',
                'participants' => [ 'id', 'firstName', 'middleName', 'lastName', 'email', 'dialNumber', 'phoneNumber' ]
            ],
            'circular_reference_handler' => fn($o) => $o->getId()
        ]);

        return $this->json([ 'call' => $callData, 'meeting' => $meetingData ], 201);
    }

    #[Route('/{id}', methods: ['PUT'])]
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
    }

}
