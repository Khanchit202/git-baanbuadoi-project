<?php
    include ("../../db_config.php");
    $db_con = connect_db();

    $payId = $_POST['payId'];
    $number = $_POST['creditNumber'];
    $fnam = $_POST['creditfname'];
    $lnam = $_POST['creditlname'];
    $name = $fnam . " " . $lnam;
    $date = $_POST['creditdate'];
    $cvv = $_POST['creditcvv'];
    $now = date('Y-m-d H:i:s');

    try {
        $query = $db_con->prepare("SELECT * FROM credit_card");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        $sql = "UPDATE booking_payment
                    SET payNameAc = ?, payDate = ?, payManey = ?, payBank = ?, payStatus = ?
                    WHERE payID = ?";
        
        if (count($results) > 0) {
            foreach ($results as $row) {
                if ($number == $row['creditNumber'] && $name == $row['creditName'] && $date == $row['creditValid'] && $cvv == $row['creditCsv']) {
                    
                    $bank = $row['creditBank'];

                    

                    $stmt = $db_con->prepare($sql);
                    $stmt->bindParam(1, $name);
                    $stmt->bindValue(2, $now);
                    $stmt->bindValue(3, 2000);
                    $stmt->bindParam(4, $bank);
                    $stmt->bindValue(5, 2);
                    $stmt->bindParam(6, $payId);
                    $stmt->execute();


                    echo "success";
                } else {
                    
                    echo "no";
                }
            }
        } else {
            echo "error";
        }

    } catch (PDOException $e) {
        echo "error: " . $e->getMessage();
    }
?>
