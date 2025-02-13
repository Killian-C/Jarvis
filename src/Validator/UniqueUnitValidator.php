<?php

namespace App\Validator;

use App\Entity\Unit;
use App\Repository\UnitRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class UniqueUnitValidator extends ConstraintValidator
{
    public UnitRepository $unitRepository;

    public function __construct(UnitRepository $unitRepository){
        $this->unitRepository = $unitRepository;
    }

    /**
     * @inheritDoc
     */
    public function validate($value, Constraint $constraint): void
    {
        if (false === $constraint instanceof UniqueUnit) {
            throw new UnexpectedTypeException($constraint, UniqueUnit::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        $unitAlreadyExists = $this->unitRepository->findOneBy(['name' => $value]) instanceof Unit;
        if ($unitAlreadyExists) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ unit_name }}', $value)
                ->addViolation()
            ;
        }
    }
}