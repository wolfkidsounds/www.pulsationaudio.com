<?php // src/Menu/MenuBuilder.php

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class MenuBuilder
{
    private $factory;

    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(RequestStack $requestStack)
    {
        $menu = $this->factory->createItem('root');
        $menu->addChild('Portfolio', ['route' => 'app_index']);
        $menu->addChild('Projects', ['route' => 'app_index']);
        $menu->addChild('div_1', ['divider' => true, 'extras' => ['divider' => true]]);
        $menu->addChild('Mastering', ['route' => 'app_index']);
        $menu->addChild('Music', ['route' => 'app_index']);
        $menu->addChild('Sound Design', ['route' => 'app_index']);
        $menu->addChild('div_2', ['divider' => true, 'extras' => ['divider' => true]]);
        $menu->addChild('Label', ['route' => 'app_index']);
        $menu->addChild('Web', ['route' => 'app_index']);
        $menu->addChild('div_3', ['divider' => true, 'extras' => ['divider' => true]]);
        $menu->addChild('Samples', ['route' => 'app_index']);
        $menu->addChild('div_4', ['divider' => true, 'extras' => ['divider' => true]]);
        $menu->addChild('About', ['route' => 'app_index']);
        $menu->addChild('Contact', ['route' => 'app_index']);

        return $menu;
    }
}