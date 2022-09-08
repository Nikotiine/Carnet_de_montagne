<?php

namespace App\Form;

use App\Entity\Like;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LikeType extends AbstractType
{
    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ): void {
        $builder
            ->add("isLike", CheckboxType::class, [
                "attr" => [
                    "class" => "btn-check",
                ],
                "label" => "J aime",
                "label_attr" => [
                    "class" => "btn btn-primary",
                ],
            ])
            ->addEventListener(FormEvents::POST_SET_DATA, function (
                FormEvent $event
            ) {
                dump($event);
            });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            "data_class" => Like::class,
        ]);
    }
}
