<?php

namespace App\Controller;

use App\Service\Validator;
use App\Service\WeatherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatisticsController extends AbstractController
{

    public function __construct(private WeatherService $service)
    {
    }

    #[Route('/get-statistics', name: "getStatistics", methods: ['GET'])]
    public function getStatistics(): Response
    {
        $statistics = $this->service->getStatistics();
        return $this->json($statistics);
    }

}