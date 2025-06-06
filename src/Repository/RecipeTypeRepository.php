<?php

namespace App\Repository;

use App\Entity\RecipeType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RecipeType|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecipeType|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecipeType[]    findAll()
 * @method RecipeType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipeTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecipeType::class);
    }

    public function findByNames(array $names)
    {
        $qb = $this->createQueryBuilder('rt');
        $qb
            ->where($qb->expr()->in('rt.name', ':names'))
            ->setParameter('names', $names)
        ;

        return $qb->getQuery()->getResult();
    }
}
