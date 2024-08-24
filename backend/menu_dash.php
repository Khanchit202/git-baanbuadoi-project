<?php

function menu_dash() {
    
    if (empty($_SESSION['user_lavel'])) {
        $lavel = "";
    } else {
        if($_SESSION['user_lavel'] == 1) {
            $lavel = $_SESSION['user_lavel'];
            $lavel_name = "ผู้ดูแลระบบ";
            $lavel_color = "red";
        }else if($_SESSION['user_lavel'] == 2){
            $lavel = $_SESSION['user_lavel'];
            $lavel_name = "เจ้าของกิจการ";
            $lavel_color = "LimeGreen";
        }else{
            $lavel = $_SESSION['user_lavel'];
            $lavel_name = "พนักงาน";
            $lavel_color = "blue";
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
    $current_page = basename($_SERVER['PHP_SELF']);
    ?>   
            <ul class="sidebar-nav">
                <?php user_status($lavel_name, $lavel_color); ?>
                <li class="sidebar-item">
                    <a href="#" id="dash-data" class="sidebar-link">
                        <i class="lni lni-grid-alt"></i>
                        <span>แดชบอร์ด</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" id="user-data" class="sidebar-link">
                        <i class="lni lni-protection"></i>
                        <span>กำหนดสิทธิ์การเข้าถึงระบบ</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="lni lni-list"></i>
                        <span>จัดการข้อมูลกิจการ</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" id="room-data" class="sidebar-link">ห้องพัก</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">บริการ</a>
                        </li>
                    </ul>
                </li>
            </ul>

    <?php
} 

function owner_dash($lavel_name, $lavel_color) {
    $current_page = basename($_SERVER['PHP_SELF']);
    ?>   
        <ul class="sidebar-nav">
                <?php user_status($lavel_name, $lavel_color); ?>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-grid-alt"></i>
                        <span>แดชบอร์ด</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-protection"></i>
                        <span>กำหนดสิทธิ์การเข้าถึงระบบ</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="lni lni-list"></i>
                        <span>จัดการข้อมูล</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">ห้องพัก</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">บริการ</a>
                        </li>
                    </ul>
                </li>

            </ul>

    <?php
} 

function emp_dash($lavel_name, $lavel_color) {
    $current_page = basename($_SERVER['PHP_SELF']);
    ?>   
        <ul class="sidebar-nav">
                <?php user_status($lavel_name, $lavel_color); ?>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-grid-alt"></i>
                        <span>แดชบอร์ด</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-protection"></i>
                        <span>กำหนดสิทธิ์การเข้าถึงระบบ</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="lni lni-list"></i>
                        <span>จัดการข้อมูล</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">ห้องพัก</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">บริการ</a>
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