<?php
namespace App\Controller;

use App\Entity\Meeting;
use App\Repository\UserRepository;
use App\Repository\MeetingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/meeting')]
class MeetingController extends AbstractController
{

    private $userRepository;
    private $meetingRepository;

    public function __construct(UserRepository $userRepository, MeetingRepository $meetingRepository)
    {
        $this->userRepository = $userRepository;
        $this->meetingRepository = $meetingRepository;
    }


    #[Route('', methods: ['GET'])]
    public function getAll(): JsonResponse
    {
        $user = $this->userRepository->findByToken();
        $meetingList = $this->meetingRepository->findByContact($user->getContact());
        return $this->json($meetingList, 200, [], [
            'attributes' => [
                'id', 'appointment', 'place',
                'participants' => [ 'id', 'firstName', 'middleName', 'lastName', 'email', 'dialNumber', 'phoneNumber' ]
            ]
        ]);
    }

    #[Route('/{id}', methods: ['GET'])]
    public function getOne(): JsonResponse
    {
        $meetingList = $meetingrepository->findAll();
        return $this->json($meetingList);
    }

    #[Route('', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $meeting = $meetingrepository->create($data);
        $meetingrepository->persist($meeting);
        return $this->json(['id' => $$meeting->getId()], 201);
    }

    #[Route('/{id}', methods: ['PUT'])]
    public function update(Meeting $meeting): JsonResponse
    {

        $meetingrepository->persist($meeting);
        return $this->json(null, 204);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    public function delete(Meeting $meeting): JsonResponse
    {
        $meetingrepository->delete($meeting);
        return $this->json(null, 204);
    }

}
