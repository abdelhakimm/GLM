<?php

namespace App\Form;

use App\Entity\Employees;
use App\Entity\Mutual;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MutualFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name_mutual', TextType::class, [
                'label'=>'nom de la mutuelle',
                'attr'=>[
                    'placeholder'=>'saisir le nom de la mutuelle',
                    'class'=>'form-control my-2'
                ],
                'label_attr' => [
                    'class' => 'text-info'
                ]
            ])
            ->add('percentage', TextType::class, [
                'label'=>'le pourcentage',
                'attr'=>[
                    'placeholder'=>'saisir le pourcentage',
                    'class'=>'form-control my-2'
                ],
                'label_attr' => [
                    'class' => 'text-info'
                ]
            ])

            ->add('employees', EntityType::class,[
                'label' => 'truc',
                'label_attr' => [
                    'class' => 'text-info'
                ],
                'required' => true,
                'class' => Employees::class,
                'multiple' => false,
                'expanded' => true,
                'attr' => [
                    'class' => 'mx-3 form-check'
                ],
                'choice_attr' => [
                    'class' => 'my-2'
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
            'data_class' => Mutual::class,
        ]);
    }
}
