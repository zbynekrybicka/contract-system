<?php
namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Call;
use App\Entity\Meeting;
use App\Entity\Contract;

use App\Repository\ContactRepository;
use App\Repository\CallRepository;
use App\Repository\MeetingRepository;
use App\Repository\ContractRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/contact')]
class ContactController extends AbstractController
{
    public function __construct(private EntityManagerInterface $em) {}

    #[Route('', methods: ['GET'])]
    public function getAll(ContactRepository $contactRepository): JsonResponse
    {
        $contactList = $contactRepository->findAll();
        return $this->json($contactList);
    }


    #[Route('/{id}', methods: ['GET'])]
    public function getOne(ContactRepository $contactRepository): JsonResponse
    {
        $contactList = $contactRepository->findAll();
        return $this->json($contactList);
    }


    #[Route('', methods: ['POST'])]
    public function create(Request $request, ContactRepository $contactRepository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $contact = $contactRepository->create($data);
        $contactRepository->persist($contact);
        return $this->json(['id' => $$contact->getId()], 201);
    }


    #[Route('/{id}', methods: ['PUT'])]
    public function update(Contact $contact, ContactRepository $contactRepository): JsonResponse
    {

        $contactRepository->persist($contact);
        return $this->json(null, 204);
    }


    #[Route('/{id}', methods: ['DELETE'])]
    public function delete(Contact $contact, ContactRepository $contactRepository): JsonResponse
    {
        $contactRepository->delete($contact);
        return $this->json(null, 204);
    }


}
