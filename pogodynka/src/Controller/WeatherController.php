<?php

namespace App\Controller;

use App\Repository\LocationRepository;
use App\Repository\MeasurementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class WeatherController extends AbstractController
{
    public function cityAction(string $country, string $city,
                               MeasurementRepository $measurementRepository, LocationRepository $locationRepository): Response
    {
        $location = $locationRepository->findLocationByCodeAndCity($country, $city);

        if ($location == null){
            return $this->render('weather/error.html.twig', []);
        } else {
            $measurements = $measurementRepository->findByLocation($location);
            return $this->render('weather/city.html.twig', [
                'location' => $location,
                'measurements' => $measurements,
            ]);
        }

    }
}
