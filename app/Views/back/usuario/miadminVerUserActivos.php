<br>
<h1 class="text-center">Usuarios ACTIVOS</h1>
    <!-- BOTONES -->
    <div class="col-12 text-center p-2">
    <button class="w-100 btn btn-primary btn-sm mb-2" onclick="location.href='<?php echo base_url('create_user'); ?>'">CREAR USUARIO</button>
    <button class="w-100 btn btn-primary btn-sm" onclick="location.href='<?php echo base_url('userInactivo'); ?>'">Ver Usuarios Inactivos</button>
   </div>
    <!-- FIN DE BOTONES -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <!-- div que contiene a la lista de usuarios -->
        <div class="col-md-12 col-lg-10">
            <!-- LISTA DE USUARIOS ACTIVOS -->
            <div class="card">
                <div class="card-header" style="background-color: darkgreen; color: white;">
                    USUARIOS ACTIVOS
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-info">
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Email</th>
                                <th>Usuario</th>
                                <th>Perfil</th>
                                <th>Baja</th>
                                <th>Editar</th>
                                <th>Inactivar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($user_data as $key => $user) : ?>
                                <?php if ($user['baja'] == 'NO') : ?>
                                    <tr>
                                        <td><?= $user["id"] ?></td>
                                        <td><?= $user["nombre"] ?></td>
                                        <td><?= $user["apellido"] ?></td>
                                        <td><?= $user["email"] ?></td>
                                        <td><?= $user["usuario"] ?></td>
                                        <td><?= $user["perfil_id"] ?></td>
                                        <td><?= $user["baja"] ?></td>
                                        <td>
                                            <a href="<?php echo base_url('editar-usuario/' . $user["id"]) ?>" class="btn btn-sm">
                                                <img src="assets/img/edit.svg" alt="Editar">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url('activado-usuario/' . $user["id"]) ?>" class="btn btn-sm">
                                                <img src="assets/img/bx-user-minus.svg" alt="Inactivar">
                                            </a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- FIN DE LISTA DE USUARIOS ACTIVOS -->
        </div>
        <!-- FIN DE div que contiene al botón y a la lista de usuarios -->
    </div>
</div>