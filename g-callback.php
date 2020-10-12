<?php

    require_once(__DIR__ . '/app/config/config.php');

    if (isset($_SESSION['access_token'])) {
        $gClient->setAccessToken($_SESSION['access_token']);
    }
    else if (isset($_GET["code"])) {
        $token = $gClient->fetchAccessTokenWithAuthCode($_GET["code"]);
        $_SESSION['access_token'] = $token;
    }

    $oAuth = new Google_Service_Oauth2($gClient);
    $userdata = $oAuth->userinfo->get();

    $_SESSION['email']      = $userdata['email'];
    $_SESSION['gender']     = $userdata['gender'];
    $_SESSION['picture']    = $userdata['picture'];
    $_SESSION['familyName'] = $userdata['familyName'];
    $_SESSION['givenName']  = $userdata['givenName'];

    header('location: Data.php');
    exit();
?>
