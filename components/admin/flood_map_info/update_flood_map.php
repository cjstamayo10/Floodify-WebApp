<?php
    session_start();
    //Import Database, and Automatically Logout the Admin when inactive.
    require_once '../../../assets/config/db_conn/config.php';
    require_once '../../../assets/config/admin/database_management/admin_inactive_user.php';
    //Automatically return to login page when not logged in.
    if(!isset($_SESSION['lastname'])){
        header('location: admin-login');
    }
    $id = $_GET['info_id'];
    $fetch_data = "SELECT * FROM `tbl_floodmap` WHERE flood_map_id = $id";
    $fetch_result = mysqli_query($conn, $fetch_data);
    $tbl_row = mysqli_fetch_assoc($fetch_result);
    if(isset($_POST['update_btn'])) {
        $file = $_FILES['flood_map'];
        $fileName = $_FILES['flood_map']['name'];
        $fileTmpName = $_FILES['flood_map']['tmp_name'];
        $fileSize = $_FILES['flood_map']['size'];
        $fileError = $_FILES['flood_map']['error'];
        $fileType = $_FILES['flood_map']['type'];
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('jpg', 'jpeg', 'png', 'pdf');
        if(in_array($fileActualExt, $allowed))
        {
            if($fileError === 0)
            {
                if($fileSize < 1000000)
                {
                    $fileNewName = uniqid('', true) . "." . $fileActualExt;
                    $fileDestination = '../../../assets/img/flood_map/' . $fileNewName;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    $timestamp = date('Y-m-d H:i:s');
                    $flood_map_title = $_POST["flood_map_title"];
                    $flood_map_info = $_POST["flood_map_info"];
                    $update_sql = "UPDATE `tbl_floodmap` SET `flood_map_id`='$id',`flood_map_img`='$fileNewName',`flood_map_title`='$flood_map_title',`flood_map_details`='$flood_map_info',`date_updated`='$timestamp' WHERE flood_map_id = $id";
                    $update_result = mysqli_query($conn, $update_sql);
                    if ($update_result){
                        header("Location: flood-map-info?msg=Details Updated Successfully!");
                    }
                }
                else
                {
                    header("Location: flood-map-info?errorMsg=Your file is too big!");
                }
            }
            else
            {
                header("Location: flood-map-info?errorMsg=There was an error uploading your file!");
            }
        }
        else
        {
            header("Location: flood-map-info?errorMsg=You cannot upload files of this type!");
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
    <script src="https://cdn.ckeditor.com/4.20.1/basic/ckeditor.js"></script>
<!--Sidebar Config-->
<?php
  include '../../../assets/config/admin/database_management/admin_sidebar.php';
?>
    <!--Admin Navbar-->
    <section class="home-section">
      <ddiv class="home-content">
        <i class='bx bx-menu' ></i>
        <div class="container-fluid w-100">
            <div class="home-content-title d-flex flex-wrap align-items-center justify-content-between">
                <span class="text">Database Management</span>
                <span class="me-5 fs-5 fw-semibold"><i class="fs-4 me-2 fa-solid fa-user-tie"></i><?php echo $_SESSION['lastname']; ?></span>
            </div>
        </div>
      </ddiv>
    </section>
    <!--Container-->
    <div class="container-section">
        <!--Current page of admin indicator-->
      <div class="text">Update Flood Risk Info</div>
      <nav class="mb-4" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-decoration-none text-dark" href="flood-map-info">Flood Map Info</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update</li>
        </ol>
        </nav>
        <div class="bg-body-tertiary shadow-sm border p-5 rounded">
            <!--Selected Information from the table displays here-->
            <form method="POST" enctype="multipart/form-data">
                <div class="row mb-4">
                    <div class="col d-flex flex-column">
                        <label for="currentMap" class="form-label fs-6 fw-semibold">Existing Flood Map</label>
                        <img src="../../../assets/img/flood_map/<?php echo $tbl_row['flood_map_img'] ?>" id="currentMap" alt="Flood Map" height="auto" width="268px">
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col">
                        <label for="formFile" class="form-label fs-6 fw-semibold">Upload New Flood Map</label>
                        <input class="form-control" type="file" name="flood_map" id="formFile" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="text_area" class="form-label fs-6 fw-semibold">Flood Map Title</label>
                        <input class="form-control" type="text" name="flood_map_title" value="<?php echo $tbl_row['flood_map_title']; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="text_area" class="form-label fs-6 fw-semibold">Flood Map Info</label>
                        <textarea class="form-control" id="editor1" name="flood_map_info" value="<?php echo $tbl_row['flood_map_details']; ?>" rows="3" required><?php echo $tbl_row['flood_map_details']; ?></textarea>
                        <script>
                            CKEDITOR.replace( 'editor1' );
                        </script>
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
                                Are you sure do you want to update this information?
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