<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<div class="topbar_menu">
    <div class="topbar_menu_logo">
        <a href="index.php"><img src="tabbar_view/baanbuadoi.png" alt="โฮมสเตย์บ้านบัวดอย Baanbuadoi"></a>
        <p>โฮมสเตย์บ้านบัวดอย</p>
    </div>
    <div class="topbar_menu_list">
        <ul>
            <li>
                <a href="index.php" class="<?php echo $current_page == 'index.php' ? 'active' : ''; ?>">หน้าหลัก</a>
            </li>
            <li>
                <a href="room_info.php" class="<?php echo $current_page == 'room_info.php' ? 'active' : ''; ?>">ข้อมูลห้องพัก</a>
            </li>
            <li>
                <a href="services.php" class="<?php echo $current_page == 'services.php' ? 'active' : ''; ?>">ข้อมูลบริการ</a>
            </li>
            <li>
                <a href="news.php" class="<?php echo $current_page == 'news.php' ? 'active' : ''; ?>">ข่าวสารประชาสัมพันธ์</a>
            </li>
            <li>
                <a href="./contect.php" class="<?php echo $current_page == 'contect.php' ? 'active' : ''; ?>">เกี่ยวกับเรา</a>
            </li>
        </ul>
        <a href=""><div class="btn btn-custom">เข้าสู่ระบบ</div></a>
    </div>
</div>
