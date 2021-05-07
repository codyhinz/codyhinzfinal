<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    require '../../config/database.php';
    require '../../models/category.php';

    $database = new Database();
    $db = $database->connect();

    $cat = new Category($db);

    $cat->id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    $cat->read_single();

    $cat_arr = array(
        'id' => $cat->id,
        'category' => $cat->category
    );

    if(!empty($cat_arr['category'])) {
        echo json_encode($cat_arr);
    } else {
        echo json_encode(
            array("message" => "No category found with the specified id")
        );
    }






