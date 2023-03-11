<div style="background:#fff;padding:30px;">
    <h3>search students</h3>
    <hr />
    <?php 
        if($_POST['find']){
            extract($_POST);
            $_SESSION['c'] = $course;
            $_SESSION['d'] = $degree;
            $_SESSION['m'] = $mol;
            $_SESSION['s'] = $session;
            $_SESSION['l'] = $level;
            $tblquery = "SELECT * FROM students WHERE degree = :degree AND course = :course AND mol = :mol AND level = :level AND session = :session ORDER BY lname";
            $tblvalue = array(
                ':degree' => htmlspecialchars($_SESSION['d']),
                ':course' => htmlspecialchars($_SESSION['c']),
                ':mol' => htmlspecialchars($_SESSION['m']),
                ':level' => htmlspecialchars($_SESSION['l']),
                ':session' => htmlspecialchars($_SESSION['s']),
            );
            $searches = $connect->tbl_select($tblquery, $tblvalue);
        }
        $tblquery = "SELECT * FROM students WHERE degree = :degree AND course = :course AND mol = :mol AND level = :level AND session = :session ORDER BY lname";
        $tblvalue = array(
            ':degree' => htmlspecialchars($_SESSION['d']),
            ':course' => htmlspecialchars($_SESSION['c']),
            ':mol' => htmlspecialchars($_SESSION['m']),
            ':level' => htmlspecialchars($_SESSION['l']),
            ':session' => htmlspecialchars($_SESSION['s']),
        );
        $searches = $connect->tbl_select($tblquery, $tblvalue);
    ?>
    <form action="" method="post">
        <div class="row">
            <div class="col-lg-3">
                <select name="course" class="form-control" required>
                    <option value="<?php echo $_SESSION['c']; ?>"><?php echo $_SESSION['c']; ?></option>
                    <?php
                        $tblquery = "SELECT * FROM additional_details WHERE type = :type ORDER BY name";
                        $tblvalue = array(
                            ':type' => 'Course'
                        );
                        $select = $connect->tbl_select($tblquery,$tblvalue);
                        foreach($select as $data){
                            extract($data);
                            echo "
                                <option value='$name'>$name</option>
                            ";   
                        }
                    ?> 
                </select>
                <small>Course Applied for</small>
            </div>

            <div class="col-lg-3">
                <select name="degree" class="form-control" required>
                    <option value="<?php echo $_SESSION['d']; ?>"><?php echo $_SESSION['d']; ?></option>
                    <?php
                        $tblquery = "SELECT * FROM additional_details WHERE type = :type ORDER BY name";
                        $tblvalue = array(
                            ':type' => 'Degree'
                        );
                        $select = $connect->tbl_select($tblquery,$tblvalue);
                        foreach($select as $data){
                            extract($data);
                            echo "
                                <option value='$name'>$name</option>
                            ";   
                        }
                    ?> 
                </select>
                <small>Degree Aim for</small>
            </div>

            <div class="col-lg-3">
                <select name="mol" class="form-control" required>
                    <option value="<?php echo $_SESSION['m']; ?>"><?php echo $_SESSION['m']; ?></option>
                    <?php
                        $tblquery = "SELECT * FROM additional_details WHERE type = :type ORDER BY name";
                        $tblvalue = array(
                            ':type' => 'Mol'
                        );
                        $select = $connect->tbl_select($tblquery,$tblvalue);
                        foreach($select as $data){
                            extract($data);
                            echo "
                                <option value='$name'>$name</option>
                            ";   
                        }
                    ?>
                </select>
                <small>Study Mode</small>
            </div>
            
            <div class="col-lg-3">
                <select name="session" class="form-control" required>
                    <option value="<?php echo $_SESSION['s']; ?>"><?php echo $_SESSION['s']; ?></option>
                    <?php
                        $tblquery = "SELECT session FROM students GROUP BY session ORDER BY session";
                        $tblvalue = array();
                        $select = $connect->tbl_select($tblquery,$tblvalue);
                        foreach($select as $data){
                            extract($data);
                            echo "
                                <option value='$session'>$session</option>
                            ";   
                        }
                    ?> 
                </select>
                <small>Session</small>
            </div>

            <div class="col-lg-3">
                <br>
                <select name="level" class="form-control" required>
                    <option value="<?php echo $_SESSION['l']; ?>"><?php echo $_SESSION['l']; ?></option>
                    <option value="100">100</option>
                    <option value="200">200</option>
                    <option value="300">300</option>
                    <option value="400">400</option>
                    <option value="500">500</option>
                </select>
                <small>Level</small>
            </div>
            <div class="col-lg-3">
                <br>
                <input type="submit" name="find" class="btn btn-primary" value="Proceed">
            </div>
        </div>
    </form>
</div>

<br>

