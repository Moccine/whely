<?php

namespace App\Controller\Admin;

use App\Entity\Media;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MediaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Media::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('services', 'Services'),
            AssociationField::new('presentation', 'Presentation'),
            TextField::new('filename', 'Nom du fichier'),
            ImageField::new('image')
                ->setUploadDir('public/upload_medias')
                ->setBasePath('public/upload_medias')
                ->setUploadedFileNamePattern('[year]-[month]-[day]-[contenthash].[extension]')
                ->setFormTypeOption('multiple', false)        ];
    }
}
