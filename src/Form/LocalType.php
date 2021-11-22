<?php

namespace App\Form;

use App\Entity\Contrat;
use App\Entity\Local;
use App\Entity\Site;
use App\Entity\TypeLocal;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
                "attr" => [
                    "class" => "form-control"
                ]
            ])
            ->add('adresse',TextType::class,[
                "attr" => [
                    "class" => "form-control"
                ]
            ])
            ->add('isEtat',CheckboxType::class)
            ->add('longitude',MoneyType::class,[
                "attr" => [
                    "class" => "form-control"
                ]
            ])
            ->add('latitude',MoneyType::class,[
                "attr" => [
                    "class" => "form-control"
                ]
            ])
            ->add('contrat',EntityType::class,[
                "attr" => [
                    "class" => "form-control"
                ],
                'class' => Contrat::class,
                'choice_label' => 'nom',
            ])
            ->add('typeLocal',EntityType::class,[
                "attr" => [
                    "class" => "form-control"
                ],
                'class' => TypeLocal::class,
                'choice_label' => 'type',
            ])
            ->add('site',EntityType::class,[
                "attr" => [
                    "class" => "form-control"
                ],
                'class' => Site::class,
                'choice_label' => 'nom',
            ])
            
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Local::class,
        ]);
    }
}
