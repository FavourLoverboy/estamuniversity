<div style="background:#fff;padding:30px;">
    <h3> Add staff(s)</h3>
    <hr />
    <?php 
        if($_POST){
            
            extract($_POST);
            
            $errEmail = '';
            $errPassword = '';

            $_SESSION['validate_email'] = true;
            $name = ucfirst($lname) . ' ' . ucfirst($fname) . ' ' . ucfirst($mname);
            $encryptPassword = $security->encryptPassword($password);

            // Validating Email
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $_SESSION['validate_email'] = false;
            }

            if($_SESSION['validate_email']){
                $tblquery = "SELECT * FROM staff WHERE email = :email";
                $tblvalue = array(
                    ':email' => htmlspecialchars($email)
                );
                $emailCheck = $connect->tbl_select($tblquery, $tblvalue);
                if(!$emailCheck){
                    if($password == $cpassword){
                        $tblquery = "INSERT INTO staff VALUES(:id, :name, :email, :password, :level, :date, :status)";
                        $tblvalue = array(
                            ':id' => NULL, 
                            ':name' => htmlspecialchars($name), 
                            ':email' => htmlspecialchars($email), 
                            ':password' => htmlspecialchars($encryptPassword), 
                            ':level' => htmlspecialchars($task),
                            ':date' => date('Y-m-d'),
                            ':status' => '1'
                        );
                        $insert = $connect->tbl_insert($tblquery,$tblvalue);
                        if($insert){
                            echo "<p class='text-success'>staff added</p>";
                            $fname = '';
                            $mname = '';
                            $lname = '';
                            $email = '';
                        }
                    }else{
                        $errPassword = 'password do not match';
                    }
                }else{
                    $errEmail = "email already exist";
                }
            }else{
                $errEmail = 'invalid email';
            }
        }
    ?>
    <form action="" method="post">
        <div class="row">
            <div class="col-lg-3">
                Last Name <br/>
                <input type="text" name="lname" class="form-control" value="<?php echo $fname; ?>" required>
            </div>
            <div class="col-lg-3">
                First Name <br/>
                <input type="text" name="fname" class="form-control" value="<?php echo $fname; ?>" required>
            </div>
            <div class="col-lg-3">
                Middle Name <br/>
                <input type="text" name="mname" class="form-control" value="<?php echo $mname; ?>">
            </div>
            <div class="col-lg-3">
                Email <br/>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>" required>
                <span class="main" style="color: blue;">
                    <?php echo $errEmail; ?>
                </span>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-lg-3">
                Select Task <br/>
                <select name="task" class="form-control" required>
                    <option></option>
                    <option value="PA">Payment Staff</option>
                    <option value="RA">Results Staff</option>
                    <option value="SA">Student Staff</option>
                    <option value="SUA">Super Admin</option>
                </select>
            </div>
            <div class="col-lg-3">
                Password <br />
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="col-lg-3">
                Confirm Password <br />
                <input type="password" name="cpassword" class="form-control" required>
                <span class="main" style="color: blue;">
                    <?php echo $errPassword; ?>
                </span>
            </div>
            <div class="col-lg-3">
                <br />
                <input type="submit" name="add" class="btn btn-primary" value="Add Staff">
            </div>
        </div>
    </form>
</div>