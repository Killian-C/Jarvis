<?php

namespace App\Validator;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class UniqueCategoryValidator extends ConstraintValidator
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @inheritDoc
     */
    public function validate($value, Constraint $constraint): void
    {
        if (false === $constraint instanceof UniqueCategory) {
            throw new UnexpectedTypeException($constraint, UniqueCategory::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        $categoryAlreadyExists = $this->categoryRepository->findOneBy(['name' => $value]) instanceof Category;
        if ($categoryAlreadyExists) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ category_name }}', $value)
                ->addViolation()
            ;
        }
    }
}