<?php

namespace App\Validator;

use App\Entity\RecipeType;
use App\Repository\RecipeTypeRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class UniqueRecipeTypeValidator extends ConstraintValidator
{
    private RecipeTypeRepository $recipeTypeRepository;

    public function __construct(RecipeTypeRepository $recipeTypeRepository)
    {
        $this->recipeTypeRepository = $recipeTypeRepository;
    }

    /**
     * @inheritDoc
     */
    public function validate($value, Constraint $constraint): void
    {
        if (false === $constraint instanceof UniqueRecipeType) {
            throw new UnexpectedTypeException($constraint, UniqueRecipeType::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        $recipeTypeAlreadyExists = $this->recipeTypeRepository->findOneBy(['name' => $value]) instanceof RecipeType;
        if ($recipeTypeAlreadyExists) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ recipe_type_name }}', $value)
                ->addViolation()
            ;
        }
    }
}