<?php

namespace App\Service;

use App\DTO\WeatherApiResponse;
use App\DTO\WeatherInfoInput;
use App\DTO\WeatherRes;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class WeatherProvider
{
    public function __construct(
        private SerializerInterface $serializer,
        private HttpClientInterface $client,
        #[Autowire('%env(WEATHER_API_KEY)%')]
        private string              $weatherApiKey,
        #[Autowire('%env(WEATHER_API_URL)%')]
        private string              $weatherApiUrl,
    )
    {
    }

    public function getWeather(WeatherInfoInput $input): WeatherApiResponse
    {
        $params = [
            'lat' => $input->lat,
            'lon' => $input->lng,
            'units' => "metric",
            'appid' => $this->weatherApiKey
        ];


        $apiParams = http_build_query($params, $arg_separator = "&",);

        $response = $this->client->request(
            'GET',
            $this->weatherApiUrl . $apiParams
        );

        $content = $response->getContent();
        $weatherResponse = $this->serializer->deserialize($content, WeatherApiResponse::class, 'json');

        return $weatherResponse;
    }
}