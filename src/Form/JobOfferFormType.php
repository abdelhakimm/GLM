<?php

namespace App\Form;

use App\Entity\JobOffer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobOfferFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title_job', TextType::class, [
                'label' => 'Titre de la reunion',
                'attr' => [
                    'placeholder' => 'saisir le titre de la reunion',
                    'class' => 'form-control my-2'
                ],
                'label_attr' => [
                    'class' => 'text-info'
                ]
            ])
            ->add('description', TextType::class,[
                'label' => 'Veuillez entrer la description de la reunion',
                'attr' => [
                    'placeholder' => 'saisir la description de la reunion',
                    'class' => 'form-control my-2'
                ],
                'label_attr' => [
                    'class' => 'text-info'
                ]
            ])
            ->add('publication_date')
            ->add('deadline_candidacy')
            ->add('service')
            ->add('number_positions_available')
            ->add('created_at')
            ->add('applicants')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => JobOffer::class,
        ]);
    }
}
