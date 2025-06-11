<?php

namespace App\Validator;

use App\Entity\ShopPlace;
use App\Repository\ShopPlaceRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class UniqueShopPlaceValidator extends ConstraintValidator
{
    private ShopPlaceRepository $shopPlaceRepository;

    public function __construct(ShopPlaceRepository $shopPlaceRepository)
    {
        $this->shopPlaceRepository = $shopPlaceRepository;
    }

    /**
     * @inheritDoc
     */
    public function validate($value, Constraint $constraint): void
    {
        if (false === $constraint instanceof UniqueShopPlace) {
            throw new UnexpectedTypeException($constraint, UniqueShopPlace::class);
        }

        $entity = $this->context->getObject();
        if ($entity && $entity->getId()) {
            return;
        }

        if (null === $value || '' === $value) {
            return;
        }

        $shopPlaceAlreadyExists = $this->shopPlaceRepository->findOneBy(['name' => $value]) instanceof ShopPlace;
        if ($shopPlaceAlreadyExists) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ shop_place_name }}', $value)
                ->addViolation()
            ;
        }
    }
}