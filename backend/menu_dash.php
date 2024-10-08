<?php

function menu_dash() {
    if (empty($_SESSION['user_lavel'])) {
        $lavel = "";
    } else {
        if ($_SESSION['user_lavel'] == 1) {
            $lavel = $_SESSION['user_lavel'];
            $lavel_name = "ผู้ดูแลระบบ";
            $lavel_color = "red";
        } elseif ($_SESSION['user_lavel'] == 2) {
            $lavel = $_SESSION['user_lavel'];
            $lavel_name = "เจ้าของกิจการ";
            $lavel_color = "LimeGreen";
        }else {
            $lavel = $_SESSION['user_lavel'];
            $lavel_name = "พนักงาน";
            $lavel_color = "LimeGreen";

        } 
    }

    switch ($lavel) {
        case 1: admin_dash($lavel_name, $lavel_color); break;
        case 2: owner_dash($lavel_name, $lavel_color); break;
        case 3: emp_dash($lavel_name, $lavel_color); break;
        default: no_dash();
    }
}

function user_status($lavel_name, $lavel_color) {
    ?>    
        <li class="sidebar-item">
            <div class="user_name" style="padding: 0 0 20px 30px;">
                <h2 style="font-size: 14px;font-weight: bold;"><?php echo $_SESSION['FName'], " ", $_SESSION['LName'] ?></h2>
                <p style="font-size: 11px; color: <?php echo $lavel_color ?>;"><i class="lni lni-checkmark-circle" style="color: <?php echo $lavel_color ?>; margin-right: 8px;"></i><?php echo $lavel_name ?></p>
            </div>
        </li>
    <?php
} 

function admin_dash($lavel_name, $lavel_color) {
    $current_page = isset($_GET['page']) ? $_GET['page'] : 'dashboard-admin';
    ?>   
        <ul class="sidebar-nav">
            <?php user_status($lavel_name, $lavel_color); ?>
            <li class="sidebar-item">
                <a href="?page=dashboard-admin" class="sidebar-link <?php echo ($current_page == 'dashboard-admin' ? 'active' : '') ?>">
                    <i class="lni lni-grid-alt"></i>
                    <span>แดชบอร์ด</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="?page=user-data" class="sidebar-link <?php echo ($current_page == 'user-data' ? 'active' : '') ?>">
                    <i class="lni lni-protection"></i>
                    <span>กำหนดสิทธิ์การเข้าถึงระบบ</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                    <i class="lni lni-list"></i>
                    <span>จัดการข้อมูลกิจการ</span>
                </a>
                <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="?page=room-data" class="sidebar-link <?php echo ($current_page == 'room-data' ? 'active' : '') ?>">ห้องพัก</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="?page=service-data" class="sidebar-link <?php echo ($current_page == 'service-data' ? 'active' : '') ?>">บริการ</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="?page=reviwsroom-data" class="sidebar-link <?php echo ($current_page == 'reviwsroom-data' ? 'active' : '') ?>">ข้อมูลรีวิวห้องพัก</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="?page=reviwsservice-data" class="sidebar-link <?php echo ($current_page == 'reviwsservice-data' ? 'active' : '') ?>">ข้อมูลรีวิวบริการ</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="?page=premaket-data" class="sidebar-link <?php echo ($current_page == 'premaket-data' ? 'active' : '') ?>">จัดการข้อมูลข่าวสาร</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="?page=promotion-data" class="sidebar-link <?php echo ($current_page == 'promotion-data' ? 'active' : '') ?>">จัดการข้อมูลโปรโมชั่น</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="?page=booking-data" class="sidebar-link <?php echo ($current_page == 'booking-data' ? 'active' : '') ?>">
                    <i class="lni lni-list"></i>
                    <span>ข้อมูลการจอง</span>
                </a>
            </li>
        </ul>
    <?php
} 

