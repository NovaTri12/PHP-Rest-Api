<?php

if (!isset($_SESSION['access_token'])) {
    echo "Private Area";
} else {
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Email.php';


    // init DB 

    $database = new Database();
    $db = $database->connect();


    // init Email 
    $email = new Email($db);

    // get post raw data 
    $data = json_decode(file_get_contents("php://input"));

    $email->uuid = $data->uuid;
    $email->sender = $data->sender;
    $email->recipient = $data->recipient;
    $email->body = $data->body;
    $email->subject = $data->subject;

    // create email history 

    if ($email->create()) {
        echo json_encode(
            array('message' => 'Email History Created')
        );
    } else {
        echo json_encode(
            array('message' => 'Email History Not Created')
        );
    }
}
