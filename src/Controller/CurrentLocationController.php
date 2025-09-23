<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class LocationWeatherController extends AbstractController
{
    #[Route(path: '/current_location', name: 'current_location')]
    public function __invoke(Request $request, LocationWeatherService $getLocationWeather): Reponse
    {
        // @TODO : get IP address but maybe need independant service to do so
    }
}

