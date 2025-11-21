<?php

namespace App\DataFixtures;

use App\Entity\Aliment;
use App\Entity\Category;
use App\Entity\Unit;
use App\Repository\AlimentRepository;
use App\Repository\CategoryRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class AlimentFixtures extends Fixture implements DependentFixtureInterface
{

    public const ALIMENTS = [
        'Aubergine' => [
            'Légume',
            'unité',
            'Marché'
        ],
        'Courgette' => [
            'Légume',
            'unité',
            'Marché'
        ],
        'Tomate'    => [
            'Légume',
            'unité',
            'Marché'
        ],
        'Poivron vert'   => [
            'Légume',
            'unité',
            'Marché'
        ],
        'Poivron rouge'   => [
            'Légume',
            'unité',
            'Marché'
        ],
        'Poivron jaune'   => [
            'Légume',
            'unité',
            'Marché'
        ],
        'Ail (gousses)'   => [
            'Légume',
            'unité',
            'Marché'
        ],
        'Avocat'   => [
            'Légume',
            'unité',
            'Supermarché'
        ],
        'Citron vert'   => [
            'Légume',
            'unité',
            'Supermarché'
        ],
        'Citron jaune'   => [
            'Légume',
            'unité',
            'Supermarché'
        ],
        'Oignon'   => [
            'Légume',
            'unité',
            'Marché'
        ],
        'Oignon rouge'   => [
            'Légume',
            'unité',
            'Marché'
        ],
        'Concombre'   => [
            'Légume',
            'unité',
            'Marché'
        ],
        'Tomate cerise'   => [
            'Légume',
            'g',
            'Bio / Vrac'
        ],
        'Carotte'   => [
            'Légume',
            'unité',
            'Marché'
        ],
        'Poireau'   => [
            'Légume',
            'unité',
            'Marché'
        ],
        'Patate douce'   => [
            'Légume',
            'unité',
            'Marché'
        ],
        'Pomme de terre'   => [
            'Légume',
            'unité',
            'Marché'
        ],
        'Navet'   => [
            'Légume',
            'unité',
            'Marché'
        ],
        'Panais'   => [
            'Légume',
            'unité',
            'Marché'
        ],
        'Butternut'   => [
            'Légume',
            'unité',
            'Marché'
        ],
        'Potimarron'   => [
            'Légume',
            'unité',
            'Marché'
        ],
        'Potiron'   => [
            'Légume',
            'unité',
            'Marché'
        ],
        'Broccoli'   => [
            'Légume',
            'unité',
            'Marché'
        ],
        'Échalote'   => [
            'Légume',
            'unité',
            'Marché'
        ],
        'Betterave'   => [
            'Légume',
            'unité',
            'Supermarché'
        ],
        'Champignon frais'   => [
            'Légume',
            'g',
            'Bio / Vrac'
        ],
        'Cèpe'   => [
            'Légume',
            'g',
            'Bio / Vrac'
        ],
        'Asperge blanche fraîche'   => [
            'Légume',
            'g',
            'Bio / Vrac'
        ],
        'Asperge blanche'   => [
            'Légume',
            'g',
            'Supermarché'
        ],
        'Asperge verte'   => [
            'Légume',
            'g',
            'Supermarché'
        ],
        'Chou fleur'   => [
            'Légume',
            'unité',
            'Marché'
        ],
        'Chou vert'   => [
            'Légume',
            'unité',
            'Marché'
        ],
        'Chou'   => [
            'Légume',
            'unité',
            'Marché'
        ],
        'Chou chinois'   => [
            'Légume',
            'unité',
            'Marché'
        ],
        'Gingembre'   => [
            'Légume',
            'cm',
            'Bio / Vrac'
        ],
        'Chocolat'   => [
            'Pâtisserie',
            'g',
            'Supermarché'
        ],
        'Chocolat'   => [
            'Pâtisserie',
            'g',
            'Supermarché'
        ],
        'Beurre doux'   => [
            'Pâtisserie',
            'g',
            'Supermarché'
        ],
        'Beurre demi-sel'   => [
            'Pâtisserie',
            'g',
            'Supermarché'
        ],
        'Sucre vanillé'   => [
            'Pâtisserie',
            'cc',
            'Supermarché'
        ],
        'Vanille liquide'   => [
            'Pâtisserie',
            'cc',
            'Supermarché'
        ],
        'Crème semi-épaisse'   => [
            'Pâtisserie',
            'cl',
            'Supermarché'
        ],
        'Crème liquide'   => [
            'Pâtisserie',
            'cl',
            'Supermarché'
        ],
        'Lentilles vertes'   => [
            'Légume',
            'g',
            'Supermarché'
        ],
        'Lentilles corail'   => [
            'Légume',
            'g',
            'Supermarché'
        ],
        'Châtaignes'   => [
            'Légume',
            'g',
            'Supermarché'
        ],
        'Persil'   => [
            'Condiment',
            'g',
            'Supermarché'
        ],
        'Farine de sarrasin'   => [
            'Pâtisserie',
            'g',
            'Supermarché'
        ],
        'Tofu fumé amande et sésame'   => [
            'Légume',
            'g',
            'Bio / Vrac'
        ],
        'Tofu ail des ours'   => [
            'Légume',
            'g',
            'Bio / Vrac'
        ],
        'Maïs'   => [
            'Légume',
            'g',
            'Supermarché'
        ],
        'Fromage râpé'   => [
            'Laitage',
            'g',
            'Supermarché'
        ],
        'Pâtes Penne'   => [
            'Féculent',
            'g',
            'Supermarché'
        ],
        'Pâtes Farfalle'   => [
            'Féculent',
            'g',
            'Supermarché'
        ],
        'Pâtes Coudes rayés'   => [
            'Féculent',
            'g',
            'Supermarché'
        ],
        'Pâtes Macaroni'   => [
            'Féculent',
            'g',
            'Supermarché'
        ],
        'Pâtes Coquillettes'   => [
            'Féculent',
            'g',
            'Supermarché'
        ],
        'Pâtes Spaghetti'   => [
            'Féculent',
            'g',
            'Supermarché'
        ],
        'Pâtes Tagliatelles'   => [
            'Féculent',
            'g',
            'Supermarché'
        ],
        'Vermicelles de riz'   => [
            'Féculent',
            'g',
            'Supermarché'
        ],
        'Haricots rouges'   => [
            'Féculent',
            'g',
            'Supermarché'
        ],
        'Haricots blancs'   => [
            'Féculent',
            'g',
            'Supermarché'
        ],
        'Tahin'   => [
            'Condiment',
            'cs',
            'Supermarché'
        ],
        'Jus de citron jaune'   => [
            'Fruit',
            'ml',
            'Supermarché'
        ],
        'Jus de citron vert'   => [
            'Fruit',
            'ml',
            'Supermarché'
        ],
        'Huile d\'olive'   => [
            'Condiment',
            'cl',
            'Bio / Vrac'
        ],
        'Huile de sésame'   => [
            'Condiment',
            'cl',
            'Bio / Vrac'
        ],
        'Huile de lin'   => [
            'Condiment',
            'cl',
            'Bio / Vrac'
        ],
        'Huile de tournesol'   => [
            'Condiment',
            'cl',
            'Supermarché'
        ],
        'Vinaigre balsamique'   => [
            'Condiment',
            'cl',
            'Supermarché'
        ],
        'Vinaigre de cidre'   => [
            'Condiment',
            'cl',
            'Bio / Vrac'
        ],
        'Vinaigre de riz'   => [
            'Condiment',
            'cl',
            'Bio / Vrac'
        ],
        'Riz basmati'       => [
            'Féculent',
            'g',
            'Supermarché'
        ],
        'Riz complet'       => [
            'Féculent',
            'g',
            'Supermarché'
        ],
        'Riz rond à risotto'       => [
            'Féculent',
            'g',
            'Supermarché'
        ],
        'Riz rond à sushi'       => [
            'Féculent',
            'g',
            'Supermarché'
        ],
        'Pois chiches'       => [
            'Féculent',
            'g',
            'Supermarché'
        ],
        'Quinoa'       => [
            'Féculent',
            'g',
            'Supermarché'
        ],
        'Épeautre'       => [
            'Féculent',
            'g',
            'Supermarché'
        ],
        'Boulgour'       => [
            'Féculent',
            'g',
            'Supermarché'
        ],
        'Blé'       => [
            'Féculent',
            'g',
            'Supermarché'
        ],
        'Nouilles chinoises'       => [
            'Féculent',
            'g',
            'Supermarché'
        ],
        'Semoule'       => [
            'Féculent',
            'g',
            'Supermarché'
        ],
        'Polenta'       => [
            'Féculent',
            'g',
            'Supermarché'
        ],
        'Feuilles de riz'       => [
            'Féculent',
            'unité',
            'Supermarché'
        ],
        'Fajitas'       => [
            'Féculent',
            'unité',
            'Supermarché'
        ],
        'Graines de sésame'       => [
            'Condiment',
            'g',
            'Supermarché'
        ],
        'Tomates concassées'       => [
            'Condiment',
            'g',
            'Supermarché'
        ],
        'Tomates en dés'       => [
            'Condiment',
            'g',
            'Supermarché'
        ],
        'Concentré de tomates (boîte)'       => [
            'Condiment',
            'unité',
            'Supermarché'
        ],
        'Tomacouli nature'       => [
            'Condiment',
            'cl',
            'Supermarché'
        ],
        'Tomacouli basilic'       => [
            'Condiment',
            'cl',
            'Supermarché'
        ],
        'Mozzarella (boule)'       => [
            'Laitage',
            'unité',
            'Supermarché'
        ],
        'Chèvre frais'       => [
            'Laitage',
            'g',
            'Supermarché'
        ],
        'Bûche de chèvre'       => [
            'Laitage',
            'unité',
            'Supermarché'
        ],
        'Chavroux'       => [
            'Laitage',
            'g',
            'Supermarché'
        ],
        'Chavroux'       => [
            'Laitage',
            'g',
            'Supermarché'
        ],
        'Maïzena'       => [
            'Pâtisserie',
            'g',
            'Supermarché'
        ],
        'Yaourt grec'       => [
            'Laitage',
            'unité',
            'Supermarché'
        ],
        'Oeuf'      => [
            'Viande',
            'unité',
            'Supermarché'
        ],
        'Crevettes'      => [
            'Poisson',
            'g',
            'Marché'
        ],
        'Saumon'      => [
            'Poisson',
            'g',
            'Marché'
        ],
        'Thon'      => [
            'Poisson',
            'g',
            'Marché'
        ],
        'Poisson blanc (loup, aigle fin, merlu)'      => [
            'Poisson',
            'g',
            'Marché'
        ],
        'Thon en boîte'      => [
            'Poisson',
            'g',
            'Supermarché'
        ],
        'Bacon (tranches)'     => [
            'Viande',
            'unité',
            'Supermarché'
        ],
        'Curry'     => [
            'Condiment',
            'cc',
            'Supermarché'
        ],
        'Sauce soja salée'     => [
            'Condiment',
            'cs',
            'Bio / Vrac'
        ],
        'Sauce soja sucrée'     => [
            'Condiment',
            'cs',
            'Supermarché'
        ],
        'Sauce yakitori'     => [
            'Condiment',
            'cs',
            'Supermarché'
        ],
        'Sauce teriyaki'     => [
            'Condiment',
            'cs',
            'Supermarché'
        ],
        'Sucre blanc'     => [
            'Pâtisserie',
            'g',
            'Bio / Vrac'
        ],
        'Sucre roux'     => [
            'Pâtisserie',
            'g',
            'Bio / Vrac'
        ],
        'Farine'    => [
            'Pâtisserie',
            'kg',
            'Bio / Vrac'
        ],
        'Levure chimique'    => [
            'Pâtisserie',
            'g',
            'Supermarché'
        ],
        'Pépites de chocolat'    => [
            'Pâtisserie',
            'g',
            'Supermarché'
        ],
        'Levure boulangère'    => [
            'Pâtisserie',
            'g',
            'Bio / Vrac'
        ],
        'Bicarbonate alimentaire'    => [
            'Pâtisserie',
            'g',
            'Bio / Vrac'
        ],
        'Chorizo'   => [
            'Viande',
            'g',
            'Supermarché'
        ],
        'Fromage'       => [
            'Laitage',
            'g',
            'Supermarché'
        ],
        'Eau'       => [
            'Boisson',
            'L',
            'Supermarché'
        ],
        'Vin blanc de cuisine'       => [
            'Boisson',
            'cl',
            'Supermarché'
        ],
        'Lait demi-écrémé' => [
            'Laitage',
            'L',
            'Supermarché'
        ],
        'Lait entier' => [
            'Laitage',
            'L',
            'Supermarché'
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::ALIMENTS as $alimentName => $data) {
            $aliment = new Aliment();
            $aliment->setName($alimentName);
            $aliment->setCategory($this->getReference($data[0]));
            $aliment->setUnit($this->getReference($data[1]));
            $aliment->setShopPlace($this->getReference($data[2]));
            $aliment->setPrettyName(sprintf('%s (%s)', $alimentName, $data[1]));
            $manager->persist($aliment);
            $this->addReference($alimentName, $aliment);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
            UnitFixtures::class,
            ShopPlaceFixtures::class
        ];
    }
}
