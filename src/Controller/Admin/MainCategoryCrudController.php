<?php

namespace App\Controller\Admin;

use App\Entity\MainCategory;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MainCategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MainCategory::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural("Types de sorties")
            ->setEntityLabelInSingular("Type de sortie")
            ->setPageTitle("index", "Gestion des types de sorties");
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new("id")->hideOnForm(),
            TextField::new("name"),
            TextField::new("color"),
        ];
    }
}
