<?php

namespace App\Form;

use App\Entity\Employees;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class EmployeesFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('phone_number', TelType::class, [
                'label' => 'Numéro de téléphone',
                'attr' => [
                    'placeholder' => 'saisir le numéro de téléphone',
                    'class' => 'form-control my-2'
                ],
                'label_attr' => [
                    'class' => 'text-info'
                ]
            ])
            ->add('birthday', DateType::class, [
                'label' => 'Date de naissance',
                'attr' => [
                    'placeholder' => 'saisir votre ',
                    'class' => 'form-control my-2'
                ],
                'label_attr' => [
                    'class' => 'text-info'
                ]
            ])
            ->add('hiring_date', DateType::class, [
                'label' => 'Date d\'embauche',
                'attr' => [
                    'placeholder' => 'saisir votre date d\'embauche',
                    'class' => 'form-control my-2'
                ],
                'label_attr' => [
                    'class' => 'text-info'
                ]
            ])
            ->add('job', TextType::class, [
                'label' => 'Service',
                'attr' => [
                    'placeholder' => 'saisir votre service',
                    'class' => 'form-control my-2'
                ],
                'label_attr' => [
                    'class' => 'text-info'
                ]
            ])
            ->add('profile_picture', FileType::class, [
                'label' => 'Image du thème',
                'mapped'=>false,
                'attr' => [
                    'placeholder' => 'Merci de saisir l\'url de l\'image du thème',
                    'class' => 'form-control my-2'
                ],
                'label_attr' => [
                    'class' => 'text-info'
                ],
                'constraints' => [
                    new Image([
                        'maxSize' => '2048k',
                        'mimeTypes' => ["image/png", "image/jpeg", "image/pjpeg"],
                        'mimeTypesMessage' => "Formats d'image supportées : .jpg, .png, .jpeg, .pjpeg",
                        'maxSizeMessage' => "La taille autorisée est de 2048k"
                    ])
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => 'btn btn-lg btn-outline-primary mt-4'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employees::class,
        ]);
    }
}
