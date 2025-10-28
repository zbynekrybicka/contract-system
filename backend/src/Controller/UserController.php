<?php
namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\ContactRepository;
use App\Repository\CallRepository;
use App\Repository\MeetingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class UserController extends AbstractController
{

    private $userRepository;


    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * POST /login
     * Request for get authorization token for access to system
     * Test: postLoginTest.php
     * 
     * @param Request $request, 
     * @param JWTTokenManagerInterface $jwtManager
     * @return JsonResponse
     */
    #[Route('/login', name: 'login', methods: ['POST'])]
    public function login(Request $request, 
        JWTTokenManagerInterface $jwtManager
    ): JsonResponse 
    {
        // get POST data
        $data = json_decode($request->getContent(), true);

        // check POST data
        $isInputDataCorrect = $this->login_checkInputData($data);
        if (!$isInputDataCorrect) {
            return $this->json(null, 400);
        }

        // set login data for control
        $email = $data['email'];
        $password = $data['password'];        

        // find user
        $user = $this->userRepository->findByEmail($email);

        // check password
        $isPasswordCorrect = $this->passwordVerify($user, $password);
        if (!$isPasswordCorrect) {
            return $this->json(null, 401);
        }

        // set auth token
        $token = $jwtManager->create($user);

        // successful result
        return $this->json($token);
    }


    /**
     * Check input data
     * LOW-LEVEL
     * 
     * @param array $data
     * @return bool
     */
    private function login_checkInputData(array $data): bool
    {
        // set results of the conditions
        $isDataArray = is_array($data);
        $isEmailEmpty = strlen($data['email']) === 0;
        $isPasswordEmpty = strlen($data['password']) === 0;
        
        // send result
        return $isDataArray && !$isEmailEmpty && !$isPasswordEmpty; 
    }


    /**
     * Verify if user exists and password is correct
     * 
     * @param UserPasswordHasherInterface $hasher
     * @param ?User $user
     * @param string $password
     * @return bool
     */
    private function passwordVerify(?User $user, string $password): bool
    {
        // check valid user
        if (!$user) {
            return false;
        }

        // check valid password
        return $user->verifyPassword($password);
    }


    /**
     * GET /user/statistics
     * Request for get user statistics
     * Test: getUserStatisticsTest.php
     * 
     * @return JsonResponse
     */
    #[Route('/user/statistics', name: 'getUserStatistics', methods: ['GET'])]
    public function getUserStatistics(ContactRepository $contactRepository, CallRepository $callRepository, MeetingRepository $meetingRepository): JsonResponse
    {
        $user = $this->userRepository->findByToken();
        $contactCount = $contactRepository->getCountByContact($user->getContact());
        $callCount = $callRepository->getCountBySender($user->getContact());
        $meetingCount = $meetingRepository->getCountByParticipant($user->getContact());

        return $this->json([
            "contacts" => $contactCount,
            "calls" => $callCount,
            "meetings" => $meetingCount
        ]);
    }

}