<div style='background:#fff;padding:30px;'>
    <h3>search result</h3>
    <table class='table table-bordered' style='font-family: Arial; font-size: 15px;'>
        <thead>
            <tr>
                <th>SN</th>  
                <th>Added By</th>    
                <th>Img</th>    
                <th>Name</th>    
                <th>Email</th>      
                <th>Sex</th>      
                <th>view</th>      
            </tr>     
        </thead>  
        <tbody> 
            <?php
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


                if($searches){
                    $sn = 1;
                    $snEmail = 0;
                    foreach($searches as $data){
                        extract($data);
                        echo "
                            <tr>
                                <td>$sn</td>
                                <td>$addEmail[$snEmail]</td>
                                <td>
                                    <img src='../uploads/$folder/$passport' class='rounded-circle' style='height: 40px; width: 40px'>
                                </td>
                                <td>$lname $fname $mname</td>
                                <td>$email</td>
                                <td>$sex</td>
                                <td>
                                    <form action='' method='post'>
                                        <input type='hidden' name='stu_id' value='$id'>
                                        <input type='hidden' name='stu_name' value='$lname $fname $mname'>
                                        <input type='hidden' name='stu_lname' value='$lname'>
                                        <input type='hidden' name='stu_fname' value='$fname'>
                                        <input type='hidden' name='stu_mname' value='$mname'>
                                        <input type='hidden' name='stu_img' value='$passport'>
                                        <input type='hidden' name='stu_regno' value='$regno'>
                                        <input type='hidden' name='stu_level' value='$level'>
                                        <input type='hidden' name='stu_course' value='$course'>
                                        <input type='hidden' name='stu_mol' value='$mol'>
                                        <input type='hidden' name='stu_session' value='$session'>
                                        <input type='hidden' name='stu_degree' value='$degree'>
                                        <input type='hidden' name='stu_email' value='$email'>
                                        <input type='hidden' name='stu_folder' value='$folder'>
                                        <input type='hidden' name='stu_sex' value='$sex'>
                                        <input type='hidden' name='stu_dob' value='$dob'>
                                        <input type='hidden' name='stu_state' value='$state'>
                                        <input type='hidden' name='stu_lga' value='$lga'>
                                        <input type='hidden' name='stu_nationality' value='$nationality'>
                                        <input type='hidden' name='stu_num' value='$num'>
                                        <input type='hidden' name='stu_password' value='$password'>
                                        <input type='hidden' name='stu_address' value='$c_address'>
                                        <input type='hidden' name='stu_city' value='$c_city'>
                                        <input type='hidden' name='stu_cstate' value='$c_state'>
                                        <input type='hidden' name='stu_country' value='$c_country'>
                                        <input type='hidden' name='stu_files' value='$files'>
                                        <input type='submit' name='view' class='btn btn-sm btn-info' value='see more ...'>
                                    </form>
                                </td>
                            </tr>
                        "; 
                        $sn++;
                    }
                }else{
                    echo "
                        <tr>
                            <td colspan='4'>no result found</td>
                        </tr>
                    "; 
                }

            ?>
        </tbody>
    </table>
</div>

<?php

    if($_POST['view']){
        extract($_POST);
        $_SESSION['stu_id'] = $stu_id;
        $_SESSION['stu_name'] = $stu_name;
        $_SESSION['stu_lname'] = $stu_lname;
        $_SESSION['stu_fname'] = $stu_fname;
        $_SESSION['stu_mname'] = $stu_mname;
        $_SESSION['stu_img'] = $stu_img;
        $_SESSION['stu_regno'] = $stu_regno;
        $_SESSION['stu_course'] = $stu_course;
        $_SESSION['stu_level'] = $stu_level;
        $_SESSION['stu_mol'] = $stu_mol;
        $_SESSION['stu_session'] = $stu_session;
        $_SESSION['stu_degree'] = $stu_degree;
        $_SESSION['stu_email'] = $stu_email;
        $_SESSION['stu_folder'] = $stu_folder;
        $_SESSION['stu_sex'] = $stu_sex;
        $_SESSION['stu_dob'] = $stu_dob;
        $_SESSION['stu_state'] = $stu_state;
        $_SESSION['stu_lga'] = $stu_lga;
        $_SESSION['stu_nationality'] = $stu_nationality;
        $_SESSION['stu_num'] = $stu_num;
        $_SESSION['stu_password'] = $stu_password;
        $_SESSION['stu_address'] = $stu_address;
        $_SESSION['stu_city'] = $stu_city;
        $_SESSION['stu_cstate'] = $stu_cstate;
        $_SESSION['stu_country'] = $stu_country;
        $_SESSION['stu_files'] = $stu_files;
        echo "<script>  window.location='view' </script>";
        // echo "<script>  window.open('view', '_blank') </script>";
    }

?>
