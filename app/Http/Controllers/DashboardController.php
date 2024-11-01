<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Helpers\WeatherIconsHelpers;
use App\Helpers\WeatherBackgroundHelpers;
use App\Models\Blog;
use App\Models\BookingLab;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $client = new Client([
            'verify' => false,
        ]);

        $apiKey = '035f94cb53ea90b6eade86798c4819e4';
        $city = 'Gununganyar';
        $response = $client->request('GET', "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=$apiKey");
        $weatherData = json_decode($response->getBody(), true);

        $weatherIcon = WeatherIconsHelpers::getIcon($weatherData['weather'][0]['icon'], 50, 50);
        $weatherBackground = WeatherBackgroundHelpers::getBackground();
        $tempInKelvin = $weatherData['main']['temp'];
        $tempInCelsius = round($tempInKelvin - 273.15);

        $totalPeminjamanLab = BookingLab::count();
        $totalPengguna = User::count();
        $totalBlog = Blog::count();
        $totalBlogViews = Blog::sum('view');

        return view('dashboard.dashboard', compact(
            'weatherData',
            'weatherIcon',
            'weatherBackground',
            'tempInCelsius',
            'totalPeminjamanLab',
            'totalPengguna',
            'totalBlog',
            'totalBlogViews'
        ));
    }
}
