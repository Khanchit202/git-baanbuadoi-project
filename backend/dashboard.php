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
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="dash.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="user_data.js"></script>
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
                menu_dash();
            ?>
            
            <div class="sidebar-footer">
                <a href="../index.php" class="sidebar-link">
                    <i class="lni lni-home"></i>
                    <span>กลับหน้าหลัก</span>
                </a>
            </div>
        </aside>

        <div class="main p-3" style="background-color: #ECF0F1;">
            <nav class="navbar navbar-light bg-light" style="border-radius: 10px; margin-bottom: 20px;">
                <div class="bar">
                    <button class="toggle-btn" type="button">
                        <i class="lni lni-menu"></i>
                    </button>
                </div>
            </nav>
            <div id="content">


            </div>
            <div class="footer" style="background-color: white; border-radius: 10px; margin-top: 10px; text-align: center; height: 60px;padding-top:20px;">
                <div class="bar">
                    <p style="opacity: 50%; font-size: 10px;">&copy; 2024 Khanchit Bangphra & Somchai Manheang. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="main.js"></script>
    <script src="user_data/user_data.js"></script>
</body>

</html>
