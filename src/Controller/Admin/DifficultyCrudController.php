<?php

namespace App\Controller\Admin;

use App\Entity\Difficulty;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DifficultyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Difficulty::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Difficultes')
            ->setEntityLabelInSingular('Difficulte')
            ->setPageTitle('index', 'Gestion des difficultes');
    }

    public function configureFields(string $pageName): iterable
    {
        return [IdField::new('id')->hideOnForm(), TextField::new('name')];
    }
}
