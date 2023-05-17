<?php

namespace App\Service;

use App\Repository\WeatherHistoryRepository;

class WeatherService
{
    public function __construct(
        private WeatherProvider $weatherProvider ,
        private SaveWeather $saveWeather,
        private WeatherHistoryRepository $weatherHistoryRepository)
    {
    }

    public function getWeatherByCoordinates(float $lat, float $lng)
    {
       $data = $this->weatherProvider->getWeather($lat,$lng);
       return $this->saveWeather->save($data);
    }

    public function getWeatherHistory(){
       return $this->weatherHistoryRepository->findAll();
    }

    public function getStatistics(){

    }

}