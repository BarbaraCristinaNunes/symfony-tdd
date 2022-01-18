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
use App\Repository\RoomRepository;

class HomepageController extends AbstractController
{
    #[Route('/homepage', name: 'homepage')]
    public function showRooms(ManagerRegistry $doctrine): Response
    {
        $rooms = $doctrine->getRepository(Room::class)->findAll();

        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
            'rooms' => $rooms,
        ]);
    }

    #[Route('/booking', name: 'booking')]
    public function goToRoom(Request $request, Session $session): RedirectResponse
    {
        $room = $request->request->get('room');

        var_dump($room);
        return $this->redirectToRoute('homepage');
    }
}
