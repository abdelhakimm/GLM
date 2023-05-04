<?php

namespace App\Form;

use App\Entity\Meetings;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MeetingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('title', TextType::class, [
            'label' => 'Titre de la reunion',
            'attr' => [
                'placeholder' => 'saisir le titre de la reunion',
                'class' => 'form-control my-2'
            ],
            'label_attr' => [
                'class' => 'text-info'
            ]
        ])
            ->add('date_time', DateType::class, [
                'label' => 'Veuillez mettre la date de la réunion',
                'attr' => [
                    'placeholder' => 'saisir le titre de la reunion',
                    'class' => 'form-control my-2'
                ],
                'label_attr' => [
                    'class' => 'text-info'
                ]
            ])
            ->add('place', TextType::class, [
                'label' => 'Veuillez mettre l\'endroit de la reunion',
                'attr' => [
                    'placeholder' => 'saisir l\'endroit de la reunion',
                    'class' => 'form-control my-2'
                ],
                'label_attr' => [
                    'class' => 'text-info'
                ]
            ])
            ->add('description', TextType::class, [
                'label' => 'Veuillez entrer la description de la reunion',
                'attr' => [
                    'placeholder' => 'saisir la description de la reunion',
                    'class' => 'form-control my-2'
                ],
                'label_attr' => [
                    'class' => 'text-info'
                ]
            ])
            ->add('attendees', TextType::class, [
                'label' => 'Veuillez entrer le nombre de participants',
                'attr' => [
                    'placeholder' => 'saisir le nombre de participants',
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
            'data_class' => Meetings::class,
        ]);
    }
}
