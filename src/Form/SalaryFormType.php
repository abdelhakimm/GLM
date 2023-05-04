<?php

namespace App\Form;

use App\Entity\Salary;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SalaryFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sum', NumberType::class,[
                'label'=>'le montant de votre salaire',
                'attr'=>[
                    'placeholder'=>'entré le montant du salaire',
                    'class'=>'form-control-my-2'
                ]
            ])
            ->add('overtime', TextType::class,[
                'label'=>'les heures supplémentaires',
                'attr'=>[
                    'placeholder'=>'entré le nombres d\'heures supplémentaires',
                    'class'=>'form-control-my-2'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Salary::class,
        ]);
    }
}
