<?php
    session_start();
    //Hide Warnings
    error_reporting(E_ALL ^ E_WARNING);
    //Import Weather Forecast API, Database, and Automatically Logout the Admin when inactive.
    require_once '../../../assets/config/api/current_weather.php';
    require_once '../../../assets/config/db_conn/config.php';
    require_once '../../../assets/config/admin/database_management/admin_inactive_user.php';
    //Automatically return to login page when not logged in.
    if(!isset($_SESSION['lastname'])){
        header('location: admin-login');
    }
    //CSS Links and HTML Header
    include '../../../assets/config/admin/database_management/admin_header.php';
?>
    <!--Webpage Title-->
    <title>Weather Info</title>
<!--Sidebar Config-->
<?php
  include '../../../assets/config/admin/database_management/admin_sidebar.php';
?>
    <!--Admin Navbar-->
    <section class="home-section">
      <div class="home-content">
        <i class='bx bx-menu' ></i>
        <div class="container-fluid w-100">
            <div class="home-content-title d-flex flex-wrap align-items-center justify-content-between">
                <span class="text">Database Management</span>
                <span class="me-5 fs-5 fw-semibold"><i class="fs-4 me-2 fa-solid fa-user-tie"></i><?php echo $_SESSION['lastname']; ?></span>
            </div>
        </div>
      </div>
    </section>
    <div class="container-section">
      <!--Success Message-->
      <?php
        if(isset($_GET['msg'])) 
        {
            $msg = $_GET['msg'];
            echo '<div class="alert alert-success alert-dismissible fade show fw-bold" role="alert">
                    '.$msg.'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        else if(isset($_GET['msgDel']))
        {
            $msgDel = $_GET['msgDel'];
            echo '<div class="alert alert-success alert-dismissible fade show fw-bold" role="alert">
                    '.$msgDel.'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
      ?>
      <div class="text">Weather Info</div>
      <div class="text mb-1">
        <!--Current Date and Time-->
        <div class="date-time d-flex flex-wrap">
            <span id="hours">00</span>
            <span>:</span>
            <span id="minutes">00</span>
            <span id="session"></span>
            <span>—</span>
            <span id="day">Day</span>
            <span class="me-1">,</spanc>
            <span id="date">00</span>
            <span id="month">Month</span>
            <span id="year">Year</span>
        </div>
        <!--Weather Info from API-->
        <form action="add-weather-info" method="POST">
            <div class="modal-body p-4">
                <div class="row mb-1">
                    <div class="col">
                        <label for="text_area" class="form-label fs-6 fw-semibold">Location:</label>
                        <input class="fw-semibold fs-6 text-decoration-underline" type="text" readonly name="location_name" value="<?php echo $name; echo ', '; echo $country; ?>">
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col">
                        <label for="text_area" class="form-label fs-6 fw-semibold">Temperature:</label>
                        <input class="fw-semibold fs-6 text-decoration-underline" type="text" readonly name="temperature" value="<?php echo $temperature ?> °C">
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col">
                        <label for="text_area" class="form-label fs-6 fw-semibold">Wind:</label>
                        <input class="fw-semibold fs-6 text-decoration-underline" type="text" readonly name="wind" value="<?php echo $wind_speed ?>m/s">
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col">
                        <label for="text_area" class="form-label fs-6 fw-semibold">Humidity:</label>
                        <input class="fw-semibold fs-6 text-decoration-underline" type="text" readonly name="humidity" value="<?php echo $humidity ?>%">
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col">
                        <label for="text_area" class="form-label fs-6 fw-semibold">Precipitation:</label>
                        <input class="fw-semibold fs-6 text-decoration-underline" type="text" readonly name="precipitation" value="<?php echo $rain; ?> <?php echo $rain_3h; ?> mm/hr">
                    </div>
                </div>
                <!--Add Info Btn-->
                <div class="modal-footer d-flex align-items-center justify-content-start">
                    <button type="submit" name="add_btn" value="add_btn" class="btn btn-dark">Add Weather Info</button>
                </div>
            </div>
        </form>
      </div>
      <!--Display Data from Database-->
      <div class="content d-flex flex-row flex-wrap align-items-center">
        <div class="info ps-3 pb-3 overflow-x-auto overflow-y-hidden">
            <table id="datatable" class="ui celled table" style="width:100%">
                <thead>
                    <tr>
                        <th>Actions</th>
                        <th>Location Name</th>
                        <th>Temperature</th>
                        <th>Wind</th>
                        <th>Humidity</th>
                        <th>Precipitation</th>
                        <th>Creation Date</th>
                    </tr>
                </thead>
                <tbody>
                  <?php 
                        $fetch_data = "SELECT * FROM `tbl_weather_info`";
                        $fetch_result = mysqli_query($conn, $fetch_data);
                        if ($fetch_result)
                        {
                            while($tbl_row = mysqli_fetch_assoc($fetch_result))
                            { 
                                ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex flex-row align-items-center justify-content-center">    
                                                <a class="text-decoration-none text-white mx-1" href="delete-weather-info?info_id=<?php echo $tbl_row['weather_info_id'] ?>">
                                                    <button type="button" class="btn btn-dark d-flex align-items-center">
                                                        <i class="fa-solid fa-trash-can me-1"></i>
                                                        Delete
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                        <td><?php echo $tbl_row['location_name'] ?></td>
                                        <td><?php echo $tbl_row['temperature'] ?></td>
                                        <td><?php echo $tbl_row['wind'] ?></td>
                                        <td><?php echo $tbl_row['humidity'] ?></td>
                                        <td><?php echo $tbl_row['precipitation'] ?></td>
                                        <td><?php echo $tbl_row['weather_date'] ?></td>
                                    </tr>
                                <?php
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
      </div>
    </div>
    <!--Scripts for Current Date and Time-->
    <script>
        function displayTime(){
            var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            var shortMonths = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"];
            var week = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
            var weekShort = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
            var dateTime = new Date();
            var day = dateTime.getDay();
            var date = dateTime.getDate();
            var month = dateTime.getMonth();
            var year = dateTime.getFullYear();
            let monthView = months[month];
            let monthViewShort = shortMonths[month];
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
<!--JS Scripts and HTML Footer-->
<?php
  include '../../../assets/config/admin/database_management/admin_scripts.php';
  include '../../../assets/config/admin/footer.php';
?>