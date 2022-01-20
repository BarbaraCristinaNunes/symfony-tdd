<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Entity\Room;

class BookingsController extends AbstractController
{
    #[Route('/bookings', name: 'bookings')]
    public function index(): Response
    {

        $roomId = $request->request->get('room');
        $room = $doctrine->getRepository(Room::class)->findOneBy(array('id' => $roomId));
        
        return $this->render('bookings/index.html.twig', [
            'controller_name' => 'BookingsController',
        ]);
    }
}
