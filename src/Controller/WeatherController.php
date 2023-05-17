<?php

namespace App\Controller;

use App\HistoryInput;
use App\Repository\WeatherHistoryRepository;
use App\Service\WeatherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class WeatherController extends AbstractController
{
    public function __construct(private WeatherService $service)
    {
    }

    #[Route('/getWeather', name: "getWeather", methods: ['GET'])]
    public function getWeather(Request $request): Response
    {
        $lat = $request->query->get('lat');
        $lng = $request->query->get('lng');
        if($lat < -90 || $lat > 90 || $lng < -180 || $lng >180)return $this->json(null,Response::HTTP_BAD_REQUEST);
        if($lat == null || $lng == null) return $this->json(null,Response::HTTP_BAD_REQUEST);

        $response = $this->service->getWeatherByCoordinates($lat,$lng);
        return $this->json($response);
    }

    #[Route('/getHistory', name: "getHistory", methods: ['GET'])]
    public function getHistory(Request $request): Response
    {
        $page = $request->query->get('page');
        $limit = $request->query->get('limit');
        $response = $this->service->getWeatherHistory($page,$limit);
        return $this->json($response);
    }

    #[Route('/getStatistics', name: "getStatistics", methods: ['GET'])]
    public function getStatistics(): Response
    {
        $statistics =  $this->service->getStatistics();
        return $this->json($statistics);
    }

}