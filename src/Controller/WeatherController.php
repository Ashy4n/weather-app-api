<?php

namespace App\Controller;

use App\Repository\WeatherHistoryRepository;
use App\Service\WeatherProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class WeatherController extends AbstractController
{
    #[Route('/getWeather', name: "getWeather", methods: ['GET'])]
    public function getWeather(Request $request, WeatherProvider $weatherProvider): Response
    {
        dd($weatherProvider->getWeather(10, 10));
        return $this->json($content);
    }

    public function getHistory(): Response
    {
        return $this->json("");
    }

    public function getStatistics(): Response
    {
        return $this->json("");
    }

}