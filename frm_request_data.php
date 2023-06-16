<?php
    //Hide Warnings
    error_reporting(E_ALL ^ E_WARNING);
    //Import Weather Forecast API and Database
    require_once './assets/config/api/weather_forecast.php';
    require_once './assets/config/db_conn/config.php';
?>
    <div class="hero">
        <div class="container">
            <div class="hero-container forecast text-white w-100 h-100 d-flex flex-wrap flex-column align-items-center justify-content-center">
                <div class="text-black next-day-weather-title w-100 border-bottom">
                    <div class="flood-map-title fs-4 fw-bold text-uppercase">Weather for the Next 5 days</div>
                </div>
                <!--Weather for the next 5 days-->
                <div class="text-black next-day-weather-container w-100 mb-3 d-flex flex-wrap flex-column align-items-center justify-content-center">
                    <div class="next-day-weather-details w-100">
                        <div class="next-day-weather-details-container">
                            <div class="next-day-weather-details-content w-100 border-bottom d-flex flex-wrap flex-row align-items-center justify-content-between text-start">
                                <div class="day-date px-4 py-1 mx-2">
                                    <div class="day fw-bold" id="dayShort">Tue</div>
                                </div>
                                <div class="weather-icon px-4 py-1 mx-2">
                                    <img src="./assets/img/icons/<?php echo $weather_icon_next_day_one; ?>.png" alt="Weather Icon" width="60px" height="100%">
                                </div>
                                <div class="day-date px-4 py-1 mx-2">
                                    <div class="day fw-bold"><?php echo $temp_min_next_day_one; ?>°C</div>
                                    <div class="date">Low</div>
                                </div>
                                <div class="day-date px-4 py-1 mx-2">
                                    <div class="day fw-bold"><?php echo $temp_max_next_day_one; ?>°C</div>
                                    <div class="date">High</div>
                                </div>
                                <div class="day-date px-4 py-1 mx-2">
                                    <div class="day fw-bold"><?php echo $wind_next_day_one; ?> km/hr</div>
                                    <div class="date">Wind</div>
                                </div>
                                <div class="day-date px-4 py-1 mx-2">
                                    <div class="day fw-bold"><?php echo $rain_next_day_one; ?> mm/hr</div>
                                    <div class="date">Rain</div>
                                </div>
                            </div>
                            <div class="next-day-weather-details-content w-100 border-bottom d-flex flex-wrap flex-row align-items-center justify-content-between text-start ">
                                    <div class="day-date px-4 py-1 mx-2">
                                        <div class="day fw-bold" id="dayShortTwo">Tue</div>
                                        <div class="date">
                                            <span id="monthTwo"></span>
                                            <span id="dateTwo"></span>
                                        </div>
                                    </div>
                                    <div class="weather-icon px-4 py-1 mx-2">
                                        <img src="./assets/img/icons/<?php echo $weather_icon_next_day_two; ?>.png" alt="Weather Icon" width="60px" height="100%">
                                    </div>
                                    <div class="day-date px-4 py-1 mx-2">
                                        <div class="day fw-bold"><?php echo $temp_min_next_day_two; ?>°C</div>
                                        <div class="date">Low</div>
                                    </div>
                                    <div class="day-date px-4 py-1 mx-2">
                                        <div class="day fw-bold"><?php echo $temp_max_next_day_two; ?>°C</div>
                                        <div class="date">High</div>
                                    </div>
                                    <div class="day-date px-4 py-1 mx-2">
                                        <div class="day fw-bold"><?php echo $wind_next_day_two; ?> km/hr</div>
                                        <div class="date">Wind</div>
                                    </div>
                                    <div class="day-date px-4 py-1 mx-2">
                                        <div class="day fw-bold"><?php echo $rain_next_day_two; ?> mm/hr</div>
                                        <div class="date">Rain</div>
                                    </div>
                            </div>
                            <div class="next-day-weather-details-content w-100 border-bottom d-flex flex-wrap flex-row align-items-center justify-content-between text-start ">
                                <div class="day-date px-4 py-1 mx-2">
                                    <div class="day fw-bold" id="dayShortThree">Tue</div>
                                    <div class="date">
                                        <span id="monthThree"></span>
                                        <span id="dateThree"></span>
                                    </div>
                                </div>
                                <div class="weather-icon px-4 py-1 mx-2">
                                    <img src="./assets/img/icons/<?php echo $weather_icon_next_day_three; ?>.png" alt="Weather Icon" width="60px" height="100%">
                                </div>
                                <div class="day-date px-4 py-1 mx-2">
                                    <div class="day fw-bold"><?php echo $temp_min_next_day_three; ?>°C</div>
                                    <div class="date">Low</div>
                                </div>
                                <div class="day-date px-4 py-1 mx-2">
                                    <div class="day fw-bold"><?php echo $temp_max_next_day_three; ?>°C</div>
                                    <div class="date">High</div>
                                </div>
                                <div class="day-date px-4 py-1 mx-2">
                                    <div class="day fw-bold"><?php echo $wind_next_day_three; ?> km/hr</div>
                                    <div class="date">Wind</div>
                                </div>
                                <div class="day-date px-4 py-1 mx-2">
                                    <div class="day fw-bold"><?php echo $rain_next_day_three; ?> mm/hr</div>
                                    <div class="date">Rain</div>
                                </div>
                            </div>
                            <div class="next-day-weather-details-content w-100 border-bottom d-flex flex-wrap flex-row align-items-center justify-content-between text-start">
                                <div class="day-date px-4 py-1 mx-2">
                                    <div class="day fw-bold" id="dayShortFour">Tue</div>
                                    <div class="date">
                                        <span id="monthFour"></span>
                                        <span id="dateFour"></span>
                                    </div>
                                </div>
                                <div class="weather-icon px-4 py-1 mx-2">
                                    <img src="./assets/img/icons/<?php echo $weather_icon_next_day_four; ?>.png" alt="Weather Icon" width="50px" height="100%">
                                </div>
                                <div class="day-date px-4 py-1 mx-2">
                                    <div class="day fw-bold"><?php echo $temp_min_next_day_four; ?>°C</div>
                                    <div class="date">Low</div>
                                </div>
                                <div class="day-date px-4 py-1 mx-2">
                                    <div class="day fw-bold"><?php echo $temp_max_next_day_four; ?>°C</div>
                                    <div class="date">High</div>
                                </div>
                                <div class="day-date px-4 py-1 mx-2">
                                    <div class="day fw-bold"><?php echo $wind_next_day_four; ?> km/hr</div>
                                    <div class="date">Wind</div>
                                </div>
                                <div class="day-date px-4 py-1 mx-2">
                                    <div class="day fw-bold"><?php echo $rain_next_day_four; ?> mm/hr</div>
                                    <div class="date">Rain</div>
                                </div>
                            </div>
                            <div class="next-day-weather-details-content w-100 border-bottom d-flex flex-wrap flex-row align-items-center justify-content-between text-start">
                                <div class="day-date px-4 py-1 mx-2">
                                    <div class="day fw-bold" id="dayShortFive">Tue</div>
                                    <div class="date">
                                        <span id="monthFive"></span>
                                        <span id="dateFive"></span>
                                    </div>
                                </div>
                                <div class="weather-icon px-4 py-1 mx-2">
                                    <img src="./assets/img/icons/<?php echo $weather_icon_next_day_five; ?>.png" alt="Weather Icon" width="60px" height="100%">
                                </div>
                                <div class="day-date px-4 py-1 mx-2">
                                    <div class="day fw-bold"><?php echo $temp_min_next_day_five; ?>°C</div>
                                    <div class="date">Low</div>
                                </div>
                                <div class="day-date px-4 py-1 mx-2">
                                    <div class="day fw-bold"><?php echo $temp_max_next_day_five; ?>°C</div>
                                    <div class="date">High</div>
                                </div>
                                <div class="day-date px-4 py-1 mx-2">
                                    <div class="day fw-bold"><?php echo $wind_next_day_five; ?> km/hr</div>
                                    <div class="date">Wind</div>
                                </div>
                                <div class="day-date px-4 py-1 mx-2">
                                    <div class="day fw-bold"><?php echo $rain_next_day_five; ?> mm/hr</div>
                                    <div class="date">Rain</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="request-data-btn text-center mt-2" id="request_data" data-section="request_data">
                        <form action="./assets/config/user/export.php" method="post"> 
                            <input type="hidden" id="name" name="name">
                            <button class="btn btn-dark fs-6">Request Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Flood Map Information-->
    <div class="flood-map p-5">
        <div class="container">
            <div class="map-risk-container w-100 d-flex flex-wrap flex-column align-items-start justify-content-start">
                <div class="flood-map w-100 mb-4">
                    <div class="flood-map-title text-start text-uppercase fs-4 fw-bold border-bottom mb-2">
                        Flood Map
                    </div>
                    <div class="flood-map-container w-100 mb-4 d-flex flex-wrap flex-row align-items-center justify-content-center">
                        <?php 
                            $fetch_data = "SELECT * FROM `tbl_floodmap` ORDER BY `flood_map_id` DESC";
                            $fetch_result = mysqli_query($conn, $fetch_data);
                            if ($fetch_result)
                            {
                                while($tbl_row = mysqli_fetch_assoc($fetch_result))
                                {
                                    ?>
                                        <div class="flood-map-card border rounded shadow-sm m-3 d-flex flex-wrap flex-row align-items-center justify-content-around">
                                            <div class="flood-map-image-container w-100 p-5">
                                                <div class="flood-map-img text-center mb-3">
                                                    <img class="map-img" src="./assets/img/flood_map/<?php echo $tbl_row['flood_map_img'] ?>" alt="Flood Map Image">
                                                </div>
                                                <div class="flood-map-date mb-2">
                                                    <?php 
                                                        echo date('D, d M Y | g:i A', strtotime($tbl_row ['creation_date'])); 
                                                    ?>
                                                </div>
                                                <div class="map-title fw-bold fs-3 mb-2">
                                                    <?php echo $tbl_row['flood_map_title'] ?>
                                                </div>
                                                <div class="flood-map-btn">
                                                    <a class="text-decoration-none text-black" href="./assets/config/user/floodmap_details.php?details_id=<?php echo $tbl_row['flood_map_id']; ?>">
                                                            View Details.
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="flood-risk w-100">
                    <div class="flood-map-title text-start text-uppercase fs-4 fw-bold border-bottom mb-3">
                        Flood Risk
                    </div>
                    <div class="flood-map-container w-100 d-flex flex-wrap flex-row align-items-center justify-content-center">
                        <div class="flood-risk-info-container w-100 pe-4 d-flex flex-wrap flex-column align-items-start justify-content-center">
                            <?php 
                                $fetch_risk_data = "SELECT * FROM `tbl_flood_risk_info` ORDER BY `flood_risk_id` DESC";
                                $fetch_risk_result = mysqli_query($conn, $fetch_risk_data);
                                if ($fetch_risk_result){
                                    while($tbl_risk_row = mysqli_fetch_assoc($fetch_risk_result))
                                    {
                                        ?>
                                        <div class="w-100 mb-2 d-flex flex-wrap flex-column align-items-start justify-content-around">
                                            <div class="flood-map-date">
                                                <?php 
                                                    echo date('D, d M Y | g:i A', strtotime($tbl_risk_row ['creation_date'])); 
                                                ?>
                                            </div>
                                            <div class="flood-risk-title fs-5 fw-bold mb-2"><?php echo $tbl_risk_row['flood_risk_title']; ?></div>
                                            <div class="flood-risk-info"><?php echo $tbl_risk_row['flood_risk_content']; ?></div>
                                        </div>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Script of Date and Time-->
    <script>
        function displayTime(){
            var forecastWeekShort = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
            var forecastDateTime = new Date();
            var forecastDay = forecastDateTime.getDay();
            let dayNew = forecastDay + 1;
            let dayTwo = forecastDay + 2;
            let dayThree = forecastDay + 3;
            let dayFour = forecastDay + 4;
            let dayFive = forecastDay + 5
            if(dayNew > 6){
                dayNew =  dayNew - 7;
            }
            if (dayTwo > 6){
                dayTwo =  dayTwo - 7;
            }
            if (dayThree > 6){
                dayThree =   dayThree - 7;
            }
            if (dayFour > 6){
                dayFour =  dayFour - 7;
            }
            if (dayFive > 6){
                dayFive = dayFive - 7;
            }
            if (dayNew < 7 || dayTwo < 7 || dayThree < 7 || dayFour < 7 || dayFive < 7){
                dayNew = 0 + dayNew;
                dayTwo =  0 + dayTwo;
                dayThree =  0 + dayThree;
                dayFour =  0 + dayFour;
                dayFive = 0 + dayFive;
            }
            let shortDayView = forecastWeekShort[dayNew];
            let shortDayTwoView = forecastWeekShort[dayTwo];
            let shortDayThreeView = forecastWeekShort[dayThree];
            let shortDayFourView = forecastWeekShort[dayFour];
            let shortDayFiveView = forecastWeekShort[dayFive];
            document.getElementById('dayShort').innerHTML = shortDayView;
            document.getElementById('dayShortTwo').innerHTML = shortDayTwoView;
            document.getElementById('dayShortThree').innerHTML = shortDayThreeView;
            document.getElementById('dayShortFour').innerHTML = shortDayFourView;
            document.getElementById('dayShortFive').innerHTML = shortDayFiveView;
        }
        setInterval(displayTime, 10);
    </script>