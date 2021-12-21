<?php

namespace App\Controller\Admin;

use App\Entity\AboutDescription;
use App\Form\MediaType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class AboutDescriptionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AboutDescription::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $fields = [
            TextField::new('title')->setLabel('Titre'),
            TextEditorField::new('description')->setFormType(CKEditorType::class)
                ->setLabel('Description'),
            CollectionField::new('medias')
                ->setEntryType(MediaType::class)
                ->onlyOnForms(),
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
