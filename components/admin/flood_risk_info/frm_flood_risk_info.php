<?php
    session_start();
    //Import Database, and Automatically Logout the Admin when inactive.
    require_once '../../../assets/config/db_conn/config.php';
    require_once '../../../assets/config/admin/database_management/admin_inactive_user.php';
    //Automatically return to login page when not logged in.
    if(!isset($_SESSION['lastname'])){
        header('location:../../../frm_admin_login.php');
    }
?>
<!--CSS Links and HTML Header-->
<?php 
  include '../../../assets/config/admin/database_management/admin_header.php';
?>
    <!--Webpage Title-->
    <title>Flood Risk Info</title>
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
      <div class="text">Flood Risk Info</div>
      <div class="text mb-2">
            <!--Add Info Btn-->
          <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#add_account">
          Add Info
          </button>
          <!--Handles the Input of Admin-->
          <div class="modal fade" id="add_account" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-centered overflow-auto">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">Add Flood Risk Information</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="add-flood-risk-info" method="POST" enctype="multipart/form-data">
                        <div class="modal-body p-4">
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="text_area" class="form-label fs-6 fw-semibold">Flood Risk Title</label>
                                    <input class="form-control" type="text" name="flood_risk_title">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="text_area" class="form-label fs-6 fw-semibold">Flood Risk Info</label>
                                    <textarea class="form-control" id="editor1" name="flood_risk_content" placeholder="Input text here..." rows="3" required></textarea>
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
                        <th>Flood Risk Title</th>
                        <th>Flood Risk Content</th>
                        <th>Creation Date</th>
                        <th>Date Updated</th>
                    </tr>
                </thead>
                <tbody>
                  <?php 
                        $fetch_data = "SELECT * FROM `tbl_flood_risk_info`";
                        $fetch_result = mysqli_query($conn, $fetch_data);
                        if ($fetch_result)
                        {
                            while($tbl_row = mysqli_fetch_assoc($fetch_result))
                            { 
                                ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex flex-row align-items-center justify-content-center">    
                                                <a class="text-decoration-none text-white mx-1" href="update-flood-risk-info?info_id=<?php echo $tbl_row['flood_risk_id'] ?>">
                                                    <button type="button" class="btn btn-dark d-flex align-items-center">
                                                        <i class="fa-solid fa-pen me-1"></i>
                                                        Update
                                                    </button>
                                                </a>
                                                <form action="delete_flood_risk_info.php" method="post">
                                                    <a class="text-decoration-none text-white mx-1" href="delete-flood-risk-info?info_id=<?php echo $tbl_row['flood_risk_id'] ?>">
                                                        <button type="button" class="btn btn-dark d-flex align-items-center">
                                                            <i class="fa-solid fa-trash-can me-1"></i>
                                                            Delete
                                                        </button>
                                                    </a>
                                                </form>
                                            </div>
                                        </td>
                                        <td><?php echo $tbl_row['flood_risk_title'] ?></td>
                                        <td><?php echo $tbl_row['flood_risk_content'] ?></td>
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