<?php

namespace App\Repository;

use App\Entity\Menu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Exception;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Menu|null find($id, $lockMode = null, $lockVersion = null)
 * @method Menu|null findOneBy(array $criteria, array $orderBy = null)
 * @method Menu[]    findAll()
 * @method Menu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MenuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Menu::class);
    }

    public function findAllGroupedByMonthYear(): array
    {
        $qb = $this->createQueryBuilder('m')
            ->orderBy('m.startedAt', 'DESC');

        $menus = $qb->getQuery()->getResult();

        $sortedMenus = [];

        // Formatter pour afficher les mois en français
        $formatter = new \IntlDateFormatter(
            'fr_FR',
            \IntlDateFormatter::NONE,
            \IntlDateFormatter::NONE,
            null,
            null,
            'MMMM yyyy'
        );

        /** @var Menu $menu */
        foreach ($menus as $menu) {
            $key = $formatter->format($menu->getStartedAt());
            $key = preg_replace('/\s+/u', ' ', $key);

            if (!array_key_exists($key, $sortedMenus)) {
                $sortedMenus[$key] = [];
            }

            $sortedMenus[$key][] = $menu;
        }

        return $sortedMenus;
    }

}
