<?= $this->section('title') ?>
Iniciar Sesion
<?= $this->endSection() ?>
<?= $this->extend('templates/base.php') ?>
<?= $this->section("content"); ?>

<div class="container w-50 mt-5 rounded-4 shadow">
    <div class="row gx-5 align-items-stretch">
        <div class="col bg-white p-5 rounded-end">
            <h4 class="fw-bold text-center py-5">Iniciar Sesion</h4>
            <form id="frmLogin">
                <div class="input-field transparent-input">
                    <label for="email">Ingrese su Correo</label>
                    <input type="email" class="validate " autocomplete="off" id="email" name="email">
                </div>

                <div class="input-field password-container transparent-input">
                    <label for="password">Ingrese su contraseña</label>
                    <input type="password" class="validate" autocomplete="off" id="password" name="password">
                    <span class="material-icons prefix toggle-password border text-center rounded-4" style="cursor:pointer">
                        visibility
                    </span>
                </div>
                <div class="mb-4">
                    <a href="/registro">¿No Tiene Cuenta? Registrarse</a>

                </div>
                <div class="btn-group">

                    <button class="btn waves-effect waves-light" id="login_button" type="submit">Iniciar Sesión</button>
                </div>
            </form>
        </div>
        <div class="col d-none d-lg-block col-md-5 col-xl-7  rounded">
            <img src="<?= base_url('assets/imagenes/app/tasks.png'); ?>" loading="true" class="img-responsive w-100 mx-auto d-block h-300" alt="Imagen de Tienda">
        </div>
    </div>

</div>


<?= $this->endSection() ?>