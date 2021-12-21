<?php

namespace App\Controller\Admin;

use App\Entity\Statistics;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class StatisticsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Statistics::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            NumberField::new('client')->setLabel('Nombre de  Clients en %'),
            NumberField::new('employees')->setLabel('Nomre d\'employées en %'),
            NumberField::new('satisfaction')->setLabel('Satisfaction en %'),
            NumberField::new('satistifiedCustomer')->setLabel('Clients satisfaits en %'),
        ];
    }

}
