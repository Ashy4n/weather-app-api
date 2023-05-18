<?php

namespace App\Service;

use App\Entity\WeatherHistory;
use App\Repository\WeatherHistoryRepository;
use App\Repository\WeatherRepository;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;

class WeatherService
{
    public function __construct(
        private WeatherProvider $weatherProvider ,
        private SaveWeather $saveWeather,
        private WeatherHistoryRepository $weatherHistoryRepository,
        private  WeatherRepository $weatherRepository
    )
    {
    }

    public function getWeatherByCoordinates(float $lat, float $lng) : WeatherHistory
    {
       $data = $this->weatherProvider->getWeather($lat,$lng);
       return $this->saveWeather->save($data);
    }

    public function getWeatherHistory(int $page,int $pageLimit) : Pagerfanta
    {
      $queryBuilder =  $this->weatherHistoryRepository->findAllQuery();
      $adapter = new QueryAdapter($queryBuilder);
      return Pagerfanta::createForCurrentPageWithMaxPerPage($adapter, $page, $pageLimit);
    }

    public function getStatistics() : array
    {
       return $statistics = [
           'mostQueriedCity' => $this->weatherHistoryRepository->getMostQueriedCity(),
           'allQueries' => $this->weatherRepository->getNumberOfQueries(),
           'tempData' => $this->weatherRepository->getTemperatureData()
       ];
    }

}