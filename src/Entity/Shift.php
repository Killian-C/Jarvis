<?php

namespace App\Entity;

use App\Repository\ShiftRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ShiftRepository::class)
 */
class Shift
{
    public const MOMENT_LUNCH = 'midi';
    public const MOMENT_DINER = 'soir';
    public const KEY_SHIFT_DAY = 0;
    public const KEY_SHIFT_MOMENT = 1;
    public const SHIFT_IDENTIFIER = [
        ['Lundi', self::MOMENT_LUNCH],
        ['Lundi', self::MOMENT_DINER],
        ['Mardi', self::MOMENT_LUNCH],
        ['Mardi', self::MOMENT_DINER],
        ['Mercredi', self::MOMENT_LUNCH],
        ['Mercredi', self::MOMENT_DINER],
        ['Jeudi', self::MOMENT_LUNCH],
        ['Jeudi', self::MOMENT_DINER],
        ['Vendredi', self::MOMENT_LUNCH],
        ['Vendredi', self::MOMENT_DINER],
        ['Samedi', self::MOMENT_LUNCH],
        ['Samedi', self::MOMENT_DINER],
        ['Dimanche', self::MOMENT_LUNCH],
        ['Dimanche', self::MOMENT_DINER],
    ];

    public const DAYS_INDEX_SHIFT_INDENTIFIER = [
        'Monday'    => 0,
        'Tuesday'   => 2,
        'Wednesday' => 4,
        'Thursday'  => 6,
        'Friday'    => 8,
        'Saturday'  => 10,
        'Sunday'    => 12,
    ];

    public const BLUE_SHIFT = '#5784BA';
    public const GREEN_SHIFT = '#28a745';
    public const RED_SHIFT = '#955149';
    public const DEFAULT_COLOR = self::BLUE_SHIFT;

    public const SHIFT_COLOR_DETAILS = [
        '🔵' => self::BLUE_SHIFT,
        '🟢' => self::GREEN_SHIFT,
        '🔴' => self::RED_SHIFT,
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $identifier;

    /**
     * @ORM\ManyToOne(targetEntity=Menu::class, inversedBy="shifts")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Menu $menu;

    /**
     * @ORM\OneToMany(targetEntity=Dish::class, mappedBy="shift", cascade={"persist"})
     */
    private Collection $dishes;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private ?string $moment;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private ?string $color;

    public function __construct()
    {
        $this->dishes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function getMenu(): ?Menu
    {
        return $this->menu;
    }

    public function setMenu(?Menu $menu): self
    {
        $this->menu = $menu;

        return $this;
    }

    /**
     * @return Collection|Dish[]
     */
    public function getDishes(): Collection
    {
        return $this->dishes;
    }

    public function addDish(Dish $dish): self
    {
        if (!$this->dishes->contains($dish)) {
            $this->dishes[] = $dish;
            $dish->setShift($this);
        }

        return $this;
    }

    public function removeDish(Dish $dish): self
    {
        if ($this->dishes->removeElement($dish)) {
            // set the owning side to null (unless already changed)
            if ($dish->getShift() === $this) {
                $dish->setShift(null);
            }
        }

        return $this;
    }

    public function getMoment(): ?string
    {
        return $this->moment;
    }

    public function setMoment(string $moment): self
    {
        $this->moment = $moment;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color ?? self::DEFAULT_COLOR;

        return $this;
    }
}
