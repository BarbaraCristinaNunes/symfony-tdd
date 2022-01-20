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
use App\Entity\Room;


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
            

            // var_dump($db);
            // var_dump($email, $password);
            // var_dump("premium: ", $dbPremium);

            if($db){

                $dbPassword = $db->getPassword();
                $dbPremium = $db->getPremiumMember();
                $dbUserId = $db->getId();

                if($dbPassword !== $password){
                    

                    $message = "Email  or password is not correct!";
    
                    return $this->render('login/index.html.twig', [
                    'controller_name' => 'LoginController',
                    'message' => $message,
                    ]);

                }else{
                    $session->set('Premium', $dbPremium);
                    $session->set('userName', $email);
                    $session->set('userId', $dbUserId);

                    $rooms = $doctrine->getRepository(Room::class)->findAll();
                    $message = "";
        
                    return $this->render('homepage/index.html.twig', [
                        'controller_name' => 'HomepageController',
                        'rooms' => $rooms,
                        'message' => $message,
                        'user' => "Hello ". $session->get('userName'),
                    ]);
                }           
            }else{

                $message = "Email  or password is not correct!";
    
                return $this->render('login/index.html.twig', [
                'controller_name' => 'LoginController',
                'message' => $message,
                ]);
            }
        }     
    }
}
