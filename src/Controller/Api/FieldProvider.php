<?php

namespace App\Controller\Api;

use App\Entity\Entry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]
class FieldProvider extends AbstractController {

    #[Route('/fields', name: 'api-fields-get', methods: 'GET')]
    public function getCategories(Request $request): JsonResponse {
        $category = $request->get('category');
        $fields = $category === null ? Entry::FIELDS : Entry::FIELDS[$category];
        
        if ($request->get('human_readable') == 1) {
            $fields = $category === null ? Entry::HUMAN_FIELDS : Entry::HUMAN_FIELDS[$category];
        }
        
        return new JsonResponse($fields);
    }

}