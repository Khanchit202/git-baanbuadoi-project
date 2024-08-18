<?php
    session_start();
    include("../db_config.php");
    $db_con = connect_db("client");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar With Bootstrap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="dash.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <script type="text/javascript" src="user_data/user.js"></script>
    <script type="text/javascript"> 
        $(document).ready(function () {
            $('#userdata').DataTable();
        });
    </script>
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex" style="padding: 20px 0 20px 20px;">
                <img src="../tabbar_view/baanbuadoi.png" alt="" width="30px">
                <div class="sidebar-logo">
                    <a href="#">กิจการบ้านบัวดอย</a>
                </div>
            </div>

            <?php include("menu_dash.php"); 
                menu_dash()
            ?>
            
            <div class="sidebar-footer">
                <a href="../index.php" class="sidebar-link">
                    <i class="lni lni-home"></i>
                    <span>กลับหน้าหลัก</span>
                </a>
            </div>
        </aside>
        <div class="main p-3">
            <nav class="navbar navbar-light bg-light" style="border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);margin-bottom: 20px;">
                <div class="bar">
                    <button class="toggle-btn" type="button">
                        <i class="lni lni-menu"></i>
                    </button>
                </div>
            </nav>
                
            <div class="text-center">
                <?php include("user_data\set_accessrights.php"); ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="main.js"></script>
</body>

</html>