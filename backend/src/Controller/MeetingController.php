<?php
namespace App\Controller;

use App\Entity\Meeting;
use App\Repository\MeetingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/meeting')]
class MeetingController extends AbstractController
{
    public function __construct(private EntityManagerInterface $em) {}


    #[Route('', methods: ['GET'])]
    public function getAll(MeetingRepository $meetingrepository): JsonResponse
    {
        $meetingList = $meetingrepository->findAll();
        return $this->json($meetingList);
    }

    #[Route('/{id}', methods: ['GET'])]
    public function getOne(MeetingRepository $meetingrepository): JsonResponse
    {
        $meetingList = $meetingrepository->findAll();
        return $this->json($meetingList);
    }

    #[Route('', methods: ['POST'])]
    public function create(Request $request, MeetingRepository $meetingrepository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $meeting = $meetingrepository->create($data);
        $meetingrepository->persist($meeting);
        return $this->json(['id' => $$meeting->getId()], 201);
    }

    #[Route('/{id}', methods: ['PUT'])]
    public function update(Meeting $meeting, MeetingRepository $meetingrepository): JsonResponse
    {

        $meetingrepository->persist($meeting);
        return $this->json(null, 204);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    public function delete(Meeting $meeting, MeetingRepository $meetingrepository): JsonResponse
    {
        $meetingrepository->delete($meeting);
        return $this->json(null, 204);
    }

}
