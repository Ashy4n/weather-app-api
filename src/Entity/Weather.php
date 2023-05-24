<?php

namespace App\Entity;

use App\Repository\WeatherRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WeatherRepository::class)]
class Weather
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $temperatureValue = null;

    #[ORM\Column(length: 255)]
    private ?string $temperatureUnit = null;

    #[ORM\Column(length: 255)]
    private ?string $clouds = null;

    #[ORM\Column]
    private ?float $wind = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $imageUrl = null;

    public function __construct()
    {
        $this->temperatureUnit = "C";
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTemperatureValue(): ?float
    {
        return $this->temperatureValue;
    }

    public function setTemperatureValue(float $temperatureValue): self
    {
        $this->temperatureValue = $temperatureValue;

        return $this;
    }

    public function getTemperatureUnit(): ?string
    {
        return $this->temperatureUnit;
    }

    public function setTemperatureUnit(string $temperatureUnit): self
    {
        $this->temperatureUnit = $temperatureUnit;

        return $this;
    }

    public function getClouds(): ?string
    {
        return $this->clouds;
    }

    public function setClouds(string $clouds): self
    {
        $this->clouds = $clouds;

        return $this;
    }

    public function getWind(): ?float
    {
        return $this->wind;
    }

    public function setWind(float $wind): self
    {
        $this->wind = $wind;

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

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }
}
