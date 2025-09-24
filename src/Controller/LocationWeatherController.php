<?php

namespace App\Controller;

use App\Service\LocationWeatherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class LocationWeatherController extends AbstractController
{
    #[Route(path: '/current_location', name: 'current_location')]
    public function __invoke(Request $request, LocationWeatherService $getLocationWeather): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'CurrentLocationWeatherController',
        ]);
        // @TODO : get IP address but maybe need independent service to do so
    }
}

