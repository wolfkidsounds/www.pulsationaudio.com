<?php

namespace App\Controller\Admin;

use App\Entity\Tag;
use App\Entity\Page;
use App\Entity\Type;
use App\Entity\User;
use App\Entity\Content;
use App\Entity\Category;
use App\Entity\Options;
use App\Entity\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\Component\Security\Core\User\UserInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Pulsation Audio');
    }

    public function configureCrud(): Crud
    {
        return parent::configureCrud()
            ->addFormTheme('@EasyMedia/form/easy-media.html.twig')
        ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Content');
        yield MenuItem::linkToCrud('Content', 'fas fa-folder', Content::class);
        yield MenuItem::linkToCrud('Page', 'fas fa-file', Page::class);

        yield MenuItem::section('Media');
        yield MenuItem::linkToRoute('Media', 'fas fa-icons', 'media.index');

        yield MenuItem::section('Settings');
        yield MenuItem::linkToCrud('Types', 'fas fa-list-ol', Type::class);
        yield MenuItem::linkToCrud('Categories', 'fas fa-list-ul', Category::class);
        yield MenuItem::linkToCrud('Options', 'fas fa-list-ul', Options::class);
        yield MenuItem::linkToCrud('Tags', 'fas fa-tag', Tag::class);
        yield MenuItem::linkToCrud('Templates', 'far fa-file', Template::class);

        yield MenuItem::section('System');
        yield MenuItem::linkToCrud('User', 'fas fa-user', User::class);
        
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)
            ->addMenuItems([
                MenuItem::linkToRoute('Back To Pulsation Audio', 'fa-solid fa-arrow-left', 'app_index'),
            ]);
    }

    public function configureAssets(): Assets
    {
        return Assets::new()
            ->addWebpackEncoreEntry('admin');
    }
}
