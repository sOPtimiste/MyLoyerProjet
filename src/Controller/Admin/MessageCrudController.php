<?php

namespace App\Controller\Admin;

use App\Entity\Message;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Configurator\DateTimeConfigurator;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MessageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Message::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            //IdField::new('id'),
            TextField::new('motif'),
            TextEditorField::new('description'),
            AssociationField::new('locataire')->hideOnForm(),

            
            //DateTimeConfigurator::class()
        ];
        
    }

    public function configureActions(Actions $actions): Actions
{
    return $actions
        // ...
        ->remove(Crud::PAGE_INDEX, Action::NEW)
        ->remove(Crud::PAGE_DETAIL, Action::EDIT)
    ;
}
    
}
