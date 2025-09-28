<?php
namespace App\Controller;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/contacts')]
class ContactController extends AbstractController
{
    public function __construct(private EntityManagerInterface $em) {}

    #[Route('', methods: ['GET'])]
    public function index(Request $req, ContactRepository $repo): JsonResponse
    {
        $q     = (string)$req->query->get('q', '');
        $page  = max(1, (int)$req->query->get('page', 1));
        $limit = min(100, max(1, (int)$req->query->get('limit', 20)));

        $qb = $repo->createQueryBuilder('c')->orderBy('c.createdAt','DESC');
        if ($q !== '') {
            $qb->andWhere('c.name LIKE :q OR c.email LIKE :q OR c.company LIKE :q OR c.note LIKE :q')
               ->setParameter('q', '%'.$q.'%');
        }
        $qb->setFirstResult(($page-1)*$limit)->setMaxResults($limit);
        $items = $qb->getQuery()->getResult();

        return $this->json(array_map(fn(Contact $c) => [
            'id'=>$c->getId(),'name'=>$c->getName(),'email'=>$c->getEmail(),
            'phone'=>$c->getPhone(),'company'=>$c->getCompany(),
            'tags'=>$c->getTags(),'note'=>$c->getNote(),
            'createdAt'=>$c->getCreatedAt()->format(DATE_ATOM),
        ], $items));
    }

    #[Route('', methods: ['POST'])]
    public function create(Request $req, ValidatorInterface $validator): JsonResponse
    {
        $data = json_decode($req->getContent(), true) ?? [];
        $c = new Contact();
        $c->setName($data['name'] ?? '');
        $c->setEmail($data['email'] ?? '');
        $c->setPhone($data['phone'] ?? null);
        $c->setCompany($data['company'] ?? null);
        $c->setTags($data['tags'] ?? null);
        $c->setNote($data['note'] ?? null);

        $errors = $validator->validate($c);
        if (count($errors) > 0) {
            return $this->json(['errors' => (string)$errors], 422);
        }

        $this->em->persist($c);
        $this->em->flush();
        return $this->json(['id' => $c->getId()], 201);
    }

    #[Route('/{id}', methods: ['GET'])]
    public function show(Contact $c): JsonResponse
    {
        return $this->json([
            'id'=>$c->getId(),'name'=>$c->getName(),'email'=>$c->getEmail(),
            'phone'=>$c->getPhone(),'company'=>$c->getCompany(),
            'tags'=>$c->getTags(),'note'=>$c->getNote(),
            'createdAt'=>$c->getCreatedAt()->format(DATE_ATOM),
        ]);
    }

    #[Route('/{id}', methods: ['PUT','PATCH'])]
    public function update(Contact $c, Request $req, ValidatorInterface $validator): JsonResponse
    {
        $data = json_decode($req->getContent(), true) ?? [];
        foreach (['name','email','phone','company','tags','note'] as $f) {
            if (array_key_exists($f, $data)) {
                $setter = 'set'.ucfirst($f);
                $c->$setter($data[$f]);
            }
        }
        $errors = $validator->validate($c);
        if (count($errors) > 0) { return $this->json(['errors'=>(string)$errors], 422); }
        $this->em->flush();
        return $this->json(['ok'=>true]);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    public function delete(Contact $c): JsonResponse
    {
        $this->em->remove($c);
        $this->em->flush();
        return $this->json(null, 204);
    }
}
