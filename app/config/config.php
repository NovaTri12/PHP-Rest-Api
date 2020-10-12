<?php
    require_once(__DIR__ . '/../vendor/autoload.php');
    session_start();

    $gClient = new Google_Client();
    $gClient->setClientId("973314554691-sp45qdffb0t5126j5g139ncn9kpi8gog.apps.googleusercontent.com");
    $gClient->setClientSecret("1-bJOOhhUT_90Dofy0xBrHWS");
    $gClient->setApplicationName("Rest API Send Email");
    $gClient->setRedirectUri("http://localhost/rest-api-email/g-callback.php");
    $gClient->addScope('email');
    $gClient->addScope('profile');

?>

