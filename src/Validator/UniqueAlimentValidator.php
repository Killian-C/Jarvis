<?php

namespace App\Validator;

use App\Entity\Aliment;
use App\Repository\AlimentRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class UniqueAlimentValidator extends ConstraintValidator
{
    private AlimentRepository $alimentRepository;
    public function __construct(AlimentRepository $alimentRepository)
    {
        $this->alimentRepository = $alimentRepository;
    }

    /**
     * @inheritDoc
     */
    public function validate($value, Constraint $constraint): void
    {
        if (false === $constraint instanceof UniqueAliment) {
            throw new UnexpectedTypeException($constraint, UniqueAliment::class);
        }

        $entity = $this->context->getObject();
        if ($entity && $entity->getId()) {
            return;
        }

        if (null === $value || '' === $value) {
            return;
        }

        $alimentAlreadyExists = $this->alimentRepository->findOneBy(['name' => $value]) instanceof Aliment;
        if ($alimentAlreadyExists) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ aliment_name }}', $value)
                ->addViolation()
            ;
        }
    }
}