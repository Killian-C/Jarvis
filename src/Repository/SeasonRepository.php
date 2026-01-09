<?php

namespace App\Repository;

use App\Entity\Season;
use App\Service\SeasonDateAdapter;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

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
     * @param DateTime $date
     * @return array
     * @throws Exception
     *
     * si startDate 12/26 ET on2Y ET startSeasonMonth (ex: 12) > startDateMonth ===> RefYear
     * si startDate 12/26 ET on2Y ET startSeasonMonth (ex: 09) <= startDateMonth ===> RefYear
     * si startDate 01/27 ET on2Y ET startSeasonMonth (ex: 12) > startDateMonth ===> RefYear--
     * si startDate 09/27 ET on2Y ET startSeasonMonth (ex: 09) > startDateMonth ===> RefYear
     *
     */
    public function findSeasonByDate(DateTime $date): array
    {
        $seasons = $this->findAll();
        $seasonsFiltered = [];
        foreach ($seasons as $season) {
            $onTwoYears = false;
            if ((int)$season->getStartDate()->format('Y') < (int)$season->getEndDate()->format('Y')) {
                $onTwoYears = true;
            }
            $yearToCalibrate = (int)(new DateTime($date->format('Y-m-d')))->format('Y');

            if ($onTwoYears && (int)$season->getStartDate()->format('m') > (int)$date->format('m')) {
                $yearToCalibrate--;
            }

            $calibrateSeason = $this->seasonDateAdapter->calibrateSeasonDates($season, $yearToCalibrate);

            if ($calibrateSeason->getStartDate() <= $date && $calibrateSeason->getEndDate() >= $date) {
                $seasonsFiltered[] = $season;
            }
        }

        return $seasonsFiltered;
    }
}
