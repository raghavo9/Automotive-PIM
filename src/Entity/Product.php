<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    public $category;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $addedBy;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $product_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $brand;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $colour;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $engine;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fuel_type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $milage;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $product_image;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
    * @ORM\Column(type="string", columnDefinition= "ENUM('draft', 'review', 'publish')",nullable=true)
    */
    private $status;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $stearing_side;

    /**
     * @ORM\Column(type="integer")
     */
    private $capacity;

    /**
     * @ORM\Column(type="float")
     */
    private $tankSize;

    /**
     * @ORM\Column(type="boolean")
     */
    private $stepney;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $wheelType;

    /**
     * @ORM\Column(type="boolean")
     */
    private $trunk;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $enginePower;

    /**
     * @ORM\Column(type="float")
     */
    private $engineOilCapacity;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $coolingSystemType;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $coolantType;

    /**
     * @ORM\Column(type="integer")
     */
    private $airbagCount;

    /**
     * @ORM\Column(type="boolean")
     */
    private $powerWindows;

    /**
     * @ORM\Column(type="boolean")
     */
    private $sunroof;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getAddedBy(): ?User
    {
        return $this->addedBy;
    }

    public function setAddedBy(?User $addedBy): self
    {
        $this->addedBy = $addedBy;

        return $this;
    }

    public function getProductName(): ?string
    {
        return $this->product_name;
    }

    public function setProductName(string $product_name): self
    {
        $this->product_name = $product_name;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getColour(): ?string
    {
        return $this->colour;
    }

    public function setColour(string $colour): self
    {
        $this->colour = $colour;

        return $this;
    }

    public function getEngine(): ?string
    {
        return $this->engine;
    }

    public function setEngine(string $engine): self
    {
        $this->engine = $engine;

        return $this;
    }

    public function getFuelType(): ?string
    {
        return $this->fuel_type;
    }

    public function setFuelType(string $fuel_type): self
    {
        $this->fuel_type = $fuel_type;

        return $this;
    }

    public function getMilage(): ?string
    {
        return $this->milage;
    }

    public function setMilage(string $milage): self
    {
        $this->milage = $milage;

        return $this;
    }

    public function getProductImage(): ?string
    {
        return $this->product_image;
    }

    public function setProductImage(string $product_image): self
    {
        $this->product_image = $product_image;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();
    }


    /**
     * @ORM\PrePersist
     */
    public function setUpdatedAtValue()
    {
        $this->updatedAt = new \DateTime();
    }

    public function getStearingSide(): ?string
    {
        return $this->stearing_side;
    }

    public function setStearingSide(string $stearing_side): self
    {
        $this->stearing_side = $stearing_side;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getTankSize(): ?float
    {
        return $this->tankSize;
    }

    public function setTankSize(float $tankSize): self
    {
        $this->tankSize = $tankSize;

        return $this;
    }

    public function getStepney(): ?bool
    {
        return $this->stepney;
    }

    public function setStepney(bool $stepney): self
    {
        $this->stepney = $stepney;

        return $this;
    }

    public function getWheelType(): ?string
    {
        return $this->wheelType;
    }

    public function setWheelType(string $wheelType): self
    {
        $this->wheelType = $wheelType;

        return $this;
    }

    public function getTrunk(): ?bool
    {
        return $this->trunk;
    }

    public function setTrunk(bool $trunk): self
    {
        $this->trunk = $trunk;

        return $this;
    }

    public function getEnginePower(): ?string
    {
        return $this->enginePower;
    }

    public function setEnginePower(string $enginePower): self
    {
        $this->enginePower = $enginePower;

        return $this;
    }

    public function getEngineOilCapacity(): ?float
    {
        return $this->engineOilCapacity;
    }

    public function setEngineOilCapacity(float $engineOilCapacity): self
    {
        $this->engineOilCapacity = $engineOilCapacity;

        return $this;
    }

    public function getCoolingSystemType(): ?string
    {
        return $this->coolingSystemType;
    }

    public function setCoolingSystemType(string $coolingSystemType): self
    {
        $this->coolingSystemType = $coolingSystemType;

        return $this;
    }

    public function getCoolantType(): ?string
    {
        return $this->coolantType;
    }

    public function setCoolantType(string $coolantType): self
    {
        $this->coolantType = $coolantType;

        return $this;
    }

    public function getAirbagCount(): ?int
    {
        return $this->airbagCount;
    }

    public function setAirbagCount(int $airbagCount): self
    {
        $this->airbagCount = $airbagCount;

        return $this;
    }

    public function getPowerWindows(): ?bool
    {
        return $this->powerWindows;
    }

    public function setPowerWindows(bool $powerWindows): self
    {
        $this->powerWindows = $powerWindows;

        return $this;
    }

    public function getSunroof(): ?bool
    {
        return $this->sunroof;
    }

    public function setSunroof(bool $sunroof): self
    {
        $this->sunroof = $sunroof;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }
    
    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }
    
}
