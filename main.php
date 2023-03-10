<?php
    session_start();
    if(!$_SESSION['myId']){
        header('location: /estamuniversity/');
    }

    $dir = 'estamuniversity';

    $superAdmin = 'superadmin';
    $studentAdmin = 'studentadmin';
    $paymentAdmin = 'paymentadmin';
    $resultAdmin = 'resultadmin';
    $student = 'student';

    if($_SESSION['level'] == 'SUA'){
        include('includes/titles/suparadmin.php');
        if($url[0] != $superAdmin){
            header("location: /$dir/$superAdmin/dashboard");
        }
    }elseif($_SESSION['level'] == 'SA'){
        include('includes/titles/studentadmin.php');
        if($url[0] != $studentAdmin){
            header("location: /$dir/$studentAdmin/dashboard");
        }
    }elseif($_SESSION['level'] == 'PA'){
        include('includes/titles/paymentadmin.php');
        if($url[0] != $paymentAdmin){
            header("location: /$dir/$paymentAdmin/dashboard");
        }
    }elseif($_SESSION['level'] == 'RA'){
        include('includes/titles/resultadmin.php');
        if($url[0] != $resultAdmin){
            header("location: /$dir/$resultAdmin/dashboard");
        }
    }else{
        include('includes/titles/student.php');
        if($url[0] != $student){
            header("location: /$dir/$student/dashboard");
        }
    }
?>

<?php include('includes/main/header.php'); ?>
    <?php include('includes/navs/sidebar.php'); ?>
    <!-- home -->
    <section class="home">
        <div class="toggle-sidebar">
            <i class="bx bx-menu"></i>
            <div class="text">Menu</div>
        </div>

        <div>
            <div style='margin: 10px auto;width: calc(100% - 40px);'>
                <?php include($page); ?>
            </div>
        </div>
    </section>
    <div id="popup">
        <h5>Notice</h5>
        <p><?php echo 'are you sure you want to delete ' . $_SESSION['stu_name']; ?></p>
        <div class="row">
            <div class="col-lg-2">
                <a class="btn btn-primary" onclick="toggle()">Close</a>
            </div>
            <div class="col-lg-8">
                
            </div>
            <div class="col-lg-2">
                <form action="" method="post">
                    <input class="btn btn-danger" type="submit" name= "delete" value="Confirm">
                </form>
                <?php
                    if($_POST['delete']){
                        extract($_POST);
                        
                        $tblquery = "DELETE FROM students WHERE id = :id";
                        $tblvalue = array(
                            ':id' => $_SESSION['stu_id']
                        );
                        $delete = $connect->tbl_delete($tblquery,$tblvalue);
                        echo "<script>  window.location='students' </script>";
                    }
                ?>
            </div>
        </div>
    </div>
<?php include ('includes/main/footer.php'); ?>
