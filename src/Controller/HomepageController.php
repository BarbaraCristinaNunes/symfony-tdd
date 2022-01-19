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
    public function showRoomsAndUsers(ManagerRegistry $doctrine): Response
    {
        $rooms = $doctrine->getRepository(Room::class)->findAll();
        $users = $doctrine->getRepository(User::class)->findAll();
        $message = "";

        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
            'rooms' => $rooms,
            'users' => $users,
            'message' => $message,
        ]);
    }

    #[Route('/booking', name: 'booking')]
    public function roomValidation(Request $request, ManagerRegistry $doctrine): Response
    {

        $rooms = $doctrine->getRepository(Room::class)->findAll();
        $users = $doctrine->getRepository(User::class)->findAll();
        $message = "";

        $roomId = $request->request->get('room');
        $userId = $request->request->get('user');

        $room = $doctrine->getRepository(Room::class)->findOneBy(array('id' => $roomId));
        $user = $doctrine->getRepository(User::class)->findOneBy(array('id' => $userId));

        var_dump($room->getPremiumMember());
        var_dump($user->getPremiumMember());

        if($room->getPremiumMember() == true && $user->getPremiumMember() == false){
            $message = "You can not booking this room!";

            return $this->render('homepage/index.html.twig', [
                'controller_name' => 'HomepageController',
                'rooms' => $rooms,
                'users' => $users,
                'message' => $message,
            ]);
        }        

        // return $this->goToRoom($room);
    }

    // public function goToRoom($room): RedirectResponse
    // {
    //     $roomId = $request->request->get('room');
    //     $userId = $request->request->get('user');
    //     $message = "";

    //     var_dump($roomPremium);
    //     var_dump($userPremium);

    //     $room = $doctrine->getRepository(Room::class)->findOneBy(array('id' => $roomId));
    //     $user = $doctrine->getRepository(User::class)->findOneBy(array('id' => $userId));

    //     if($room->getPremiumMember() == 0 && $user->getPremiumMember() == 1){
    //         $message = "You can not booking this room!";
    //     }        

    //     // return $this->redirectToRoute('bookings');
    // }
}
