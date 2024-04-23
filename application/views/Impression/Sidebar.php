<div class="sidebar">
        <div class="logo"><img src="<?= base_url()?>/tamplate/picture/LogoTAG.png" alt=""></div>
        <ul class="menu">
            <li>
                <a href="<?=base_url('Dashboard')?>">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?=base_url('Assigned')?>">
                    <i class="fas fa-solid fa-list"></i>
                    <span>Assigned Documents</span>
                </a>
            </li>
            <li>
                <a href="<?=base_url('Document')?>">
                    <i class="fas fa-regular fa-folder-open"></i>
                    <span>My Documents</span>
                </a>
            </li>
            <?php if ($this->session->userdata('statusUsers') == 2) { ?>
               <li>
                    <a href="<?=base_url('makeUsers')?>">
                        <i class="fa-solid fa-users"></i>
                        <span>Account Users</span>
                    </a>
                </li>
            <?php } ?> 
            <li class="logout">
                <a href="<?=base_url('Login/logout')?>">
                    <i class="fas fa-solid fa-right-from-bracket"></i>
                    <span>Logout</span>
                </a>
            </li>
            
        </ul>
    </div>

    <!-- Main-content -->

    <div class="main--content">
        <div class="header--wrapper">
            <div class="header--title">
                <span style="color: red;"><?= $divitionUnit ?> Division</span>
                <h3 style="margin-top : 12px; letter-spacing : 0.5px;"><?= $headerTamp ?></h3>
            </div>
            <div class="user-name">
                <?php if ($this->session->userdata('statusUsers') == 2) {
                    echo "Head Office  |";
                } ?> 
                <span>
                    <?= $userName ?>
                </span>
                <img src="<?=base_url()?>/tamplate/picture/hacker.png" alt="">
            </div>
        </div>