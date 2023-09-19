<?php 
    $token = basename($_COOKIE['token']);

    $ch = curl_init("https://auth.dervland.net/token/$token");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $data = curl_exec($ch);
    curl_close($ch);

    $username = json_decode($data)->username;
?>