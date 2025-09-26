<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use App\Validator as AcmeAssert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecipeRepository::class)
 */
class Recipe
{
    public const FAST          = 10;
    public const FAST_LABEL    = 'Rapide (15 min. env.)';
    public const AVERAGE       = 20;
    public const AVERAGE_LABEL = 'Normal (30-45 min. env.)';
    public const LONG          = 30;
    public const LONG_LABEL    = 'Long (plus d\'1h)';
    public const RECIPE_DURATION_DETAILS = [
        self::FAST_LABEL    => self::FAST,
        self::AVERAGE_LABEL => self::AVERAGE,
        self::LONG_LABEL    => self::LONG,
    ];

    public const RECIPE_DURATION_TEXT = [
        self::FAST    => 'Rapide',
        self::AVERAGE => 'Normal',
        self::LONG    => 'Long',
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @AcmeAssert\UniqueRecipe()
     */
    private ?string $title;

    /**
     * @ORM\Column(type="text")
     */
    private ?string $description;

    /**
     * @ORM\OneToMany(targetEntity=Ingredient::class, mappedBy="recipe", orphanRemoval=true, cascade={"persist"})
     */
    private Collection $ingredients;

    /**
     * @ORM\ManyToOne(targetEntity=RecipeType::class, inversedBy="recipes")
     * @ORM\JoinColumn(nullable=false)
     */
    private RecipeType $recipeType;

    /**
     * @ORM\ManyToOne(targetEntity=Season::class, inversedBy="recipes")
     */
    private ?Season $season;

    /**
     * @ORM\Column(type="integer", length=100, nullable=true)
     */
    private ?string $duration;


    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getTitle() ?? 'anonymous_recipe';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Ingredient[]
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(Ingredient $ingredient): self
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients[] = $ingredient;
            $ingredient->setRecipe($this);
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): self
    {
        if ($this->ingredients->removeElement($ingredient)) {
            // set the owning side to null (unless already changed)
            if ($ingredient->getRecipe() === $this) {
                $ingredient->setRecipe(null);
            }
        }

        return $this;
    }

    public function getRecipeType(): ?RecipeType
    {
        return $this->recipeType;
    }

    public function setRecipeType(?RecipeType $recipeType): self
    {
        $this->recipeType = $recipeType;

        return $this;
    }

    public function getSeason(): ?Season
    {
        return $this->season;
    }

    public function setSeason(?Season $season): self
    {
        $this->season = $season;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }
}
