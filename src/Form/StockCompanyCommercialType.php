<?php

namespace App\Form;

use App\Entity\StockCompanyCommercial;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StockCompanyCommercialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantity', NumberType::class, [
                'label' => 'veuillez entrez la quantité',
                'attr' =>[
                    'placeholder' => 'Veuillez entrez la quantité',
                    'class' => 'form-control my-2'
                ],
            ])
            ->add('etat', ChoiceType::class, [
                'choices' => [
                    'Veuillez selectionner la condition du produit' => [
                        'Neuf' => 'Neuf',
                        'Bon état' => 'Bon etat',
                        'Mauvais état' => 'Mauvais etat'
                    ]
                ],
            ])
            ->add('ref', TextType::class, [
                'label' => 'Titre de la reference',
                'attr' => [
                    'placeholder' => 'saisir le nom de la reference',
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
            'data_class' => StockCompanyCommercial::class,
        ]);
    }
}
