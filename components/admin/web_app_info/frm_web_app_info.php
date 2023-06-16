<?php
    session_start();
    //Import Database, and Automatically Logout the Admin when inactive.
    require_once '../../../assets/config/db_conn/config.php';
    require_once '../../../assets/config/admin/database_management/admin_inactive_user.php';
    //Automatically return to login page when not logged in.
    if(!isset($_SESSION['lastname'])){
        header('location: admin-account');    
    }
?>
<!--CSS Links and HTML Header-->
<?php 
  include '../../../assets/config/admin/database_management/admin_header.php';
?>
    <!--Webpage Title-->
    <title>Web App Info</title>
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
      <div class="text">Web App Info</div>
      <div class="text mb-2">
            <!--Add Info Btn-->
          <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#add_account">
          Add Info
          </button>
          <!--Handles the Input of Admin-->
          <div class="modal fade" id="add_account" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered overflow-auto">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">Add Website Information</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="add-web-app-info" method="POST">
                          <div class="modal-body p-4">
                              <div class="row mb-3">
                                  <div class="col">
                                      <input type="text" name="website_name" class="form-control" placeholder="Website Name" aria-label="First name" required>
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <div class="col">
                                      <input type="text" name="telephone_number" class="form-control" placeholder="Telephone #" aria-label="Middle name" required>
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <div class="col">
                                      <input type="text" name="cellphone_number" class="form-control" placeholder="Cellphone #" aria-label="Last name" required>
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <div class="col">
                                      <input type="text" name="fb_page" class="form-control" placeholder="Facebook Page Link" aria-label="Last name" required>
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <div class="col">
                                      <input type="email" name="email" class="form-control" placeholder="Company Email" aria-label="Email" required>
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
                        <th>Website Name</th>
                        <th>Telephone #</th>
                        <th>Cellphone #</th>
                        <th>FB Page Link</th>
                        <th>Company Email</th>
                        <th>Creation Date</th>
                        <th>Date Updated</th>
                    </tr>
                </thead>
                <tbody>
                  <?php 
                        $fetch_data = "SELECT * FROM `tbl_website_info`";
                        $fetch_result = mysqli_query($conn, $fetch_data);
                        if ($fetch_result)
                        {
                            while($tbl_row = mysqli_fetch_assoc($fetch_result))
                            { 
                                ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex flex-row align-items-center justify-content-center">    
                                                <a class="text-decoration-none text-white mx-1" href="update-web-app-info?info_id=<?php echo $tbl_row['website_info_id'] ?>">
                                                    <button type="button" class="btn btn-dark d-flex align-items-center">
                                                        <i class="fa-solid fa-pen me-1"></i>
                                                        Update
                                                    </button>
                                                </a>
                                                <a class="text-decoration-none text-white mx-1" href="delete-web-app-info?info_id=<?php echo $tbl_row['website_info_id'] ?>">
                                                    <button type="button" class="btn btn-dark d-flex align-items-center">
                                                        <i class="fa-solid fa-trash-can me-1"></i>
                                                        Delete
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                        <td><?php echo $tbl_row['website_name'] ?></td>
                                        <td><?php echo $tbl_row['website_tell_num'] ?></td>
                                        <td><?php echo $tbl_row['website_cell_num'] ?></td>
                                        <td><?php echo $tbl_row['website_fb_page'] ?></td>
                                        <td><?php echo $tbl_row['website_email'] ?></td>
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