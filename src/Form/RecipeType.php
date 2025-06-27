<?php

namespace App\Form;

use App\Entity\Recipe;
use App\Entity\RecipeType as Type;
use App\Entity\Season;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'label' => 'Titre',
            ])
            ->add('description')
            ->add('recipeType', EntityType::class, [
                'label'        => 'Type',
                'class'        => Type::class,
                'choice_label' => 'name',
                'placeholder'  => 'Sélectionner le type de recette'
            ])
            ->add('duration', ChoiceType::class, [
                'choices'  => Recipe::RECIPE_DURATION_DETAILS,
                'label'    => 'Rapidité d\'exécution',
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('season', EntityType::class, [
                'label'        => 'Saison',
                'class'        => Season::class,
                'choice_label' => 'name',
                'placeholder'  => 'Sélectionner la saison'
            ])
            ->add('ingredients',CollectionType::class,[
                    'entry_type' => IngredientType::class,
                    'allow_add'  => true,
                    'label'      => false,
                ],
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
