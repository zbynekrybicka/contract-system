<?php
namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class LoginController extends AbstractController
{
    /**
     * POST /login
     * Request for get authorization token for access to system
     * Test: postLoginTest.php
     * 
     * @param Request $request, 
     * @param UserRepository $users, 
     * @param UserPasswordHasherInterface $hasher, 
     * @param JWTTokenManagerInterface $jwtManager
     * @return JsonResponse
     */
    #[Route('/login', name: 'login', methods: ['POST'])]
    public function login(Request $request, 
        UserRepository $users, 
        UserPasswordHasherInterface $hasher, 
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
        $user = $users->findByEmail($email);

        // check password
        $isPasswordCorrect = $this->passwordVerify($hasher, $user, $password);
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
        $isEmailEmpty = empty($data['email']);
        $isPasswordEmpty = empty($data['password']);
        
        // send result
        return $isDataArray && !$isEmailEmpty && !$isPasswordEmpty; 
    }


    /**
     * Verify if user exists and password is correct
     * 
     * @param UserPasswordHasherInterface $hasher
     * @param UserEntity $user
     * @param string $password
     * @return bool
     */
    private function passwordVerify(UserPasswordHasherInterface $hasher, UserEntity $user, string $password): bool
    {
        // check valid user
        if (!$user) {
            return false;
        }

        // check valid password
        return $hasher->isPasswordValid($user, $password);
    }
}
