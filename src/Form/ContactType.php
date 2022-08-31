<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ): void {
        $builder
            ->add('lastName', TextType::class, [
                'label' => 'Nom',
                'label_attr' => [
                    'class' => 'form-label mt-3',
                ],
            ])
            ->add('firstName', TextType::class, [
                'label' => 'Prenom',
                'label_attr' => [
                    'class' => 'form-label mt-3',
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'label_attr' => [
                    'class' => 'form-label mt-3',
                ],
            ])
            ->add('subject', TextType::class, [
                'label' => 'Sujet',
                'label_attr' => [
                    'class' => 'form-label mt-3',
                ],
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Message',
                'label_attr' => [
                    'class' => 'form-label mt-3',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4',
                ],
                'label' => 'Envoyer',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
