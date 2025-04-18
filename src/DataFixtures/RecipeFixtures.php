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
            'season' => 'Toutes saisons'
        ],
        'Pain' => [
            'description' => 'faire la recette',
            'ingredients' => [
                'Farine' => 100,
            ],
            'type' => 'Snack',
            'season' => 'Été'
        ],
        'Toast veggie' => [
            'description' => 'faire la recette',
            'ingredients' => [
                'Aubergine' => 3,
            ],
            'type' => 'Entrée',
            'season' => 'Été'
        ],
        'Flan vert indien' => [
            'description' => 'faire la recette',
            'ingredients' => [
                'Courgette' => 3,
                'Curry' => 20
            ],
            'type' => 'Plat',
            'season' => 'Été'
        ],
        'Apéro piquant' => [
            'description' => 'faire la recette',
            'ingredients' => [
                'Chorizo' => 12,
            ],
            'type' => 'Apéro',
            'season' => 'Hiver'
        ],
        'Riz cantonais d\'automne' => [
            'description' => 'faire la recette',
            'ingredients' => [
                'Riz' => 250,
            ],
            'type' => 'Plat',
            'season' => 'Automne'
        ],
        'Riz au lait' => [
            'description' => 'faire la recette',
            'ingredients' => [
                'Riz' => 250,
                'Sucre' => 12.5
            ],
            'type' => 'Dessert',
            'season' => 'Printemps'
        ],
        'Poivrons farcis' => [
            'description' => 'faire la recette',
            'ingredients' => [
                'Poivron' => 2,
                'Bacon' => 7
            ],
            'type' => 'Plat',
            'season' => 'Printemps'
        ],
        'Ratatouille' => [
            'description' => 'faire la recette',
            'ingredients' => [
                'Poivron' => 2,
                'Tomate' => 7
            ],
            'type' => 'Plat',
            'season' => 'Automne'
        ],
        'Fajitas' => [
            'description' => 'faire la recette',
            'ingredients' => [
                'Poivron' => 2,
                'Tomate' => 7
            ],
            'type' => 'Plat',
            'season' => 'Toutes saisons'
        ],
        'Flammekueche' => [
            'description' => 'faire la recette',
            'ingredients' => [
                'Bacon' => 5,
                'Farine' => 100
            ],
            'type' => 'Plat',
            'season' => 'Toutes saisons'
        ],
    ];

    public function load(ObjectManager $manager)
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
            $manager->persist($recipe);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AlimentFixtures::class,
            RecipeTypeFixtures::class,
            SeasonFixtures::class
        ];
    }
}
