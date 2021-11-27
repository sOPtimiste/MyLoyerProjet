<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\PasswordHasher\Hasher\PlaintextPasswordHasher;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des Utilisateurs')
            //->setEntityPermission($this->getEntityFqcn($this->getUser()))
        ;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            //IdField::new('id'),
            EmailField::new('email'),
            CollectionField::new('roles')
                ->setEntryType(ChoiceType::class)
                ->setFormTypeOptions(
                    [
                        'entry_options' => [
                            'choices'  => [
                                'ROLE_USER'    => 'ROLE_USER',
                                'ROLE_ADMIN' => 'ROLE_ADMIN',
                            ]

                        ],
                    ]
                )->hideOnIndex(),

            TextField::new('password')->hideOnIndex(),
            TextField::new('nom'),
            TextField::new('prenom'),
            TextField::new('profession')->hideOnIndex(),
            TextField::new('nationalite')->hideOnIndex(),
            IntegerField::new('age'),
            TelephoneField::new('telephone'),
            TextField::new('genre')->hideOnIndex(),

            TextField::new('num_piece'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions

            ->add(Crud::PAGE_INDEX, Action::DETAIL)->update(Crud::PAGE_INDEX, Action::DETAIL, function (Action $action) {
                return $action->setIcon("fas fa-eye")->setLabel(false);
            })

            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action->setIcon("fas fa-edit")->setLabel(false);
            })

            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {

                return $action->setIcon("fas fa-trash-alt")->setLabel(false);
            });
    }
}
