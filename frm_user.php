<?php
    //Hide Warnings
    error_reporting(E_ALL ^ E_WARNING);
    //Import Current Weather API
    require_once './assets/config/api/current_weather.php'; 
    require_once './assets/config/db_conn/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./vendor/fontawesome/css/all.min.css">
    <link rel="shortcut icon" type="image/png" href="./assets/img/floodify-logo.png">
    <script type="text/javascript" src="./vendor/mapbox/mapbox-gl.js"></script>
    <link href="./vendor/mapbox/mapbox-gl.css" rel="stylesheet"/>
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Floodify</title>
</head>
<body>
    <!--Navigation Panel for User Access-->
    <nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom shadow-sm">
        <div class="container">
            <div class="logo">
                <a class="navbar-brand" href="https://floodify.infinityfreeapp.com">
                    <img src="./assets/img/floodify-logo.png" alt="Floodify" width="auto" height="50px">
                </a>
            </div>
            <div class="nav-btn-responsive">
                <div class="btn-container">
                    <button class="navbar-toggler border-0 d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasResponsive" aria-controls="offcanvasResponsive">
                        <span class="text-center"><i class="fs-4 fa-solid fa-bars"></i></span>
                    </button>
                </div>
                <div class="transition offcanvas-lg offcanvas-end" tabindex="-1" id="offcanvasResponsive" aria-labelledby="offcanvasResponsiveLabel">
                    <div class="offcanvas-header shadow-sm">
                        <div class="offcanvas-title" id="offcanvasResponsiveLabel">
                            <a class="navbar-brand" href="#">
                                <img src="./assets/img/floodify-logo.png" alt="Floodify" width="auto" height="50px">
                            </a>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasResponsive" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="navigation-links">
                            <ul class="navbar-nav fs-5">
                                <li class="nav-item">
                                    <a class="nav-link text-uppercase fw-bold" href="home" role="button" aria-expanded="false">
                                        Home
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link text-uppercase fw-bold active-color dropdown-toggle" href="user-access" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        User
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#live_chat" data-nav-section="live_chat">Live Chat</a></li>
                                        <li><a class="dropdown-item" href="#request_data" data-nav-section="request_data">Request Data</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link text-uppercase fw-bold dropdown-toggle" href="admin-login" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Admin
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="admin-login">Admin Login</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-uppercase fw-bold" href="dashboard" role="button" aria-expanded="false">
                                        Database Management
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!--Home Page Information-->
    <div class="hero-bg py-5 d-flex flex-wrap align-items-center">
        <div class="container">
            <div class="home-page-container w-100 d-flex flex-row flex-wrap align-items-baseline justify-content-center">
                <div class="info-analytics-container d-flex flex-column px-2">
                    <div class="w-100">
                        <div class="floodmap mb-5">
                            <div class="hero-left-title fs-4 border-bottom mb-2 text-uppercase fw-bold">
                                Live Rain Radar—<?php echo $name;?>, <?php echo $country; ?>
                            <div class="hero-right-title fs-4 text-uppercase fw-bold"></div>
                            </div>
                            <div class="hero-left-map border-bottom overflow-auto pb-2">
                                <div id="map" class="map-container mapboxgl-map"></div>
                            </div>
                        </div>
                        <div class="data-analytics">
                            <div class="data-analytics-title fs-4 border-bottom text-uppercase fw-bold">
                                Daily Weather Analytics—<?php echo $name;?>, <?php echo $country; ?>
                            </div>
                            <div class="weather-icon-container text-center mb-3 w-100">
                                <div style="width:100%;">
                                    <canvas id="weatherChart" width="678" height="300"></canvas>
                                </div>
                                <?php require_once './assets/config/api/data_analytics.php'; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="live-chat-container d-flex flex-column justify-content-center align-items-center px-2">
                    <div class="w-100">
                        <?php 
                            include 'frm_live_chat.php';
                        ?>
                        <div class="current-weather">
                            <div class="current-weather-container">
                                <div class="current-weather-header border-bottom mb-2">
                                    <div class="current-weather-title fw-bold fs-4 text-uppercase">Current Weather</div>
                                </div>
                                <div class="current-weather-info w-100 mb-4">
                                    <div class="temperature d-flex w-100 justify-content-between">
                                        <div class="temp-title">Temperature</div>
                                        <div class="temp-value fw-bold"><?php echo $temperature; ?>°C</div>
                                    </div>
                                    <div class="wind d-flex w-100 justify-content-between">
                                        <div class="wind-title">wind</div>
                                        <div class="wind-value fw-bold"><?php echo $wind_speed; ?> m/s</div>
                                    </div>
                                    <div class="precipitation d-flex w-100 justify-content-between">
                                        <div class="precipitation-title">Precipitation</div>
                                        <div class="precipitation-value fw-bold"><?php echo $rain; ?><?php echo $rain_3h; ?> mm/hr</div>
                                    </div>
                                    <div class="humidity d-flex w-100 justify-content-between">
                                        <div class="humidity-title">Humidity</div>
                                        <div class="humidity-value fw-bold"><?php echo $humidity; ?> %</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php 
        include 'frm_request_data.php';
    ?>
    <?php
        include './assets/config/user/user_footer.php';
    ?>
    <!--JS Scripts-->
    <script src="./vendor/jquery/jquery.min.js"></script>
    <script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/script.js"></script>
    <!--Script of Date and Time-->
    <script>
        function displayTime(){
            var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            var week = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
            var dateTime = new Date();
            var day = dateTime.getDay();
            var date = dateTime.getDate();
            var month = dateTime.getMonth();
            var year = dateTime.getFullYear();
            let monthView = months[month];
            let dayView = week[day];
            var hrs = dateTime.getHours();
            var min = dateTime.getMinutes();
            var session = document.getElementById('session');
            if(hrs >= 12){
                session.innerHTML = 'PM';
            }else{
                session.innerHTML = 'AM';
            }
            if(hrs > 12){
                hrs = hrs - 12;
            }
            document.getElementById('hours').innerHTML = hrs;
            document.getElementById('minutes').innerHTML = min;
            document.getElementById('day').innerHTML = dayView;
            document.getElementById('date').innerHTML = date;
            document.getElementById('month').innerHTML = monthView;
            document.getElementById('year').innerHTML = year;
        }
        setInterval(displayTime, 10);
    </script>
    <!--Script of Live Rain Radar-->
    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiZmxvb2RpZnlhcHAiLCJhIjoiY2xkbXF1OTl1MDlpZzNwcGg0ZDdzejg0NyJ9.o0fmNhC6dSpCbB-z37fCwA';
        const map = new mapboxgl.Map({
        container: "map",
        style: 'mapbox://styles/mapbox/streets-v11',
        maxBounds: [
            [120.9080, 14.6308],
            [121.0015, 14.7024]
        ],
        zoom: 14,
        center: [120.956120, 14.665940],
        minZoom: 13
      });
      window.map = map;
      map.on("load", () => {
        fetch("https://api.rainviewer.com/public/weather-maps.json")
          .then(res => res.json())
          .then(apiData => {
            apiData.radar.past.forEach(frame => {
              map.addLayer({
                id: `rainviewer_${frame.path}`,
                type: "raster",
                source: {
                  type: "raster",
                  tiles: [
                    apiData.host + frame.path + '/256/{z}/{x}/{y}/2/1_1.png'
                  ],
                  tileSize: 256
                },
                layout: { visibility: "none" },
                minzoom: 0,
                maxzoom: 12
              });
            });
            let i = 0;
            const interval = setInterval(() => {
              if (i > apiData.radar.past.length - 1) {
                clearInterval(interval);
                return;
              } else {
                apiData.radar.past.forEach((frame, index) => {
                  map.setLayoutProperty(
                    `rainviewer_${frame.path}`,
                    "visibility",
                    index === i || index === i - 1 ? "visible" : "none"
                  );
                });
                if (i - 1 >= 0) {
                  const frame = apiData.radar.past[i - 1];
                  let opacity = 1;
                  setTimeout(() => {
                    const i2 = setInterval(() => {
                      if (opacity <= 0) {
                        return clearInterval(i2);
                      }
                      map.setPaintProperty(
                        `rainviewer_${frame.path}`,
                        "raster-opacity",
                        opacity
                      );
                      opacity -= 0.1;
                    }, 50);
                  }, 400);
                }
                i += 1;
              }
            }, 2000);
          })
          .catch(console.error);
      });
    </script>
</body>
</html>