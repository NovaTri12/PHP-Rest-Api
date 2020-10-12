<?php

if (!isset($_SESSION['access_token'])) {
    echo "Private Area";
} else {


    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once(__DIR__ . '/../../config/Database.php');
    include_once(__DIR__ . '/../../models/');



    //  init DB & Connect 
    $database = new Database();
    $db = $database->connect();

    // init email 

    $email = new Email($db);

    // Email query
    $result = $email->read();
    // get row count 
    $num = $result->rowCount();

    if ($num > 0) {
        // Email Read

        $emails_arr = array();
        $emails_arr['data'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $email_item = array(
                'uuid' => $uuid,
                'sender' => $sender,
                'recipient' => $recipient,
                'body' => $body,
                'subject' => $subject
            );

            // push the data 
            array_push($emails_arr['data'], $email_item);
        }
        echo json_encode($emails_arr);
    } else {
        echo json_encode(
            array('message' => 'No Data Found')
        );
    }
}
