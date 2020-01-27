<?php

defined('_EXEC') or die;

$this->dependencies->add(['js','{$path.js}Destinations/index.min.js']);

$this->dependencies->add(['css','{$path.plugins}datatables/css/jquery.dataTables.min.css']);
$this->dependencies->add(['css','{$path.plugins}datatables/css/dataTables.material.min.css']);
$this->dependencies->add(['css','{$path.plugins}datatables/css/responsive.dataTables.min.css']);
$this->dependencies->add(['css','{$path.plugins}datatables/css/buttons.dataTables.min.css']);
$this->dependencies->add(['js','{$path.plugins}datatables/js/jquery.dataTables.min.js']);
$this->dependencies->add(['js','{$path.plugins}datatables/js/dataTables.material.min.js']);
$this->dependencies->add(['js','{$path.plugins}datatables/js/dataTables.responsive.min.js']);
$this->dependencies->add(['js','{$path.plugins}datatables/js/dataTables.buttons.min.js']);
$this->dependencies->add(['js','{$path.plugins}datatables/js/vfs_fonts.js']);
$this->dependencies->add(['js','{$path.plugins}datatables/js/buttons.html5.min.js']);

?>

%{header}%
<section class="main-container">
    <div class="title">
        <h1>Destinos</h1>
    </div>
    <div class="buttons">
        <a class="btn btn-colored" data-button-modal="datas">Nuevo</a>
    </div>
    <div class="content">
        <table class="display" data-page-length="100">
            <thead>
                <tr>
                    <th width="40px"></th>
                    <th>Nombre</th>
                    <th width="60px"></th>
                </tr>
            </thead>
            <tbody>
                {$lst_datas}
            </tbody>
        </table>
    </div>
</section>
<section class="modal" data-modal="datas">
    <div class="content">
        <header>
            <h4>Nuevo</h4>
        </header>
        <main>
            <form name="datas" data-submit-action="new">
                <fieldset class="fields-group">
                    <p class="warning"><span class="required-field">*</span>Campos obligatorios</p>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="text">
                        <h6><span class="required-field">*</span>Nombre</h6>
                        <input type="text" name="name" autofocus>
                    </div>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="uploader" data-low-uploader>
                        <h6><span class="required-field">*</span>Imágen de portada</h6>
                        <figure data-preview>
                            <img src="{$path.images}empty.png">
                        </figure>
                        <a class="btn" data-select>Seleccionar imagen</a>
                        <input type="file" id="cover" name="cover" accept="image/*" data-select>
                    </div>
                </fieldset>
            </form>
        </main>
        <footer>
            <a class="btn btn-colored" button-success>Aceptar</a>
            <a class="btn" button-cancel>Cerrar</a>
        </footer>
    </div>
</section>
<section class="modal alert" data-modal="delete">
    <div class="content">
        <header>
            <h4>Eliminar</h4>
        </header>
        <main>
            <p>¿Esta seguro de realizar esta acción?</p>
        </main>
        <footer>
            <a class="btn btn-colored" button-success>Aceptar</a>
            <a class="btn" button-close>Cancelar</a>
        </footer>
    </div>
</section>