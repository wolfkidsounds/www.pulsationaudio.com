<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MusicController extends AbstractController
{
    #[Route('/music', name: 'app_music')]
    public function index(): Response
    {
        return $this->render('pages/music/index.html.twig', [
            'controller_name' => 'MusicController',
        ]);
    }
}
