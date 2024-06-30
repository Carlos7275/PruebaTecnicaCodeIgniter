<?php
$usuario =  session("usuario");
?>

<link rel="stylesheet" href="<?= base_url("assets/css/dropdown.css") ?>">
<div class="split-button" data-aos="fade-left">

<img loading="true" src="<?= base_url() . $usuario["foto"] ?>" class="img-fluid rounded" width="100px" height="100px">
<button disabled><?= $usuario["nombres"] . " " . $usuario["apellidos"] ?></button>

    <button onclick="toggleDropdown()">
        <span id="chevron" class="material-icons prefix">
            expand_more

        </span>
    </button>
    <div id="menu" class="menu">

        <button onclick="configuracion()" onclick="disableDropdown()">
            <span class="material-icons"> build </span>
            Configuracion de Usuario
        </button>

        <button onclick="logout()" onclick="disableDropdown()">
            <span class="material-icons"> logout </span>
            Cerrar Sesion
        </button>

    </div>
</div>

<script src="<?= base_url("assets/js/dropdown/dropdown.js") ?>"></script>