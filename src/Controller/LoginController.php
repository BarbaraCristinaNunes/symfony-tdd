<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Entity\User;


class LoginController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function index(): Response
    {
        $message = "";
        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
            'message' => $message,
        ]);
    }
    
    #[Route('/userLogin', name: 'userLogin')]
    public function checkUserLogin(Request $request, ManagerRegistry $doctrine, Session $session):  Response
    {
        $email = "";
        $password = "";
        $message = "";

        if($request->request->get('emal') === "" || $request->request->get('password') === ""){
            $message = "No field can be empty!";
            
            return $this->render('login/index.html.twig', [
                'controller_name' => 'LoginController',
                'message' => $message,
            ]);

        }else{

            $email = $request->request->get('email');
            $password = $request->request->get('password');
            $db = $doctrine->getRepository(User::class)->findOneBy(array('email' => $email));
            $dbPassword = $db->getPassword();
            $dbPremium = $db->getPremiumMember();

            // var_dump($db);
            var_dump($email, $password);
            var_dump("premium: ", $dbPremium);

            if(!$db || $dbPassword !== $password){
                $message = "Email  or password is not correct!";
    
                return $this->render('login/index.html.twig', [
                    'controller_name' => 'LoginController',
                    'message' => $message,
                ]);
    
            }else{
                $session->set('userId', $dbPremium);
    
                return $this->render('homepage/index.html.twig');
            }
        }     
    }
}
