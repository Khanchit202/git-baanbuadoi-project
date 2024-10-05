<?php
    include ("../../db_config.php");
    $db_con = connect_db();

    if (isset($_GET['payId'])) {
        $payId = $_GET['payId'];
    } elseif (isset($_POST['payId'])) {
        $payId = $_POST['payId'];
    } else {
        $payId = null;
    }

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

        $sql2 = "UPDATE booking_bill
        SET billStatus = ?
        WHERE payID = ?";
        
        if (count($results) > 0) {
            $found = false;
        
            foreach ($results as $row) {
                if ($number == $row['creditNumber'] && $name == $row['creditName'] && $date == $row['creditValid'] && $cvv == $row['creditCsv']) {
                    $found = true;
        
                    $bank = $row['creditBank'];
        
                    $stmt = $db_con->prepare($sql);
                    $stmt->bindParam(1, $name);
                    $stmt->bindValue(2, $now);
                    $stmt->bindValue(3, 300);
                    $stmt->bindParam(4, $bank);
                    $stmt->bindValue(5, 2);
                    $stmt->bindParam(6, $payId);
                    $stmt->execute();

                    $stmt2 = $db_con->prepare($sql2);
                    $stmt2->bindValue(1, 1);
                    $stmt2->bindParam(2, $payId);
                    $stmt2->execute();
        
                    echo "success";
                    break;
                }
            }
        
            if (!$found) {
                echo "no";
            }
        } else {
            echo "error";
        }
        

    } catch (PDOException $e) {
        echo "error: " . $e->getMessage();
    }
?>
