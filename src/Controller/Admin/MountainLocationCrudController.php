<?php

namespace App\Controller\Admin;

use App\Entity\MountainLocation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MountainLocationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MountainLocation::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural("Massifs montagneux")
            ->setEntityLabelInSingular("Massif montagneux")
            ->setPageTitle("index", "Gestion des massifs montagneux");
    }

    public function configureFields(string $pageName): iterable
    {
        return [IdField::new("id")->hideOnForm(), TextField::new("name")];
    }
}
