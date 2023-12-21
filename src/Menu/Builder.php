<?php // src/Menu/MenuBuilder.php

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use App\Repository\PageRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class MenuBuilder
{
    private $factory;
    private $categoryRepository;
    private $pageRepository;

    public function __construct( FactoryInterface $factory, CategoryRepository $categoryRepository, PageRepository $pageRepository )
    {
        $this->factory = $factory;
        $this->categoryRepository = $categoryRepository;
        $this->pageRepository = $pageRepository;
    }

    public function createMainMenu(RequestStack $requestStack)
    {
        $menu = $this->factory->createItem('root');
        $items = $this->categoryRepository->findBy([], ['OrderNr' => 'ASC']);
        $pages = $this->pageRepository->findAll();

        foreach ($items as $item) {
            if ($item->getType() == 'Seperator') {
                $menu->addChild('divider_' . $item->getOrderNr(), [
                    'divider' => true, 
                    'extras' => [
                        'divider' => true
                    ]
                ]);
            } else {
                $menu->addChild($item->getName(), [
                    'route' => 'app_content',
                    'routeParameters' => [
                        'slug' => $item->getSlug(),
                    ]
                ]);
            }
        }

        $menu->addChild('divider_custom_2', [
            'divider' => true, 
            'extras' => [
                'divider' => true
            ]
        ]);

        foreach ($pages as $page) {
            $menu->addChild($page->getTitle(), [
                'route' => 'app_page',
                'routeParameters' => [
                    'slug' => $page->getSlug(),
                ]
            ]);
        }

        return $menu;
    }
}