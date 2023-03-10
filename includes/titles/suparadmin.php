<?php 
    $tag = 'Estam University Akpakpa';
    if($url[1] == 'dashboard'){
        echo "<title>Dashboard | $tag</title>";
    }
    else if($url[1] == 'pay' || $url[1] == 're'  || $url[1] == 'students'){
        echo "<title>Search | $tag</title>";
    }
    else if($url[1] == 'payment'){
        echo "<title>Add Payment | $tag</title>";
    }
    else if($url[1] == 'paymenthistory'){
        echo "<title>Payments | $tag</title>";
    }
    else if($url[1] == 'result'){
        echo "<title>Add Results | $tag</title>";
    }
    else if($url[1] == 'resulthistory'){
        echo "<title>Results | $tag</title>";
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
    else if($url[1] == 'addstaff'){
        echo "<title>Add Staff | $tag</title>";
    }
    else if($url[1] == 'changepassword'){
        echo "<title>Change Password | $tag</title>";
    }
    else if($url[1] == 'formsfields' | $url[1] == 'paymentdetails'){
        echo "<title>Add Fields | $tag</title>";
    }
    else if($url[1] == 'resultdetails'){
        echo "<title>Add Course | $tag</title>";
    }
    else if($url[1] == 'staffs'){
        echo "<title>Staffs | $tag</title>";
    }

?>