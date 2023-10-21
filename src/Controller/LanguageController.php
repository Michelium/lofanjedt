<?php

namespace App\Controller;

use App\Entity\Language;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/lofanje')]
class LanguageController extends AbstractController {

    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    #[Route('/set-language/{language}', name: 'lofanje_set_language')]
    public function setUserLanguage(Language $language) {
        $user = $this->getUser();
        
        $user->setLanguage($language);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        
        $this->addFlash('info', "language set to: {$language->getName()}");
        return $this->redirectToRoute('lofanje');
    }

}