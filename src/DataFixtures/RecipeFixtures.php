<?php

namespace App\DataFixtures;

use App\Entity\Aliment;
use App\Entity\Category;
use App\Entity\Ingredient;
use App\Entity\Recipe;
use App\Entity\Unit;
use App\Repository\AlimentRepository;
use App\Repository\CategoryRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class RecipeFixtures extends Fixture implements DependentFixtureInterface
{
    public const RECIPES = [
        'La poule et le cochon' => [
            'description' => 'faire la recette',
            'ingredients' => [
                'Oeuf' => 2,
                'Bacon' => 5
            ],
            'type' => 'Plat',
            'season' => 'Toutes saisons',
            'duration' => Recipe::FAST,
        ],
        'Pain' => [
            'description' => 'faire la recette',
            'ingredients' => [
                'Farine' => 100,
            ],
            'type' => 'Snack',
            'season' => 'Été',
            'duration' => Recipe::LONG,
        ],
        'Toast veggie' => [
            'description' => 'faire la recette',
            'ingredients' => [
                'Aubergine' => 3,
            ],
            'type' => 'Entrée',
            'season' => 'Été',
            'duration' => Recipe::FAST,
        ],
        'Flan vert indien' => [
            'description' => 'faire la recette',
            'ingredients' => [
                'Courgette' => 3,
                'Curry' => 20
            ],
            'type' => 'Plat',
            'season' => 'Été',
            'duration' => Recipe::AVERAGE,
        ],
        'Apéro piquant' => [
            'description' => 'faire la recette',
            'ingredients' => [
                'Chorizo' => 12,
            ],
            'type' => 'Apéro',
            'season' => 'Hiver',
            'duration' => Recipe::FAST,
        ],
        'Riz cantonais d\'automne' => [
            'description' => 'faire la recette',
            'ingredients' => [
                'Riz' => 250,
            ],
            'type' => 'Plat',
            'season' => 'Automne',
            'duration' => Recipe::AVERAGE,
        ],
        'Riz au lait' => [
            'description' => 'faire la recette',
            'ingredients' => [
                'Riz' => 250,
                'Sucre' => 12.5
            ],
            'type' => 'Dessert',
            'season' => 'Printemps',
            'duration' => Recipe::AVERAGE,
        ],
        'Poivrons farcis' => [
            'description' => 'faire la recette',
            'ingredients' => [
                'Poivron' => 2,
                'Bacon' => 7
            ],
            'type' => 'Plat',
            'season' => 'Printemps',
            'duration' => Recipe::LONG,
        ],
        'Ratatouille' => [
            'description' => 'faire la recette',
            'ingredients' => [
                'Poivron' => 2,
                'Tomate' => 7
            ],
            'type' => 'Plat',
            'season' => 'Automne',
            'duration' => Recipe::LONG,
        ],
        'Fajitas' => [
            'description' => 'faire la recette',
            'ingredients' => [
                'Poivron' => 2,
                'Tomate' => 7
            ],
            'type' => 'Plat',
            'season' => 'Toutes saisons',
            'duration' => Recipe::AVERAGE,
        ],
        'Flammekueche' => [
            'description' => 'faire la recette',
            'ingredients' => [
                'Bacon' => 5,
                'Farine' => 100
            ],
            'type' => 'Plat',
            'season' => 'Toutes saisons',
            'duration' => Recipe::FAST,
        ],
        'Pizza rapide toutes saisons' => [
            'description' => 'faire la recette',
            'ingredients' => [
                'Fromage' => 350,
                'Farine' => 100
            ],
            'type' => 'Plat',
            'season' => 'Toutes saisons',
            'duration' => Recipe::FAST,
        ],
        'Pizza normale toutes saisons' => [
            'description' => 'faire la recette',
            'ingredients' => [
                'Tomate' => 5,
                'Farine' => 100
            ],
            'type' => 'Plat',
            'season' => 'Toutes saisons',
            'duration' => Recipe::AVERAGE,
        ],
        'Pizza longue toutes saisons' => [
            'description' => 'faire la recette',
            'ingredients' => [
                'Truffe' => 1,
                'Farine' => 100
            ],
            'type' => 'Plat',
            'season' => 'Toutes saisons',
            'duration' => Recipe::LONG,
        ],

    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::RECIPES as $recipeTitle => $data) {
            $recipe = new Recipe();
            $recipe->setTitle($recipeTitle);
            $recipe->setDescription($data['description']);
            foreach ($data['ingredients'] as $ingredientName => $ingredientNb) {
                $ingredient = new Ingredient();
                $ingredient->setAliment($this->getReference($ingredientName));
                $ingredient->setQuantity($ingredientNb);
                $recipe->addIngredient($ingredient);
            }
            $recipe->setRecipeType($this->getReference($data['type']));
            $recipe->setSeason($this->getReference($data['season']));
            $recipe->setDuration($data['duration']);
            $manager->persist($recipe);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            AlimentFixtures::class,
            RecipeTypeFixtures::class,
            SeasonFixtures::class
        ];
    }
}
