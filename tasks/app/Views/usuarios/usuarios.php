<?= $this->section('title') ?>
Inicio
<?= $this->endSection() ?>
<?= $this->extend('templates/base.sidenav.php') ?>
<?= $this->section("content"); ?>
<link rel="stylesheet" href="<?=base_url("assets/css/usuarios.css")?>">

<div class="container w-100 shadow gris" data-aos="fade-up">
    <h4 class="fw-bold">Panel de usuarios</h4>
    <hr>
    <div class="btn-group mt-10">
        <button type="button" id="btnAgregar" name="btnAgregar" class="btn blue"><span  class="material-icons iconCenter">add</span> Usuarios</button>
    </div>
    <table id="usuarios" name="usuarios" class="table striped bordered highlight responsive-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Correo</th>
                <th>Foto</th>
                <th>Fecha de Nacimiento</th>
                <th>Género</th>
                <th>Rol</th>
                <th>Estatus</th>
                <th>Acciones</th>
            </tr>
        </thead>
    </table>
<br>
    <!-- Modal -->
    <div class="modal fade " id="registroModal" name="registroModal" static="true" tabindex="-1" aria-labelledby="registroModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registroModalLabel">Crear Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="frmModal">
                        <p>Datos personales del Usuario</p>
                        <hr>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="input-field ">
                                    <input type="text" class="validate" id="nombres" name="nombres" required>
                                    <label for="nombres">Nombres</label>
                                </div>

                                <div class="input-field ">
                                    <input type="text" id="apellidos" name="apellidos" required>
                                    <label for="apellidos">Apellidos</label>
                                </div>

                                <div class="input-field ">
                                    <select id="id_genero" name="id_genero" required>
                                    <option disabled selected value="-1">Seleccione un Genero</option>

                                    </select>
                                    <label for="id_genero">Genero</label>
                                </div>
                                <br>
                                <div class="input-field ">
                                    <input type="date" id="fechanacimiento" name="fechanacimiento" class="validate" required>
                                    <label for="fechanacimiento">Fecha de Nacimiento</label>
                                </div>
                                <p>Datos de la cuenta:</p>
                                <div class="input-field">
                                    <input type="email" id="email" name="email" class="validate" required>
                                    <label for="email">Correo</label>
                                </div>

                                <div class="input-field password-field">
                                    <input type="password" id="password" name="password" class="validate" required>
                                    <label for="Contraseña">Contraseña</label>
                                    <span id="passwordButton" name="passwordButton" class="material-icons prefix toggle-password border text-center rounded-4" style="cursor:pointer">
                                        visibility
                                    </span>
                                </div>

                                <div class="input-field password-field">
                                    <input type="password" id="passwordAux" name="passwordAux" class="validate" required>
                                    <label for="ContraseñaAux">Reingrese la Contraseña</label>
                                    <span id="passwordButtonAux" name="passwordButtonAux" class="material-icons prefix toggle-password border text-center rounded-4" style="cursor:pointer">
                                        visibility
                                    </span>
                                </div>

                                <div class="input-field">
                                    <select id="id_rol" name="id_rol" required>
                                    </select>
                                    <label for="id_rol">Rol</label>
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

</div>

<script src="<?= base_url("assets/js/usuarios/usuarios.js") ?>"></script>


<?= $this->endSection() ?>