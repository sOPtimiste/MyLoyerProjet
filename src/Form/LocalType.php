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
            ->add('nom', TextType::class, [
                'label' => 'Nom de local',
                "attr" => [
                    "class" => "form-control",
                    "placeholder" => "Nom de local"
                ]
            ])
            ->add('adresse', TextType::class, [
                'label' => 'Adresse',
                "attr" => [
                    "class" => "form-control",
                    "placeholder" => "Adresse du local"
                ]
            ])
            ->add('isEtat', CheckboxType::class, [
                'label'    => 'est-il disponible ?',
                'required' => false,
            ])
            ->add('longitude', MoneyType::class, [
                'label' => 'Longitude',
                "attr" => [
                    "class" => "form-control",
                    "placeholder" => "Longitude"
                ]
            ])
            ->add('latitude', MoneyType::class, [
                'label' => 'latitude',
                "attr" => [
                    "class" => "form-control",
                    "placeholder" => "latitude"
                ]
            ])
            ->add('contrat', EntityType::class, [
                'label' => 'quel contrat',
                "attr" => [
                    "class" => "form-control"
                ],
                'class' => Contrat::class,
                'choice_label' => 'nom',
            ])
            ->add('typeLocal', EntityType::class, [
                'label' => 'quel type de local',
                "attr" => [
                    "class" => "form-control"
                ],
                'class' => TypeLocal::class,
                'choice_label' => 'type',
            ])
            ->add('site', EntityType::class, [
                'label' => 'quel site',
                "attr" => [
                    "class" => "form-control"
                ],
                'class' => Site::class,
                'choice_label' => 'nom',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Local::class,
        ]);
    }
}
