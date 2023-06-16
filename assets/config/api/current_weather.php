<?php
error_reporting(E_ALL ^ E_WARNING);
$city_name = 'Malabon';
$api_key = '2d0e03c585429615a8d44cfd9c5c6b01';
$map_api = 'pk.eyJ1IjoiZmxvb2RpZnlhcHAiLCJhIjoiY2xkbXF1OTl1MDlpZzNwcGg0ZDdzejg0NyJ9.o0fmNhC6dSpCbB-z37fCwA';

$api_url = "https://api.openweathermap.org/data/2.5/weather?q=$city_name&appid=$api_key&units=metric";
$weather_data = json_decode(file_get_contents($api_url), true);


$name = $weather_data['name'];
$country = $weather_data['sys']['country'];

$weather_main = $weather_data['weather']['0']['main'];
$weather_description = $weather_data['weather']['0']['description'];
$weather_icon = $weather_data['weather']['0']['icon'];

$temperature = $weather_data['main']['temp'];
$feels_like = $weather_data['main']['feels_like'];
$temp_total = ($weather_data ['main']['temp_min'] + $weather_data['main']['temp_max']) / 2;

$humidity = $weather_data['main']['humidity'];

$wind_speed = $weather_data['wind']['speed'];

$clouds = $weather_data['clouds']['all'];

$rain = $weather_data['rain']['1h'];
$rain_3h = $weather_data['rain']['3h'];
?>