<?php

namespace App\Form\Type;

use App\Entity\Movie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Translation\Translator;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $translator = new Translator('');

        $builder
            ->add('name', TextType::class, [
                'label' => $translator->trans('Name')
            ])
            ->add('releaseYear', NumberType::class, [
                'label' => $translator->trans('Release Year')
            ])
            ->add('save', SubmitType::class, [
                'label' => $translator->trans('Save')
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}