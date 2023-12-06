<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SoundController extends AbstractController
{
    #[Route('/sound', name: 'app_sound')]
    public function index(): Response
    {
        return $this->render('pages/sound/index.html.twig', [
            'controller_name' => 'SoundController',
        ]);
    }
}
