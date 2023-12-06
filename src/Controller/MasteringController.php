<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MasteringController extends AbstractController
{
    #[Route('/mastering', name: 'app_mastering')]
    public function index(): Response
    {
        return $this->render('pages/mastering/index.html.twig', [
            'controller_name' => 'MasteringController',
        ]);
    }
}
