<?php

namespace App\Controller;

use App\Entity\Entry;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class ApiController extends AbstractController {

    public function __construct(
        private EntityManagerInterface $entityManager,
        private SerializerInterface    $serializer,
    ) {
    }

    /**
     * @Route("/get-categories", name="api-categories", methods={"GET"})
     */
    public function getCategories(): JsonResponse {
        return new JsonResponse(Entry::CATEGORIES);
    }

    /**
     * @Route("/get-entries/{category}", name="api-entries", methods={"GET"})
     */
    public function getEntries(string $category): JsonResponse {
        $entries = $this->entityManager->getRepository(Entry::class)->findBy(['view_status' => 5, 'category' => $category]);
        return new JsonResponse($this->serializer->toArray($entries));
    }


}