<?php

namespace App\Controller\Admin;

use App\Constant\Parameters as ParametersConst;
use App\Entity\Parameters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ParametersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Parameters::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            ChoiceField::new('parameterKey')
             ->setChoices(fn () => array_flip(ParametersConst::PARAMETERS)),
            TextField::new('value'),
            TextEditorField::new('description'),
        ];
    }

}
