<?php

namespace App\Controller\Api;

use App\Entity\Entry;
use App\Form\EntryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\ChoiceList\Loader\CallbackChoiceLoader;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]
class FieldProvider extends AbstractController {

    #[Route('/fields', name: 'api-fields-get', methods: 'GET')]
    public function getCategories(Request $request, FormFactoryInterface $formFactory): JsonResponse {
        $category = $request->get('category');
        $fields = $category === null ? Entry::FIELDS : Entry::FIELDS[$category];

        $entry = new Entry();
        $form = $formFactory->create(EntryType::class, $entry);

        $fieldDetails = [];

        foreach ($fields as $fieldName) {
            $fieldInfo = [
                'name' => $fieldName,
            ];

            // Get the form field configuration using the form instance
            $formField = $form->get($fieldName);
            $fieldConfig = $formField->getConfig();
            
            $fieldInfo['type'] = $fieldConfig->getType()->getBlockPrefix();
            $fieldInfo['required'] = $fieldConfig->getOption('required') ?? false;
            $fieldInfo['label'] = $fieldConfig->getOption('label') ?? false;

            // Check if choices are set directly
            $choices = $fieldConfig->getOption('choices');
            if (!empty($choices)) {
                $fieldInfo['choices'] = $choices;
            }

            // Check if choices are set using a choice_loader callback
            $choiceLoader = $fieldConfig->getOption('choice_loader');
            if ($choiceLoader instanceof CallbackChoiceLoader) {
                $fieldInfo['choices'] = $choiceLoader->loadChoiceList()->getChoices();
            }
            
            $fieldDetails[] = $fieldInfo;
        }

        return new JsonResponse($fieldDetails);
    }

}