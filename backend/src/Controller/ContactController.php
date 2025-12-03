<?php
namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Call;
use App\Entity\Meeting;
use App\Entity\Contract;

use App\Repository\ContactRepository;
use App\Repository\UserRepository;
use App\Repository\CallRepository;
use App\Repository\MeetingRepository;
use App\Repository\ContractRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer as AON;

#[Route('/contact')]
class ContactController extends AbstractController
{

    private $userRepository;
    private $contactRepository;

    public function __construct(
        UserRepository $userRepository, 
        ContactRepository $contactRepository
    ) {
        $this->userRepository = $userRepository;
        $this->contactRepository = $contactRepository;
    }


    /**
     * GET /contact
     * Request for get all contacts from user
     */
    #[Route('', methods: ['GET'])]
    public function getAll(Request $request): JsonResponse
    {
        /**
         * Get User By Auth Token
         */
        $user = $this->userRepository->findByToken();

        /**
         * Get Contact List By User
         */
        $superior = $user->getContact();
        $data = $request->query->all();
        if (array_key_exists('id', $data)) {
            $id = intval($data['id']) ?: null;
            $ids = $this->contactRepository->getSubordinateIds($superior);
            if ($id !== null && !in_array($id, $ids)) {
                return $this->json(null, 401);
            }
            $contact = $this->contactRepository->find($id);
        } else {
            $contact = $superior;
        }
        $contactList = $contact->getSubordinates();

        /**
         * Send result in structure
         */
        $result = $this->json($contactList, 200, [], [ 'attributes' => ['id', 'firstName', 'middleName', 'lastName', 'email', 'dialNumber', 'phoneNumber']]);
        // var_dump($result);
        return $result;
    }


    /**
     * GET /contact/:id
     * Request for get one contact with all details
     * @param int id
     * @return JsonResponse
     */
    #[Route('/{id}', methods: ['GET'])]
    public function getOne(int $id): JsonResponse
    {
        /**
         * Get User By Auth Token
         */
        $user = $this->userRepository->findByToken();

        /**
         * Find Contact Entity
         */
        $superior = $user->getContact();
        $contact = $this->contactRepository->findWithSuperior($superior, $id);


        /**
         * Result of finding
         */
        if ($contact) {

            
            /**
             * Send Entity in structure
             */
            return $this->json($contact, 200, [], [ 
                'attributes' => [ 
                    'id', 'firstName', 'middleName', 'lastName', 'email', 'dialNumber', 'phoneNumber', 
                    'calls' => [ 'id', 'purpose', 'realizedAt', 'successful', 'description', 'nextCall' ],
                    'meetings' => [ 
                        'id', 'appointment', 'place', 
                        'participants' => [ 'id', 'firstName', 'middleName', 'lastName', 'email', 'dialNumber', 'phoneNumber' ]
                    ]
                ],
                AON::CIRCULAR_REFERENCE_HANDLER => fn ($o) => [ 'id' => $o->getId() ],
            ]);


        } else {

            
            /**
             * Send Error
             */
            return $this->json(null, 400);
        }
    }


    /**
     * POST /contact
     * Request For Create New Contact
     * @param Request request
     * @return JsonResponse
     */
    #[Route('', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        /**
         * Get User By Auth Token
         */
        $user = $this->userRepository->findByToken();


        /**
         * Extract Data From Request
         */
        $data = json_decode($request->getContent(), true);

        
        /**
         * Create Contact
         */
        $superior = $user->getContact();
        $firstName = $data['firstName'];
        $middleName = $data['middleName'];
        $lastName = $data['lastName'];
        $dialNumber = $data['dialNumber'];
        $phoneNumber = $data['phoneNumber'];
        $email = $data['email'];
        $contact = $this->contactRepository->create($superior, $firstName, $middleName, $lastName, $dialNumber, $phoneNumber, $email);


        /**
         * Send Result
         */
        return $this->json($contact->getId(), 201);
    }


    /**
     * PUT /contact/:id
     * Request For Update Contact Data
     * @param Request request
     * @param int contactId
     * @return JsonResponse
     */
    #[Route('/{contactId}', methods: ['PUT'])]
    public function update(Request $request, int $contactId): JsonResponse
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
         * Get Selected Contact
         */
        $user->getContact();
        $contact = $this->contactRepository->findWithSuperior($superior, $contactId);
        /**
         * If Contact Not Found, Send Error
         */
        if (!$contact) {
            return $this->json(null, 401);
        }


        /**
         * Update Contact
         */
        $firstName = $data['firstName'];
        $middleName = $data['middleName'];
        $lastName = $data['lastName'];
        $dialNumber = $data['dialNumber'];
        $phoneNumber = $data['phoneNumber'];
        $email = $data['email'];
        $contact->hydrate($firstName, $middleName, $lastName, $dialNumber, $phoneNumber, $email);
        $this->contactRepository->persistContact($contact);


        /**
         * Send Positive Result
         */
        return $this->json(null, 204);
    }


    /**
     * DELETE /contact/:id
     * Request For Delete Contact
     * @param int contactId
     * @return JsonResponse
     */
    #[Route('/{contactId}', methods: ['DELETE'])]
    public function delete(int $contactId): JsonResponse
    {
        /**
         * Get User By Auth Token
         */
        $user = $this->userRepository->findByToken();


        /**
         * Find Contact By Superior
         */
        $superior = $user->getContact();
        $contact = $this->contactRepository->findWithSuperior($superior, $contactId);


        /**
         * If Contact Is Found
         */
        if ($contact) {
            /**
             * Delete Contact
             */
            $this->contactRepository->delete($contact);
            return $this->json(null, 204);
        } else {
            /**
             * Else Send Error
             */
            return $this->json(null, 400);
        }
    }


}
