<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDefaultSort(['OrderNr' => 'ASC'])
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IntegerField::new('OrderNr')
        ->setColumns(1);
        yield TextField::new('Name')
        ->setColumns(5);

        yield FormField::AddRow();
        yield TextField::new('slug')
        ->setColumns(6);

        yield FormField::AddRow();
        yield AssociationField::new('Type')
        ->setColumns(3);
        yield AssociationField::new('Template')
        ->setColumns(3);
    }
}
