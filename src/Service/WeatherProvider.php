<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class WeatherProvider
{
    public function __construct(
        private HttpClientInterface $client,
        #[Autowire('%env(WEATHER_API_KEY)%')]
        private string $weatherApiKey,
    )
    {
    }

    public function getWeather(float $lat,float $lng): Object
    {
        $apiEndpoint = "https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lng}&units=metric&appid={$this->weatherApiKey}";
        $response = $this->client->request(
            'GET',
            $apiEndpoint
        );

        $content = $response->getContent();

        return json_decode($content);
    }
}