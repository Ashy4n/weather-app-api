<?php

namespace App\Controller;

use App\Forms\WeatherHistoryForm;
use App\Service\WeatherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HistoryControllet extends AbstractController
{

    public function __construct(private WeatherService $service)
    {
    }

    #[Route('/get-history', name: "getHistory", methods: ['GET'])]
    public function getHistory(Request $request): Response
    {
        $form = $this->createForm(WeatherHistoryForm::class);
        $form->submit($request->query->all());

        if (!$form->isValid()) {
            return $this->json(null, Response::HTTP_BAD_REQUEST);
        }

        $input = $form->getData();
        $response = $this->service->getWeatherHistory($input);

        return $this->json($response);
    }
}