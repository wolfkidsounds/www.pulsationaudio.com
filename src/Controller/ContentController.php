<?php

namespace App\Controller;

use App\Repository\ContentRepository;
use App\Repository\OptionsRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/content')]
class ContentController extends AbstractController
{
    #[Route('/portfolio', name: 'app_content_portfolio')]
    public function portfolio(OptionsRepository $optionsRepository): Response
    {
        $option = $optionsRepository->findOneBy(['Name' => 'Portfolio']);
        $posts = $option->getContents();
        $title = $option->getName();

        return $this->render('_template/grid.html.twig', [
            'title' => $title,
            'posts' => $posts,
            'controller_name' => 'ContentController',
        ]);
    }

    #[Route('/projects', name: 'app_content_projects')]
    public function projects(OptionsRepository $optionsRepository): Response
    {
        $option = $optionsRepository->findOneBy(['Name' => 'Projects']);
        $posts = $option->getContents();
        $title = $option->getName();

        return $this->render('_template/grid.html.twig', [
            'title' => $title,
            'posts' => $posts,
            'controller_name' => 'ContentController',
        ]);
    }

    #[Route('/{slug}/{id}', name: 'app_content_single')]
    public function single(string $slug, int $id, CategoryRepository $categoryRepository, ContentRepository $contentRepository): Response
    {
        $category = $categoryRepository->findOneBy(['slug' => $slug]);
        $post = $contentRepository->findOneBy(['id' => $id]);
        $title = $post->getTitle();

        $template = strtolower($category->getName()) . '.html.twig';

        return $this->render('_template/single/' . $template, [
            'title' => $title,
            'post' => $post,
            'controller_name' => 'ContentController',
        ]);
    }

    #[Route('/{slug}', name: 'app_content')]
    public function content(string $slug, CategoryRepository $categoryRepository, ContentRepository $contentRepository): Response
    {
        $category = $categoryRepository->findOneBy(['slug' => $slug]);
        $posts = $contentRepository->findBy(['Category' => $category]);
        $title = $category->getName();

        $template = strtolower($category->getTemplate()->getName()) . '.html.twig';

        return $this->render('_template/' . $template, [
            'title' => $title,
            'posts' => $posts,
            'controller_name' => 'ContentController',
        ]);
    }
}
