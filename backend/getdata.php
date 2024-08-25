<?php
    $response = array();
    if (isset($_POST['page'])) {
        $page = $_POST['page'];
        switch ($page) {
            case 'dashboard':
                $response['data'] = "user_data/user_data.php";
                break;
            case 'user-data':
                $response['data'] = "user_data/user_data.php";
                break;
            case 'room-data':
                $response['data'] = "user_data/user_data.php";
                break;
            case 'service-data':
                $response['data'] = "user_data/user_data.php";
                break;
            default:
                $response['data'] = "user_data/user_data.php";
        }
    } else {
        $response['data'] = "user_data/user_data.php";
    }
    echo json_encode($response);
?>