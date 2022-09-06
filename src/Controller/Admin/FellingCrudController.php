<?php

namespace App\Controller\Admin;

use App\Entity\Felling;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FellingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Felling::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural("Sentiments")
            ->setEntityLabelInSingular("Sentiment")
            ->setPageTitle("index", "Gestion des sentiments");
    }

    public function configureFields(string $pageName): iterable
    {
        return [IdField::new("id")->hideOnForm(), TextField::new("name")];
    }
}
