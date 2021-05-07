<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    require '../../config/database.php';
    require '../../models/quote.php';

    $database = new Database();
    $db = $database->connect();

    $quote = new Quote($db);

    //get url query parameters
    $authorId = filter_input(INPUT_GET, 'authorId', FILTER_VALIDATE_INT);
    $categoryId = filter_input(INPUT_GET, 'categoryId', FILTER_VALIDATE_INT);
    $limit = filter_input(INPUT_GET, 'limit', FILTER_VALIDATE_INT);

    $num = 0;

    if($authorId || $categoryId || $limit) {
        $result = $quote->get_quotes_by_query($authorId, $categoryId, $limit);
        $num = $result->rowCount();
    } else {
        $result = $quote->read();
        $num = $result->rowCount();
    }
    
    if($num > 0) {
        $quotes_arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $quote_item = array(
                'id' => $id,
                'quote' => $quote,
                'author' => $author,
                'category' => $category
            );

            array_push($quotes_arr, $quote_item);
        }

        echo json_encode($quotes_arr);
    } else {
        echo json_encode(
            array('message' => 'No Quotes Found')
        );
    }