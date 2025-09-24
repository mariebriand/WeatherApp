<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class CityWeatherService
{
    private HttpClientInterface $client;
    private string $apiKey;

    public function __construct(HttpClientInterface $client, string $apiKey)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
    }

    public function getCityWeather(string $city): ?array
    {
        $city = trim($city);

        if (!preg_match('/^[a-zA-Z\s-]+$/', $city)) {
            return null;
        }

        try {
            $response = $this->client->request('GET', 'https://api.openweathermap.org/data/2.5/weather', [
                'query' => [
                    'q' => $city,
                    'appid' => $this->apiKey,
                    'units' => 'metric'
                ]
            ]);

            $data = $response->toArray();

            return [
                'city' => $data['name'],
                'temp' => $data['main']['temp'],
                'desc' => $data['weather'][0]['description'],
                'icon' => $data['weather'][0]['icon'],
            ];
        } catch (\Exception $e) {
            return null;
        }
    }
}