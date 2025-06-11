<?php include 'config/koneksi.php';
$queryMainMenu = mysqli_query($config, "SELECT * FROM menus WHERE parent_id = 0 OR parent_id=''");
$MainMenus = mysqli_fetch_all($queryMainMenu, MYSQLI_ASSOC);
// var_dump($MainMenus);
?>

<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <!-- End Dashboard Nav -->

        <?php foreach ($MainMenus as $mainMenu): ?>

            <?php
            $id_menu = $mainMenu['id'];
            $querySubMenu = mysqli_query($config, "SELECT * FROM menus WHERE parent_id ='$id_menu' ORDER BY urutan ASC");
            // print_r($querySubMenu);
            // die;
            // print_r($mainMenu['name']);
            // die;
            ?>
            <?php if (mysqli_num_rows($querySubMenu) > 0): ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#menu-<?php echo $mainMenu['id'] ?>" data-bs-toggle="collapse" href="#">
                        <i class="<?php echo $mainMenu['icon'] ?>"></i><span><?php echo $mainMenu['name'] ?></span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="menu-<?php echo $mainMenu['id'] ?>" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                        <?php while ($rowSubMenu = mysqli_fetch_assoc($querySubMenu)): ?>
                            <li>
                                <a href="?page=<?php echo $rowSubMenu['url'] ?>">
                                    <i class="<?php echo $rowSubMenu['icon'] ?>"></i><span><?php echo $rowSubMenu['name'] ?></span>
                                </a>
                            </li>
                        <?php endwhile ?>
                    </ul>
                </li><!-- End Components Nav -->
            <?php elseif (!empty($mainMenu['url'])): ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="home.php">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

            <?php endif ?>
        <?php endforeach ?>


        <li class="nav-heading">Transaction</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="?page=moduls">
                <i class="bi bi-book"></i>
                <span>Moduls</span>
            </a>
        </li><!-- End Profile Page Nav -->
    </ul>
</aside>