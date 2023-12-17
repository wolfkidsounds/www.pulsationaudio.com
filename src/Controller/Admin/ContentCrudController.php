<?php

namespace App\Controller\Admin;

use App\Entity\Content;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Adeliom\EasyMediaBundle\Admin\Field\EasyMediaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ContentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Content::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('Title')
        ->setColumns(3);
        yield AssociationField::new('Category')
        ->setColumns(3);
        
        yield FormField::addRow();
        yield AssociationField::new('Tags')
        ->setColumns(3)
        ->hideOnIndex();
        yield AssociationField::new('Options', 'Display On')
        ->setColumns(3)
        ->hideOnIndex();

        yield FormField::addRow();
        yield EasyMediaField::new('Thumbnail')
        ->setColumns(6);

        yield FormField::addRow();
        yield TextEditorField::new('Description')
        ->setColumns(6)
        ->hideOnIndex();
    }
}
