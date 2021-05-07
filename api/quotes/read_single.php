<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    require '../../config/database.php';
    require '../../models/quote.php';

    $database = new Database();
    $db = $database->connect();

    $quote = new Quote($db);

    $quote->id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    $quote->read_single();

    $quote_arr = array(
        'id' => $quote->id,
        'quote' => $quote->quote,
        'author' => $quote->author,
        'category' => $quote->category
    );

    if(!empty($quote_arr['quote'])) {
        echo json_encode($quote_arr);
    } else {
        echo json_encode(
            array("message" => "No quote found with the specified id")
        );
    }






