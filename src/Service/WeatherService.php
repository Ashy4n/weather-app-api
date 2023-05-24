<?php

namespace App\Service;

use App\DTO\Statistics;
use App\DTO\WeatherHistoryInput;
use App\DTO\WeatherInfoInput;
use App\Entity\WeatherHistory;
use App\Repository\WeatherHistoryRepository;
use App\Repository\WeatherRepository;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;

class WeatherService
{
    public function __construct(
        private WeatherProvider          $weatherProvider,
        private SaveWeather              $saveWeather,
        private WeatherHistoryRepository $weatherHistoryRepository,
        private WeatherRepository        $weatherRepository
    )
    {
    }

    public function getWeatherByCoordinates(WeatherInfoInput $input): WeatherHistory
    {
        $data = $this->weatherProvider->getWeather($input);
        return $this->saveWeather->save($data);
    }

    public function getWeatherHistory(WeatherHistoryInput $input): Pagerfanta
    {
        $queryBuilder = $this->weatherHistoryRepository->findAllQuery();
        $adapter = new QueryAdapter($queryBuilder);
        return Pagerfanta::createForCurrentPageWithMaxPerPage($adapter, $input->page, $input->limit);
    }

    public function getStatistics() : Statistics
    {
       return $statistics = new Statistics(
            $this->weatherHistoryRepository->getMostQueriedCity(),
            $this->weatherRepository->getNumberOfQueries(),
            $this->weatherRepository->getTemperatureData(),
        );
    }

}