function owner_dash($lavel_name, $lavel_color) {
    $current_page = isset($_GET['page']) ? $_GET['page'] : 'dashboard-owner';
    ?>   
        <ul class="sidebar-nav">
            <?php user_status($lavel_name, $lavel_color); ?>
            <li class="sidebar-item">
                <a href="?page=dashboard-owner" class="sidebar-link <?php echo ($current_page == 'dashboard-owner' ? 'active' : '') ?>">
                    <i class="lni lni-grid-alt"></i>
                    <span>แดชบอร์ด เจ้าของกิจการ</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="?page=user-data" class="sidebar-link <?php echo ($current_page == 'user-data' ? 'active' : '') ?>">
                    <i class="lni lni-protection"></i>
                    <span>กำหนดสิทธิ์การเข้าถึงระบบ</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                    <i class="lni lni-list"></i>
                    <span>จัดการข้อมูล</span>
                </a>
                <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="?page=room-data" class="sidebar-link <?php echo ($current_page == 'room-data' ? 'active' : '') ?>">ห้องพัก</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="?page=service-data" class="sidebar-link <?php echo ($current_page == 'service-data' ? 'active' : '') ?>">บริการ</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="?page=reviwsroom-data" class="sidebar-link <?php echo ($current_page == 'reviwsroom-data' ? 'active' : '') ?>">ข้อมูลรีวิวห้องพัก</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="?page=reviwsservice-data" class="sidebar-link <?php echo ($current_page == 'reviwsservice-data' ? 'active' : '') ?>">ข้อมูลรีวิวบริการ</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="?page=premaket-data" class="sidebar-link <?php echo ($current_page == 'premaket-data' ? 'active' : '') ?>">จัดการข้อมูลข่าวสาร</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="?page=promotion-data" class="sidebar-link <?php echo ($current_page == 'promotion-data' ? 'active' : '') ?>">จัดการข้อมูลโปรโมชั่น</a>
                    </li>
                </ul>
                
                    
            </li>
        </ul>
    <?php
} 

function emp_dash($lavel_name, $lavel_color) {
    $current_page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
    ?>   
        <ul class="sidebar-nav">
            <?php user_status($lavel_name, $lavel_color); ?>
            <li class="sidebar-item">
                <a href="?page=dashboard" class="sidebar-link <?php echo ($current_page == 'dashboard' ? 'active' : '') ?>">
                    <i class="lni lni-grid-alt"></i>
                    <span class="fw-bold" style="font-size: 12px;">แดชบอร์ด</span>
                </a>
            </li>

            <li class="sidebar-item">
                
                <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#roomService" aria-expanded="false" aria-controls="roomService">
                <i class="lni lni-layers"></i>
                    <span class="fw-bold" style="font-size: 12px;">จัดการข้อมูลห้องพักและบริการ</span>
                </a>
                <ul id="roomService" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="?page=room-data" class="sidebar-link <?php echo ($current_page == 'room-data' ? 'active' : '') ?>">ห้องพัก</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="?page=service-data" class="sidebar-link <?php echo ($current_page == 'service-data' ? 'active' : '') ?>">บริการ</a>
                    </li>
                </ul>
            </li>
       
            <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#booking" aria-expanded="false" aria-controls="booking">
                    <i class="lni lni-library"></i>
                    <span class="fw-bold" style="font-size: 12px;">จัดการข้อมูลการจอง</span>
                </a>
                <ul id="booking" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="?page=bookingpayment-data" class="sidebar-link <?php echo ($current_page == 'bookingpayment-data' ? 'active' : '') ?>">การชำระเงิน</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="?page=booking-data" class="sidebar-link <?php echo ($current_page == 'booking-data' ? 'active' : '') ?>">จัดการข้อมูลการจอง</a>
                    </li>
                </ul>
            </li>
        
            <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#website" aria-expanded="false" aria-controls="website">
                    <i class="lni lni-code-alt"></i>
                    <span class="fw-bold" style="font-size: 12px;">จัดการข้อมูลหน้าเว็บไซต์</span>
                </a>
                <ul id="website" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="?page=premaket-data" class="sidebar-link <?php echo ($current_page == 'premaket-data' ? 'active' : '') ?>">จัดการข้อมูลข่าวสาร</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="?page=promotion-data" class="sidebar-link <?php echo ($current_page == 'promotion-data' ? 'active' : '') ?>">จัดการข้อมูลโปรโมชั่น</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="?page=reviwsroom-data" class="sidebar-link <?php echo ($current_page == 'reviwsroom-data' ? 'active' : '') ?>">จัดการข้อมูลรีวิวห้องพัก</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="?page=reviwsservice-data" class="sidebar-link <?php echo ($current_page == 'reviwsservice-data' ? 'active' : '') ?>">จัดการข้อมูลรีวิวบริการ</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#check" aria-expanded="false" aria-controls="check">
                    <i class="lni lni-write"></i>
                    <span class="fw-bold" style="font-size: 12px;">จัดการการเข้าและคืน</span>
                </a>
                <ul id="check" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="?page=checkin-data" class="sidebar-link <?php echo ($current_page == 'checkin-data' ? 'active' : '') ?>">คำขอเข้าใช้บริการ</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="?page=checkout-data" class="sidebar-link <?php echo ($current_page == 'checkout-data' ? 'active' : '') ?>">คำขอส่งคืนบริการ</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="?page=checkstory-data" class="sidebar-link <?php echo ($current_page == 'checkstory-data' ? 'active' : '') ?>">ประวัติการเข้าพัก</a>
                    </li>
                </ul>
            </li>

            
        </ul>
    <?php
}



function no_dash() {
    echo "คุณไม่มีสิทธิ์เรียกดูข้อมูลใดๆ";
} 
?>
