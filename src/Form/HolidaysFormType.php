<?php

namespace App\Form;

use App\Entity\Holidays;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HolidaysFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_start', DateType::class, [
                'label'=>"date de début",
                'attr'=>[
                    'class'=>'form-control-my-2',
                    'format'=>'dd/mm/yyyy'
                ],
                'label_attr' => [
                    'class' => 'text-info'
                ]
            ])
            ->add('date_end', DateType::class, [
                'label'=>'date de fin',
                'attr'=>[
                    'class'=>'form-control-my-2',
                    'format'=>'dd/mm/yyyy'
                ],
                'label_attr' => [
                    'class' => 'text-info'
                ]
            ])
            ->add('is_validated')


            ->add('employees')

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
            'data_class' => Holidays::class,
        ]);
    }
}
