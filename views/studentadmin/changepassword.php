<div style="background:#fff;padding:30px;">
        <h3> Change password</h3>
        <hr />
        <?php 
            if($_POST){
                
                extract($_POST);
                
                $errOld = '';
                $errNew = '';

                $encryptOldPassword = $security->encryptPassword($oldpassword);
                $encryptNewPassword = $security->encryptPassword($newpassword);

                
                $tblquery = "SELECT * FROM staff WHERE id = :id AND password = :password";
                $tblvalue = array(
                    ':id' => htmlspecialchars($_SESSION['myId']),
                    ':password' => htmlspecialchars($encryptOldPassword)
                );
                $checkOldpassword = $connect->tbl_select($tblquery, $tblvalue);
                if($checkOldpassword){
                    if($newpassword == $cpassword){
                        $tblquery = "UPDATE staff SET password = :password WHERE id = :id";
                        $tblvalue = array(
                            ':password' => htmlspecialchars($encryptNewPassword), 
                            ':id' => htmlspecialchars($_SESSION['myId'])
                        );
                        $update = $connect->tbl_update($tblquery,$tblvalue);
                        if($update){
                            echo "<p class='text-success'>password changed</p>";
                        }
                    }else{
                        $errNew = 'password do not match';
                    }
                }else{
                    $errOld = "incorret old password";
                }
            }
        ?>
        <form action="" method="post">
            <div class="row">
                <div class="col-lg-3">
                    Old Password <br/>
                    <input type="password" name="oldpassword" class="form-control" required>
                    <span class="main" style="color: blue;">
                        <?php echo $errOld; ?>
                    </span>
                </div>
                <div class="col-lg-3">
                    New Password <br/>
                    <input type="password" name="newpassword" class="form-control" required>
                </div>
                <div class="col-lg-3">
                    Confirm Password <br/>
                    <input type="password" name="cpassword" class="form-control" required>
                    <span class="main" style="color: blue;">
                        <?php echo $errNew; ?>
                    </span>
                </div>
                <div class="col-lg-3">
                    <br />
                    <input type="submit" name="change" class="btn btn-primary" value="Change">
                </div>
            </div>
        </form>
    </div>