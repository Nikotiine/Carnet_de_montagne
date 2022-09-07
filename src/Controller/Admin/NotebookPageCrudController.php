<?php

namespace App\Controller\Admin;

use App\Entity\NotebookPage;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class NotebookPageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return NotebookPage::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Sorties utilisateurs')
            ->setEntityLabelInSingular('Sortie utilisateur')
            ->setPageTitle('index', 'Gestion des sorties utilisateurs');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm()
                ->hideOnIndex(),
            TextField::new('title', 'Titre'),
            TextField::new('routName', 'Nom de la course'),
            TextareaField::new('story')->hideOnIndex(),
            TextareaField::new('pointToReview')->hideOnIndex(),
            NumberField::new('heightDifference'),
            AssociationField::new('category', 'name')
                ->setCrudController(MainCategoryCrudController::class)
                ->hideOnForm(),
            DateTimeField::new('achieveAt'),
            DateTimeField::new('createdAt')
                ->setFormTypeOption('disabled', 'disabled')
                ->hideOnIndex(),
        ];
    }
}
