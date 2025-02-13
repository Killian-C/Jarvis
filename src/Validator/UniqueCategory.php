<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class UniqueCategory extends Constraint
{
    public string $message = "Il existe déjà une catégorie avec ce nom : {{ category_name }}";
}