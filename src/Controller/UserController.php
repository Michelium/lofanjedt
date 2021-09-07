<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/dashboard/admin/user")
 */
class UserController extends AbstractController {

    /**
     * @Route("/", name="admin_user_index")
     */
    public function index(UserRepository $userRepository) {
        if (!$this->isGranted('ROLE_ADMIN')) {
            $this->addFlash('danger', 'Access denied');
            return $this->redirectToRoute('lofanje');
        }

        return $this->render('user/index.html.twig', [
            'title' => 'User overview',
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/form/{id}", name="admin_user_form", defaults={"id": 0})
     */
    public function form($id, Request $request, UserRepository $userRepository, UserPasswordEncoderInterface $passwordEncoder) {
        if (!$this->isGranted('ROLE_ADMIN')) {
            $this->addFlash('danger', 'Access denied');
            return $this->redirectToRoute('lofanje');
        }

        $em = $this->getDoctrine()->getManager();

        $user = $id === 0 ? new User() : $userRepository->find($id);
        $mode = $id === 0 ? 'new' : 'edit';
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($user->getPlainPassword()) {
                $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
                $user->setPassword($password);
            }

            if ($form->get('role')->getData()) {
                $user->setRoles([$form->get('role')->getData()]);
            }

            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'user saved');

            return $this->redirectToRoute('admin_user_index');
        }

        return $this->render('user/form.html.twig', [
            'title' => 'User form',
            'form' => $form->createView(),
            'user' => $user,
            'mode' => $mode,
        ]);
    }

    /**
     * @Route("/{id}/delete", name="admin_user_delete")
     */
    public function delete(Request $request, User $user) {
        if (!$this->isGranted('ROLE_ADMIN')) {
            $this->addFlash('danger', 'Access denied');
            return $this->redirectToRoute('lofanje');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        $this->addFlash('danger', 'user deleted successfully');

        return $this->redirectToRoute('admin_user_index');
    }

}
