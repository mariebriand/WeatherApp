<?php

namespace App\Controller;

use App\Service\CityWeatherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CityWeatherController extends AbstractController
{
    #[Route(path: '/city', name: 'city')]
    public function __invoke(Request $request, CityWeatherService $cityWeather): Response
    {
        $city = $request->query->get('city');
        $weather = null;
        $error = null;

        if ($city) {
            $weather = $cityWeather->getCityWeather($city);

            if (!$weather) {
                $error = "Could not fetch weather for '$city'.";
            }
        }

        return $this->render('city/index.html.twig', [
            'weather' => $weather,
            'error' => $error,
            'city' => $city
        ]);
    }
}
