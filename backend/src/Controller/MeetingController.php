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

    public function __construct(
        UserRepository $userRepository, 
        MeetingRepository $meetingRepository
    ) {
        $this->userRepository = $userRepository;
        $this->meetingRepository = $meetingRepository;
    }


    /**
     * GET /meeting
     * Request for get list of meeting with user participant
     * Test: getMeetingTest.php
     * @return JsonResponse
     */
    #[Route('', methods: ['GET'])]
    public function getAll(): JsonResponse
    {
        /**
         * Find User By Token
         */
        $user = $this->userRepository->findByToken();


        /**
         * Get Meeting List
         */
        $meetingList = $this->meetingRepository->findByContact($user->getContact());


        /**
         * Return result in structure
         */
        return $this->json($meetingList, 200, [], [
            'attributes' => [
                'id', 'appointment', 'place',
                'participants' => [ 'id', 'firstName', 'middleName', 'lastName', 'email', 'dialNumber', 'phoneNumber' ]
            ]
        ]);
    }


    /**
     * PUT /meeting
     * Request for save meeting result
     * Test: putMeetingTest.php
     * @return JsonResponse
     */
    #[Route('/{id}', methods: ['PUT'])]
    public function update(Request $request, int $id): JsonResponse
    {
        /**
         * Find User By Token
         */
        $user = $this->userRepository->findByToken();


        /**
         * User Contact
         */
        $contact = $user->getContact();


        /**
         * Find Meeting
         */
        $meeting = $this->meetingRepository->findByIdAndParticipant($id, $contact);

        
        /**
         * Get Data From Request
         */
        $data = json_decode($request->getContent(), true);
        
        
        /**
         * Fill Meeting Result
         */
        $result = $data['result'];
        $type = $data['type'];
        $meeting->fillResult($result, $type);


        /**
         * Save Meeting
         */
        $this->meetingRepository->persistMeeting($meeting);


        /**
         * If New Meeting Appointment
         */
        $nextMeeting = $data['nextMeeting'];
        if ($nextMeeting) 
        {
            /**
             * Find Participants of Current Meeting
             */
            $participants = $this->meetingRepository->findParticipantsByMeeting($meeting);


            /**
             * Create New Meeting
             */
            $place = $data['place'];
            $newMeeting = $this->meetingRepository->create($participants, $nextMeeting, $place);
        }


        /**
         * If Result of Meeting is not Contract, finish
         */
        if ($result !== "contract") {
            return $this->json(null, 204);
        }


        /**
         * Find Contact to New Client
         */
        $client = $this->meetingRepository->findSecondParticipant($meeting, $contact);


        /**
         * Create new Contract
         */
        $contractRepository->create($client, $price);


        return $this->json(null, 204);
    }

    /*#[Route('/{id}', methods: ['GET'])]
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


    #[Route('/{id}', methods: ['DELETE'])]
    public function delete(Meeting $meeting): JsonResponse
    {
        $meetingrepository->delete($meeting);
        return $this->json(null, 204);
    }*/

}
