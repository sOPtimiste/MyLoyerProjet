<?php

namespace App\Form;

use App\Entity\Contrat;
use App\Entity\Local;
use App\Entity\Loi;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContratType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
                'label' => 'Nom de contrat',
                "attr" => [
                    "class" => "form-control",
                    "placeholder" => "Nom de contrat"
                ]
            ])
            ->add('typeContrat',TextType::class,[
                'label' => 'Type de contrat',
                "attr" => [
                    "class" => "form-control",
                    "placeholder" => "Type de contrat"
                ]
            ])
            ->add('createAt',DateType::class)
            ->add('duree_de_bail',IntegerType::class,[
                'label' => 'Duree de bail',
                "attr" => [
                    "class" => "form-control",
                    "placeholder" => "La duree de bail du contrat"
                ]
            ])
            ->add('montant_de_cotion',MoneyType::class,[
                'label' => 'Montant Caution ',
                "attr" => [
                    "class" => "form-control",
                    "placeholder" => "Montant de la caution"
                ]
            ])
            ->add('montant_du_mensualite',MoneyType::class,[
                'label' => 'Montant Mensualite',
                "attr" => [
                    "class" => "form-control",
                    "placeholder" => "Montant de la mensualite",
                ]
            ])
            ->add('local')
            
            ->add('lois')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contrat::class,
        ]);
    }
}
