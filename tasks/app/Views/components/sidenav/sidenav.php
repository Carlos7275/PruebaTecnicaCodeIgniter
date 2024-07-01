<?php
$usuario =  session("usuario");
?>
<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
<link href="<?php echo base_url('assets/css/sidenav.css') ?>" rel="stylesheet">


<div class="sidebar" data-aos="fade-up">
    <div class="logo-details">

        <div class="logo_name"> <img src="<?= base_url("/assets/imagenes/app/logo.png") ?>" width="50" style="border-radius: 50px;margin:10px" alt="">Tareas </div>
        <i class='bx bx-menu' id="btn"></i>
    </div>
    <ul class="nav-list">

        <li>
            <a href="/">
                <i class='bx bx-grid-alt'></i>
                <span class="links_name">Inicio</span>
            </a>
            <span class="tooltip">Inicio</span>
        </li>
        <?php if ($usuario["id_rol"] == 1) : ?>
            <li>
                <a href="/usuarios">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Usuarios</span>
                </a>
                <span class="tooltip">Administracion de Usuario</span>
            </li>
        <?php endif; ?>
        <li>
            <a href="/tareas">
                <i class='bx bx-task'></i>
                <span class="links_name">Tareas</span>
            </a>
            <span class="tooltip">Tareas</span>
        </li>

        <li class="profile">
            <?= include(APPPATH . "views/components/dropdown/dropdown.php") ?>
        </li>
    </ul>
</div>

<script src="<?= base_url("assets/js/sidenav/sidenav.js") ?>"></script>