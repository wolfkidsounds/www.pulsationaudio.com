<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ContentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContentController extends AbstractController
{
    #[Route('/content/{slug}', name: 'app_content')]
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

    #[Route('/content/{slug}/{id]', name: 'app_content_single')]
    public function single(string $slug, int $id, CategoryRepository $categoryRepository, ContentRepository $contentRepository): Response
    {
        $category = $categoryRepository->findOneBy(['Category' => $slug]);
        $post = $contentRepository->findOneBy(['id' => $id]);
        $title = $post->getTitle();

        $template = strtolower($category->getName()) . '.html.twig';

        return $this->render('_template/single/' . $template, [
            'title' => $title,
            'post' => $post,
            'controller_name' => 'ContentController',
        ]);
    }
}
