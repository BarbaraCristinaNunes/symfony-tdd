<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\User;

class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'registration')]
    public function index(): Response
    {
        $message = "";

        return $this->render('registration/index.html.twig', [
            'controller_name' => 'RegistrationController',
            'message' => $message,
        ]);
    }

    #[Route('/userRegistration', name: 'userRegistration', methods: ['POST'])]
    public function userValidation(Request $request, ManagerRegistry $doctrine): Response
    {
        $email = "";
        $password = "";
        $confirm = "";
        $message = "";
        $premium = false;

        if($request->request->get('premium') !== null){
            $premium = true;
        }

        if($request->request->get('email') !== "" && $request->request->get('password') !== "" && $request->request->get('confirm') !== "" && $request->request->get('password') === $request->request->get('confirm')){
            $email = $request->request->get('email');
            $password = $request->request->get('password');
            $confirm = $request->request->get('confirm');            

            // var_dump("validation email: ", $email, "password: ", $password, "premium: ", $premium);
            return $this->userRegistration($email, $password, $premium, $doctrine);

        }else{

            if($request->request->get('password') !== $request->request->get('confirm')){

                $message = "Password and confirm password should be the same!";

            }else{
                $message = "No field can be empty!";
            }


            return $this->render('registration/index.html.twig', [
                'controller_name' => 'RegistrationController',
                'message' => $message,
            ]);
        }
    }

    public function userRegistration($email, $password, $premium, $doctrine):  RedirectResponse
    {
    
        // var_dump("userRegistration email: ", $email, "password: ", $password, "premium: ", $premium);

        $entityManager = $doctrine->getManager();
        $user =new User();
        $user->setEmail($email);
        $user->setPassword($password);
        $user->setCredit(100);
        $user->setPremiumMember($premium);

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('login');        
    }

    
}
