<?php

namespace App\Service;
class WeatherService
{
    public function __construct(private WeatherProvider $weatherProvider)
    {
    }

    public function getWeatherByCoordinates(){
    }
}