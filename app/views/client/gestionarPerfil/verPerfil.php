<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodingDung | Profile Template</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container light-style flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">Gestión de Perfil</h4>
        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">Datos Personales</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password">Contraseña</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-info">Información</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-delete-account">Eliminar Cuenta</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-logout">Cerrar Sesión</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <form action="process_form.php" method="post" enctype="multipart/form-data">
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="account-general">
                                <div class="card-body media align-items-center">
                                    <img src="icon/Profile-user.png" alt="profile-picture" class="d-block ui-w-80">
                                    <div class="media-body ml-4">
                                        <label class="btn btn-outline-primary">
                                            Nueva Foto
                                            <input type="file" name="foto_perfil" class="account-settings-fileinput">
                                        </label> &nbsp;
                                        <button type="button" class="btn btn-default md-btn-flat">Anterior</button>
                                    </div>
                                </div>
                                <hr class="border-light m-0">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">Usuario</label>
                                        <input type="text" name="usuario" class="form-control mb-1" placeholder="Usuario" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Nombre</label>
                                        <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Correo</label>
                                        <input type="email" name="correo" class="form-control mb-1" placeholder="Correo@mail.com" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Compañía</label>
                                        <input type="text" name="compania" class="form-control" placeholder="Compañía.">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="account-change-password">
                                <div class="card-body pb-2">
                                    <div class="form-group">
                                        <label class="form-label">Contraseña actual</label>
                                        <input type="password" name="password_actual" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Nueva contraseña</label>
                                        <input type="password" name="password_nueva" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Repita la nueva contraseña</label>
                                        <input type="password" name="password_nueva_repetir" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="account-info">
                                <div class="card-body pb-2">
                                    <div class="form-group">
                                        <label class="form-label">Fecha de Nacimiento</label>
                                        <input type="date" name="fecha_nacimiento" class="form-control">
                                    </div>
                                    <div class="input-container-sexo">
                                        <label>Sexo</label>
                                        <div>
                                            <input type="radio" id="hombre" name="sexo" value="hombre">
                                            <label for="hombre">Hombre</label>
                                        </div>
                                        <div>
                                            <input type="radio" id="mujer" name="sexo" value="mujer">
                                            <label for="mujer">Mujer</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">País</label>
                                        <select name="pais" class="custom-select">
                                            <option>Italia</option>
                                            <option selected>Canada</option>
                                            <option>USA</option>
                                            <option>Colombia</option>
                                            <option>Francia</option>
                                            <option>México</option>
                                        </select>
                                    </div>
                                </div>
                                <hr class="border-light m-0">
                                <div class="card-body pb-2">
                                    <h6 class="mb-4">Contacto</h6>
                                    <div class="form-group">
                                        <label class="form-label">Teléfono</label>
                                        <input type="text" name="telefono" class="form-control" placeholder="+0 (123) 456 7891">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="account-delete-account">
                                <button type="button" class="btn btn-primary">Eliminar</button>&nbsp;
                                <button type="button" class="btn btn-default">Cancelar</button>    
                            </div>
                            <div class="tab-pane fade" id="account-logout">
                                <button type="button" class="btn btn-primary">Salir</button>&nbsp;
                                <button type="button" class="btn btn-default">Cancelar</button>
                            </div>
                        </div>
                        <div class="text-right mt-3">
                            <button type="submit" class="btn btn-primary">Guardar</button>&nbsp;
                            <button type="reset" class="btn btn-default">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>