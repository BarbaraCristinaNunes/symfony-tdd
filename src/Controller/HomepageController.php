<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Room;
use App\Entity\User;
use App\Repository\RoomRepository;

class HomepageController extends AbstractController
{
    #[Route('/homepage', name: 'homepage')]
    public function showRoomsAndUsers(ManagerRegistry $doctrine, Session $session): Response
    {
        $rooms = $doctrine->getRepository(Room::class)->findAll();
        // $users = $doctrine->getRepository(User::class)->findAll();
        $message = "";

        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
            'rooms' => $rooms,
            'user' => "Hello ". $session->get('userName'),
            'message' => $message,
        ]);
    }

    #[Route('/booking', name: 'booking')]
    public function roomValidation(Request $request, ManagerRegistry $doctrine, Session $session): Response
    {

        $rooms = $doctrine->getRepository(Room::class)->findAll();
        $message = "";

        $roomId = $request->request->get('room');
        $room = $doctrine->getRepository(Room::class)->findOneBy(array('id' => $roomId));

        $userPremium = $session->get('Premium');

        // var_dump($room->getPremiumMember());
        // var_dump($user->getPremiumMember());

        if($room->getPremiumMember() == true && $userPremium == false){
            $message = "You can not booking this room!";

            return $this->render('homepage/index.html.twig', [
                'controller_name' => 'HomepageController',
                'rooms' => $rooms,
                'user' => "Hello ". $session->get('name'),
                'message' => $message,
            ]);
        }else{

            $session->set('roomId', $roomId);

            return $this->render('bookings/index.html.twig', [
                'controller_name' => 'BookingsController',
            ]);
        }        
    }
}
