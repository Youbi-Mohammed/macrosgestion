<?php

namespace App\Form;

use App\Entity\Ingredient;
use App\Entity\Plats;
use App\Entity\Recette;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('instructions')
          
            ->add('ingredient', EntityType::class, [
                'class' => Ingredient::class,
                'choice_label' => 'aliment',
                'multiple' => true,
                'expanded' => true, // Affiche les checkboxes
                'label' => 'aliment',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recette::class,
        ]);
    }
}
