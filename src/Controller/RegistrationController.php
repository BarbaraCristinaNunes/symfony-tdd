<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'registration')]
    public function index(): Response
    {
        return $this->render('registration/index.html.twig', [
            'controller_name' => 'RegistrationController',
        ]);
    }

    #[Route('/userRegistration', name: 'userRegistration', methods: ['POST'])]
    public function userLogin(Request $request):  RedirectResponse
    {
        $email = "";
        $password = "";
        $confirm = "";

        if($request->request->get('emal') !== "" && $request->request->get('password') !== "" && $request->request->get('confirm') !== ""){
            $email = $request->request->get('emal');
            $password = $request->request->get('password');
            $confirm = $request->request->get('confirm');
            echo "ola";
            return $this->redirectToRoute('login');    
        }else{
            echo "no";
            return $this->redirectToRoute('registration');
        }       
    }
}
