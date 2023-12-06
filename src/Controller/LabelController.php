<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LabelController extends AbstractController
{
    #[Route('/label', name: 'app_label')]
    public function index(): Response
    {
        return $this->render('pages/label/index.html.twig', [
            'controller_name' => 'LabelController',
        ]);
    }
}
