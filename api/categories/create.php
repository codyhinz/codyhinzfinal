<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

    require '../../config/database.php';
    require '../../models/category.php';

    $database = new Database();
    $db = $database->connect();

    $cat = new Category($db);

    $data = json_decode(file_get_contents("php://input"));

    $cat->category = $data->category;

    if(!empty($cat->category)) {
        //create category
        $cat->create();
        echo json_encode(
            array('message' => 'Category created')
        );
    } else {
        echo json_encode(
            array('message' => 'Category was not created')
        );
    }