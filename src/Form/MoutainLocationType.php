<?php

namespace App\Form;

use App\Entity\MountainLocation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class MoutainLocationType extends AbstractType
{
    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ): void {
        $builder
            ->add("name", TextType::class, [
                "attr" => [
                    "class" => "from-control",
                ],
                "label" => "Renseignez le nouveau massif",
                "label_attr" => [
                    "class" => "form_label mt-3",
                ],

                "constraints" => [new Assert\NotBlank()],
            ])
            //            ->add("color", ColorType::class, [
            //                "attr" => [
            //                    "class" => "from-control",
            //                ],
            //                "html5" => true,
            //                "data" => "#6f42c1",
            //                "label" => "Enregister",
            //                "mapped" => false,
            //            ])
            ->add("submit", SubmitType::class, [
                "attr" => [
                    "class" => "btn btn-primary mt-4",
                ],
                "label" => "Enregistrer",
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            "data_class" => MountainLocation::class,
        ]);
    }
}
