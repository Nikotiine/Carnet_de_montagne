<?php

namespace App\Form;

use App\Entity\ConditionMeteo;
use App\Entity\Difficulty;
use App\Entity\Felling;
use App\Entity\MainCategory;
use App\Entity\MountainLocation;
use App\Entity\NotebookPage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class NotebookPageType extends AbstractType
{
    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ): void {
        $builder
            ->add("title", TextType::class, [
                "attr" => [
                    "class" => "form-control",
                ],
                "label" => "Titre de la page",
                "label_attr" => [
                    "class" => "form-label mt-3",
                ],
                "constraints" => [new Assert\NotBlank()],
            ])
            ->add("routName", TextType::class, [
                "attr" => [
                    "class" => "form-control",
                ],
                "label" => "Nom de la course",
                "label_attr" => [
                    "class" => "form-label mt-3",
                ],
                "constraints" => [new Assert\NotBlank()],
            ])
            ->add("moutainLocation", EntityType::class, [
                "class" => MountainLocation::class,
                "placeholder" => "Localisation",
                "attr" => [
                    "class" => "form-select",
                ],
                "label" => "Dans quel massif ?",
                "label_attr" => [
                    "class" => "form-label mt-3",
                ],
                "choice_label" => "name",
                "multiple" => false,
                "expanded" => false,
            ])
            ->add("category", EntityType::class, [
                "class" => MainCategory::class,
                "attr" => [
                    "class" => "form-select",
                ],
                "placeholder" => "Choisir un type de course",

                "label" => "Type de sortie",
                "label_attr" => [
                    "class" => "form-label mt-3",
                ],
                "choice_label" => "name",
                "multiple" => false,
                "expanded" => false,
                "constraints" => [new Assert\NotNull()],
            ])
            ->add("difficulty", EntityType::class, [
                "class" => Difficulty::class,
                "attr" => [
                    "class" => "form-select",
                ],
                "placeholder" => "Choisir une difficulté",

                "label" => "Difficulté",
                "label_attr" => [
                    "class" => "form-label mt-3",
                ],
                "choice_label" => "name",
                "multiple" => false,
                "expanded" => false,
                "constraints" => [new Assert\NotNull()],
            ])
            ->add("heightDifference", IntegerType::class, [
                "attr" => [
                    "class" => "form-control",
                    "min" => 1,
                    "max" => 99999,
                ],
                "label" => "Denivele",
                "label_attr" => [
                    "class" => "form-label mt-3",
                ],
                "constraints" => [new Assert\Range(min: 1, max: 99999)],
            ])
            ->add("achieveAt", DateType::class, [
                "attr" => [
                    "class" => "form-control mt-2",
                ],
                "input" => "datetime_immutable",
                "label" => "Quel Jour ?",
                "label_attr" => [
                    "class" => "form-label mt-3",
                ],
                "html5" => false,
            ])
            ->add("totalTime", TimeType::class, [
                "attr" => [
                    "class" => "form-control mt-2",
                ],
                "label" => "Temps de course",
                "label_attr" => [
                    "class" => "form-label mt-3",
                ],
            ])
            ->add("story", TextareaType::class, [
                "attr" => [
                    "class" => "form-control",
                ],
                "label" => "Votre recit",
                "label_attr" => [
                    "class" => "form-label mt-3",
                ],
                "constraints" => [new Assert\NotNull()],
            ])
            ->add("pointToReview", TextareaType::class, [
                "attr" => [
                    "class" => "form-control",
                ],
                "label" => "Point a revoir",
                "label_attr" => [
                    "class" => "form-label mt-3",
                ],
            ])
            ->add("conditionMeteot", EntityType::class, [
                "class" => ConditionMeteo::class,
                "placeholder" => "Definir la meteo",
                "attr" => [
                    "class" => "form-select",
                ],
                "label" => "Condition meteo",
                "label_attr" => [
                    "class" => "form-label mt-3",
                ],
                "choice_label" => "name",
                "multiple" => false,
                "expanded" => false,
                "constraints" => [new Assert\NotNull()],
            ])
            ->add("feeling", EntityType::class, [
                "class" => Felling::class,
                "placeholder" => "Quel sentiment ?",
                "attr" => [
                    "class" => "form-select",
                ],
                "label" => "Sentiment",
                "label_attr" => [
                    "class" => "form-label mt-3",
                ],
                "choice_label" => "name",
                "multiple" => false,
                "expanded" => false,
            ])
            ->add("isPublic", ChoiceType::class, [
                "attr" => [
                    "class" => "form-check d-flex",
                ],
                "choices" => [
                    "Oui" => true,
                    "Non" => false,
                ],
                "data" => true,
                "label" => "Afficher en public ?",
                "label_attr" => [
                    "class" => "p-1",
                ],
                "expanded" => true,
                "multiple" => false,
            ])
            ->add("submit", SubmitType::class, [
                "attr" => [
                    "class" => "btn btn-primary mt-4",
                ],
                "label" => "Ajouter",
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            "data_class" => NotebookPage::class,
        ]);
    }
}
