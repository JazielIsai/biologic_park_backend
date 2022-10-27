<?php

function cors() {
    // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
        // you want to allow, and if so:
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            // may also be using PUT, PATCH, HEAD etc
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }
}

cors();

include './DBCnx.php';
include './Controller.php';
include './Users.php';
include './Parks.php';

$users_services = new Users();
$parks_services = new Parks();

$servicesName = $_GET['servicesName'] ?? '';

switch ($servicesName) {

    //user services
    case 'get_all_users':
        echo json_encode($users_services->get_all_users());
        break;
    case 'get_all_user_by_rol':
        echo json_encode($users_services->get_all_user_by_rol());
        break;

    //parks services
    case 'get_parks_by_municipality':
        if ($_GET['search_municipality'])
        echo json_encode($parks_services->get_parks_by_municipality(json_decode($_GET['search_municipality'])));
        break;

}
