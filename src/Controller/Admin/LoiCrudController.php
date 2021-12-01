<?php

namespace App\Controller\Admin;

use App\Entity\Loi;
use App\Form\ContratType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;

class LoiCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Loi::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des lois')
            //->setEntityPermission($this->getEntityFqcn($this->getUser()))
            ;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            //IdField::new('id'),
            TextField::new('libelle'),
            //DateTimeField::new('date'),
            //DateTimeField::new('dateLoi')->setFormat('d-m-Y')->renderAsNativeWidget(),
            TextEditorField::new('description'),
            CollectionField::new('contrats')
                    ->setEntryType(ContratType::class)
             
        ];
    }

}
