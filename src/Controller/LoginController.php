<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function index(): Response
    {
        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
        ]);
    }
    
    #[Route('/userLogin', name: 'userLogin')]
    public function userLogin(Request $request):  RedirectResponse
    {
        $email = "";
        $password = "";

        if($request->request->get('emal') !== "" && $request->request->get('password') !== ""){
            $email = $request->request->get('emal');
            $password = $request->request->get('password');
            echo "ola";
            return $this->redirectToRoute('homepage');
        }else{
            echo "no";
            return $this->redirectToRoute('login');
        }
        
        
    }
}
