<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture
{
    public const SEASONS = [
        '🌸 Printemps' => [
            '2022-03-02',
            '2022-06-01'
        ],
        '☀️ Été' => [
            '2022-06-02',
            '2022-09-01'
        ],
        '🎃 Automne' => [
            '2022-09-02',
            '2022-12-01'
        ],
        '❄️ Hiver' => [
            '2022-12-02',
            '2023-03-01'
        ],
        '🌈 Toutes saisons' => [
            '2022-01-01',
            '2022-12-31'
        ]
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::SEASONS as $seasonName => $date) {
            $season = new Season();
            $season->setName($seasonName);
            $season->setStartDate(new \DateTime($date[0]));
            $season->setEndDate(new \DateTime($date[1]));
            $manager->persist($season);
            $this->addReference($seasonName, $season);
        }

        $manager->flush();
    }
}
