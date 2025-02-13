<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class UniqueAliment extends Constraint
{
    public string $message = "Il existe déjà un aliment avec ce nom : {{ aliment_name }}";
}