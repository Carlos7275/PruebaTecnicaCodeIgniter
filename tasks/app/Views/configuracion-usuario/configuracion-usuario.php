<?= $this->section('title') ?>
Configuración del Usuario
<?= $this->endSection() ?>
<?= $this->extend('templates/base.sidenav.php') ?>


<?= $this->section("content"); ?>
<?php
$usuario = session("usuario");
?>
<link rel="stylesheet" href="<?= base_url('assets/css/configuracion-usuario.css') ?>">

<div class="container p-0 shadow">
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0 fw-bold">Configuración del Usuario</h5>
            </div>
            <div class="card-body">
                <form name="frmConfiguracion" id="frmConfiguracion">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="input-field ">
                                <label>Correo:</label>
                                <input name="email" id="email" type="email" class="validate" value="<?= $usuario["email"] ?>">
                                <span class="material-icons prefix">email</span>
                            </div>
                            <h6>Datos Personales</h6>

                            <div class="input-field col-sm-4">
                                <label for="nombres">Nombres</label>
                                <input type="text" name="nombres" id="nombres" value="<?= $usuario["nombres"] ?>" />
                            </div>

                            <div class="input-field ">
                                <label for="apellidos">Apellidos</label>
                                <input type="text" name="apellidos" id="apellidos" value="<?= $usuario["apellidos"] ?>" />
                            </div>

                            <div class="input-field ">
                                <select name="id_genero" id="id_genero">
                                    <?php foreach ($generos as $genero) : ?>
                                        <option value="<?= $genero['id'] ?>"><?= trim($genero['descripcion']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="input-field">
                                <label for="fechanacimiento">Fecha de Nacimiento</label>
                                <input type="date" name="fechanacimiento" id="fechanacimiento" value="<?= $usuario["fechanacimiento"] ?>" />

                            </div>


                        </div>

                        <div class="col-md-2 col-xl-4">
                            <div class="text-center">
                                <img loading="lazy" name="fotoUsuario" id="fotoUsuario" src="<?= base_url() . $usuario["foto"] ?>" accept="image/*" alt="Imagen del usuario" class="rounded-circle img-responsive mt-2" style="width: 200px; height: 200px; object-fit: cover;">
                                <div class="mt-3">
                                    <input #file id="seleccionArchivos" type="file" accept="image/*" onchange="preview(this.files)" >
                                </div>
                                <br>
                                <span class="error mb-4" id="errorArchivo" name="errorArchivo"></span>


                            </div>
                        </div>
                    </div>

                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary blue">Guardar</button>
                    </div>
            </div>

            </form>
        </div>
    </div>
</div>


</div>
<script>
    var idUsuario = "<?= $usuario["id"] ?>"
</script>
<script src="<?= base_url('assets/js/configuracion-usuario/configuracion-usuario.js') ?>"></script>

<?= $this->endSection() ?>