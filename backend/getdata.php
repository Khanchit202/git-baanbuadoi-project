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
                $response['data'] = "user_data/room.php";
                break;
            case 'service-data':
                $response['data'] = "user_data/service.php";
                break;
            case 'booking-data':
                    $response['data'] = "user_data/booking.php";
                break;
            case 'premaket-data':
                    $response['data'] = "user_data/premaket.php";
                break;
            case 'bookingpayment-data':
                    $response['data'] = "user_data/booking_payment.php";
                break;
            case 'promotion-data':
                    $response['data'] = "user_data/promotion.php";
                break;
            case 'reviwsroom-data':
                    $response['data'] = "user_data/reviwsroom.php";
                break;
            case 'reviwsservice-data':
                    $response['data'] = "user_data/reviwsservice.php";
                break;
            default:
                $response['data'] = "user_data/user_data.php";
        }
    } else {
        $response['data'] = "user_data/user_data.php";
    }
    echo json_encode($response);
?>