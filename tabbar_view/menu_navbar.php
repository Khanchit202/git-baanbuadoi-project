

<?php

function menu_navbar() {

   
    if (empty($_SESSION['user_lavel'])) {
        $lavel = "";
    } else {
        $lavel = $_SESSION['user_lavel'];
    }
    
    if (empty($_SESSION['userImg'])) {
        $profile_name = "img/profile/profile_1.jpg";
        
    } else {
        $profile_name = $_SESSION['userImg'];
    }
    
    switch ($lavel) {
        case 1: admin_menu($profile_name); break;
        case 2: owner_menu($profile_name); break;
        case 3: emp_menu($profile_name); break;
        case 4: member_menu($profile_name); break;
        default: web_menu();
    }
}

function render_dropdown($profile_name) {
    ?>    
        <div class="dropdown" style="position: relative; display: inline-block;">
            <div class="profile-button" onclick="toggleDropdown()"
                 style="width: 40px; height: 40px; border-radius: 50%; overflow: hidden; display: flex; align-items: center; justify-content: center; background-color: #f0f0f0; border: 2px solid #ddd; cursor: pointer;">
                <img src="<?php echo $profile_name ?>" alt="Profile"
                     style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <div class="dropdown-menu"
            style="display: none; position: absolute; top: 50px; right: 0; background-color: #fff; border: 1px solid #ddd; border-radius: 4px; min-width: 150px; box-shadow: 0 2px 5px rgba(0,0,0,0.2); z-index: 1000; font-size: 12px;">
            <p style="margin: 0px;display: block; padding: 10px; text-decoration: none; color: #333;font-weight: bold;">คุณ <?php echo $_SESSION['FName'], " " , $_SESSION['LName'] ?></p>
            <a href="./user_profile.php?userID=<?php echo $_SESSION['userID']; ?>" style="display: block; padding: 10px; text-decoration: none; color: #333;">
                <i class="fas fa-user" style="color: #000;"></i> โปรไฟล์ของฉัน
            </a>


            <a href="#" style="display: block; padding: 10px; text-decoration: none; color: #333;">
                <i class="fas fa-history" style="color: #000;"></i> ประวัติการจอง
            </a>
            <a href="logout.php" style="display: block; padding: 10px; text-decoration: none; color: #333;">
                <i class="fas fa-sign-out-alt" style="color: #000;"></i> Logout
            </a>
        </div>

        </div>
    <?php
} 

function admin_menu($profile_name) {
    $current_page = basename($_SERVER['PHP_SELF']);
    ?>   
        <ul>
            <li><a href="index.php" class="<?php echo $current_page == 'index.php' ? 'active' : ''; ?>">หน้าหลัก</a></li>
            <li><a href="./room_product.php" class="<?php echo $current_page == 'room_product.php' ? 'active' : ''; ?>">ข้อมูลห้องพัก</a></li>
            <li><a href="./service_product.php" class="<?php echo $current_page == 'service_product.php' ? 'active' : ''; ?>">ข้อมูลบริการ</a></li>
            <li><a href="./premaket.php" class="<?php echo $current_page == 'premaket.php' ? 'active' : ''; ?>">ข่าวสารประชาสัมพันธ์</a></li>
            <li><a href="./contect.php" class="<?php echo $current_page == 'contect.php' ? 'active' : ''; ?>">เกี่ยวกับเรา</a></li>
            <li><a href="backend/dashboard.php" class="<?php echo $current_page == 'backend/dashboard.php' ? 'active' : ''; ?>">จัดการข้อมูล</a></li>
        </ul>
        <?php render_dropdown($profile_name); ?>
    <?php
} 

