<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class RegistrationController
 * @package App\Controller
 */
class RegistrationController extends AbstractController
{
    /**
     * @Route("/", name="home")
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function home(Request $request)
    {
        return $this->redirectToRoute('app_register');
    }

    /**
     * @Route("/register", name="app_register")
     *
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        $success = false;

        if(!$form->isSubmitted()) {
            return $this->render('registration/register.html.twig', [
                'registrationForm' => $form->createView(),
                'success' => $success,
            ]);
        }

        if($form->isValid()) {
            $this->userAdd($user, $form, $passwordEncoder);
            $form = $this->createForm(RegistrationFormType::class, new User());
            $success = true;
        }

        return $this->render('form/registration.html.twig', [
            'registrationForm' => $form->createView(),
            'success' => $success
        ]);
    }

    /**
     * @param User $user
     * @param FormInterface $form
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    protected function userAdd(User $user, FormInterface $form, UserPasswordEncoderInterface $passwordEncoder)
    {
        $pass = $passwordEncoder->encodePassword($user, $form->get('password')->getData());
        $user->setPassword($pass);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
    }
}
