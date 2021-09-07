<?php

namespace App\Controller;

use App\Entity\Entry;
use App\Form\EntryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController {

    /**
     * @Route("/", name="index")
     */
    public function index(Request $request): Response {
       return $this->redirectToRoute('lofanje');
    }

    /**
     * @Route("/lofanje", name="lofanje")
     */
    public function lofanje(Request $request): Response {
        $em = $this->getDoctrine()->getManager();

        $entries = $em->getRepository(Entry::class)->findBy(['view_status' => 5]);

        $entry = new Entry();
        $form = $this->createForm(EntryType::class, $entry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($entry);
            $em->flush();

            return $this->redirectToRoute('lofanje');
        }


        return $this->render('lofanje/index.html.twig', [
            'title' => 'lofanje',
            'entries' => $entries,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/entry/form/{id}", name="entry_form")
     */
    public function form(Entry $entry = null, Request $request) {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(EntryType::class, $entry);
        $form->handleRequest($request);

        if (!$entry) {
            $entry = $form->getData();
        } else {
            $entry->setModifiedAt(new \DateTime('now'));
        }

        $em->persist($entry);
        $em->flush();

        $this->addFlash('success', 'saved successfully');
        return $this->redirectToRoute('lofanje');
    }

    /**
     * @Route("/entry/get-form", name="entry_get_form")
     */
    public function getForm(Request $request) {
        $id = $request->get('id');
        $entry = $id == 0 ? new Entry() : $this->getDoctrine()->getRepository(Entry::class)->find($id);

        $form = $this->createForm(EntryType::class, $entry);

        return new JsonResponse($this->renderView('lofanje/_form.html.twig', [
            'form' => $form->createView(),
        ]));
    }

    /**
     * @Route("/entry/delete/{id}", name="entry_delete")
     */
    public function delete(Entry $entry) {
        $em = $this->getDoctrine()->getManager();

        $entry->setViewStatus(1);
        $entry->setModifiedAt(new \DateTime('now'));

        $em->persist($entry);
        $em->flush();

        $this->addFlash('success', 'deleted successfully');

        return $this->redirectToRoute('lofanje');
    }
}
