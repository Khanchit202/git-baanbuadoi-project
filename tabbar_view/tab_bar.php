<?php
session_start();
$current_page = basename($_SERVER['PHP_SELF']);
?>

<div class="topbar_menu">
    <div class="topbar_menu_logo">
        <a href="index.php"><img src="tabbar_view/baanbuadoi.png" alt="โฮมสเตย์บ้านบัวดอย Baanbuadoi"></a>
        <p>โฮมสเตย์บ้านบัวดอย</p>
    </div>
    <div class="topbar_menu_list">

        <?php include("menu_navbar.php"); 
            menu_navbar()
        ?>
        
    </div>
</div>






<script>
    function toggleDropdown() {
    const dropdown = document.querySelector('.dropdown');
    const menu = dropdown.querySelector('.dropdown-menu');
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
}

window.onclick = function(event) {
    if (!event.target.closest('.dropdown')) {
        const dropdowns = document.querySelectorAll('.dropdown-menu');
        dropdowns.forEach(menu => {
            if (menu.style.display === 'block') {
                menu.style.display = 'none';
            }
        });
    }
}

document.querySelectorAll('.dropdown-menu a').forEach(link => {
    link.addEventListener('mouseover', function() {
        this.style.backgroundColor = '#f0f0f0';
    });
    link.addEventListener('mouseout', function() {
        this.style.backgroundColor = '';
    });
});

</script>
