<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class UniqueShopPlace extends Constraint
{
    public string $message = "Il existe déjà un lieu d'achat avec ce nom : {{ shop_place_name }}";
}