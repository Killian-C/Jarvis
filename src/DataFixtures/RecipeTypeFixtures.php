<?php

namespace App\DataFixtures;

use App\Entity\RecipeType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RecipeTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach (RecipeType::RECIPE_TYPES as $recipeTypeName) {
            $recipeType = new RecipeType();
            $recipeType->setName($recipeTypeName);
            $manager->persist($recipeType);
            $this->addReference($recipeTypeName, $recipeType);
        }

        $manager->flush();
    }
}
