<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('old_password', PasswordType::class, [
                'mapped' => false,
                'label' => 'Mon mot de passe actuel',
                'attr' => [
                    'placeholder' =>'Veuillez saisir votre mot de passe actuel'
                ]
            ])
            ->add('new_password', RepeatedType::class, [
                'mapped' => false,
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe et la confirmation doivent etre identique.',
                'required' => true,
                'label' => 'Mon nouveau mot de passe',
                'constraints' => new Length([
                    'min' => 8,
                    'max' => 30
                ]),
                'first_options' => [ 'label' => 'Mot de passe',
                'label' => 'Merci de saisir votre nouveau mot de passe',
                'attr' => [
                    'placeholder' =>'Veuillez saisir votre nouveau mot de passe'
                ]
                ],
                'second_options' => ['label' => 'Confirmez votre mot de passe',
                'label' => 'Merci de confirmer votre nouveau mot de passe',
                'attr' => [
                    'placeholder' =>'Veuillez confirmer votre nouveau mot de passe'
                ]
                ]
                ]
            )
            ->add('submit', SubmitType::class, [
                'label' => "Mettre à jour"
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
