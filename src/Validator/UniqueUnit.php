<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class UniqueUnit extends Constraint
{
    public string $message = "Il existe déjà une unité avec ce nom : {{ unit_name }}";
}