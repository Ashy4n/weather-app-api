<?php

namespace App\Service;

use App\Entity\Weather;
use App\Entity\WeatherHistory;
use App\Repository\WeatherHistoryRepository;
use App\Repository\WeatherRepository;
use Doctrine\ORM\EntityManagerInterface;

class SaveWeather
{
    public function __construct(
        private WeatherRepository $weatherRepository ,
        private WeatherHistoryRepository $weatherHistoryRepository,
        private EntityManagerInterface $entityManager
    )
    {
    }

    public function save($data) : WeatherHistory
    {
        $weather = new Weather();
        $weather->setTemperatureValue($data->main->temp);
        $weather->setClouds($data->clouds->all);
        $weather->setDescription($data->weather[0]->description);
        $weather->setImageUrl($data->weather[0]->icon);
        $weather->setWind($data->wind->speed);
        $this->entityManager->persist($weather);

        $weatherHistory = new WeatherHistory();
        $weatherHistory->setLat($data->coord->lat);
        $weatherHistory->setLng($data->coord->lon);
        $weatherHistory->setCity($data->name);
        if(property_exists($data,"country")){
            $weatherHistory->setCountry($data->sys->country);
        }else $weatherHistory->setCountry("");
        $weatherHistory->setWeather($weather);
        $this->entityManager->persist($weatherHistory);

        $this->entityManager->flush();

        return $weatherHistory;
    }
}