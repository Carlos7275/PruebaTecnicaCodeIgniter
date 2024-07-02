<?= $this->section('title') ?>
Panel de tareas
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

        <select name="estatusFiltro" id="estatusFiltro">
            <option value="-1">Todos</option>
            <option value="N">Sin empezar</option>
            <option value="P">En proceso</option>
            <option value="C">Completado</option>
        </select>
        <label for="estatus">Estatus de la tarea</label>

    </div>
    <div class="form-group">
        <label for="fechaInicial">Fecha Inicial</label>
        <input type="date" name="fechaInicial" id="fechaInicial" class="form-control">
    </div>
    <div class="form-group">
        <label for="fechaFinal">Fecha Final</label>

        <input type="date" name="fechaFinal" id="fechaFinal" class="form-control">
    </div>
    <button class="btn btn-primary" onclick="actualizarDatos()"><span class="material-icons iconCenter">search</span>Filtrar</button>
    <div class="btn-group mt-7">
        <button type="button" id="btnAgregar" name="btnAgregar" class="btn blue"><span style="vertical-align: middle;" class="material-icons">add</span> Agregar Tareas</button>
    </div>

    <br>
    <table id="tareas" name="tareas" style="overflow-y: visible;" class="table w-100 striped bordered highlight responsive-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre de la tarea</th>
                <th>Descripcion</th>
                <th>Fecha entrega</th>
                <th>Prioridad</th>
                <th>Estado de la tarea</th>
                <th>Estatus</th>
                <th>Fecha de Creación</th>
                <th>Fecha de Actualización</th>
                <th>Acciones</th>
            </tr>
        </thead>
    </table>

</div>
<!-- Modal -->
<div class="modal fade " id="registroModal" name="registroModal" static="true" tabindex="-1" aria-labelledby="registroModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registroModalLabel">Crear Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmModal" name="frmModal">
                    <div class="input-field">
                        <input type="text" name="nombretarea" id="nombretarea" class="validate">
                        <label for="nombretarea">Nombre de la tarea</label>
                    </div>

                    <div class="input-field">
                        <textarea class="materialize-textarea" name="descripcion" id="descripcion"></textarea>
                        <label for="descripcion">Descripcion</label>
                    </div>
                    <label for="fechaentrega">Fecha de Entrega</label>

                    <input type="datetime-local" name="fechaentrega" id="fechaentrega">
                    <div class="input-field">
                        <select name="idprioridad" id="idprioridad">
                        </select>
                        <label for="idprioridad">Nivel de prioridad</label>

                    </div>
                    <div class="input-field">
                        <select name="estatus" id="estatus">
                            <option value="N">Sin empezar</option>
                            <option value="P">En proceso</option>
                            <option value="C">Completado</option>
                        </select>
                        <label for="estatus">Estatus de la tarea</label>

                    </div>
                    <div class="btn-group col s4">
                        <button type="submit" class="btn blue">Guardar Cambios</button>
                    </div>

            </div>

        </div>
        </form>
    </div>
</div>
</div>
</div>

<script src="<?= base_url("assets/js/tareas/tareas.js") ?>"></script>
<?= $this->endSection() ?>