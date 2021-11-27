<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AcountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class)
            ->remove('roles')
            ->remove('password')
            ->add('nom',TextType::class)
            ->add('prenom',TextType::class)
            ->add('age',IntegerType::class)
            ->add('nationalite',TextType::class)
            ->add('num_piece',TextType::class)
            ->remove('genre')
            ->add('telephone',TextType::class)
            ->add('profession',TextType::class)
           ->remove('locataire')
            ->remove('bailleur')
            ->remove('superviseur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

    public function getParent()
    {
        return RegistrationType::class;
    }
}
