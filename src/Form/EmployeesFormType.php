<?php

namespace App\Form;

use App\Entity\Employees;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
            ->add('birthday')
            ->add('hiring_date')
            ->add('job')
            ->add('profile_picture')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employees::class,
        ]);
    }
}