function owner_menu($profile_name) {
    $current_page = basename($_SERVER['PHP_SELF']);
    ?>   
        <ul>
            <li><a href="index.php" class="<?php echo $current_page == 'index.php' ? 'active' : ''; ?>">หน้าหลัก</a></li>
            <li><a href="./room_product.php" class="<?php echo $current_page == 'room_product.php' ? 'active' : ''; ?>">ข้อมูลห้องพัก</a></li>
            <li><a href="./service_product.php" class="<?php echo $current_page == 'service_product.php' ? 'active' : ''; ?>">ข้อมูลบริการ</a></li>
            <li><a href="./premaket.php" class="<?php echo $current_page == 'premaket.php' ? 'active' : ''; ?>">ข่าวสารประชาสัมพันธ์</a></li>
            <li><a href="./contect.php" class="<?php echo $current_page == 'contect.php' ? 'active' : ''; ?>">เกี่ยวกับเรา</a></li>
            <li><a href="backend/dashboard.php" class="<?php echo $current_page == 'backend/dashboard.php' ? 'active' : ''; ?>">จัดการข้อมูล</a></li>


        </ul>
        <?php render_dropdown($profile_name); ?>
    <?php
} 

function emp_menu($profile_name) {
    $current_page = basename($_SERVER['PHP_SELF']);
    ?>   
        <ul>
            <li><a href="index.php" class="<?php echo $current_page == 'index.php' ? 'active' : ''; ?>">หน้าหลัก</a></li>
            <li><a href="./room_product.php" class="<?php echo $current_page == 'room_product.php' ? 'active' : ''; ?>">ข้อมูลห้องพัก</a></li>
            <li><a href="./service_product.php" class="<?php echo $current_page == 'service_product.php' ? 'active' : ''; ?>">ข้อมูลบริการ</a></li>
            <li><a href="./premaket.php" class="<?php echo $current_page == 'premaket.php' ? 'active' : ''; ?>">ข่าวสารประชาสัมพันธ์</a></li>
            <li><a href="./contect.php" class="<?php echo $current_page == 'contect.php' ? 'active' : ''; ?>">เกี่ยวกับเรา</a></li>
            <li><a href="backend/dashboard.php" class="<?php echo $current_page == 'backend/dashboard.php' ? 'active' : ''; ?>">จัดการข้อมูล</a></li>
        </ul>
        <?php render_dropdown($profile_name); ?>
    <?php
} 

function member_menu($profile_name) {
    $current_page = basename($_SERVER['PHP_SELF']);
    ?>   
        <ul>
            <li><a href="index.php" class="<?php echo $current_page == 'index.php' ? 'active' : ''; ?>">หน้าหลัก</a></li>
            <li><a href="./room_product.php" class="<?php echo $current_page == 'room_product.php' ? 'active' : ''; ?>">ข้อมูลห้องพัก</a></li>
            <li><a href="./service_product.php" class="<?php echo $current_page == 'service_product.php' ? 'active' : ''; ?>">ข้อมูลบริการ</a></li>
            <li><a href="./premaket.php" class="<?php echo $current_page == 'premaket.php' ? 'active' : ''; ?>">ข่าวสารประชาสัมพันธ์</a></li>
            <li><a href="./contect.php" class="<?php echo $current_page == 'contect.php' ? 'active' : ''; ?>">เกี่ยวกับเรา</a></li>
        </ul>
        <?php render_dropdown($profile_name); ?>
    <?php
} 

function web_menu() {
    $current_page = basename($_SERVER['PHP_SELF']);
    ?>   
        <ul>
            <li><a href="index.php" class="<?php echo $current_page == 'index.php' ? 'active' : ''; ?>">หน้าหลัก</a></li>
            <li><a href="./room_product.php" class="<?php echo $current_page == 'room_product.php' ? 'active' : ''; ?>">ข้อมูลห้องพัก</a></li>
            <li><a href="./service_product.php" class="<?php echo $current_page == 'service_product.php' ? 'active' : ''; ?>">ข้อมูลบริการ</a></li>
            <li><a href="./premaket.php" class="<?php echo $current_page == 'premaket.php' ? 'active' : ''; ?>">ข่าวสารประชาสัมพันธ์</a></li>
            <li><a href="./contect.php" class="<?php echo $current_page == 'contect.php' ? 'active' : ''; ?>">เกี่ยวกับเรา</a></li>
        </ul>
        <a href="./login.php" class="btn btn-custom">เข้าสู่ระบบ</a>
    <?php
}
?>
