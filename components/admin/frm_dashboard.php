<?php
    session_start();
    require_once '../../assets/config/db_conn/config.php';
    require_once '../../assets/config/admin/dashboard/inactive_user.php';
    require_once '../../assets/config/admin/dashboard/count_total_db.php';
    if(!isset($_SESSION['lastname'])){
        header('location: admin-login');
    }
    include '../../assets/config/admin/dashboard/header.php';
?>
    <title>Dashboard</title>
<?php
  include '../../assets/config/admin/dashboard/sidebar.php';
?>
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
      <div class="text">Dashboard</div>
      <div class="dashboard-container d-flex flex-wrap align-items-center">
        <div class="dashboard-card-container p-4 m-1 rounded">
          <div class="dashboard-card-content w-100 d-flex flex-row flex-wrap align-items-center justify-content-between">
            <div class="dashboard-card w-75 d-flex flex-wrap flex-column">
              <div class="dashboard-card-title fw-bold">
                Admin Accounts
              </div>
              <div class="dashboard-card-count fs-1">
                <?php echo $count; ?>
              </div>
              <div class="dashboard-card-link">
                <a class="text-decoration-underline text-black" href="admin-account">
                    View
                </a>
              </div>
            </div>
            <div class="dashboard-card-icon w-25">
              <div class="icon">
                <i class="icon-size fa-solid fa-user-tie"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="dashboard-card-container p-4 m-1 rounded">
          <div class="dashboard-card-content w-100 d-flex flex-row flex-wrap align-items-center justify-content-between">
            <div class="dashboard-card w-75 d-flex flex-wrap flex-column">
              <div class="dashboard-card-title fw-bold">
                Website Info
              </div>
              <div class="dashboard-card-count fs-1">
                <?php echo $count_info; ?>
              </div>
              <div class="dashboard-card-link">
                <a class="text-decoration-underline text-black" href="web-app-info">View</a>
              </div>
            </div>
            <div class="dashboard-card-icon w-25">
              <div class="icon">
                <i class="icon-size fa-solid fa-list"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="dashboard-card-container p-4 m-1 rounded">
          <div class="dashboard-card-content w-100 d-flex flex-row flex-wrap align-items-center justify-content-between">
            <div class="dashboard-card w-75 d-flex flex-wrap flex-column">
              <div class="dashboard-card-title fw-bold">
                Flood Risk Info
              </div>
              <div class="dashboard-card-count fs-1">
                <?php echo $count_risk; ?>
              </div>
              <div class="dashboard-card-link">
                <a class="text-decoration-underline text-black" href="flood-risk-info">View</a>
              </div>
            </div>
            <div class="dashboard-card-icon w-25">
              <div class="icon">
                <i class="icon-size fa-solid fa-circle-exclamation"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="dashboard-card-container p-4 m-1 rounded">
          <div class="dashboard-card-content w-100 d-flex flex-row flex-wrap align-items-center justify-content-between">
            <div class="dashboard-card w-75 d-flex flex-wrap flex-column">
              <div class="dashboard-card-title fw-bold">
                Flood Map Info
              </div>
              <div class="dashboard-card-count fs-1">
                <?php echo $count_map; ?>
              </div>
              <div class="dashboard-card-link">
                <a class="text-decoration-underline text-black" href="flood-map-info">View</a>
              </div>
            </div>
            <div class="dashboard-card-icon w-25">
              <div class="icon">
                <i class="icon-size fa-solid fa-map-location-dot"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="dashboard-card-container p-4 m-1 rounded">
          <div class="dashboard-card-content w-100 d-flex flex-row flex-wrap align-items-center justify-content-between">
            <div class="dashboard-card w-75 d-flex flex-wrap flex-column">
              <div class="dashboard-card-title fw-bold">
                Weather Info
              </div>
              <div class="dashboard-card-count fs-1">
                <?php echo $count_weather; ?>
              </div>
              <div class="dashboard-card-link">
                <a class="text-decoration-underline text-black" href="weather-info">View</a>
              </div>
            </div>
            <div class="dashboard-card-icon w-25">
              <div class="icon">
                <i class="icon-size fa-solid fa-smog"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="dashboard-card-container p-4 m-1 rounded">
          <div class="dashboard-card-content w-100 d-flex flex-row flex-wrap align-items-center justify-content-between">
            <div class="dashboard-card w-75 d-flex flex-wrap flex-column">
              <div class="dashboard-card-title fw-bold">
                Request Data
              </div>
              <div class="dashboard-card-count fs-1">
                <?php echo $count_request_data; ?>
              </div>
              <div class="dashboard-card-link">
                <a class="text-decoration-underline text-black" href="request-data">View</a>
              </div>
            </div>
            <div class="dashboard-card-icon w-25">
              <div class="icon">
                <i class="icon-size fa-solid fa-file-pdf"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php 
  include '../../assets/config/admin/dashboard/scripts.php';
  include '../../assets/config/admin/footer.php';
?>