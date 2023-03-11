<div style="background:#fff; padding:20px;">
    <h3>Edit student details</h3>

    <?php 

        $tblquery = "SELECT * FROM students WHERE id = :id";
        $tblvalue = array(
            ':id' => htmlspecialchars($_SESSION['stu_id'])
        );
        $selectStudent = $connect->tbl_select($tblquery, $tblvalue);
        foreach ($selectStudent as $data) {
            extract($data);
            $_SESSION['stu_lname'] = $lname;
            $_SESSION['stu_fname'] = $fname;
            $_SESSION['stu_mname'] = $mname;
            $_SESSION['stu_img'] = $passport;
            $_SESSION['stu_regno'] = $regno;
            $_SESSION['stu_course'] = $course;
            $_SESSION['stu_level'] = $level;
            $_SESSION['stu_mol'] = $mol;
            $_SESSION['stu_session'] = $session;
            $_SESSION['stu_degree'] = $degree;
            $_SESSION['stu_email'] = $email;
            $_SESSION['stu_sex'] = $sex;
            $_SESSION['stu_dob'] = $dob;
            $_SESSION['stu_state'] = $state;
            $_SESSION['stu_lga'] = $lga;
            $_SESSION['stu_nationality'] = $nationality;
            $_SESSION['stu_num'] = $num;
            $_SESSION['stu_password'] = $password;
            $_SESSION['stu_address'] = $c_address;
            $_SESSION['stu_city'] = $c_city;
            $_SESSION['stu_cstate'] = $c_state;
            $_SESSION['stu_country'] = $c_country;
            $_SESSION['stu_files'] = $files;
        }
















        if($_POST){

            extract($_POST);

            $errfname = $errmname = $errlname = $errEmail = $errPassword = $errsoo = $errlga = $errnumber = $errcstate = $errsession = $errpassport = $errmultiple = '';
            $status = true;

            $tblquery = "SELECT * FROM students WHERE email = :email";
            $tblvalue = array(
                ':email' => htmlspecialchars($email)
            );
            $emailCheck = $connect->tbl_select($tblquery, $tblvalue);
            if($emailCheck){
                $tblquery = "SELECT * FROM students WHERE id = :id AND email = :email";
                $tblvalue = array(
                    ':id' => htmlspecialchars($_SESSION['stu_id']),
                    ':email' => htmlspecialchars($email)
                );
                $emailCheck2 = $connect->tbl_select($tblquery, $tblvalue);
                if(!$emailCheck2){
                    $errEmail = "email already exist";
                    $status = false;
                }
            }

            $_SESSION['validate_email'] = true;
            $encryptPassword = $security->encodeMsg($password);
            $folder = uniqid();

            //Get the Name of the Uploaded File
            $uniqid = uniqid();
            $pport = $uniqid . $_FILES['passport']['name'];
            $pport2 = $_FILES['passport']['name'];

            if($pport2){
                $passPassport = $pport;
            }else{
                $passPassport = $_SESSION['stu_img'];
            }

            $allowed = array('png', 'PNG', 'jpg', 'JPG', 'jpeg', 'JPEG');
            $ext = pathinfo($pport, PATHINFO_EXTENSION);

            // Validating Email
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $_SESSION['validate_email'] = false;
            }
            
            if(strlen($fname) > 15){
                $errfname = 'first name must be below 16 characters';
                $status = false;
            }elseif(strlen($lname) > 15){
                $errlname = 'last name must be below 16 characters';
                $status = false;
            }elseif(strlen($mname) > 15){
                $errmname = 'middle name must be below 16 characters';
                $status = false;
            }elseif(strlen($soo) > 15){
                $errsoo = 'state must be below 16 characters';
                $status = false;
            }elseif(strlen($lga) > 30){
                $errlga = 'LGA must be below 31 characters';
                $status = false;
            }elseif($password != $cpassword){
                $errPassword = 'password do no match';
                $status = false;
            }elseif(strlen($number) > 15){
                $errnumber = 'mobile number must be below 16 characters';
                $status = false;
            }elseif(strlen($city) > 20){
                $errcity = 'city must be below 21 characters';
                $status = false;
            }elseif(strlen($cstate) > 15){
                $errcstate = 'state must be below 16 characters';
                $status = false;
            }elseif(strlen($session) > 9){
                $errsession = 'session must be below 10 characters';
                $status = false;
            }elseif(strpos($session, '/') == false){
                $errsession = 'invalid session';
                $status = false;
            }elseif(!$_SESSION['validate_email']){
                $errEmail = 'invalid email';
                $status = false;
            }elseif(!in_array($ext, $allowed) AND $pport2 != ""){
                $errpassport = "invalid passport";
                $status = false;
            }

            // Multiple image / credentials
            $credentials = array();
            foreach($_FILES['image']['tmp_name'] as $key => $value) {
                $fileNames = uniqid() . $_FILES['image']['name'][$key];
                $fi = $_FILES['image']['name'][$key];
                $arrayValue = $fileNames;
                $fileName_tmp = $_FILES['image']['tmp_name'][$key];
                $extMul = pathinfo($fileNames, PATHINFO_EXTENSION);
                
                if($fi){
                    $files = explode(",- ", $_SESSION['stu_files']);
                    for($i = 0; $i < sizeof($files) - 1; $i++){
                        // delete old passport
                        if(file_exists("uploads/" . $_SESSION['stu_folder'] . "/".$files[$i])){
                            unlink("uploads/" . $_SESSION['stu_folder'] . "/".$files[$i]);
                        }
                    }
                    array_push($credentials, $arrayValue);
                    if(in_array($extMul, $allowed)){
                        if($status){
                            if(!is_dir("uploads/" . $_SESSION['stu_folder'])){
                                mkdir("uploads/" . $_SESSION['stu_folder'], 0777, true);
                            }
                            // Choose where to save the Upload File 
                            $location = "uploads/" . $_SESSION['stu_folder'] . "/".$fileNames;

                            // Save the uploaded File to the local file system
                            move_uploaded_file($fileName_tmp, $location);
                        }
                    }else{
                        $errmultiple = 'one of the file format is invalid';
                        $status = false;
                    }
                }else{
                    $newFiles = $_SESSION['stu_files'];
                }
            }
            
            if($status){
                if($pport2){
                    if(!is_dir("uploads/" . $_SESSION['stu_folder'])){
                        mkdir("uploads/" . $_SESSION['stu_folder'], 0777, true);
                    }
                    
                    // delete old passport
                    unlink("uploads/" . $_SESSION['stu_folder'] . "/".$_SESSION['stu_img']);
        
                    // Choose where to save the Upload File 
                    $location = "uploads/" . $_SESSION['stu_folder'] . "/".$pport;
                    // Save the uploaded File to the local file system
                    move_uploaded_file($_FILES['passport']['tmp_name'], $location);
                }

                // getting additional field value
                $allFields = array();
                $tblquery = "SELECT * FROM morefields WHERE type = :type";
                $tblvalue = array(
                    ':type' => 'S'
                );
                $select = $connect->tbl_select($tblquery,$tblvalue);
                foreach($select as $data){
                    extract($data);
                    array_push($allFields, $name); 
                }

                $allMore = '';
                foreach($allFields as $data){
                    $a = "$data";
                    $allMore .= htmlspecialchars(ucfirst($$a) . '?* ');
                }
                $allMore = rtrim($allMore, "?* ");

                $tblquery = "UPDATE students SET regno = :regno, lname = :lname, fname = :fname, mname = :mname, sex = :sex, dob = :dob, state = :state, lga = :lga, nationality = :nationality, num = :num, email = :email, password = :password, c_address = :c_address, c_city = :c_city, c_state = :c_state, c_country = :c_country, degree = :degree, course = :course, mol = :mol, level = :level, session = :session, passport = :passport, files = :files, more = :more WHERE id = :id";
                
                if(!$newFiles){
                    $totalValue = sizeof($credentials);
                    $newFiles = '';
                    for($i = 0; $i < $totalValue; $i++){
                        $newFiles .= $credentials[$i] . ",- ";
                    }
                }
                
                $tblvalue = array(
                    ':regno' => htmlspecialchars($regno),
                    ':lname' => htmlspecialchars(ucwords($lname)),
                    ':fname' => htmlspecialchars(ucwords($fname)),
                    ':mname' => htmlspecialchars(ucwords($mname)),
                    ':sex' => htmlspecialchars($sex),
                    ':dob' => htmlspecialchars($dob),
                    ':state' => htmlspecialchars(ucwords($soo)),
                    ':lga' => htmlspecialchars(ucwords($lga)),
                    ':nationality' => htmlspecialchars($nationality),
                    ':num' => htmlspecialchars($number),
                    ':email' => htmlspecialchars($email),
                    ':password' => htmlspecialchars($encryptPassword),
                    ':c_address' => htmlspecialchars($address),
                    ':c_city' => htmlspecialchars(ucwords($city)),
                    ':c_state' => htmlspecialchars(ucwords($cstate)),
                    ':c_country' => htmlspecialchars($country),
                    ':degree' => htmlspecialchars($degree),
                    ':course' => htmlspecialchars($course),
                    ':mol' => htmlspecialchars($mol),
                    ':level' => htmlspecialchars($level),
                    ':session' => htmlspecialchars($session),
                    ':passport' => htmlspecialchars($passPassport),
                    ':files' => $newFiles,
                    ':more' => $allMore,
                    ':id' => $_SESSION['stu_id']
                );
                $update = $connect->tbl_update($tblquery,$tblvalue);
                if($update){
                    echo "<p class='text-success'>student details updated</p>";
                    echo "<script>  window.location='editstudent' </script>";
                }
            }
            
        }
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <br>
        <small><strong>Personal Information</strong></small>
        <div class="row">
            <div class="col-lg-3">
                <input type="text" name="regno" class="form-control" value="<?php echo $_SESSION['stu_regno']; ?>">
                <small>Reg No</small>
            </div>
            <div class="col-lg-3">
                <span class="main">
                    <?php echo $errlname; ?>
                </span>
                <input type="text" name="lname" class="form-control" required value="<?php echo $_SESSION['stu_lname']; ?>">
                <small>Last Name</small>
            </div>
            <div class="col-lg-3">
                <span class="main">
                    <?php echo $errfname; ?>
                </span>
                <input type="text" name="fname" class="form-control" required value="<?php echo $_SESSION['stu_fname']; ?>">
                <small>First Name</small>
            </div>
            <div class="col-lg-3">
                <span class="main">
                    <?php echo $errmname; ?>
                </span>
                <input type="text" name="mname" class="form-control" value="<?php echo $_SESSION['stu_mname']; ?>">
                <small>Middle Name</small>
            </div>
        </div>
        <div class="row" style="margin-top: 5px;">
            <div class="col-lg-3">
                <select name="sex" class="form-control" required>
                    <option value="<?php echo $_SESSION['stu_sex']; ?>"><?php echo $_SESSION['stu_sex']; ?></option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <small>Gender</small>
            </div>
            <div class="col-lg-3">
                <input type="date" name="dob" class="form-control" required value="<?php echo $_SESSION['stu_dob']; ?>">
                <small>Date of Birth</small>
            </div>
            <div class="col-lg-3">
                <span class="main">
                    <?php echo $errsoo; ?>
                </span>
                <input type="text" name="soo" class="form-control" required value="<?php echo $_SESSION['stu_state']; ?>">
                <small>State/Province/Region</small>
            </div>
            <div class="col-lg-3">
                <span class="main">
                    <?php echo $errlga; ?>
                </span>
                <input type="text" name="lga" class="form-control" value="<?php echo $_SESSION['stu_lga']; ?>">
                <small>LGA</small>
            </div>
        </div>
        <div class="row" style="margin-top: 5px;">
            <div class="col-lg-3">
                <select name="nationality" class="form-control" required>
                    <option value="<?php echo $_SESSION['stu_nationality']; ?>"><?php echo $_SESSION['stu_nationality']; ?></option>
                    <?php include('includes/others/listofcountries.php'); ?>
                </select>
                <small>Nationality</small>
            </div>
            <div class="col-lg-3">
                <input type="password" name="password" class="form-control" required value="<?php echo $security->decodeMsg($_SESSION['stu_password']); ?>">
                <small>Student Password</small>
            </div>
            <div class="col-lg-3">
                <span class="main">
                    <?php echo $errPassword; ?>
                </span>
                <input type="password" name="cpassword" class="form-control" required value="<?php echo $security->decodeMsg($_SESSION['stu_password']); ?>">
                <small>Confirm Password</small>
            </div>
        </div>

        <br>
        <small><strong>Contact Information</strong></small>
        <div class="row">
            <div class="col-lg-6">
                <span class="main">
                    <?php echo $errnumber; ?>
                </span>
                <input type="text" name="number" class="form-control" required value="<?php echo $_SESSION['stu_num']; ?>">
                <small>Mobile No</small>
            </div>
            <div class="col-lg-6">
                <span class="main">
                    <?php echo $errEmail; ?>
                </span>
                <input type="email" name="email" class="form-control" required value="<?php echo $_SESSION['stu_email']; ?>">
                <small>Email</small>
            </div>
        </div>

        <br>
        <small><strong>Contact Address</strong></small>
        <div class="row">
            <div class="col-lg-12">
                <textarea type="text" name="address" class="form-control" required><?php echo $_SESSION['stu_address']; ?></textarea>
                <small>Street Address</small>
            </div>
        </div>
        <div class="row" style="margin-top: 5px;">
            <div class="col-lg-6">
                <span class="main">
                    <?php echo $errcity; ?>
                </span>
                <input type="text" name="city" class="form-control" required value="<?php echo $_SESSION['stu_city']; ?>">
                <small>City</small>
            </div>
            <div class="col-lg-6">
                <span class="main">
                    <?php echo $errcstate; ?>
                </span>
                <input type="text" name="cstate" class="form-control" required value="<?php echo $_SESSION['stu_cstate']; ?>">
                <small>State</small>
            </div>
            <div class="col-lg-6">
                <select name="country" class="form-control" required>
                    <option value="<?php echo $_SESSION['stu_country']; ?>"><?php echo $_SESSION['stu_country']; ?></option>
                    <?php include('includes/others/listofcountries.php'); ?>
                </select>
                <small>Country</small>
            </div>
        </div>

        <br>
        <small><strong>Study Information</strong></small>
        <div class="row">
            <div class="col-lg-3">
                <select name="degree" class="form-control" required>
                    <option value="<?php echo $_SESSION['stu_degree']; ?>"><?php echo $_SESSION['stu_degree']; ?></option>
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
                <select name="course" class="form-control" required>
                    <option value="<?php echo $_SESSION['stu_course']; ?>"><?php echo $_SESSION['stu_course']; ?></option>
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
                <select name="mol" class="form-control" required>
                    <option value="<?php echo $_SESSION['stu_mol']; ?>"><?php echo $_SESSION['stu_mol']; ?></option>
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
                <select name="level" class="form-control" required>
                    <option value="<?php echo $_SESSION['stu_level']; ?>"><?php echo $_SESSION['stu_level']; ?></option>
                    <option value="100">100</option>
                    <option value="200">200</option>
                    <option value="300">300</option>
                    <option value="400">400</option>
                    <option value="500">500</option>
                </select>
                <small>Level</small>
            </div>
        </div>
        <div class="row" style="margin-top: 5px;">
            <div class="col-lg-3">
                <span class="main">
                    <?php echo $errsession; ?>
                </span>
                <input type="text" name="session" placeholder="2020/2021" class="form-control" required value="<?php echo $_SESSION['stu_session']; ?>">
                <small>Session</small>
            </div>
        </div>

        
        <br>
        <small><strong>Upload Credentials</strong></small>
        <div class="row">
            <div class="col-lg-12">
                <div class="col-3">
                    <img src='../uploads/<?php echo $_SESSION['stu_folder'] . '/' . $_SESSION['stu_img']; ?>' style="height: 50px; width:50px; border-radius:5px;margin-bottom: 5px;">
                </div>
                <span class="main">
                    <?php echo $errpassport; ?>
                </span>
                <input type="file" name="passport" class="form-control">
                <small>Passport</small>
                <small style="display: block;">Accepted file types: jpg, jpeg, png, Max. file size: 1 MB.</small>
            </div>
        </div>

        <br>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <?php
                    
                        $files = explode(",- ", $_SESSION['stu_files']);
                        $path = $_SESSION['stu_folder'];
                        for($i = 0; $i < sizeof($files) - 1; $i++){
                            echo "
                                <div class='col-1'>
                                    <img src='../uploads/$path/$files[$i]' style='height: 50px; width:50px; border-radius:5px;margin-bottom: 5px;'>
                                </div>
                            ";
                        }
                    
                    ?>
                </div>
                <span class="main">
                    <?php echo $errmultiple; ?>
                </span>
                <input type="file" name="image[]" class="form-control" multiple>
                <small>Other Credentials</small>
                <small style="display: block;">WAEC RESULT, LGA IDENTIFICATION, BIRTH CERTIFICATE/AGE DECLARATION</small>
                <small style="display: block;">Accepted file types: jpg, jpeg, png, Max. file size: 100 MB, Max. files: 10</small>
            </div>
        </div>
        
        <?php
            $tblquery = "SELECT * FROM morefields WHERE type = :type";
            $tblvalue = array(
                ':type' => 'S'
            );
            $select = $connect->tbl_select($tblquery,$tblvalue);
            if($select){
                echo "<br><small><strong>Others</strong></small>";
            }
        ?>
        
        <div class="row">
            <?php
                
                if($select){
                    $i = 0;
                    foreach($select as $data){
                        extract($data);
                        if(!$enter){
                            $a = "$name";
                            $abc = $$a;
                        }
                        
                        echo "
                            <div class='col-lg-3'>
                                $content <br/>
                        ";
                            $tblquery = "SELECT more FROM students WHERE id = :id";
                            $tblvalue = array(
                                ':id' => $_SESSION['stu_id']
                            );
                            $selects = $connect->tbl_select($tblquery,$tblvalue);
                            foreach($selects as $date){
                                extract($date);
                                $moreFields = explode('?* ', $more);
                                echo "
                                    <input type='text' name='$name' value='$moreFields[$i]' class='form-control'>
                                ";
                            }
                        echo"
                            </div>
                        ";
                        $i++;  
                    }
                }
            ?>    
            <div class="col-lg-3">
                <br>
                <input type="submit" name="submit" value="Update" class="btn btn-primary">
            </div>
        </div>
    </form>
</div>