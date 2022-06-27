<?php

namespace App\Controller;

use App\Entity\Entry;
use App\Form\EntryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class DefaultController extends AbstractController {
    
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

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
        $entry = new Entry();
        $form = $this->createForm(EntryType::class, $entry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->entityManager->persist($entry);
            $this->entityManager->flush();

            return $this->redirectToRoute('lofanje');
        }

        return $this->render('lofanje/index.html.twig', [
            'title' => 'lofanje',
            'categories' => Entry::CATEGORIES,
            'form' => $form->createView(),
            'totalEntries' => count($this->entityManager->getRepository(Entry::class)->findBy(['view_status' => 5])),
        ]);
    }

    /**
     * @Route("/lofanje/get-table", name="lofanje_get_table")
     */
    public function getTable(Request $request): JsonResponse {
        $category = $request->get('category');
        $entries = $this->entityManager->getRepository(Entry::class)->findBy(['view_status' => 5, 'category' => $category]);

        return new JsonResponse($this->renderView('lofanje/_table.html.twig', [
            'fields' => Entry::FIELDS[$category],
            'entries' => $entries,
        ]));
    }

    /**
     * @Route("/entry/form/{id}", name="entry_form")
     */
    public function form(Entry $entry = null, Request $request): RedirectResponse {
        $form = $this->createForm(EntryType::class, $entry, ['data' => $entry]);
        $form->handleRequest($request);

        if (!$entry) {
            $entry = $form->getData();
        } else {
            $entry->setModifiedAt(new \DateTime('now'));
        }

        $this->entityManager->persist($entry);
        $this->entityManager->flush();

        $this->addFlash('success', 'saved successfully');
        return $this->redirectToRoute('lofanje');
    }

    /**
     * @Route("/entry/get-form", name="entry_get_form")
     */
    public function getForm(Request $request): JsonResponse {
        $id = $request->get('id');
        $entry = $id == 0 ? new Entry() : $this->entityManager->getRepository(Entry::class)->find($id);

        $form = $this->createForm(EntryType::class, $entry);

        return new JsonResponse($this->renderView('lofanje/_form.html.twig', [
            'form' => $form->createView(),
        ]));
    }

    /**
     * @Route("/entry/delete/{id}", name="entry_delete")
     */
    public function delete(Entry $entry): RedirectResponse {
        $entry->setViewStatus(1);
        $entry->setModifiedAt(new \DateTime('now'));

        $this->entityManager->persist($entry);
        $this->entityManager->flush();

        $this->addFlash('success', 'deleted successfully');

        return $this->redirectToRoute('lofanje');
    }

    /**
     * @Route("/{slug}", name="pages", priority="-1")
     */
    public function pages($slug, Environment $environment): RedirectResponse|Response {
        if ($environment->getLoader()->exists('pages/' . $slug . '.html.twig')) {
            return $this->render('pages/' . $slug . '.html.twig', [
                'title' => $slug,
            ]);
        } else {
            return $this->redirectToRoute('lofanje');
        }
    }
}
