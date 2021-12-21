<?php

namespace App\Controller\Admin;

use App\Entity\OurTeam;
use App\Form\MediaType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class OurTeamCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OurTeam::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $fields = [
            TextField::new('firstName')->setLabel('Nom'),
            TextField::new('lastName')->setLabel('Prenom'),
            TextField::new('role')->setLabel('Rôle'),
            TextField::new('title')->setLabel('Titre'),
            TextField::new('facebookLink')->setLabel('Facebook'),
            TextField::new('twitterLink')->setLabel('lien Twitter'),
            TextField::new('youtubeLink')->setLabel('Youtube'),
            TextEditorField::new('description')->setFormType(CKEditorType::class)
                ->setLabel('Resumé du service en 100 Caractères max'),
            CollectionField::new('media')
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
