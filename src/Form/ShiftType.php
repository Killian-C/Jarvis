<?php

namespace App\Form;

use App\Entity\Recipe;
use App\Entity\Shift;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShiftType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $colorTypeOptions = [
            'label'    => false,
            'choices'  => Shift::SHIFT_COLOR_DETAILS,
            'expanded' => true,
            'multiple' => false,
        ];
        if (array_key_exists(MenuType::OPT_KEY_MODE, $options) && $options[MenuType::OPT_KEY_MODE] === MenuType::OPT_ARG_MODE_NEW) {
            $colorTypeOptions['data'] = Shift::BLUE_SHIFT;
        }

        $builder
            ->add('identifier', HiddenType::class, [
                'label' => false,
            ])
            ->add('moment', HiddenType::class, [
                'label' => false,
            ])
            ->add('color', ChoiceType::class, $colorTypeOptions)
            ->add('dishes', CollectionType::class, [
                'entry_type'    => DishType::class,
                'allow_add'     => true,
                'entry_options' => [MenuType::OPT_KEY_MODE => $options[MenuType::OPT_KEY_MODE]],
                'label'         => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class'           => Shift::class,
            MenuType::OPT_KEY_MODE => MenuType::OPT_ARG_MODE_EDIT
        ]);
    }
}
