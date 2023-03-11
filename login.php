<?php include('includes/authenticate/header.php'); ?>

    <?php 
        $errEmail = "";
        $errPassword = "";
        $_SESSION['validate_email'] = true;
        if($_POST){
            extract($_POST);
            $e = $email;
            $encryptPassword = $security->encryptPassword($password);

            // Validating Email
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $_SESSION['validate_email'] = false;
            }

            if($_SESSION['validate_email']){
                // Checking for email or username
                $tblquery = "SELECT * FROM students WHERE email = :email";
                $tblvalue = array(
                    ':email' => htmlspecialchars($email)
                );
                $emailCheck = $connect->tbl_select($tblquery, $tblvalue);
                if($emailCheck){
                    $tblquery = "SELECT * FROM students WHERE email = :email && password = :password";
                    $tblvalue = array(
                        ':email' => htmlspecialchars($email),
                        ':password' => htmlspecialchars($encryptPassword)
                    );
                    // print_r($tblvalue);
                    $login = $connect->tbl_select($tblquery, $tblvalue);
                    if($login){
                        $tblquery = "SELECT * FROM students WHERE email = :email AND status = :status";
                        $tblvalue = array(
                            ':email' => htmlspecialchars($email),
                            ':status' => '1'
                        );
                        $statusCheck = $connect->tbl_select($tblquery, $tblvalue);
                        if($statusCheck){
                            foreach($statusCheck as $data){
                                extract($data);
                                $_SESSION['myId'] = $id;
                                $_SESSION['email'] = $email;
                                $_SESSION['name'] = $name;
                                $_SESSION['level'] = $level;
        
                                echo "<script>  window.location='student/dashboard' </script>";
                            }
                        }else{
                            $errPassword = "you account has been disabled";
                        }
                    }else{
                        $errPassword = "incorrect password";
                    }
                }else{
                    $errEmail = "email don't exist";
                }
            }else{
                $errEmail = 'invalid email';
            }
        }

    ?>

    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true" checked>

        <div class="signup">
            <!-- <form>
                <label for="chk" aria-hidden="true">Sign up</label>
                <input type="text" name="txt" placeholder="User name" required="">
                <input type="email" name="email" placeholder="Email" required="">
                <input type="password" name="pswd" placeholder="Password" required="">
                <button>Sign up</button>
            </form> -->
        </div>

        <div class="login">
            <form method="POST" action="">
                <label for="chk" aria-hidden="true">Login</label>
                <input type="text" name="email" placeholder="Email" value="<?php echo $e; ?>" required>
                <span> <?php echo $errEmail; ?> </span>
                <input type="password" name="password" placeholder="Password" required>
                <span> <?php echo $errPassword; ?> </span>
                <button>Login</button>
            </form>
        </div>
    </div>
<?php include('includes/authenticate/footer.php'); ?>