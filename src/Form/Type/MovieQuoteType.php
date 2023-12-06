<?php
namespace App\Form\Type;

use App\Entity\Movie;
use App\Validator\DoubleLetter;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\MovieQuote;
use Symfony\Component\Validator\Constraints\GreaterThan;

class MovieQuoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quote', TextType::class, [
                'constraints' => [new DoubleLetter()]
            ])
            ->add('character', TextType::class)
            ->add('movie', EntityType::class, [
                'class' => Movie::class,
                'choice_label' => 'name',
                'choice_value' => 'id'
            ])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MovieQuote::class,
        ]);
    }
}