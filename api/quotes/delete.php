<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

    require '../../config/database.php';
    require '../../models/quote.php';

    $database = new Database();
    $db = $database->connect();

    $quote = new Quote($db);

    $data = json_decode(file_get_contents("php://input"));

    $quote->id = $data->id;

    if(!empty($quote->id)) {
        $quote->delete();
        echo json_encode(
            array('message' => 'Quote deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'Quote was not deleted')
        );
    }