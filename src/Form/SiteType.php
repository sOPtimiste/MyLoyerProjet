<?php

namespace App\Form;

use App\Entity\Site;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
                'label' => 'Le nom du site',
                "attr" => [
                    "class" => "form-control",
                    "placeholder" => "Le nom du site"
                ]
            ])
            ->add('lieu',TextType::class,[
                'label' => 'L\'emplacement du site',
                "attr" => [
                    "class" => "form-control",
                    "placeholder" => "Le lieu du site"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Site::class,
        ]);
    }
}
