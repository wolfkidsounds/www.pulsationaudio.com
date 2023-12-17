<?php // src/Menu/MenuBuilder.php

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class MenuBuilder
{
    private $factory;
    private $categoryRepository;

    public function __construct( FactoryInterface $factory, CategoryRepository $categoryRepository)
    {
        $this->factory = $factory;
        $this->categoryRepository = $categoryRepository;
    }

    public function createMainMenu(RequestStack $requestStack)
    {
        $menu = $this->factory->createItem('root');
        $items = $this->categoryRepository->findBy([], ['OrderNr' => 'ASC']);

        foreach ($items as $item) {

            if ($item->getType() == 'Content') {
                $menu->addChild($item->getName(), [
                    'route' => 'app_content',
                    'routeParameters' => [
                        'slug' => $item->getSlug(),
                    ]
                ]);
            }

            if ($item->getType() == 'Page') {
                $menu->addChild($item->getName(), [
                    'route' => 'app_page',
                    'routeParameters' => [
                        'slug' => $item->getSlug(),
                    ]
                ]);
            }

            if ($item->getType() == 'Seperator') {
                $menu->addChild('divider_' . $item->getOrderNr(), [
                    'divider' => true, 
                    'extras' => [
                        'divider' => true
                    ]
                ]);
            }

        }

        return $menu;
    }
}