<?php
namespace App\Controller;

use App\Entity\Call;
use App\Repository\CallRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/call')]
class CallController extends AbstractController
{
    public function __construct(private EntityManagerInterface $em) {}

    #[Route('', methods: ['POST'])]
    public function create(Request $request, CallRepository $callRepository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $call = $callRepository->create($data);
        $callRepository->persist($call);
        return $this->json(['id' => $$call->getId()], 201);
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
