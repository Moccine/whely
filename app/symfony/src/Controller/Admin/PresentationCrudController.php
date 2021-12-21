<?php

namespace App\Controller\Admin;

use App\Entity\Presentation;
use App\Entity\Services;
use App\Form\MediaType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class PresentationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Presentation::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $fields = [
            TextField::new('title')->setLabel('Titre'),
            TextField::new('secondTitle')->setLabel('Sous titre'),
            TextEditorField::new('Summary')->setFormType(CKEditorType::class)
                ->setLabel('Resumé de la presentation en 100 Caractères max'),
            TextareaField::new('content')
                ->setFormType(CKEditorType::class)
                ->onlyOnForms(),
            CollectionField::new('medias')
                ->setEntryType(MediaType::class)
                ->onlyOnForms()
                ->setLabel('Ajouter les images (taille max 2M '),
        ];

        return $fields;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }

    public function configureActions(Actions $action): Actions
    {
        return $action->add(CRUD::PAGE_INDEX, 'detail');
    }
}
