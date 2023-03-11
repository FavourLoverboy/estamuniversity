<?php 
    $tag = 'Estam University Akpakpa';
    if($url[1] == 'dashboard'){
        echo "<title>Dashboard | $tag</title>";
    }
    else if($url[1] == 'students'){
        echo "<title>Search | $tag</title>";
    }
    
    else if($url[1] == 'addstudent'){
        echo "<title>Add Student | $tag</title>";
    }
    else if($url[1] == 'view'){
        echo "<title>Student Details | $tag</title>";
    }
    else if($url[1] == 'editstudent'){
        echo "<title>Edit Student | $tag</title>";
    }
    else if($url[1] == 'changepassword'){
        echo "<title>Change Password | $tag</title>";
    }

?>