<?php
    session_start();
    if(!$_SESSION['myId']){
        header('location: /schoolhenry/');
    }

    $dir = 'schoolhenry';

    $suparAdmin = 'suparadmin';
    $studentAdmin = 'studentadmin';
    $paymentAdmin = 'paymentadmin';
    $resultAdmin = 'resultadmin';
    $student = 'student';

    if($_SESSION['level'] == 'SUA'){
        include('includes/titles/suparadmin.php');
        if($url[0] != $suparAdmin){
            header("location: /$dir/$suparAdmin/dashboard");
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
    <div class="wrapper">
        <?php include ('includes/navs/sidebar.php'); ?>
        <div class="main-panel">
            <?php include ('includes/navs/topbar.php'); ?>
            <div class="content">
                <?php include($page); ?>
            </div>
            <?php include ('includes/navs/bottombar.php'); ?>
        </div>
    </div>
<?php include ('includes/main/footer.php'); ?>
