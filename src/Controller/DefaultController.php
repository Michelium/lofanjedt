<?php

namespace App\Controller;

use App\Entity\Entry;
use App\Form\EntryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController {

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(Request $request): Response {
        $em = $this->getDoctrine()->getManager();

        $entries = $em->getRepository(Entry::class)->findBy(['view_status' => 5]);

        $entry = new Entry();
        $form = $this->createForm(EntryType::class, $entry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($entry);
            $em->flush();

            $this->addFlash('success', 'new entry added');

            return $this->redirectToRoute('dashboard');
        }


        return $this->render('dashboard/index.html.twig', [
            'title' => 'Dashboard',
            'entries' => $entries,
            'form' => $form->createView(),
        ]);
    }
}
