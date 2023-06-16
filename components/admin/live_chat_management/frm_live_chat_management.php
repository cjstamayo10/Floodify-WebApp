<?php
    session_start();
    require_once '../../../assets/config/db_conn/config.php';
    require_once '../../../assets/config/admin/database_management/admin_inactive_user.php';
    if(!isset($_SESSION['lastname'])){
        header('location: admin-account');
    }
?>
<!--CSS Links and HTML Header-->
<?php 
  include '../../../assets/config/admin/database_management/admin_header.php';
?>
    <!--Webpage Title-->
    <title>Live Chat Management</title>
    <script src="https://cdn.ckeditor.com/4.20.1/basic/ckeditor.js"></script>
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
        else if(isset($_GET['errorMsg'])){
            $errorMsg = $_GET['errorMsg'];
            echo '<div class="alert alert-warning alert-dismissible fade show fw-bold" role="alert">
                    '.$errorMsg.'
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
      <div class="text">Live Chat Management</div>
        <!--Display Live Chat from Database-->
        <div class="live-chat-container w-100">
            <div class="live-chatbox-container mb-5">
                <div class="live-chat-title border-bottom mb-2">
                    <div class="hero-right-title-container d-flex flex-wrap flex-row align-items-end justify-content-between">
                        <div class="date-time d-flex flex-wrap">
                            <span id="hours">00</span>
                            <span>:</span>
                            <span id="minutes">00</span>
                            <span id="session">AM</span>
                            <span>—</span>
                            <span id="day">Day</span>
                            <span class="me-1">,</spanc>
                            <span id="date">00</span>
                            <span id="month">Month</span>
                            <span id="year">Year</span>
                        </div>
                    </div>
                </div>
                <div class="live-chatbox bg-white p-3 w-100" id="chatbox">
                    <div id="messages"></div>
                    <div class="chat-form">
                        <select class="form-select mb-1 d-none" name="barangay" id="barangay" aria-label="Malabon" required>
                            <option Selected>Malabon</option>
                        </select>
                        <select class="form-select mb-1" name="user_name" id="user_name" aria-label="Select Brgy." required>
                            <option Selected>MDRRMO Admin</option>
                        </select>
                        <div class="form-floating mb-2">
                            <textarea id="message" class="form-control" placeholder="Leave a comment here" id="floatingTextarea" required></textarea>
                            <label for="floatingTextarea">Enter your concerns here...</label>
                        </div>
                        <div class="chatbox-btn">
                            <button class="btn btn-dark" type="submit" id="send">Send</button>
                            <button class="btn btn-dark" type="button" id="clear-all">Clear</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
<!--JS Scripts and HTML Footer-->
<?php 
  include '../../../assets/config/admin/database_management/admin_scripts.php';
?>
    <script src="../../../assets/js/admin_script.js"></script>
<?php
  include '../../../assets/config/admin/footer.php';
?>