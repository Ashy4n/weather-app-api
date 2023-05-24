<?php

namespace App\Service;

use App\DTO\WeatherApiResponse;
use App\Entity\Weather;
use App\Entity\WeatherHistory;
use App\Repository\WeatherHistoryRepository;
use App\Repository\WeatherRepository;
use Doctrine\ORM\EntityManagerInterface;

class SaveWeather
{
    public function __construct(
        private EntityManagerInterface $entityManager
    )
    {
    }

    public function save(WeatherApiResponse $data): WeatherHistory
    {
        $weather = new Weather();

        $weather->setTemperatureValue($data->main->temp);
        $weather->setClouds($data->clouds->all);
        $weather->setDescription($data->weather->description);
        $weather->setImageUrl($data->weather->icon);
        $weather->setWind($data->wind->speed);

        $this->entityManager->persist($weather);

        $weatherHistory = new WeatherHistory();

        $weatherHistory->setLat($data->coord->lat);
        $weatherHistory->setLng($data->coord->lon);
        $weatherHistory->setCity($data->name);
        if ($data->sys->country === "null") {
            $weatherHistory->setCountry($data->sys->country);
        } else $weatherHistory->setCountry("");
        $weatherHistory->setWeather($weather);

        $this->entityManager->persist($weatherHistory);

        $this->entityManager->flush();

        return $weatherHistory;
    }
}