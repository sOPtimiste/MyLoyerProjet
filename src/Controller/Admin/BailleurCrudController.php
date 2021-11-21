<?php

namespace App\Controller\Admin;

use App\Entity\Bailleur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BailleurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Bailleur::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
