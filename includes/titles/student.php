<?php 
    $tag = 'Estam University Akpakpa';
    if($url[1] == 'dashboard'){
        echo "<title>Dashboard | $tag</title>";
    }
    
    else if($url[1] == 'paymenthistory'){
        echo "<title>Payments | $tag</title>";
    }
    
    else if($url[1] == 'resulthistory'){
        echo "<title>Results | $tag</title>";
    }

?>