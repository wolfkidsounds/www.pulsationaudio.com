<?php

namespace App\Controller;

use App\Repository\PageRepository;
use App\Repository\ContentRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PageController extends AbstractController
{
    #[Route('/page/{slug}', name: 'app_page')]
    public function content(string $slug, PageRepository $pageRepository): Response
    {
        $page = $pageRepository->findOneBy(['slug' => $slug]);
        $title = $page->getTitle();
        $content = $page;

        $template = strtolower($page->getSlug()) . '.html.twig';

        return $this->render('page/' . $template, [
            'title' => $title,
            'content' => $content,
            'controller_name' => 'ContentController',
        ]);
    }
}
