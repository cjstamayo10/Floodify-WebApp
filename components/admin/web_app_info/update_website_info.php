<?php
    session_start();
    //Import Database, and Automatically Logout the Admin when inactive.
    require_once '../../../assets/config/db_conn/config.php';
    require_once '../../../assets/config/admin/database_management/admin_inactive_user.php';
    //Automatically return to login page when not logged in.
    if(!isset($_SESSION['lastname'])){
        header('location: admin-account');
    }
    $id = $_GET['info_id'];
    $fetch_data = "SELECT * FROM `tbl_website_info` WHERE website_info_id = $id";
    $fetch_result = mysqli_query($conn, $fetch_data);
    $tbl_row = mysqli_fetch_assoc($fetch_result);
    if(isset($_POST['update_btn'])) {
        $timestamp = date('Y-m-d H:i:s');
        $website_name = $_POST["website_name"];
        $telephone_number = $_POST["telephone_number"];
        $cellphone_number = $_POST["cellphone_number"];
        $fb_page = $_POST["fb_page"];
        $email = $_POST["email"];
        $update_sql = "UPDATE `tbl_website_info` SET `website_info_id`='$id',`website_name`='$website_name',`website_tell_num`='$telephone_number',`website_cell_num`='$cellphone_number',`website_fb_page`='$fb_page',`website_email`='$email',`date_updated`= '$timestamp' WHERE website_info_id = $id";
        $update_result = mysqli_query($conn, $update_sql);
        if ($update_result){
            header("Location: web-app-info?msg=Details Updated Successfully!");
        }
    }
    $conn->close();
?>
<?php
  //CSS Links and HTML Header
  include '../../../assets/config/admin/database_management/admin_header.php';
?>
    <!--Webpage Title-->
    <title>Update Information</title>
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
    <!--Container-->
    <div class="container-section">
        <!--Current page of admin indicator-->
      <div class="text">Update Website Info</div>
      <nav class="mb-4" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-decoration-none text-dark" href="web-app-info">Website Info</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update</li>
        </ol>
        </nav>
        <div class="bg-body-tertiary shadow-sm border p-5 rounded">
            <!--Selected Information from the table displays here-->
            <form method="POST">
                <div class="row mb-3">
                    <div class="col">
                        <input type="text" name="website_name" class="form-control" value="<?php echo $tbl_row['website_name']; ?>" aria-label="First name" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <input type="text" name="telephone_number" class="form-control" value="<?php echo $tbl_row['website_tell_num']; ?>" aria-label="Middle name" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <input type="text" name="cellphone_number" class="form-control" value="<?php echo $tbl_row['website_cell_num']; ?>" aria-label="Last name" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <input type="text" name="fb_page" class="form-control" value="<?php echo $tbl_row['website_fb_page']; ?>" aria-label="Last name" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <input type="email" name="email" class="form-control" value="<?php echo $tbl_row['website_email']; ?>" aria-label="Email" required>
                    </div>
                </div>
                <!--Update Confirmation-->
                <div class="modal fade" id="update_account" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">Update Confirmation</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure do you want to update <span class="fw-bold"><?php echo $tbl_row['website_name']?></span>'s information?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light border" data-bs-dismiss="modal">No</button>
                                <button type="submit" name="update_btn" value="update_btn" class="btn btn-dark">Yes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!--Update Information Btn-->
            <div class="d-flex align-items-center justify-content-end">
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#update_account">
                    Update
                </button>
            </div>
        </div>
    </div>
<!--JS Scripts and HTML Footer-->
<?php
  include '../../../assets/config/admin/database_management/admin_scripts.php';
  include '../../../assets/config/admin/footer.php';
?>