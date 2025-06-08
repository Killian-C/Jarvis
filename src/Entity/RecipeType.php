<?php

namespace App\Entity;

use App\Repository\RecipeTypeRepository;
use App\Validator as AcmeAssert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecipeTypeRepository::class)
 */
class RecipeType
{
    public const RECIPE_TYPES = [
        self::START,
        self::MAIN,
        self::TRASH_MAIN,
        self::DESSERT,
        self::SNACK,
        self::APERITIF,
        self::BREAKFAST,
    ];

    public const DEFAULT_TYPE_FILTERS = [
      self::MAIN,
      self::TRASH_MAIN
    ];

    public const START = 'Entrée';
    public const MAIN = 'Plat';
    public const TRASH_MAIN = 'Plat trash';
    public const DESSERT = 'Dessert';
    public const SNACK = 'Snack';
    public const APERITIF = 'Apéro';
    public const BREAKFAST = 'Petit déj\'';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @AcmeAssert\UniqueRecipeType()
     */
    private ?string $name;

    /**
     * @ORM\OneToMany(targetEntity=Recipe::class, mappedBy="recipeType")
     */
    private Collection $recipes;

    public function __construct()
    {
        $this->recipes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Recipe[]
     */
    public function getRecipes(): Collection
    {
        return $this->recipes;
    }

    public function addRecipe(Recipe $recipe): self
    {
        if (!$this->recipes->contains($recipe)) {
            $this->recipes[] = $recipe;
            $recipe->setRecipeType($this);
        }

        return $this;
    }

    public function removeRecipe(Recipe $recipe): self
    {
        if ($this->recipes->removeElement($recipe)) {
            // set the owning side to null (unless already changed)
            if ($recipe->getRecipeType() === $this) {
                $recipe->setRecipeType(null);
            }
        }

        return $this;
    }
}
