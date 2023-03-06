<?php
    session_start();
    if(!$_SESSION['myId']){
        // header('location: /estamuniversity/');
    }

    $dir = 'schoolhenry';

    $superAdmin = 'superadmin';
    $studentAdmin = 'studentadmin';
    $paymentAdmin = 'paymentadmin';
    $resultAdmin = 'resultadmin';
    $student = 'student';

    if($_SESSION['level'] == 'SUA'){
        // include('includes/titles/suparadmin.php');
        if($url[0] != $superAdmin){
            header("location: /$dir/$superAdmin/dashboard");
        }
    }elseif($_SESSION['level'] == 'SA'){
        // include('includes/titles/studentadmin.php');
        if($url[0] != $studentAdmin){
            header("location: /$dir/$studentAdmin/dashboard");
        }
    }elseif($_SESSION['level'] == 'PA'){
        // include('includes/titles/paymentadmin.php');
        if($url[0] != $paymentAdmin){
            header("location: /$dir/$paymentAdmin/dashboard");
        }
    }elseif($_SESSION['level'] == 'RA'){
        // include('includes/titles/resultadmin.php');
        if($url[0] != $resultAdmin){
            header("location: /$dir/$resultAdmin/dashboard");
        }
    }else{
        // include('includes/titles/student.php');
        if($url[0] != $student){
            header("location: /$dir/$student/dashboard");
        }
    }
?>

<?php include('includes/main/header.php'); ?>
    <?php include($page); ?>
<?php include ('includes/main/footer.php'); ?>
