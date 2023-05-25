<?php

namespace App\Controller;

use App\Forms\WeatherInfoForm;
use App\Service\WeatherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class WeatherController extends AbstractController
{
    public function __construct(private WeatherService $service)
    {
    }

    #[Route('/get-weather', name: "getWeather", methods: ['GET'])]
    public function getWeather(Request $request): Response
    {
        $form = $this->createForm(WeatherInfoForm::class);
        $form->submit($request->query->all());

        if (!$form->isValid()) {
            return $this->json(null, Response::HTTP_BAD_REQUEST);
        }

        $input = $form->getData();

        $response = $this->service->getWeatherByCoordinates($input);
        return $this->json($response);
    }

}