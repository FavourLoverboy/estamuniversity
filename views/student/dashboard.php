<div style="background:#fff;padding:30px;">

    <?php
    
        $tblquery = "SELECT * FROM students WHERE id = :id";
        $tblvalue = array(
            ':id' => $_SESSION['myId']
        );
        $select = $connect->tbl_select($tblquery,$tblvalue);
        
        foreach($select as $data){
            extract($data);    
        }
    
    ?>

    <h5>Welcome <?php echo $lname . ' ' . $fname . ' ' . $mname; ?></h5>
    <br>
    <div class="row">
        <div class="col-3">
            <img src='../uploads/<?php echo $folder . '/' . $passport; ?>' style="height: 300px; width:200px; border-radius:5px;">
        </div>
        <div class="col-9">
            <div class="row">
                <table class='table table-bordered' style='font-family: Arial; font-size: 15px;'>
                    <tbody>
                        <tr>
                            <td>
                                <h6>Regno</h6>
                                <?php echo $regno; ?>
                            </td>
                            <td>
                                <h6>STUDENT NAME</h6>
                                <?php echo $lname . ' ' . $fname . ' ' . $mname; ?>
                            </td>
                            <td>
                                <h6>Gender</h6>
                                <?php echo $sex; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Dob</h6>
                                <?php echo $dob; ?>
                            </td>
                            <td>
                                <h6>State</h6>
                                <?php echo $state; ?>
                            </td>
                            <td>
                                <h6>LGA</h6>
                                <?php echo $lga; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Nationality</h6>
                                <?php echo $nationality; ?>
                            </td>
                            <!-- <td> -->
                                <!-- <h6>password</h6> -->
                                <?php //echo $security->decodeMsg($_SESSION['stu_password']); ?>
                            <!-- </td> -->
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
                            <?php echo $num; ?>
                        </td>
                        <td>
                            <h6>Email</h6>
                            <?php echo $email; ?>
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
                            <?php echo $c_city; ?>
                        </td>
                        <td>
                            <h6>State</h6>
                            <?php echo $c_state; ?>
                        </td>
                        <td>
                            <h6>Country</h6>
                            <?php echo $c_country; ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <h6>Address</h6>
                            <?php echo $c_address; ?>
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
                            <?php echo $course; ?>
                        </td>
                        <td>
                            <h6>Degree</h6>
                            <?php echo $degree; ?>
                        </td>
                        <td>
                            <h6>Session</h6>
                            <?php echo $session; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h6>Level</h6>
                            <?php echo $level; ?>
                        </td>
                        <td>
                            <h6>Method</h6>
                            <?php echo $mol; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    <?php
        $tblquery = "SELECT * FROM morefields WHERE type = :type";
        $tblvalue = array(
            ':type' => 'S'
        );
        $select = $connect->tbl_select($tblquery,$tblvalue);
        if($select){
            echo "
                <br>
                <small><strong>Others</strong></small>
                <div class='row'>
                    <div class='col-12'>
                        <table class='table table-bordered' style='font-family: Arial; font-size: 15px;'>
                            <tbody>
                                <tr>
            ";
                $i = 0;
                foreach($select as $data){
                    extract($data);
                    echo "
                            <td>
                                <h6>$content</h6>
                    ";
                                $tblquery = "SELECT more FROM students WHERE id = :id";
                                $tblvalue = array(
                                    ':id' => $_SESSION['myId']
                                );
                                $selects = $connect->tbl_select($tblquery,$tblvalue);
                                foreach($selects as $date){
                                    extract($date);
                                    $moreFields = explode('?* ', $more);
                                    echo $moreFields[$i];
                                }
                    echo"
                            </td>
                    ";
                    $i++;
                }
            echo "
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            ";
        }
    ?>

    <br>
    <label><strong>Other credentials</strong></label>
    <div class="row">
        <?php 
        
            $files = explode(",- ", $files);
            $path = $folder;
            for($i = 0; $i < sizeof($files) - 1; $i++){
                echo "
                    <div class='col-3'>
                        <img src='../uploads/$path/$files[$i]' style='height: 300px; width:200px; border-radius:5px;'>
                    </div>
                ";
            }
        
        ?>
    </div>
</div>