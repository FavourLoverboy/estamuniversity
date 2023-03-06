<?php
    // Logout
    session_start();
    if($_SESSION['level']){
        session_destroy();
        header('location: staff');
    }else{
        session_destroy();
        header('location: login');
    }
?>