<?= $this->section('title') ?>
Registrarse
<?= $this->endSection() ?>
<?= $this->extend('templates/base.php') ?>
<?= $this->section("content"); ?>

<div class="container w-75 mt-3 rounded-4 shadow  gris">
    <div class="row gx-5 align-items-stretch">
        <div class="col bg-white rounded-end">
            <a href="/login" style="color:black" ><span class="material-icons" style="vertical-align: middle;">keyboard_backspace</span></a>
            <h5 class="fw-bold text-center">Registrarse</h5>

            <form id="frmRegistro">
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
                        <div class="input-field ">
                            <input type="email" id="email" name="email" class="validate" required>
                            <label for="email">Correo</label>
                        </div>

                        <div class="input-field ">
                            <input type="password" id="password" name="password" class="validate" required>
                            <label for="Contraseña">Contraseña</label>
                            <span id="passwordButton" name="passwordButton" class="material-icons prefix toggle-password border text-center rounded-4" style="cursor:pointer">
                                visibility
                            </span>
                        </div>

                        <div class="input-field">
                            <input type="password" id="passwordAux" name="passwordAux" class="validate" required>
                            <label for="ContraseñaAux">Reingrese la Contraseña</label>
                            <span id="passwordButtonAux" name="passwordButtonAux" class="material-icons prefix toggle-password border text-center rounded-4" style="cursor:pointer">
                                visibility
                            </span>
                        </div>

                        <div class="btn-group col s4">
                            <button type="submit" class="btn blue">Registrarse</button>
                        </div>

                    </div>

                </div>


            </form>
        </div>
        <div class="d-none d-lg-block col-md-5 col-xl-7 mt-5 rounded">
            <img src="<?= base_url('assets/imagenes/app/registro.jpg'); ?>" loading="true" class="img-responsive w-100 mx-auto d-block" alt="Imagen de Tienda">
        </div>
    </div>

</div>

</div>
<script type="text/javascript" src="<?= base_url("assets/js/registro/registro.js") ?>"></script>

<?= $this->endSection() ?>