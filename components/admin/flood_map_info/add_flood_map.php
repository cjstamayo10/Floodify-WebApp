<?php
    session_start();
    //Import Database, and Automatically Logout the Admin when inactive.
    require_once '../../../assets/config/db_conn/config.php';
    require_once '../../../assets/config/admin/database_management/admin_inactive_user.php';
    //Automatically return to login page when not logged in.
    if(!isset($_SESSION['lastname'])){
        header('location: admin-login');
    }
    if(isset($_POST["add_btn"]))
    {
        $timestamp = date('Y-m-d H:i:s');
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
                    $flood_map_title = $_POST["flood_map_title"];
                    $flood_map_info = $_POST["flood_map_info"];
                    $sql = "INSERT INTO `tbl_floodmap`(`flood_map_img`, `flood_map_title`, `flood_map_details`, `creation_date`) VALUES ('$fileNewName','$flood_map_title','$flood_map_info', '$timestamp')";
                    $result = mysqli_query($conn, $sql);
                    if ($result){
                        header("Location: flood-map-info?msg=File Uploaded Successfuly!");
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
    //Close database
    $conn->close();
?>