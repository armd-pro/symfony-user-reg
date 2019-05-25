<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
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
        $form = $this->createForm(RegistrationFormType::class, new User());
        $form->handleRequest($request);
        $success = false;

        if(!$form->isSubmitted()) {
            return $this->render('registration/register.html.twig', [
                'registrationForm' => $form->createView(),
                'success' => $success,
            ]);
        }

        if($form->isValid()) {
            $this->handleForm($form, $passwordEncoder);
            $form = $this->createForm(RegistrationFormType::class, new User());
            $success = true;
        }

        return JsonResponse::create([
            'success' => $success,
            'form' => $this->renderView('form/registration-form.html.twig', [
                'registrationForm' => $form->createView(),
                'success' => $success
            ])
        ]);
    }

    /**
     * @param FormInterface $form
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    protected function handleForm(FormInterface $form, UserPasswordEncoderInterface $passwordEncoder)
    {
        /** @var User $user */
        $user = $form->getData();
        $pass = $passwordEncoder->encodePassword($user, $form->get('password')->getData());
        $user->setPassword($pass);

        /** @var UploadedFile|null $photo */
        $photo = $form->get('photo')->getData();

        if($photo)
        {
            $dir = $this->getParameter('kernel.project_dir') . '/public/images/users';
            $ext = explode('/', $photo->getClientMimeType())[1];
            $fileName = md5(uniqid(rand(), 1)) . ".$ext";
            $photo->move($dir, $fileName);
            $user->setPhoto($fileName);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
    }
}
