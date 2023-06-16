<?php
    error_reporting(E_ALL ^ E_WARNING);
    $city_name = 'Malabon';
    $api_key = '2d0e03c585429615a8d44cfd9c5c6b01';
    $map_api = 'pk.eyJ1IjoiZmxvb2RpZnlhcHAiLCJhIjoiY2xkbXF1OTl1MDlpZzNwcGg0ZDdzejg0NyJ9.o0fmNhC6dSpCbB-z37fCwA';

    $api_url = "https://api.openweathermap.org/data/2.5/forecast?q=$city_name&appid=$api_key&units=metric";
    $weather_data = json_decode(file_get_contents($api_url), true);

    $city = $weather_data['city']['name'];
    $country = $weather_data['city']['country'];
    $weather_icon = $weather_data['list']['0']['weather']['0']['icon'];
    $weather_description = $weather_data['list']['0']['weather']['0']['description'];
    $temperature = $weather_data['list']['0']['main']['temp'];
    $temp_max = $weather_data['list']['0']['main']['temp_max'];
    $temp_min = $weather_data['list']['0']['main']['temp_min'];
    $wind = $weather_data['list']['0']['wind']['speed'];
    $humidity = $weather_data['list']['0']['main']['humidity'];
    $clouds = $weather_data['list']['0']['clouds']['all'];
    $rain = $weather_data['list']['0']['rain']['3h'];

    $weather_icon_next_day_one = $weather_data['list']['7']['weather']['0']['icon'];
    $weather_icon_next_day_two = $weather_data['list']['15']['weather']['0']['icon'];
    $weather_icon_next_day_three = $weather_data['list']['23']['weather']['0']['icon'];
    $weather_icon_next_day_four = $weather_data['list']['31']['weather']['0']['icon'];
    $weather_icon_next_day_five = $weather_data['list']['39']['weather']['0']['icon'];

    $temp_min_next_day_one = $weather_data['list']['7']['main']['temp_min'];
    $temp_min_next_day_two = $weather_data['list']['15']['main']['temp_min'];
    $temp_min_next_day_three = $weather_data['list']['23']['main']['temp_min'];
    $temp_min_next_day_four = $weather_data['list']['31']['main']['temp_min'];
    $temp_min_next_day_five = $weather_data['list']['39']['main']['temp_min'];
    
    $temp_max_next_day_one = $weather_data['list']['7']['main']['temp_max'];
    $temp_max_next_day_two = $weather_data['list']['15']['main']['temp_max'];
    $temp_max_next_day_three = $weather_data['list']['23']['main']['temp_max'];
    $temp_max_next_day_four = $weather_data['list']['31']['main']['temp_max'];
    $temp_max_next_day_five = $weather_data['list']['39']['main']['temp_max'];

    $wind_next_day_one = $weather_data['list']['7']['wind']['speed'];
    $wind_next_day_two = $weather_data['list']['15']['wind']['speed'];
    $wind_next_day_three = $weather_data['list']['23']['wind']['speed'];
    $wind_next_day_four = $weather_data['list']['31']['wind']['speed'];
    $wind_next_day_five = $weather_data['list']['39']['wind']['speed'];

    $rain_next_day_one = $weather_data['list']['7']['rain']['3h'];
    $rain_next_day_two = $weather_data['list']['15']['rain']['3h'];
    $rain_next_day_three = $weather_data['list']['23']['rain']['3h'];
    $rain_next_day_four = $weather_data['list']['31']['rain']['3h'];
    $rain_next_day_five = $weather_data['list']['39']['rain']['3h'];

?>