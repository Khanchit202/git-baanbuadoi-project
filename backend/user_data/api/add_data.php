<?php
    include("../../../db_config.php");
    $db_con = connect_db("client");
    $response = array();

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $userName = $_POST['userName'];
        $userFName = $_POST['userFName'];
        $userLName = $_POST['userLName'];
        $userTel = $_POST['userTel'];
        $userEmail = $_POST['userEmail'];
        $userLavelID = $_POST['userLavelID'];
        $passwd = $_POST['userName'] . "1234";
        $userProfile = "img/profile/profile_1.jpg";

        // $userName = "khanchit";
        // $userFName = 'khanchit';
        // $userLName = "Bangphra";
        // $userTel = "02222222";
        // $userEmail = "Khanchit@buadoi.ac.th";
        // $userLavelID = 1;
        // $passwd =  $userName. "1234";
        // $userProfile = "img/profile/profile_1.jpg";

        $hashedPasswd = password_hash($passwd, PASSWORD_DEFAULT);
        

        $sql = "INSERT INTO users (userName, userPass, userFName, userLName,  userTel, userEmail,  userLavelID, userImg)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $db_con->prepare($sql);

        $stmt->bindParam(1, $userName);
        $stmt->bindParam(2, $hashedPasswd);
        $stmt->bindParam(3, $userFName);
        $stmt->bindParam(4, $userLName);
        $stmt->bindParam(5, $userTel);
        $stmt->bindParam(6, $userEmail);
        $stmt->bindParam(7, $userLavelID);
        $stmt->bindParam(8, $userProfile);
        $result = $stmt->execute();
        
        if($result){
            $respose['status'] = 'ok';
        }else{
            $respose['status'] = 'error';
        }

    }
    echo json_encode($respose);

?>