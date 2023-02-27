<?php

namespace App\Controller\Api;

use App\Entity\Entry;
use Doctrine\ORM\EntityManagerInterface;
use http\Exception\InvalidArgumentException;
use JMS\Serializer\SerializerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

#[Route('/api')]
class EntryProvider extends AbstractController {

    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly SerializerInterface    $serializer,
        private readonly LoggerInterface        $logger,
    ) {
    }


    #[Route('/entries/{category}', name: 'api-entries-get', methods: 'GET')]
    public function get(string $category): JsonResponse {
        $entries = $this->entityManager->getRepository(Entry::class)->findBy(['view_status' => 5, 'category' => $category]);
        return new JsonResponse($this->serializer->toArray($entries));
    }

    #[Route('/entries', name: 'api-entries-post', methods: 'POST')]
    public function post(Request $request): Response|JsonResponse {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $entry = new Entry();

        try {
            $serializer->deserialize($request->getContent(), Entry::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $entry]);

            $this->entityManager->persist($entry);
            $this->entityManager->flush();
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage());
            return new Response("Entry not created: {$exception->getMessage()}", 500);
        }

        return new JsonResponse($this->serializer->toArray($entry));
    }

    #[Route('/entries', name: 'api-entries-put', methods: 'PUT')]
    public function put(Request $request): Response|JsonResponse {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $data = json_decode($request->getContent(), true);

        if (!isset($data['id'])) {
            return new Response('Entry ID not valid', 500);
        }

        $entry = $this->entityManager->getRepository(Entry::class)->find($data['id']);

        if (!$entry) {
            return new Response('Entry not found', 500);
        }

        try {
            $serializer->deserialize($request->getContent(), Entry::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $entry]);

            $entry->setModifiedAt(new \DateTime('now'));
            
            $this->entityManager->persist($entry);
            $this->entityManager->flush();
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage());
            return new Response("Entry not updated: {$exception->getMessage()}", 500);
        }

        return new JsonResponse($this->serializer->toArray($entry));
    }

    #[Route('/entries/{id}', name: 'api-entries-delete', methods: 'DELETE')]
    public function delete(int $id): Response|JsonResponse {
        $entry = $this->entityManager->getRepository(Entry::class)->find($id);

        if (!$entry) {
            return new Response('Entry not found', 500);
        }
        
        $entry->setViewStatus(1);
        $entry->setModifiedAt(new \DateTime('now'));

        $this->entityManager->persist($entry);
        $this->entityManager->flush();

        return new JsonResponse($this->serializer->toArray($entry));
    }


}