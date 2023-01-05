<?php

namespace App\Controller\Api;

use App\Entity\Entry;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class EntryProvider {

    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly SerializerInterface    $serializer,
    ) {
    }


    /**
     * @Route("/entries/{category}", name="api-entries", methods={"GET"})
     */
    public function getEntries(string $category): JsonResponse {
        $entries = $this->entityManager->getRepository(Entry::class)->findBy(['view_status' => 5, 'category' => $category]);
        return new JsonResponse($this->serializer->toArray($entries));
    }


}