<div style="background:#fff;padding:30px;">
    <!-- <h3 style="font-family: Arial; font-weight: 300;"> -->
        <?php //echo $_SESSION['stu_name']; ?>
    <!-- </h3> -->


    <div class="row">
        <div class="col-3">
            <img src='../uploads/<?php echo $_SESSION['stu_folder'] . '/' . $_SESSION['stu_img']; ?>' style="height: 100%; width:100%; border-radius:5px;">
        </div>
        <div class="col-9">
            <div class="row">
                <table class='table table-bordered' style='font-family: Arial; font-size: 15px;'>
                    <tbody>
                        <tr>
                            <td>
                                <h6>Regno</h6>
                                <?php echo $_SESSION['stu_regno']; ?>
                            </td>
                            <td>
                                <h6>STUDENT NAME</h6>
                                <?php echo $_SESSION['stu_name']; ?>
                            </td>
                            <td>
                                <h6>Gender</h6>
                                <?php echo $_SESSION['stu_sex']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Dob</h6>
                                <?php echo $_SESSION['stu_dob']; ?>
                            </td>
                            <td>
                                <h6>State</h6>
                                <?php echo $_SESSION['stu_state']; ?>
                            </td>
                            <td>
                                <h6>LGA</h6>
                                <?php echo $_SESSION['stu_lga']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Nationality</h6>
                                <?php echo $_SESSION['stu_nationality']; ?>
                            </td>
                            <td>
                                <h6>password</h6>
                                <?php echo $security->decodeMsg($_SESSION['stu_password']); ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <br>
    <div class="row">
        <div class="col-12">
            <table class='table table-bordered' style='font-family: Arial; font-size: 15px;'>
                <tbody>
                    <tr>
                        <td>
                            <h6>Number</h6>
                            <?php echo $_SESSION['stu_num']; ?>
                        </td>
                        <td>
                            <h6>Email</h6>
                            <?php echo $_SESSION['stu_email']; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <br>
    <div class="row">
        <div class="col-12">
            <table class='table table-bordered' style='font-family: Arial; font-size: 15px;'>
                <tbody>
                    <tr>
                        <td>
                            <h6>City</h6>
                            <?php echo $_SESSION['stu_city']; ?>
                        </td>
                        <td>
                            <h6>State</h6>
                            <?php echo $_SESSION['stu_cstate']; ?>
                        </td>
                        <td>
                            <h6>Country</h6>
                            <?php echo $_SESSION['stu_country']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <h6>Address</h6>
                            <?php echo $_SESSION['stu_address']; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <br>
    <div class="row">
        <div class="col-12">
            <table class='table table-bordered' style='font-family: Arial; font-size: 15px;'>
                <tbody>
                    <tr>
                        <td>
                            <h6>Course</h6>
                            <?php echo $_SESSION['stu_course']; ?>
                        </td>
                        <td>
                            <h6>Degree</h6>
                            <?php echo $_SESSION['stu_degree']; ?>
                        </td>
                        <td>
                            <h6>Session</h6>
                            <?php echo $_SESSION['stu_session']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h6>Level</h6>
                            <?php echo $_SESSION['stu_level']; ?>
                        </td>
                        <td>
                            <h6>Method</h6>
                            <?php echo $_SESSION['stu_mol']; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <br>
    <div class="row">
        <?php 
        
            $files = explode(",- ", $_SESSION['stu_files']);
            $path = $_SESSION['stu_folder'];
            for($i = 0; $i < sizeof($files) - 1; $i++){
                echo "
                    <div class='col-3'>
                        <img src='../uploads/$path/$files[$i]' style='height: 100%; width:100%; border-radius:5px;'>
                    </div>
                ";
            }
        
        ?>
    </div>
</div>