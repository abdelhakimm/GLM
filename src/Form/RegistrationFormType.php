<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre nom',
                    'class' => 'form-control my-2'
                ],
                'label_attr' => [
                    'class' => 'text-info'
                ],
                'required' => true,
                'invalid_message' => 'Le nom est obligatoire'
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre prénom',
                    'class' => 'form-control my-2'
                ],
                'label_attr' => [
                    'class' => 'text-info'
                ],
                'required' => true,
                'invalid_message' => 'Le prénom est obligatoire'
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre email',
                    'class' => 'form-control my-2'
                ],
                'label_attr' => [
                    'class' => 'text-info'
                ],
                'required' => true,
                'invalid_message' => 'L\'email est obligatoire'
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'Veuillez accepter les conditions d\'utilisation',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter nos conditions.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'placeholder' => 'Merci de saisir votre mot de passe',
                    'class' => 'form-control my-2'
                ],
                'label_attr' => [
                    'class' => 'text-info'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un mot de passe s\'il vous plait',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
