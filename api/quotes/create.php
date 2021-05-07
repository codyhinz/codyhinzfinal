<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

    require '../../config/database.php';
    require '../../models/quote.php';

    $database = new Database();
    $db = $database->connect();

    $quote = new Quote($db);

    $data = json_decode(file_get_contents("php://input"));

    $quote->quote = $data->quote;
    $quote->authorId = $data->authorId;
    $quote->categoryId = $data->categoryId;

    if(!empty($quote->quote) &&
    !empty($quote->authorId) &&
    !empty($quote->categoryId)) {
        $quote->create();
        echo json_encode(
            array('message' => 'Quote created')
        );
    } else {
        echo json_encode(
            array('message' => 'Quote was not created')
        );
    }