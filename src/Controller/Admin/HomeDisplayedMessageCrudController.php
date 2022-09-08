<?php

namespace App\Controller\Admin;

use App\Entity\HomeDisplayedMessage;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class HomeDisplayedMessageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return HomeDisplayedMessage::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural("Messages d accueil")
            ->setEntityLabelInSingular("Message d accueil")
            ->setPageTitle("index", "Gestion des messages d accueil");
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new("id")->hideOnForm(),
            TextareaField::new("message"),
        ];
    }
}
