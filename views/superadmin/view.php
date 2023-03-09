<div style="background:#fff;padding:30px;">
    <!-- <h3 style="font-family: Arial; font-weight: 300;"> -->
        <?php //echo $_SESSION['stu_name']; ?>
    <!-- </h3> -->

    <div class="row">
        <?php
        
            if($_SESSION['level'] == 'SUA' || $_SESSION['level'] == 'SA'){
                echo "
                    <div class=col-3>
                        <a href='editstudent' class='btn btn-warning'>Edit student details</a>
                    </div>
                ";
            }
            if($_SESSION['level'] == 'SUA' || $_SESSION['level'] == 'PA'){
                echo "
                    <div class=col-3>
                        <a href='payment' class='btn btn-primary'>Add payment</a>
                    </div>
                ";
            }
            if($_SESSION['level'] == 'SUA' || $_SESSION['level'] == 'RA'){
                echo "
                    <div class=col-3>
                        <a href='re' class='btn btn-info'>Add result</a>
                    </div>
                ";
            }
        
        ?>
    </div>

    <hr>
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
    <label><strong>Other credentials</strong></label>
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

    <br>
    <label><strong>Payments</strong></label>
    <div class="row">
        <div class="col-12">
            <table class='table table-bordered' style='font-family: Arial; font-size: 15px;'>
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Added By</th>
                        <th>Item</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <?php
            
                            $tblquery = "SELECT * FROM morefields WHERE type = :type";
                            $tblvalue = array(
                                ':type' => 'P'
                            );
                            $select = $connect->tbl_select($tblquery,$tblvalue);
                            
                            if($select){
                                $selected = true; 
                                $numV = sizeof($select);
                                foreach($select as $data){
                                    extract($data);
                                    if(!$enter){
                                        $a = "$name";
                                        $abc = $$a;
                                    }
                                    
                                    echo "
                                        <th>$content</th>
                                    ";    
                                }
                            }
                        
                        ?>   
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                        $tblquery = "SELECT * FROM payment WHERE stu_id = :stu_id AND level = :level ORDER BY item";
                        $tblvalue = array(
                            ':stu_id' => $_SESSION['stu_id'],
                            ':level' => $_SESSION['stu_level'],
                        );
                        $select = $connect->tbl_select($tblquery,$tblvalue);
                        if($select){
                            $addEmail = array();
                            foreach($select as $data){
                                extract($data);
                                $tblquery = "SELECT * FROM staff WHERE id = :id";
                                $tblvalue = array(
                                    ':id' => htmlspecialchars($addedby)
                                );
                                $sear = $connect->tbl_select($tblquery, $tblvalue);
                                foreach($sear as $data){
                                    extract($data);
                                    array_push($addEmail, $email);
                                }
                            }
                        }
                        if($select){
                            $sn = 1;
                            $snE = 0;
                            foreach($select as $data){
                                extract($data);
                                $moreFields = explode('?* ', $more);
                                echo "
                                    <tr>
                                        <td>$sn</td>
                                        <td>$addEmail[$snE]</td>
                                        <td>$item</td>
                                        <td>$amount</td>
                                        <td>$pm</td>
                                ";
                                        $numV;
                                        if($selected){
                                            for($i = 0; $i < $numV; $i++){
                                                if($moreFields[$i]){
                                                    echo "
                                                        <td>$moreFields[$i]</td>
                                                    ";
                                                }else{
                                                    echo "
                                                        <td>-</td>
                                                    ";
                                                }
                                            }
                                            
                                        }
                                    
                                echo "
                                        <td>$date</td>
                                    </tr>
                                ";
                                $sn++;    
                                $snE++;
                            }
                        }else{
                            echo "
                                <tr>
                                    <td colspan='5'>no payment made</td>
                                </tr>
                            ";
                        }
                        
                    
                    ?>
                </tbody>
            </table>
        </div>
    </div>


    <br>
    <label><strong>Results</strong></label>
    <div class="row">
        <div class="col-12">
            <table class='table table-bordered' style='font-family: Arial; font-size: 15px;'>
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Added By</th>
                        <th>Title</th>    
                        <th>Code</th>      
                        <th>CU</th>   
                        <th>Score</th>
                        <?php
            
                            $tblquery = "SELECT * FROM morefields WHERE type = :type";
                            $tblvalue = array(
                                ':type' => 'R'
                            );
                            $select = $connect->tbl_select($tblquery,$tblvalue);
                            
                            if($select){
                                $selected = true; 
                                $numV = sizeof($select);
                                foreach($select as $data){
                                    extract($data);
                                    if(!$enter){
                                        $a = "$name";
                                        $abc = $$a;
                                    }
                                    
                                    echo "
                                        <th>$content</th>
                                    ";    
                                }
                            }
                        
                        ?>     
                        <th>Grade</th>     
                        <th>GP</th>     
                    </tr>  
                </thead>
                <tbody> 
                    <?php
                        $tblquery = "SELECT * FROM result WHERE userid = :userid AND level = :level AND session = :session ORDER BY semester, code";
                        $tblvalue = array(
                            ':userid' => htmlspecialchars($_SESSION['stu_id']),
                            ':level' => htmlspecialchars($_SESSION['stu_level']),
                            ':session' => htmlspecialchars($_SESSION['stu_session'])
                        );
                        $searches = $connect->tbl_select($tblquery, $tblvalue);
                        if($searches){
                            $addEmail = array();
                            foreach($searches as $data){
                                extract($data);
                                $tblquery = "SELECT * FROM staff WHERE id = :id";
                                $tblvalue = array(
                                    ':id' => htmlspecialchars($addedby)
                                );
                                $sear = $connect->tbl_select($tblquery, $tblvalue);
                                foreach($sear as $data){
                                    extract($data);
                                    array_push($addEmail, $email);
                                }
                            }
                        }
                        $se = '1st';
                        $seE = 0;
                        if($searches){
                            $sn = 1;
                            foreach($searches as $data){
                                extract($data);
                                
                                if($score > 74){
                                    $g = 'A';
                                    $gp = '4.00';
                                }elseif($score > 69){
                                    $g = 'AB';
                                    $gp = '3.50';
                                }elseif($score > 64){
                                    $g = 'B';
                                    $gp = '3.25';
                                }elseif($score > 59){
                                    $g = 'BC';
                                    $gp = '3.00';
                                }elseif($score > 54){
                                    $g = 'C';
                                    $gp = '2.75';
                                }elseif($score > 49){
                                    $g = 'CD';
                                    $gp = '2.50';
                                }elseif($score > 44){
                                    $g = 'D';
                                    $gp = '2.25';
                                }elseif($score > 39){
                                    $g = 'E';
                                    $gp = '2.00';
                                }else{
                                    $g = 'F';
                                    $gp = '0.00';
                                }

                                $moreFields = explode('?* ', $more);
                                if(strpos($se, $semester) > -1){
                                    echo "
                                        <tr>
                                            <td>$sn</td>
                                            <td>$addEmail[$seE]</td>
                                            <td>$title</td>
                                            <td>$code</td>
                                            <td>$cu</td>
                                            <td>$score</td>
                                    ";
                                        $numV;
                                        if($selected){
                                            for($i = 0; $i < $numV; $i++){
                                                if($moreFields[$i]){
                                                    echo "
                                                        <td>$moreFields[$i]</td>
                                                    ";
                                                }else{
                                                    echo "
                                                        <td>-</td>
                                                    ";
                                                }
                                            }
                                            
                                        }
                                    
                                    echo "
                                            <td>$g</td>
                                            <td>$gp</td>
                                        </tr>
                                    "; 
                                }else{
                                    $se = $se . $semester;
                                    $sn = 1;
                                    echo "
                                        <tr>
                                            <td colspan='8'></td>
                                        </tr>
                                        <tr>
                                            <td>$sn</td>
                                            <td>$addEmail[$seE]</td>
                                            <td>$title</td>
                                            <td>$code</td>
                                            <td>$cu</td>
                                            <td>$score</td>
                                    ";
                                        $numV;
                                        if($selected){
                                            for($i = 0; $i < $numV; $i++){
                                                if($moreFields[$i]){
                                                    echo "
                                                        <td>$moreFields[$i]</td>
                                                    ";
                                                }else{
                                                    echo "
                                                        <td>-</td>
                                                    ";
                                                }
                                            }
                                            
                                        }
                                    
                                    echo "
                                            <td>$g</td>
                                            <td>$gp</td>
                                        </tr>
                                    "; 
                                }
                                
                                $sn++;
                                $seE++;
                            }
                        }else{
                            echo "
                                <tr>
                                    <td colspan='7'>no result found</td>
                                </tr>
                            "; 
                        }

                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>