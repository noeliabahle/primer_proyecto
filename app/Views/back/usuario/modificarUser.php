<div class="container-fluid justify-content-center page-container">
    <div>
        <!-- Recuperamos datos con la función Flashdata para mostrarlos -->
        <?php if (session()->getFlashdata('success')) {
            echo "
            <div class='mt-3 mb-3 ms-3 me-3 h4 text-center alert alert-success alert-dismissible'>
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>" . session()->getFlashdata('success') . "
        </div>";
        } ?>
    </div>
    
    <!-- Validación -->
    <?php $validation = \Config\Services::validation(); ?>

    <a class="btn btn-primary" href="<?php echo base_url('/crud_usuarios') ?>">
        <h5>Volver</h5>
    </a>

    <div class="container-fluid mt-1 mb-1 d-flex justify-content-center">
        <div class="col-md-7 col-lg-8">

            <h4 class="mb-3">Editar usuario</h4>
            <!-- Envío de datos a la ruta -->
            <form method="post" action="<?php echo base_url('/editar_usuario/' . $usuario['id']); ?>">

                <div class="row g-3 p-4">
                    <div class="col-sm-6">
                        <label for="nombre" class="form-label">Nombre</label>
                        <!-- Ingreso del nombre -->
                        <input name="nombre" type="text" class="form-control" value="<?php echo $usuario['nombre']?>" placeholder="Nombre...">
                        <!-- Error -->
                        <?php if ($validation->getError('nombre')) { ?>
                            <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('nombre'); ?>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="col-sm-6">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" name="apellido" class="form-control" value="<?php echo $usuario['apellido']?>" placeholder="Apellido...">
                        <!-- Error -->
                        <?php if ($validation->getError('apellido')) { ?>
                            <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('apellido'); ?>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="col-sm-6">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input name="email" type="email" class="form-control" value="<?php echo $usuario['email'] ?>" placeholder="correo@ejemplo.com">
                        <!-- Error -->
                        <?php if ($validation->getError('email')) { ?>
                            <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('email'); ?>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="col-sm-6">
                        <label for="usuario" class="form-label">Nombre de usuario</label>
                        <input type="text" name="usuario" value="<?php echo $usuario['usuario'] ?>" class="form-control" placeholder="Nombre de usuario">
                        <!-- Error -->
                        <?php if ($validation->getError('usuario')) { ?>
                            <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('usuario'); ?>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="col-md-6">
                        <label for="cod_tipo_usuario" class="form-label">Tipo de usuario</label>
                        <select required name="cod_tipo_usuario" class="form-select">
                            <option value="">Elegir...</option>
                            <?php foreach ($perfiles as $perfil) : ?>
                                <?php if ($perfil['perfil_eliminado'] == "NO") : ?>
                                    <option value="<?= $perfil['id'] ?>">
                                        <?= $perfil['id'] ?>-
                                        <?= $perfil['descripcion'] ?>
                                    </option>
                                <?php endif ?>
                            <?php endforeach ?>
                        </select>
                        <!-- Error -->
                        <?php if ($validation->getError('cod_tipo_usuario')) { ?>
                            <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('cod_tipo_usuario'); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="text-center">
                    <button class="btn btn-danger btn-sm" type="reset">Cancelar</button>
                    <button class="btn btn-primary btn-sm" type="submit">Guardar</button>
                </div>

            </form>
        </div>
    </div>
</div>
