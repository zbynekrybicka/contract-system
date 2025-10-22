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

#[Route('/contact')]
class ContactController extends AbstractController
{

    private $userRepository;
    private $contactRepository;

    public function __construct(UserRepository $userRepository, ContactRepository $contactRepository) 
    {
        $this->userRepository = $userRepository;
        $this->contactRepository = $contactRepository;
    }

    #[Route('', methods: ['GET'])]
    public function getAll(ContactRepository $contactRepository): JsonResponse
    {
        $user = $this->userRepository->findByToken();
        $contactList = $contactRepository->getBySuperior($user->getContact());
        return $this->json($contactList);
    }


    #[Route('/{id}', methods: ['GET'])]
    public function getOne(ContactRepository $contactRepository, int $id): JsonResponse
    {
        $user = $this->userRepository->findByToken();
        $contact = $contactRepository->findWithSuperior($user->getContact(), $id);
        if ($contact) {
            return $this->json($contact, 200);
        } else {
            return $this->json(null, 400);
        }
    }


    #[Route('', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $user = $this->userRepository->findByToken();
        $contact = $this->contactRepository->insert($user->getContact(), $data);
        return $this->json($contact->getId(), 201);
    }


    #[Route('/{contactId}', methods: ['PUT'])]
    public function update(Request $request, int $contactId): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $user = $this->userRepository->findByToken();
        $superior = $user->getContact();

        $contact = $this->contactRepository->findWithSuperior($superior, $contactId);
        if (!$contact) {
            return $this->json(null, 401);
        }

        $contact->hydrate(...$data);
        $this->contactRepository->update($contact);
        return $this->json(null, 204);
    }


    #[Route('/{contactId}', methods: ['DELETE'])]
    public function delete(int $contactId): JsonResponse
    {
        $user = $this->userRepository->findByToken();
        $superior = $user->getContact();
        $contact = $this->contactRepository->findWithSuperior($superior, $contactId);
        if ($contact) {
            $this->contactRepository->delete($contact);
            return $this->json(null, 204);
        } else {
            return $this->json(null, 400);
        }
    }


}
