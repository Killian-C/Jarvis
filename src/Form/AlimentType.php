<?php

namespace App\Form;

use App\Entity\Aliment;
use App\Entity\Category;
use App\Entity\ShopPlace;
use App\Entity\Unit;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlimentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom',
            ])
            ->add('category', EntityType::class, [
                'label'        => 'Categorie',
                'class'        => Category::class,
                'choice_label' => 'name',
                'multiple'     => false,
                'expanded'     => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')->orderBy('c.name', 'ASC');
                }
            ])
            ->add('unit', EntityType::class, [
                'label'         => 'Unité de mesure de l\'aliment',
                'class'         => Unit::class,
                'choice_label'  => 'name',
                'placeholder'   => 'Sélectionner l\'unité de mesure',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')->orderBy('u.name', 'ASC');
                }
            ])
            ->add('shopPlace', EntityType::class, [
                'label'        => 'Lieu d\'achat principal',
                'class'        => ShopPlace::class,
                'choice_label' => 'name',
                'placeholder'  => 'Sélectionner un lieu d\'achat',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('s')->orderBy('s.name', 'ASC');
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Aliment::class,
        ]);
    }
}
