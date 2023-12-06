<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SamplesController extends AbstractController
{
    #[Route('/samples', name: 'app_samples')]
    public function index(): Response
    {
        return $this->render('pages/samples/index.html.twig', [
            'controller_name' => 'SamplesController',
        ]);
    }
}
