<?php

defined('_EXEC') or die;

$this->dependencies->add(['js','{$path.js}Tours/index.js']);

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
        <h1>Tours</h1>
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
                    <th width="160px">Precio</th>
                    <th width="180px">Descuento</th>
                    <th>Destino</th>
                    <th width="100px">Proveedor</th>
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
                        <h6><span class="required-field">*</span>Nombre (Español)</h6>
                        <input type="text" name="name_es" autofocus>
                    </div>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="text">
                        <h6><span class="required-field">*</span>Nombre (Ingles)</h6>
                        <input type="text" name="name_en">
                    </div>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="text">
                        <h6><span class="required-field">*</span>Descripción (Español)</h6>
                        <textarea name="description_es"></textarea>
                    </div>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="text">
                        <h6><span class="required-field">*</span>Descripción (Ingles)</h6>
                        <textarea name="description_en"></textarea>
                    </div>
                </fieldset>
                <fieldset class="fields-group row">
                    <div class="text span6">
                        <h6><span class="required-field">*</span>Costo (Adultos)</h6>
                        <input type="number" name="cost_adults" min="1">
                        <p class="caption">Moneda en USD</p>
                    </div>
                    <div class="text span6">
                        <h6><span class="required-field">*</span>Costo (Niños)</h6>
                        <input type="number" name="cost_children" min="1">
                        <p class="caption">Moneda en USD</p>
                    </div>
                </fieldset>
                <fieldset class="fields-group row">
                    <div class="text span6">
                        <h6><span class="required-field">*</span>Precio (Adultos)</h6>
                        <input type="number" name="price_adults" min="1">
                        <p class="caption">Moneda en USD</p>
                    </div>
                    <div class="text span6">
                        <h6><span class="required-field">*</span>Precio (Niños)</h6>
                        <input type="number" name="price_children" min="1">
                        <p class="caption">Moneda en USD</p>
                    </div>
                </fieldset>
                <fieldset class="fields-group row">
                    <div class="text span6">
                        <h6>Descuento (Monto)</h6>
                        <input type="number" name="discount_amount" min="1" disabled>
                    </div>
                    <div class="text span6">
                        <h6>Descuento (Tipo)</h6>
                        <select name="discount_type">
                            <option value="">Sin descuento</option>
                            <option value="%">% (Porcentaje)</option>
                            <option value="$">$ (Monto fijo)</option>
                        </select>
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
                <fieldset class="fields-group">
                    <div class="text">
                        <h6>Disponibilidad diaria</h6>
                        <input type="number" name="availability" min="1">
                    </div>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="text">
                        <h6><span class="required-field">*</span>Destino</h6>
                        <select name="destination">
                            {$lst_destinations}
                        </select>
                    </div>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="text">
                        <h6><span class="required-field">*</span>Proveedor</h6>
                        <select name="provider">
                            {$lst_providers}
                        </select>
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
<section class="modal size-big" data-modal="gallery">
    <div class="content">
        <header>
            <h4>Galería</h4>
        </header>
        <main>
            <!-- <fieldset class="fields-group">
                <div class="uploader" data-multiple-uploader="add">
                    <a data-select><i class="material-icons">add_box</i></a>
                    <input type="file" id="gallery" name="gallery" accept="image/*" multiple data-select>
                </div>
            </fieldset> -->
        </main>
        <footer>
            <a class="btn" button-close>Cerrar</a>
        </footer>
    </div>
</section>
