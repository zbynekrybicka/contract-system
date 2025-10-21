<?php
namespace App\Controller;

use App\Entity\Contract;
use App\Repository\ContractRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/contract')]
class ContractController extends AbstractController
{
    public function __construct(private EntityManagerInterface $em) {}

    #[Route('', methods: ['GET'])]
    public function getAll(ContractRepository $contractRepository): JsonResponse
    {
        $contractList = $contractRepository->findAll();
        return $this->json($contractList);
    }

    #[Route('/{id}', methods: ['GET'])]
    public function getOne(ContractRepository $contractRepository): JsonResponse
    {
        $contractList = $contractRepository->findAll();
        return $this->json($contractList);
    }

    #[Route('', methods: ['POST'])]
    public function create(Request $request, ContractRepository $contractRepository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $contract = $contractRepository->create($data);
        $contractRepository->persist($contract);
        return $this->json(['id' => $$contract->getId()], 201);
    }

    #[Route('/{id}', methods: ['PUT'])]
    public function update(Contract $contract, ContractRepository $contractRepository): JsonResponse
    {

        $contractRepository->persist($contract);
        return $this->json(null, 204);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    public function delete(Contract $contract, ContractRepository $contractRepository): JsonResponse
    {
        $contractRepository->delete($contract);
        return $this->json(null, 204);
    }

}
