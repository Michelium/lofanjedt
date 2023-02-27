<?php

namespace App\Controller\Api;

use App\Entity\Entry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]
class CategoryProvider extends AbstractController {

    #[Route('/categories', name: 'api-categories-get', methods: 'GET')]
    public function getCategories(): JsonResponse {
        return new JsonResponse(Entry::CATEGORIES);
    }

}