<?php

namespace App\Service;

use App\Entity\Season;
use DateMalformedStringException;
use DateTime;

class SeasonDateAdapter
{
    public const REFERENCE_YEAR = 2022;
    public function adapt(\DateTimeInterface $date, ?int $referenceYear = self::REFERENCE_YEAR): DateTime
    {
        return $date->setDate($referenceYear,(int)$date->format('m'), (int)$date->format('d'));
    }

    /**
     * @param Season $season
     * @param int|null $referenceYear
     * @return Season
     */
    public function calibrateSeasonDates(Season $season, ?int $referenceYear = self::REFERENCE_YEAR): Season
    {
        if ($season->getStartDate() === null || $season->getEndDate() === null) {
            return $season;
        }
        $adaptedStartDate = $this->adapt($season->getStartDate(), $referenceYear);
        $adaptedStartMonth = (int)$adaptedStartDate->format('m');
        $adaptedEndDate = $this->adapt($season->getEndDate(), $referenceYear);
        $adaptedEndMonth = (int)$adaptedEndDate->format('m');
        if ($adaptedEndMonth < $adaptedStartMonth) {
            $adaptedEndDate->modify('+1 year');
        }
        $season->setStartDate($adaptedStartDate);
        $season->setEndDate($adaptedEndDate);

        return $season;
    }

    public function actualizeSeasonToCurrentYear(Season $season): Season
    {
        if ($season->getStartDate() === null || $season->getEndDate() === null) {
            return $season;
        }
        $currentYear = (int)(New DateTime())->format('Y');

        return $this->calibrateSeasonDates($season, $currentYear);
    }
}