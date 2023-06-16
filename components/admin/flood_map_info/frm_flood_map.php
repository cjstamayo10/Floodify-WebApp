<?php
    session_start();
    //Import Database, and Automatically Logout the Admin when inactive.
    require_once '../../../assets/config/db_conn/config.php';
    require_once '../../../assets/config/admin/database_management/admin_inactive_user.php';
    //Automatically return to login page when not logged in.
    if(!isset($_SESSION['lastname'])){
        header('location: admin-login');
    }
?>
<!--CSS Links and HTML Header-->
<?php 
  include '../../../assets/config/admin/database_management/admin_header.php';
?>
    <!--Webpage Title-->
    <title>Flood Map</title>
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
      <div class="text">Flood Map</div>
      <div class="text mb-2">
            <!--Add Info Btn-->
          <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#add_account">
          Add Flood Map
          </button>
          <!--Handles the Input of Admin-->
          <div class="modal fade" id="add_account" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered overflow-auto">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">Add Flood Risk Information</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="add-flood-map-info" method="POST" enctype="multipart/form-data">
                          <div class="modal-body p-4">
                            <div class="row mb-4">
                                <div class="col">
                                    <label for="formFile" class="form-label fs-6 fw-semibold">Flood Map</label>
                                    <input class="form-control" type="file" name="flood_map" id="formFile" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="text_area" class="form-label fs-6 fw-semibold">Flood Map Title</label>
                                    <input class="form-control" type="text" name="flood_map_title" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="text_area" class="form-label fs-6 fw-semibold">Flood Map Info</label>
                                    <textarea class="form-control" id="editor1" name="flood_map_info" placeholder="Input text here..." rows="3" required></textarea>
                                    <script>
                                        CKEDITOR.replace( 'editor1' );
                                    </script>
                                </div>
                            </div>
                          </div>
                            <!--Add Info Btn and Close Modal Btn-->
                          <div class="modal-footer">
                              <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Close</button>
                              <button type="submit" name="add_btn" value="add_btn" class="btn btn-dark">Add</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
        <!--Display Data from Database-->
      <div class="content d-flex flex-row flex-wrap align-items-center">
        <div class="info ps-3 pb-3 overflow-x-auto overflow-y-hidden">
            <table id="datatable" class="ui celled table" style="width:100%">
                <thead>
                    <tr>
                        <th>Actions</th>
                        <th>Flood Map</th>
                        <th>Flood Map Title</th>
                        <th>Flood Map Details</th>
                        <th>Creation Date</th>
                        <th>Date Updated</th>
                    </tr>
                </thead>
                <tbody>
                  <?php 
                        $fetch_data = "SELECT * FROM `tbl_floodmap`";
                        $fetch_result = mysqli_query($conn, $fetch_data);
                        if ($fetch_result)
                        {
                            while($tbl_row = mysqli_fetch_assoc($fetch_result))
                            { 
                                ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex flex-row align-items-center justify-content-center">
                                                <a class="text-decoration-none text-white mx-1" href="update-flood-map-info?info_id=<?php echo $tbl_row['flood_map_id'] ?>">
                                                    <button type="button" class="btn btn-dark d-flex align-items-center">
                                                        <i class="fa-solid fa-pen me-1"></i>
                                                        Update
                                                    </button>
                                                </a>    
                                                <a class="text-decoration-none text-white mx-1" href="delete-flood-map-info?info_id=<?php echo $tbl_row['flood_map_id'] ?>&name=<?php echo $tbl_row['flood_map_img'];?>">
                                                    <button type="button" class="btn btn-dark d-flex align-items-center">
                                                        <i class="fa-solid fa-trash-can me-1"></i>
                                                        Delete
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <img src="../../../assets/img/flood_map/<?php echo $tbl_row['flood_map_img'] ?>" alt="Flood Map" height="auto" width="268px">
                                        </td>
                                        <td><?php echo $tbl_row['flood_map_title'] ?></td>
                                        <td><?php echo $tbl_row['flood_map_details'] ?></td>
                                        <td><?php echo $tbl_row['creation_date'] ?></td>
                                        <td><?php echo $tbl_row['date_updated'] ?></td>
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
<!--JS Scripts and HTML Footer-->
<?php 
  include '../../../assets/config/admin/database_management/admin_scripts.php';
  include '../../../assets/config/admin/footer.php';
?>