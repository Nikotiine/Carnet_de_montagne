<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class UserPasswordType extends AbstractType
{
    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ): void {
        $builder
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'attr' => [
                        'class' => 'form-control',
                    ],
                    'label' => 'Mot de passe',
                    'label_attr' => [
                        'class' => 'form_label mt-3',
                    ],
                ],
                'second_options' => [
                    'attr' => [
                        'class' => 'form-control',
                    ],
                    'label' => 'Confirmer mot de passe',
                    'label_attr' => [
                        'class' => 'form_label mt-3',
                    ],
                ],
                'invalid_message' => 'Les mots de passe sont differents',
            ])
            ->add('newPassword', PasswordType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Nouveau mot de passe',
                'label_attr' => [
                    'class' => 'form_label mt-3',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4',
                ],
                'label' => 'Valider',
            ]);
    }
}
