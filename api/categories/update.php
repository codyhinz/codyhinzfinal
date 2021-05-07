<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

    require '../../config/database.php';
    require '../../models/category.php';

    $database = new Database();
    $db = $database->connect();

    $cat = new Category($db);

    $data = json_decode(file_get_contents("php://input"));

    $cat->id = $data->id;
    $cat->category = $data->category;

    if(!empty($cat->id) &&
    !empty($cat->category)) {
        $cat->update();
        echo json_encode(
            array('message' => 'Category updated')
        );
    } else {
        echo json_encode(
            array('message' => 'Category was not updated')
        );
    }