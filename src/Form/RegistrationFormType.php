<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class RegistrationFormType extends AbstractType
{
    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ): void {
        $builder
            ->add("lastName", TextType::class, [
                "attr" => [
                    "class" => "form-control",
                    "minlenght" => "2",
                    "maxlenght" => "50",
                ],
                "label" => "Nom",
                "label_attr" => [
                    "class" => "form_label mt-3",
                ],
                "constraints" => [
                    new Assert\Length(["min" => 2, "max" => 50]),
                    new Assert\NotBlank(),
                ],
            ])
            ->add("firstName", TextType::class, [
                "attr" => [
                    "class" => "form-control",
                    "minlenght" => "2",
                    "maxlenght" => "50",
                ],
                "label" => "Prenom",
                "label_attr" => [
                    "class" => "form_label mt-3",
                ],
                "constraints" => [
                    new Assert\Length(["min" => 2, "max" => 50]),
                    new Assert\NotBlank(),
                ],
            ])

            ->add("email", EmailType::class, [
                "attr" => [
                    "class" => "form-control",
                    "minlenght" => "2",
                    "maxlenght" => "180",
                ],
                "label" => "Email",
                "label_attr" => [
                    "class" => "form_label mt-3",
                ],
                "constraints" => [
                    new Assert\Length(["min" => 2, "max" => 180]),
                    new Assert\NotBlank(),
                    new Assert\Email(),
                ],
            ])

            ->add("address", TextType::class, [
                "attr" => [
                    "class" => "form-control",
                    "minlenght" => "2",
                    "maxlenght" => "50",
                ],
                "label" => "Adresse",
                "label_attr" => [
                    "class" => "form_label mt-3",
                ],
                "constraints" => [
                    new Assert\Length(["min" => 2, "max" => 255]),
                    new Assert\NotBlank(),
                ],
            ])
            ->add("city", TextType::class, [
                "attr" => [
                    "class" => "form-control",
                    "minlenght" => "2",
                    "maxlenght" => "50",
                ],
                "label" => "Ville",
                "label_attr" => [
                    "class" => "form_label mt-3",
                ],
                "constraints" => [
                    new Assert\Length(["min" => 2, "max" => 100]),
                    new Assert\NotBlank(),
                ],
            ])
            ->add("zipCode", IntegerType::class, [
                "attr" => [
                    "class" => "form-control",
                    "min" => 1,
                    "max" => 99999,
                ],
                "label" => "Code Postal",
                "label_attr" => [
                    "class" => "form_label mt-3",
                ],
                "constraints" => [
                    new Assert\NotBlank(),
                    new Assert\Range(min: 1, max: 99999),
                ],
            ])
            ->add("plainPassword", RepeatedType::class, [
                "type" => PasswordType::class,
                "first_options" => [
                    "attr" => [
                        "class" => "form-control",
                    ],
                    "label" => "Mot de passe",
                    "label_attr" => [
                        "class" => "form_label mt-3",
                    ],
                ],
                "second_options" => [
                    "attr" => [
                        "class" => "form-control",
                    ],
                    "label" => "Confirmer mot de passe",
                    "label_attr" => [
                        "class" => "form_label mt-3",
                    ],
                ],
                "invalid_message" => "Les mots de passe sont differents",
            ])
            ->add("submit", SubmitType::class, [
                "attr" => [
                    "class" => "btn btn-primary mt-4",
                ],
                "label" => "Enregister",
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            "data_class" => User::class,
        ]);
    }
}
