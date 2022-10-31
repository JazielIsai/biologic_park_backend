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

include_once './config/DBCnx.php';
include_once './model/Controller.php';
include_once './model/Users.php';
include_once './model/Parks.php';
include_once './model/BiologicalCategory.php';
include_once './model/BiologicData.php';
include_once './model/CityState.php';
include_once './model/PivotBiologicPark.php';

$users_services = new Users();
$parks_services = new Parks();
$category_services = new BiologicalCategory();
$biologicalData_services = new BiologicData();
$cityState_services = new CityState();
$pivotBiologicPark_services = new PivotBiologicPark();

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
    case 'get_all_parks':
        echo json_encode($parks_services->get_all_parks());
        break;

    case 'get_park_by_id':
        if ($_GET['idPark']) {
            echo json_encode($parks_services->get_park_by_id($_GET['idPark']));
        }
        break;

    case 'get_parks_by_city_state':
        if ($_GET('search_city_state')) {
           echo json_encode($parks_services->get_parks_by_city_state($_GET['search_city_state']));
        }
        break;

    case 'get_parks_by_municipality':
        if ($_GET['search_municipality']) {
            echo json_encode($parks_services->get_parks_by_municipality($_GET['search_municipality']));
        }
        break;

    case 'get_park_by_name':
        if ($_GET['search_park_by_name']) {
            echo json_encode($parks_services->get_park_by_name($_GET['search_park_by_name']));
        }
        break;

    // Services to biological category
    case 'get_all_category':
        echo json_encode($category_services->get_all_category());
        break;
    case 'get_category_by_id':
        echo json_encode($category_services->get_category_by_id());
        break;

    // services to biological data
    case 'get_all_biological_data':
        echo json_encode($biologicalData_services->get_all_biological_data());
        break;
    case 'get_all_biologic_data_by_common_name':
        if ($_GET['search_common_name']) {
            echo json_encode($biologicalData_services->get_all_biologic_data_by_common_name($_GET['search_common_name']));
        }
        break;
    case 'get_all_biologic_data_by_scientific_data':
        if ($_GET['search_scientific_data']) {
            echo json_encode($biologicalData_services->get_all_biologic_data_by_scientific_data($_GET['search_scientific_data']));
        }
        break;
    case '':
        break;

    // services to municipality
    case 'get_all_municipality_by_state':
        echo json_encode($cityState_services->get_all_municipality_by_state());
        break;

    // services to Pivot Biologic Park_services table
    case 'get_all_relation_biologic_data_and_parks_data':
        echo json_encode($pivotBiologicPark_services->get_all_relation_biologic_data_and_parks_data());
        break;


}
