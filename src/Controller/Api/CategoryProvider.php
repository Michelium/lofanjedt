<?php

namespace App\Controller\Api;

use App\Entity\Entry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class CategoryProvider {

    /**
     * @Route("/categories", name="api-categories-get", methods={"GET"})
     */
    public function getCategories(): JsonResponse {
        return new JsonResponse(Entry::CATEGORIES);
    }


}