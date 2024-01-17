<?php
namespace App\Form\Type;

use App\Entity\Movie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\MovieQuote;
use Symfony\Component\Translation\Translator;

class MovieQuoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $translator = new Translator('');

        $builder
            ->add('quote', TextType::class, [
                'label' => $translator->trans('Quote')
            ])
            ->add('character', TextType::class, [
                'label' => $translator->trans('Character')
            ])
            ->add('movie', EntityType::class, [
                'label' => $translator->trans('Movie'),
                'class' => Movie::class,
                'choice_label' => 'name',
                'choice_value' => 'id'
            ])
            ->add('save', SubmitType::class, [
                'label' => $translator->trans('Save'),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MovieQuote::class,
        ]);
    }
}