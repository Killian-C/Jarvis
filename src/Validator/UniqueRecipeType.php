<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class UniqueRecipeType extends Constraint
{
    public string $message = 'Il existe déjà un type de recette avec ce nom : {{ recipe_type_name }}';
}