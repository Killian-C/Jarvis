<?php

namespace App\Repository;

use App\Entity\Aliment;
use App\Entity\Ingredient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ingredient|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ingredient|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ingredient[]    findAll()
 * @method Ingredient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IngredientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ingredient::class);
    }

    public function findLikeByName(string $value)
    {
        /** @var AlimentRepository $alimentRepository */
        $alimentRepository = $this->getEntityManager()->getRepository(Aliment::class);
        $aliments = $alimentRepository->findLikeByName($value);

        return $this->createQueryBuilder('i')
            ->where('i.aliment IN (:aliments)')
            ->setParameter('aliments', $aliments)
            ->getQuery()
            ->getResult()
        ;
    }
}
