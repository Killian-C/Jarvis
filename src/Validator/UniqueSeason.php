<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class UniqueSeason extends Constraint
{
    public string $message = 'Il existe déjà une saison avec ce nom : {{ season_name }}';
}