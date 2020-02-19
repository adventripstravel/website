<?php defined('_EXEC') or die; ?>
<!-- Loader -->
<div id="preloader"><div id="status"><div class="spinner"></div></div></div>

<!-- Begin page -->
<div class="accountbg">
    <div class="content-center">
        <div class="content-desc-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-8">
                        <div class="card">
                            <div class="card-body">

                                <h3 class="text-center mt-0 m-b-15">
                                    <a href="index.html" class="logo logo-admin"><img src="{$path.root_uploads}icontype-white.png" height="50" alt="logo"></a>
                                </h3>

                                <h4 class="text-muted text-center font-18"><b>Iniciar sesión</b></h4>

                                <div class="p-2">
                                    <form id="login" class="form-horizontal m-t-20">
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <input name="username" class="form-control" type="email" placeholder="Correo electrónico">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-12">
                                                <input name="password" class="form-control" type="password" placeholder="Contraseña">
                                            </div>
                                        </div>

                                        <!-- <div class="form-group row">
                                            <div class="col-12">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                    <label class="custom-control-label" for="customCheck1">Recordarme</label>
                                                </div>
                                            </div>
                                        </div> -->

                                        <div class="form-group text-center row m-t-20">
                                            <div class="col-12">
                                                <button id="btn_login" class="btn btn-primary btn-block waves-effect waves-light" type="submit">Iniciar sesión</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
    </div>
</div>
