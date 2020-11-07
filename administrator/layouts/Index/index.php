<?php defined('_EXEC') or die; ?>
<main class="wrapper">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <ol class="breadcrumb hide-phone">
                        <li class="breadcrumb-item">
                            <a href="index.php">{$vkye_webpage}</a>
                        </li>
                        <li class="breadcrumb-item active">Inicio</li>
                    </ol>

                    <h4 class="page-title">Generales</h4>
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->

        <div class="row">
            <div class="col-12 m-b-20 d-print-none">
                <div class="button-items text-lg-right">
                    <?php if ( in_array('{reservations_create}', Session::get_value('session_permissions')) ) : ?>
                        <a href="index.php?c=reservations&m=create" class="btn btn-success waves-effect waves-light">Agregar reservación</a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
