<?php 
    $tag = 'Estam University Akpakpa';
    if($url[1] == 'dashboard'){
        echo "<title>Dashboard | $tag</title>";
    }
    else if($url[1] == 're'){
        echo "<title>Search | $tag</title>";
    }
    else if($url[1] == 'result'){
        echo "<title>Add Results | $tag</title>";
    }
    else if($url[1] == 'resulthistory'){
        echo "<title>Results | $tag</title>";
    }
    else if($url[1] == 'changepassword'){
        echo "<title>Change Password | $tag</title>";
    }

?>