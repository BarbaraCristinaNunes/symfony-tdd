<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\User;
use App\Entity\Bookings;
use App\Repository\RoomRepository;
use App\Repository\UserRepository;

class BookingsController extends AbstractController
{
    #[Route('/bookings', name: 'bookings')]
    public function index(): Response
    {

        return $this->render('bookings/index.html.twig', [
            'controller_name' => 'BookingsController',
        ]);
    }

    #[Route('/request', name: 'request')]
    public function requestBooking(Request $request, ManagerRegistry $doctrine, Session $session): Response
    {
        $date = $request->request->get(date);
        $userStartTime = $request->request->get(startTime);
        $userEndTime = $request->request->get(endTime);

        $room = $session->get("roomId");

        $roomBookings = $doctrine->getRepository(Bookings::class)->findAllByRoomId();

        foreach( $roomBooking in $roomBookings){

            $dbDate = $roomBooking.startDay;

            if($dbDate == $date){

                $dbStartTime = $roomBooking.startTime;
                $dbEndTime = $roomBooking.endTime;
            }
        }

    }
}
