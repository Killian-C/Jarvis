<?php

namespace App\Service;

use App\Entity\Season;
use DateMalformedStringException;

class SeasonDateAdapter
{
    public const REFERENCE_YEAR = 2022;
    public function adapt(\DateTimeInterface $date): \DateTime
    {
        return $date->setDate(self::REFERENCE_YEAR,(int)$date->format('m'), (int)$date->format('d'));
    }

    /**
     * @param Season $season
     * @return void
     * @throws DateMalformedStringException
     */
    public function calibrateSeasonDates(Season $season): Season
    {
        if ($season->getStartDate() === null || $season->getEndDate() === null) {
            return $season;
        }
        $adaptedStartDate = $this->adapt($season->getStartDate());
        $adaptedStartMonth = (int)$adaptedStartDate->format('m');
        $adaptedEndDate = $this->adapt($season->getEndDate());
        $adaptedEndMonth = (int)$adaptedEndDate->format('m');
        if ($adaptedEndMonth < $adaptedStartMonth) {
            $adaptedEndDate->modify('+1 year');
        }
        $season->setStartDate($adaptedStartDate);
        $season->setEndDate($adaptedEndDate);

        return $season;
    }
}