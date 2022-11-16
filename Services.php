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
include_once './model/Municipality.php';
include_once './model/ImagesBiologicData.php';
include_once './model/ImageParkData.php';
include_once './model/PivotBiologicPark.php';
include_once './model/JoinsTables.php';

$users_services = new Users();
$parks_services = new Parks();
$category_services = new BiologicalCategory();
$biologicalData_services = new BiologicData();
$cityState_services = new CityState();
$municipality_services = new Municipality();
$images_biologic_data = new ImagesBiologicData();
$images_park_data = new ImageParkData();
$pivotBiologicPark_services = new PivotBiologicPark();
$joinsTables_services = new JoinsTables();

$servicesName = $_GET['servicesName'] ?? '';

switch ($servicesName) {

    //user services
    case 'get_all_users':
        echo json_encode($users_services->get_all_users());
        break;
    case 'get_all_user_by_rol':
        echo json_encode($users_services->get_all_user_by_rol());
        break;
    case 'checking_if_exist_user':
        if(isset( $_GET['email'], $_GET['password'] )){
            echo json_encode($users_services->checking_if_exist_user($_GET['email'], $_GET['password']));
        }
        break;

    //parks services
    case 'get_all_name_and_id_parks':
        if (isset($_GET['user_id'])) {
            echo json_encode($parks_services->get_all_name_and_id_parks($_GET['user_id']));
        }
        break;

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
    case 'get_parks_by_user_id':
        if (isset($_GET['user_id'])) {
            echo json_encode($parks_services->get_parks_by_user_id($_GET['user_id']));
        }
        break;
    case 'add_park':
        if (isset($_POST['data'])) {
            echo json_encode($parks_services->add_park(json_decode($_POST['data'])));
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
    case 'get_all_name_and_id_biologic_data':
        if (isset($_GET['user_id'])) {
            echo json_encode($biologicalData_services->get_all_name_and_id_biologic_data($_GET['user_id']));
        }
        break;
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
    case 'get_biologic_data_by_user_id':
        if ( $_GET['user_id'] ) {
            echo json_encode($biologicalData_services->get_biologic_data_by_user_id($_GET['user_id']));
        }
        break;

    // services to cityState table
    case 'get_all_cityState':
        echo json_encode($cityState_services->get_all_cityState());
        break;

    // services to municipality table
    case 'get_all_municipality_by_id':
        if(isset($_GET['cityState_id'])) {
            echo json_encode($municipality_services->get_all_municipality_by_id($_GET['cityState_id']));
        }
        break;

    // services to images biologic data table
    case 'get_img_by_biologic_data_id':
        if (isset($_GET['biologic_data_id'])) {
            echo json_encode($images_biologic_data->get_img_by_biologic_data_id($_GET['biologic_data_id']));
        }
        break;
    case 'get_img_with_biologic_data_and_category':
        if (isset($_GET['biologic_data_id'])) {
            echo json_encode($images_biologic_data->get_img_with_biologic_data_and_category($_GET['biologic_data_id']));
        }
        break;
    case 'add_biologic_data':
        if (isset($_POST['data'])) {
            echo json_encode($biologicalData_services->add_biologic_data(json_decode($_POST['data'])));
        }
        break;
    case 'upload_image_by_biologic_data':
        if (isset($_POST['data'])) {
            var_dump($_POST['data']);
            echo json_encode($images_biologic_data->upload_image_by_biologic_data(json_decode($_POST['data'])));
        }
        break;

    // services to img parks data table
    case 'get_image_by_parks_data_id':
        if ($_GET['parks_data_id']) {
            echo json_encode($images_park_data->get_image_by_parks_data_id($_GET['parks_data_id']));
        }
        break;

    case 'get_images_by_user':
        if (isset($_GET['user_id'])) {
            echo json_encode($images_park_data->get_images_by_user($_GET['user_id']));
        }
        break;

    case 'upload_image_by_park_data':
        if (isset($_POST['data'])) {
            echo json_encode($images_park_data->upload_image_by_park_data(json_decode($_POST['data'])));
        }
        break;



    // services to Pivot Biologic Park_services table
    case 'get_all_relation_biologic_data_and_parks_data_by_biologic_data_id':
        if (isset($_GET['biologic_data_id'])) {
            echo json_encode($pivotBiologicPark_services->get_all_relation_biologic_data_and_parks_data_by_biologic_data_id($_GET['biologic_data_id']));
        }
        break;
    case 'get_all_relation_biologic_data_and_parks_data_with_img_way_desc':
        echo json_encode($pivotBiologicPark_services->get_all_relation_biologic_data_and_parks_data_with_img_way_desc());
        break;

    // joins tables services
    case 'get_join_tables_parks_and_biologic_data':
        if (isset($_GET['parks_user_id'], $_GET['biological_data_user_id'] )) {
            echo json_encode($joinsTables_services->get_join_tables_parks_and_biologic_data($_GET['parks_user_id'], $_GET['biological_data_user_id']) );
        }
        break;
    case 'get_join_tables_images':
        if (isset( $_GET['parks_user_id'], $_GET['biologic_user_id'] )) {
            echo json_encode($joinsTables_services->get_join_tables_images($_GET['parks_user_id'], $_GET['biologic_user_id']));
        }
        break;

    case 'get_data_and_img_parks_biologic':
        if (isset( $_GET['parks_user_id'], $_GET['biologic_user_id'], $_GET['img_parks_user_id'], $_GET['img_biologic_user_id'] )) {
            echo json_encode($joinsTables_services->get_data_and_img_parks_biologic($_GET['parks_user_id'], $_GET['biologic_user_id'], $_GET['img_parks_user_id'], $_GET['img_biologic_user_id']));
        }
        break;

    case 'add_relation_to_pivot_table':
        if (isset($_POST['data'])) {
            echo json_encode($pivotBiologicPark_services->add_relation_to_pivot_table(json_decode($_POST['data'])));
        }
        break;

}
