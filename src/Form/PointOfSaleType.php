<?php

namespace App\Form;

use App\Entity\PointOfSale;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PointOfSaleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name_varchar', TextType::class, [
                'label' => 'Titre du point de vente',
                'attr' => [
                    'placeholder' => 'saisir le nom du point de vente',
                    'class' => 'form-control my-2'
                ],
                'label_attr' => [
                    'class' => 'text-info'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                'attr' => [
                    'class' => 'btn btn-lg btn-outline-success mt-4'
                ]
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PointOfSale::class,
        ]);
    }
}
