<?php

namespace App\Controller;

use App\Service\WeatherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class WeatherController extends AbstractController
{
    #[Route('/weather', name: 'app_weather')]
    public function __invoke(Request $request, WeatherService $getWeather): Response
    {
        $city = $request->query->get('city');
        $weather = null;
        $error = null;

        if ($city) {
            $weather = $getWeather->getWeather($city);

            if (!$weather) {
                $error = "Could not fetch weather for '$city'.";
            }
        }

        return $this->render('weather/index.html.twig', [
            'weather' => $weather,
            'error' => $error,
            'city' => $city
        ]);
    }
}
