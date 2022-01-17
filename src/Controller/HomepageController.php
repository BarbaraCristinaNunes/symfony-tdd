<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Room;

class HomepageController extends AbstractController
{
    #[Route('/homepage', name: 'homepage')]
    public function showRooms(ManagerRegistry $doctrine): Response
    {
        $data = $doctrine->getRepository(Room::class)->find(1);

        $room = new Response('Check out this great room: '.$data->getName());

        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
            'room' => $room,
        ]);
    }
}
