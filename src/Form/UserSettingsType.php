<?php

namespace App\Form;

use App\Entity\UserSettings;
use App\Repository\MainCategoryRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserSettingsType extends AbstractType
{
    public function __construct(private MainCategoryRepository $repository)
    {
    }

    public function buildForm(
        FormBuilderInterface $builder,

        array $options
    ): void {
        $colors = $this->repository->getColors();

        $builder
            ->add("colorCatGrandeVoie", ColorType::class, [
                "attr" => [
                    "class" => "from-control",
                ],
                "html5" => true,
                "data" => $colors[0]["color"],
                "label" => "Grandes voies",
                "label_attr" => [
                    "class" => "form_label",
                ],
            ])
            ->add("colorCatGrandeVoieTrad", ColorType::class, [
                "attr" => [
                    "class" => "from-control",
                ],
                "html5" => true,
                "data" => $colors[1]["color"],
                "label" => "Grandes voies trad",
                "label_attr" => [
                    "class" => "form_label",
                ],
            ])
            ->add("colorCatAlpiRocheux", ColorType::class, [
                "attr" => [
                    "class" => "from-control",
                ],
                "html5" => true,
                "data" => $colors[2]["color"],
                "label" => "Alpinisme rocheux",
                "label_attr" => [
                    "class" => "form_label",
                ],
            ])
            ->add("colorCatAlpiMixte", ColorType::class, [
                "attr" => [
                    "class" => "from-control",
                ],
                "html5" => true,
                "data" => $colors[3]["color"],
                "label" => "Alpinisme mixte",
                "label_attr" => [
                    "class" => "form_label",
                ],
            ])
            ->add("colorCatRando", ColorType::class, [
                "attr" => [
                    "class" => "from-control",
                ],
                "html5" => true,
                "data" => $colors[4]["color"],
                "label" => "Randonée",
                "label_attr" => [
                    "class" => "form_label",
                ],
            ])
            ->add("colorCatRandoAlpine", ColorType::class, [
                "attr" => [
                    "class" => "from-control",
                ],
                "html5" => true,
                "data" => $colors[5]["color"],
                "label" => "Randonée Alpine",
                "label_attr" => [
                    "class" => "form_label",
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            "data_class" => UserSettings::class,
        ]);
    }
}
