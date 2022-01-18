<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
    #[Route('/user', name: 'user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/login', name: 'login', methods: ['POST'])]
    public function userLogin(Request $request):  RedirectResponse
    {
        $email = "";
        $password = "";

        if($request->request->get('emal') !== "" && $request->request->get('password') !== ""){
            $email = $request->request->get('emal');
            $password = $request->request->get('password');
            echo "ola";
        }else{
            echo "no";
        }
        
        return $this->redirectToRoute('homepage');
    }
}
