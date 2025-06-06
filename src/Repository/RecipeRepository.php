<?php

namespace App\Repository;

use App\Entity\Recipe;
use App\Entity\Ingredient;
use App\Entity\RecipeType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use function Doctrine\ORM\QueryBuilder;

/**
 * @method Recipe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recipe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recipe[]    findAll()
 * @method Recipe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recipe::class);
    }

    public function findByTitleOrIngredientInRecipeTypes(string $value, array $recipeTypeNames)
    {
        $ingredientRepository = $this->getEntityManager()->getRepository(Ingredient::class);
        $ingredients          = $ingredientRepository->findLikeByName($value);
        $recipeTypeRepository = $this->getEntityManager()->getRepository(RecipeType::class);
        $recipeTypes          = $recipeTypeRepository->findByNames($recipeTypeNames);

        $qb = $this->createQueryBuilder('r');

        $qb
            ->join('r.ingredients', 'i')
            ->join('r.recipeType', 'rt')
        ;

        if ($value !== '') {
            $qb
                ->where('r.title LIKE :title')
                ->orWhere(
                    $qb->expr()->in('i', ':ingredients')
                )
                ->setParameter('title', '%' . $value . '%')
                ->setParameter('ingredients', $ingredients)
            ;
        }

        if (count($recipeTypeNames) > 0) {
            $qb->andWhere($qb->expr()->in('rt.name', ':recipeTypes'))->setParameter('recipeTypes', $recipeTypeNames);
        }

        return $qb->getQuery()->getResult();
    }
}
