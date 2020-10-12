<?php
    require_once(__DIR__ . '/app/config/config.php');
    unset($_SESSION['access_token']);
    session_destroy();
    header('Location: index.php');
    exit();
?>
