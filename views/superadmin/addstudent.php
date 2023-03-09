<div style="background:#fff; padding:20px;">
    <h3>Add student</h3>

    <?php 
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
                $errEmail = "email already exist";
            }

            $_SESSION['validate_email'] = true;
            $encryptPassword = $security->encodeMsg($password);
            $folder = uniqid();

            //Get the Name of the Uploaded File
            $pport = uniqid() . $_FILES['passport']['name'];

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
            }elseif(!in_array($ext, $allowed)){
                $errpassport = "invalid passport";
                $status = false;
            }

            $tblquery = "SELECT * FROM students WHERE email = :email";
            $tblvalue = array(
                ':email' => htmlspecialchars($email)
            );
            $emailCheck = $connect->tbl_select($tblquery, $tblvalue);
            if($emailCheck){
                $errEmail = "email already exist";
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
                    array_push($credentials, $arrayValue);
                    if(in_array($extMul, $allowed)){
                        if($status){
                            if(!is_dir("uploads/" . $folder)){
                                mkdir("uploads/" . $folder, 0777, true);
                            }
                            // Choose where to save the Upload File 
                            $location = "uploads/$folder/".$fileNames;

                            // Save the uploaded File to the local file system
                            move_uploaded_file($fileName_tmp, $location);
                        }
                    }else{
                        $errmultiple = 'one of the file format is invalid';
                        $status = false;
                    }
                }
            }
            
            if($status){
                if(!is_dir("uploads/" . $folder)){
                    mkdir("uploads/" . $folder, 0777, true);
                }
                // Choose where to save the Upload File 
                $location = "uploads/$folder/".$pport;
                // Save the uploaded File to the local file system
                move_uploaded_file($_FILES['passport']['tmp_name'], $location);


                $tblquery = "INSERT INTO students VALUES(:id, :addedby, :regno, :lname, :fname, :mname, :sex, :dob, :state, :lga, :nationality, :num, :email, :password, :c_address, :c_city, :c_state, :c_country, :degree, :course, :mol, :level, :session, :passport, :files, :date, :status, :folder, :more)";
                
                $totalValue = sizeof($credentials);
                $newFiles = '';
                for($i = 0; $i < $totalValue; $i++){
                    $newFiles .= $credentials[$i] . ",- ";
                }
                
                $tblvalue = array(
                    ':id' => NULL,
                    ':addedby' => htmlspecialchars($_SESSION['myId']),
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
                    ':passport' => htmlspecialchars($pport),
                    ':files' => $newFiles,
                    ':date' => date('Y-m-d'),
                    ':status' => '1',
                    ':folder' => $folder,
                    ':more' => $folder
                );
                $insert = $connect->tbl_insert($tblquery,$tblvalue);
                if($insert){
                    echo "<p class='text-success'>student added</p>";
                    
                    $lname = $fname = $mname = $sex = $dob = $soo = $lga = $nationality = $number = $email = $password = $cpassword = $address = $city = $cstate = $country = $degree = $course = $mol = $level = $session = '';
                }
            }
            
        }
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <br>
        <small><strong>Personal Information</strong></small>
        <div class="row">
            <div class="col-lg-3">
                <input type="text" name="regno" class="form-control" value="<?php echo time(); ?>">
                <small>Reg No</small>
            </div>
            <div class="col-lg-3">
                <span class="main">
                    <?php echo $errlname; ?>
                </span>
                <input type="text" name="lname" class="form-control" required value="<?php echo $lname; ?>">
                <small>Last Name</small>
            </div>
            <div class="col-lg-3">
                <span class="main">
                    <?php echo $errfname; ?>
                </span>
                <input type="text" name="fname" class="form-control" required value="<?php echo $fname; ?>">
                <small>First Name</small>
            </div>
            <div class="col-lg-3">
                <span class="main">
                    <?php echo $errmname; ?>
                </span>
                <input type="text" name="mname" class="form-control" value="<?php echo $mname; ?>">
                <small>Middle Name</small>
            </div>
        </div>
        <div class="row" style="margin-top: 5px;">
            <div class="col-lg-3">
                <select name="sex" class="form-control" required>
                    <option value="<?php echo $sex; ?>"><?php echo $sex; ?></option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <small>Gender</small>
            </div>
            <div class="col-lg-3">
                <input type="date" name="dob" class="form-control" required value="<?php echo $dob; ?>">
                <small>Date of Birth</small>
            </div>
            <div class="col-lg-3">
                <span class="main">
                    <?php echo $errsoo; ?>
                </span>
                <input type="text" name="soo" class="form-control" required value="<?php echo $soo; ?>">
                <small>State/Province/Region</small>
            </div>
            <div class="col-lg-3">
                <span class="main">
                    <?php echo $errlga; ?>
                </span>
                <input type="text" name="lga" class="form-control" value="<?php echo $lga; ?>">
                <small>LGA</small>
            </div>
        </div>
        <div class="row" style="margin-top: 5px;">
            <div class="col-lg-3">
                <select name="nationality" class="form-control" required>
                    <option value="<?php echo $nationality; ?>"><?php echo $nationality; ?></option>
                    <?php include('includes/others/listofcountries.php'); ?>
                </select>
                <small>Nationality</small>
            </div>
            <div class="col-lg-3">
                <input type="password" name="password" class="form-control" required value="<?php echo $password; ?>">
                <small>Student Password</small>
            </div>
            <div class="col-lg-3">
                <span class="main">
                    <?php echo $errPassword; ?>
                </span>
                <input type="password" name="cpassword" class="form-control" required value="<?php echo $cpassword; ?>">
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
                <input type="text" name="number" class="form-control" required value="<?php echo $number; ?>">
                <small>Mobile No</small>
            </div>
            <div class="col-lg-6">
                <span class="main">
                    <?php echo $errEmail; ?>
                </span>
                <input type="email" name="email" class="form-control" required value="<?php echo $email; ?>">
                <small>Email</small>
            </div>
        </div>

        <br>
        <small><strong>Contact Address</strong></small>
        <div class="row">
            <div class="col-lg-12">
                <textarea type="text" name="address" class="form-control" required><?php echo $address; ?></textarea>
                <small>Street Address</small>
            </div>
        </div>
        <div class="row" style="margin-top: 5px;">
            <div class="col-lg-6">
                <span class="main">
                    <?php echo $errcity; ?>
                </span>
                <input type="text" name="city" class="form-control" required value="<?php echo $city; ?>">
                <small>City</small>
            </div>
            <div class="col-lg-6">
                <span class="main">
                    <?php echo $errcstate; ?>
                </span>
                <input type="text" name="cstate" class="form-control" required value="<?php echo $cstate; ?>">
                <small>State</small>
            </div>
            <div class="col-lg-6">
                <select name="country" class="form-control" required>
                    <option value="<?php echo $country; ?>"><?php echo $country; ?></option>
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
                    <option value="<?php echo $degree; ?>"><?php echo $degree; ?></option>
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
                    <option value="<?php echo $course; ?>"><?php echo $course; ?></option>
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
                    <option value="<?php echo $mol; ?>"><?php echo $mol; ?></option>
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
                    <option value="<?php echo $level; ?>"><?php echo $level; ?></option>
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
                <input type="text" name="session" placeholder="2020/2021" class="form-control" required value="<?php echo $session; ?>">
                <small>Session</small>
            </div>
        </div>

        
        <br>
        <small><strong>Upload Credentials</strong></small>
        <div class="row">
            <div class="col-lg-12">
                <span class="main">
                    <?php echo $errpassport; ?>
                </span>
                <input type="file" name="passport" class="form-control" required>
                <small>Passport</small>
                <small style="display: block;">Accepted file types: jpg, jpeg, png, Max. file size: 1 MB.</small>
            </div>
        </div>

        <br>
        <div class="row">
            <div class="col-lg-12">
                <span class="main">
                    <?php echo $errmultiple; ?>
                </span>
                <input type="file" name="image[]" class="form-control" multiple>
                <small>Other Credentials</small>
                <small style="display: block;">WAEC RESULT, LGA IDENTIFICATION, BIRTH CERTIFICATE/AGE DECLARATION</small>
                <small style="display: block;">Accepted file types: jpg, jpeg, png, Max. file size: 100 MB, Max. files: 10</small>
            </div>
            
            <div class="col-lg-3">
                <br><br>
                <input type="submit" name="submit" value="Add Student" class="btn btn-primary">
            </div>
        </div>
    </form>
</div>