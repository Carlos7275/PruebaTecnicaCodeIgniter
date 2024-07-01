<?= $this->section('title') ?>
Inicio
<?= $this->endSection() ?>
<?= $this->extend('templates/base.sidenav.php') ?>


<?= $this->section("content"); ?>

<div class="container w-100 shadow gris" data-aos="fade-up">
    <h4 class="fw-bold">Panel de Tareas</h4>
    <p>Filtros</p>
    <div class="input-field">

        <select name="prioridad" id="prioridad">
            <option value="-1">Todos</option>
        </select>
        <label for="prioridad">Nivel de prioridad</label>

    </div>
    <div class="input-field">

        <select name="prioridad" id="prioridad">
            <option value="-1">Todos</option>
        </select>
        <label for="prioridad">Estatus de la tarea</label>

    </div>
    <div class="form-group">
        <label for="fechaInicial">Fecha Inicial</label>
        <input type="date" name="fechaInicial" id="fechaInicial" class="form-control">
    </div>
    <div class="form-group">
        <label for="fechaFinal">Fecha Final</label>

        <input type="date" name="fechaFinal" id="fechaFinal" class="form-control">
    </div>
    <button class="btn btn-primary" onclick="actualizarTabla()"><span class="material-icons iconCenter">search</span>Filtrar</button>
    <div class="btn-group mt-7">
        <button type="button" id="btnAgregar" name="btnAgregar" class="btn blue"><span style="vertical-align: middle;" class="material-icons">add</span> Agregar Tareas</button>
    </div>

    <br>
    <table id="tareas" name="tareas" class="table striped bordered highlight responsive-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre de la tarea</th>
                <th>Descripcion</th>
                <th>Fecha entrega</th>
                <th>Prioridad</th>
                <th>Estado de la tarea</th>
                <th>Estatus</th>
                <th>Fecha de Creacion</th>
                <th>Acciones</th>
            </tr>
        </thead>
    </table>

</div>
<script src="<?= base_url("assets/js/tareas/tareas.js") ?>"></script>
<?= $this->endSection() ?>