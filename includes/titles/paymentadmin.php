<?php 
    $tag = 'Estam University Akpakpa';
    if($url[1] == 'dashboard'){
        echo "<title>Dashboard | $tag</title>";
    }
    else if($url[1] == 'pay'){
        echo "<title>Search | $tag</title>";
    }
    else if($url[1] == 'payment'){
        echo "<title>Add Payment | $tag</title>";
    }
    else if($url[1] == 'paymenthistory'){
        echo "<title>Payments | $tag</title>";
    }
    else if($url[1] == 'changepassword'){
        echo "<title>Change Password | $tag</title>";
    }

?>