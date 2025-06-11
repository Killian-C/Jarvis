<?php

namespace App\Validator;

use App\Entity\Season;
use App\Repository\SeasonRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class UniqueSeasonValidator extends ConstraintValidator
{
    private SeasonRepository $seasonRepository;

    public function __construct(SeasonRepository $seasonRepository)
    {
        $this->seasonRepository = $seasonRepository;
    }

    /**
     * @inheritDoc
     */
    public function validate($value, Constraint $constraint): void
    {
        if (false === $constraint instanceof UniqueSeason) {
            throw new UnexpectedTypeException($constraint, UniqueSeason::class);
        }

        $entity = $this->context->getObject();
        if ($entity && $entity->getId()) {
            return;
        }

        if (null === $value || '' === $value) {
            return;
        }

        $seasonAlreadyExists = $this->seasonRepository->findOneBy(['name' => $value]) instanceof Season;
        if ($seasonAlreadyExists) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ season_name }}', $value)
                ->addViolation()
            ;
        }
    }
}