<?php

namespace App\Form;

use App\Entity\PurchaseRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PurchaseRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_request', DateType::class, [
                'label' => 'date de la demande d\'achat',
                'attr' => [
                    'placeholder' => 'saisir la date de la demande d\'achat',
                    'class' => 'form-control my-2'
                ],
            ])
            ->add('quantity', TextType::class, [
                'label' => 'Veuillez entrer la quantité',
                'attr' => [
                    'placeholder' => 'Veuillez saisir la quantité',
                    'class' => 'form-control my-2'
                ],
            ])
            ->add('name', TextType::class, [
                'label' => 'veuillez entrez le nom',
                'attr' =>[
                    'placeholder' => 'Veuillez entrez le nom',
                    'class' => 'form-control my-2'
                ],
            ])
            ->add('price_request', NumberType::class, [
                'label' => 'veuillez entrez le prix',
                'attr' =>[
                    'placeholder' => 'Veuillez entrez le prix',
                    'class' => 'form-control my-2'
                ],
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
            'data_class' => PurchaseRequest::class,
        ]);
    }
}
