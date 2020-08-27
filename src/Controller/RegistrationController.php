<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Form\RegistrationType;
use App\Security\LoginFormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $authenticator,UserRepository $UserRepo): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        // dd($form);
        $form->handleRequest($request);
        $msg = '';

        if ($form->isSubmitted() && $form->isValid()) {
            
            $email = $form->get('email')->getData();

            $userExist = $UserRepo->findOneBy(array('email'=>$email));

            if (!$userExist) {
                // encode the plain password
                $user->setPassword(
                    $passwordEncoder->encodePassword(
                        $user,
                        $form->get('password')->getData()
                    )
                );

                $createdDate = date('Y-m-d H:i:s');
                $user->setDateCreation(new \DateTime($createdDate));

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();

                // do anything else you need here, like send an email

                return $guardHandler->authenticateUserAndHandleSuccess(
                    $user,
                    $request,
                    $authenticator,
                    'main' // firewall name in security.yaml
                );
            }else{
                $msg = 'Cet email est déjà utilisé';
            }

        }

        return $this->render('registration/register.html.twig', [
        //return $this->render('one_page/form.html.twig', [
            'form' => $form->createView(),
            'titre' => "Inscription : ",
            'msg' => $msg
        ]);
    }
}
