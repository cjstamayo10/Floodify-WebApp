<?php 
    session_start();
    require_once './assets/config/db_conn/config.php';
?>
<div class="footer p-5">
    <div class="container">
        <div class="footer-container mb-5 w-100 d-flex flex-wrap flex-row align-items-baseline justify-content-between">
            <div class="footer-content mb-4">
                <div class="logo">
                    <a class="navbar-brand" href="#">
                        <img src="./assets/img/floodify-logo-white.png" alt="Floodify" width="auto" height="50px">
                    </a>
                </div>
            </div>
            <div class="footer-content mb-4 text-center">
                <div class="references-title fs-6 text-uppercase">References</div>
                <div class="references-link">
                    <a class="text-decoration-none text-white" href=""><span class="hover-content">Click Here</span></a>
                </div>
            </div>
            <?php 
                $fetch_data = "SELECT * FROM `tbl_website_info`";
                $fetch_result = mysqli_query($conn, $fetch_data);
                if ($fetch_result)
                {
                    ?>
                    <?php 
                        $fetch_data_email = "SELECT * FROM `tbl_website_info`";
                        $fetch_result_email = mysqli_query($conn, $fetch_data_email);
                        
                    ?>
                    <div class="d-flex flex-column">
                        <div class="footer-content">
                            <div class="social-links-container text-center">
                                <div class="social-links-title fs-6 text-uppercase">Contact Us</div>
                            </div>
                        </div>
                        <?php 
                        while($tbl_row_info = mysqli_fetch_assoc($fetch_result_email)){
                        ?>
                        <div class="d-flex align-items-start justify-content-center flex-column mb-3">
                            <div class="footer-content">
                                <div class="telephone-num d-flex">
                                    <div class="telephone-num-content text-break">
                                        <a class="text-decoration-none text-white" href="<?php echo $tbl_row_info['website_fb_page']; ?>"><span class="hover-img"><i class="fa-brands fa-facebook"></i> <?php echo $tbl_row_info['website_fb_page']; ?></span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="footer-content">
                                <div class="cellphone-num d-flex align-items-center justify-content-center">
                                    <div class="cellphone-num-content text-break text-center">
                                        <a class="text-decoration-none text-white"><span class="hover-img text-center"><i class="fa-solid fa-envelope me-1"></i><?php echo $tbl_row_info['website_email']; ?></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                    </div>
                    <div class="flex flex-row align-items-center justify-content-center">
                        <div class="footer-content">
                            <div class="social-links-container text-center">
                                <div class="social-links-title fs-6 text-uppercase">Emergency Hotlines</div>
                            </div>
                        </div>
                    <?php
                    while($tbl_row = mysqli_fetch_assoc($fetch_result))
                    {
                        ?>
                        <div class="d-flex flex-column mb-3">
                            <div class="footer-content">
                                <div class="telephone-num d-flex">
                                    <div class="telephone-num-title fs-6 text-uppercase pe-2"><i class="fa-solid fa-tty"></i></div>
                                    <div class="telephone-num-content text-break">
                                        <?php echo $tbl_row['website_tell_num'];?>
                                    </div>
                                </div>
                            </div>
                            <div class="footer-content">
                                <div class="cellphone-num d-flex">
                                    <div class="cellphone-num-title fs-6 text-uppercase pe-2"><i class="fa-solid fa-phone"></i></div>
                                    <div class="cellphone-num-content text-break">
                                        <?php echo $tbl_row['website_cell_num'];?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
            ?>
                    </div>
        </div>
        <div class="copyright text-center">
            Floodify &copy; 2023 (Beta)
        </div>
    </div>
</div>