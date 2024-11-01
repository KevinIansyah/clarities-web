<?php

namespace App\Helpers;

class WeatherBackgroundHelpers
{
  public static function getBackground()
  {
    $backgroundPagi = 'images/dashboard/pagi.jpg';
    $backgroundSiang = 'images/dashboard/siang.jpg';
    $backgroundSore = 'images/dashboard/sore.jpg';
    $backgroundSunset = 'images/dashboard/sunset.jpg';
    $backgroundMalam = 'images/dashboard/malam.jpg';
    $backgroundMalam2 = 'images/dashboard/malam2.jpg';
    $backgroundSunrise = 'images/dashboard/sunrise.jpg';

    date_default_timezone_set('Asia/Jakarta'); // Set zona waktu ke "Asia/Jakarta"

    $currentHour = (int)date('H');

    $backgroundUrl = "";

    if ($currentHour >= 6 && $currentHour < 10) {
      $backgroundUrl = $backgroundPagi;
    } else if ($currentHour >= 10 && $currentHour < 15) {
      $backgroundUrl = $backgroundSiang;
    } else if ($currentHour >= 15 && $currentHour < 17) {
      $backgroundUrl = $backgroundSore;
    } else if ($currentHour >= 17 && $currentHour < 18) {
      $backgroundUrl = $backgroundSunset;
    } else if ($currentHour >= 18 && $currentHour < 24) {
      $backgroundUrl = $backgroundMalam;
    } else if (($currentHour >= 0 && $currentHour < 5) || ($currentHour >= 23)) {
      $backgroundUrl = $backgroundMalam2;
    } else if ($currentHour >= 5 && $currentHour < 6) {
      $backgroundUrl = $backgroundSunrise;
    }

    return $backgroundUrl;
  }
}
