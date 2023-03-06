<div class="sidebar">
        <!-- logo -->
        <a href="#" class="logo-box" style='padding-left: 30px;'>
            <!-- <i class="bx bxl-xing"></i> -->
            <div class="logo-name">Estam University</div>
            <!-- logo -->
        </a>

        <!-- list -->
        <ul class="sidebar-list">
            <?php
                if($_SESSION['level'] == 'SUA'){
                    include('levels/superadmin.php');
                }else if($_SESSION['level'] == 'SA'){
                    include('levels/studentadmin.php');
                }else if($_SESSION['level'] == 'PA'){
                    include('levels/paymentadmin.php');
                }else if($_SESSION['level'] == 'RA'){
                    include('levels/resultadmin.php');
                }else{
                    include('level/member.php');
                }
            ?>
            <li>
                <div class="title">
                    <a href="/estamuniversity/logout.php" class="link">
                        <i class="bx bx-grid-alt"></i>
                        <span class="name">Logout</span>
                    </a>
                    <!-- <i class="bx bxs-chevron-down"></i> -->
                </div>
                <div class="submenu">
                    <a href="/estamuniversity/logout.php" class="link submenu-title">Logout</a>
                </div>
            </li>
        </ul>
    </div>