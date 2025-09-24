<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class LocationWeatherService
{
    public function __construct(HttpClientInterface $client, string $apiKey)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
    }

    public function getWeather(array $lat, array $lon): ?array
    {
        // @TODO : need to sanitize parameters

        try {
            $response = $this->client->request('GET', 'https://api.openweathermap.org/data/2.5/weather', [
                'query' => [
                    'lat' => $lat,
                    'lon' => $lon,
                    'appid' => $this->apiKey,
                    'units' => 'metric'
                ]
            ]);

            $data = $response->toArray();

            return [
                'city' => $data['name'],
                'temp' => $data['main']['temp'],
            ];
        } catch (\Exception $e) {
            return null;
        }
    }
}
