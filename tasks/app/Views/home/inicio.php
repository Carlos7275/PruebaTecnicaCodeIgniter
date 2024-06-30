<?= $this->section('title') ?>
Inicio
<?= $this->endSection() ?>
<?= $this->extend('templates/base.sidenav.php') ?>


<?= $this->section("content"); ?>



<h5 class="fw-bold text-center">Bienvenido
    <?= $usuario["nombres"] . " " . $usuario["apellidos"] ?>
</h5>

<div class="container header bg-gradient-primary pb-3 pt-3 pt-md-3">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row">
                <div class="col-xl-3 col-lg-3">
                    <div class="card card-stats mb-3 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <p class=" text-uppercase text-muted mb-0">Actividades Registradas</p>
                                    
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3">
                    <div class="card card-stats mb-3 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <p class=" text-uppercase text-muted mb-0">Actividades Retrasadas</p>
                                    
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

    <?= $this->endSection() ?>