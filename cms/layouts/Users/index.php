<?php

defined('_EXEC') or die;

/**
* @package valkyrie.cms.layouts.users
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since August 01 - 18, 2018 <@create>
* @version 1.0.0
* @summary cm-valkyrie-platform-website-template
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since December 01 - 15, 2018 <@update>
* @version 1.1.0
* @summary cm-valkyrie-platform-website-template
*
* @copyright Copyright (C) Code Monkey <legal@codemonkey.com.mx, wwww.codemonkey.com.mx>. All rights reserved.
*/

$this->dependencies->add(['css', '{$path.plugins}datatables/css/jquery.dataTables.min.css']);
$this->dependencies->add(['css', '{$path.plugins}datatables/css/dataTables.material.min.css']);
$this->dependencies->add(['css', '{$path.plugins}datatables/css/responsive.dataTables.min.css']);
$this->dependencies->add(['css', '{$path.plugins}datatables/css/buttons.dataTables.min.css']);
$this->dependencies->add(['js', '{$path.plugins}datatables/js/jquery.dataTables.min.js']);
$this->dependencies->add(['js', '{$path.plugins}datatables/js/dataTables.material.min.js']);
$this->dependencies->add(['js', '{$path.plugins}datatables/js/dataTables.responsive.min.js']);
$this->dependencies->add(['js', '{$path.plugins}datatables/js/dataTables.buttons.min.js']);
$this->dependencies->add(['js', '{$path.plugins}datatables/js/vfs_fonts.js']);
$this->dependencies->add(['js', '{$path.plugins}datatables/js/buttons.html5.min.js']);
$this->dependencies->add(['js', '{$path.js}Users/index.min.js']);

?>

%{header}%
<section class="main-container">
    <div class="title">
        <h1>Usuarios</h1>
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
                    <th>Correo electrónico</th>
                    <th width="100px">Teléfono</th>
                    <th width="100px">Token</th>
                    <th width="100px">N. de usuario</th>
                    <th width="100px">Estado</th>
                    <th width="90px"></th>
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
                        <input type="text" name="name">
                    </div>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="text">
                        <h6><span class="required-field">*</span>Correo electrónico</h6>
                        <input type="email" name="email">
                    </div>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="text">
                        <h6>Teléfono</h6>
                        <input type="text" name="phone">
                    </div>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="uploader" data-low-uploader>
                        <h6>Avatar</h6>
                        <figure data-preview>
                            <img src="{$path.images}empty.png">
                        </figure>
                        <a class="btn" data-select>Seleccionar imagen</a>
                        <input type="file" id="avatar" name="avatar" accept="image/*" data-select>
                    </div>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="text">
                        <h6><span class="required-field">*</span>Nivel de usuario</h6>
                        <select name="user_level">
                            {$lst_users_levels}
                        </select>
                    </div>
                </fieldset>
                <fieldset class="fields-group row">
                    <div class="text span6">
                        <h6><span class="required-field">*</span>Usuario</h6>
                        <input type="text" name="username" disabled>
                    </div>
                    <div class="text span6">
                        <h6><span class="required-field">*</span>Contraseña</h6>
                        <input type="password" name="password">
                    </div>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="text">
                        <h6>Token</h6>
                        <input type="text" name="token" value="<?php echo Functions::get_random(6); ?>" disabled>
                    </div>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="text">
                        <h6>Fecha de registro</h6>
                        <input type="text" name="register_date" value="<?php echo Functions::get_date(); ?>" disabled>
                    </div>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="text">
                        <h6><span class="required-field">*</span>Estado</h6>
                        <select name="status">
                            <option value="1">Activado</option>
                            <option value="0">Desactivado</option>
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
