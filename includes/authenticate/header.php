<?php 
    include("config/db.php");
    include("config/security.php");
    $connect = new DB();
    $security = new Security();
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Slide Navbar</title>
        <link rel="stylesheet" href="css/authentication.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap">
    </head>
    <body>
    