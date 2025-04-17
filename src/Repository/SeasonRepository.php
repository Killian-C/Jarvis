<?php

namespace App\Repository;

use App\Entity\Season;
use App\Service\SeasonDateAdapter;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Season|null find($id, $lockMode = null, $lockVersion = null)
 * @method Season|null findOneBy(array $criteria, array $orderBy = null)
 * @method Season[]    findAll()
 * @method Season[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SeasonRepository extends ServiceEntityRepository
{
    private SeasonDateAdapter $seasonDateAdapter;
    public function __construct(ManagerRegistry $registry, SeasonDateAdapter $seasonDateAdapter)
    {
        parent::__construct($registry, Season::class);
        $this->seasonDateAdapter = $seasonDateAdapter;
    }

    /**
     * @throws \DateMalformedStringException
     */
    public function findSeasonByDate(DateTime $date)
    {
        $qb = $this->createQueryBuilder('s');

        $qb
            ->where("s.start_date <= :date AND s.end_date >= :date")
            ->setParameter('date', $this->seasonDateAdapter->adapt($date))
        ;

        return $qb->getQuery()->getResult();
    }
}
