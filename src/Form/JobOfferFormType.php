<?php

namespace App\Form;

use App\Entity\Applicant;
use App\Entity\JobOffer;
use DateTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobOfferFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title_job', TextType::class, [
                'label' => 'Titre du poste',
                'attr' => [
                    'placeholder' => 'saisir le titre du poste',
                    'class' => 'form-control my-2'
                ],
                'label_attr' => [
                    'class' => 'text-info'
                ]
            ])
            ->add('description', TextType::class,[
                'label' => 'Veuillez entrer la description du poste',
                'attr' => [
                    'placeholder' => 'saisir la description du poste',
                    'class' => 'form-control my-2'
                ],
                'label_attr' => [
                    'class' => 'text-info'
                ]
            ])
            ->add('publication_date', DateType::class,[
                'label' => 'Veuillez mettre le début de date du poste',
                'attr' => [
                    'placeholder' => 'saisir la date du début de l\'offre',
                    'class' => 'form-control my-2'
                ],
                'label_attr' => [
                    'class' => 'text-info'
                ]])
            ->add('deadline_candidacy', DateType::class,[
                'label' => 'Veuillez mettre la date de fin de l\'offre',
                'attr' => [
                    'placeholder' => 'saisir la date de fin du poste',
                    'class' => 'form-control my-2'
                ],
                'label_attr' => [
                    'class' => 'text-info'
                ]])
            ->add('service', ChoiceType::class, [
                'choices' => [
                    'Veuillez selectionner votre service' => [
                        'Comptabilité' => 'Comptabilité',
                        'Logistique' => 'Logistique',
                        'Ressources Humaines' => 'Ressources Humaines'
                    ]
                ]])
            ->add('number_positions_available', IntegerType::class, [
                'label'=>'nombre de poste ',
                'attr'=>[
                    'placeholder'=>'entré le nombre de poste disponible',
                    'class' => 'tinymce'
                ],
                'label_attr' => [
                    'class' => 'text-info'
                ]
            ])
            
            ->add('applicant', EntityType::class,[
                'label' => 'Choix du truc',
                'label_attr' => [
                    'class' => 'text-info'
                ],
                'required' => true,
                'class' => Applicant::class,
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
            'data_class' => JobOffer::class,
        ]);
    }
}
