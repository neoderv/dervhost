<?php 
    if ($_GET['data']) {
        setcookie('token', $_GET['data'], strtotime( '+30 days' )  ); 
    }
?>