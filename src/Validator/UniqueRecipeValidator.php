<?php

namespace App\Validator;

use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class UniqueRecipeValidator extends ConstraintValidator
{
    private RecipeRepository $recipeRepository;

    public function __construct(RecipeRepository $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }

    /**
     * @inheritDoc
     */
    public function validate($value, Constraint $constraint): void
    {
        if (false === $constraint instanceof UniqueRecipe) {
            throw new UnexpectedTypeException($constraint, UniqueRecipe::class);
        }

        $entity = $this->context->getObject();
        if ($entity && $entity->getId()) {
            return;
        }

        if (null === $value || '' === $value) {
            return;
        }

        $recipeAlreadyExists = $this->recipeRepository->findOneBy(['title' => $value]) instanceof Recipe;
        if ($recipeAlreadyExists) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ recipe_title }}', $value)
                ->addViolation()
            ;
        }
    }
}