<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class UniqueRecipe extends Constraint
{
    public string $message = 'Il existe déjà une recette avec ce titre : {{ recipe_title }}';
}