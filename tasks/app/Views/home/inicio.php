<?= $this->section('title') ?>
Inicio
<?= $this->endSection() ?>
<?= $this->extend('templates/base.sidenav.php') ?>


<?= $this->section("content"); ?>

<div class="container-fluid gris shadow">
    <h5 class="fw-bold text-center">Bienvenido
        <?= $usuario["nombres"] . " " . $usuario["apellidos"] ?>
    </h5>
    <div class="row">
        <div class="col-sm-5">
            <div class="card">
                <div class="card-title">Total de actividades</div>

                <div class="card-body">
                    <span class="material-icons rounded "">tasks</span>

                    Numero de Actividades:
                    <p class=" d-inline" id="totalActividades" name="totalActividades">0</p>
                        
                        <div class="container mt-3">
                            <a href="tareas" class="btn text-center">Ir a tareas</a>
                        </div>

                </div>
            </div>

        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-title">Total de actividades Retrasadas</div>
                <div class="card-body">
                    <span class="material-icons rounded  ">date_range</span>

                    Numero de Actividades Retrasadas:
                    <p class="d-inline" id="totalActividadesRetrasadas" name="totalActividadesRetrasadas">0</p>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url("assets/js/inicio/inicio.js") ?>"></script>
    <?= $this->endSection() ?>