<div  class="container-fluid" >
<div class="container mt-1 mb-1 d-flex justify-content-center">
  <div class="card" style="width: 50%;">
    <div class="card-header text-center">
      <!-- titulo del formulario-->
      <h2>Registrar usuario</h2>
    </div>
            <!-- envio de datos a la ruta /enviar-form -->
    <div>
      <!--recuperamos datos con la función Flashdata para mostrarlos-->
    <?php if (session()->getFlashdata('success')) {
          echo "
          <div class='mt-3 mb-3 ms-3 me-3 h4 text-center alert alert-success alert-dismissible'>
          <button type='button' class='btn-close' data-bs-dismiss='alert'></button>" . session()->getFlashdata('success') . "
      </div>";
        } ?>
    </div>
    <?php $validation = \Config\Services::validation(); ?>
        <form method="post" action="<?php echo base_url('/enviar-form') ?>">
      <div class="card-body">
        <div class="mb-2">
          <label for="nombre" class="form-label">Nombre</label>
          <!-- ingreso sel nombre-->
          <input name="nombre" type="text" class="form-control" placeholder="Nombre">
          <!-- Error -->
          <?php if ($validation->getError('nombre')) { ?>
            <div class='alert alert-danger mt-2'>
              <?= $error = $validation->getError('nombre'); ?>
            </div>
          <?php } ?>
        </div>
        <div class="mb-3">
          <label for="apellido" class="form-label">Apellido</label>
          <input type="text" name="apellido" class="form-control"  placeholder="Apellido">
          <!-- Error -->
          <?php if ($validation->getError('apellido')) { ?>
            <div class='alert alert-danger mt-2'>
              <?= $error = $validation->getError('apellido'); ?>
            </div>
          <?php } ?>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Correo Electrónico</label>
          <input name="email" type="email" class="form-control"  placeholder="correo@algo.com">
          <!-- Error -->
          <?php if ($validation->getError('email')) { ?>
            <div class='alert alert-danger mt-2'>
              <?= $error = $validation->getError('email'); ?>
            </div>
          <?php } ?>
        </div>
        <div class="mb-3">
          <label for="usuario" class="form-label">Usuario</label>
          <input type="text" name="usuario"  class="form-control" placeholder="Usuario">
          <!-- Error -->
          <?php if ($validation->getError('usuario')) { ?>
            <div class='alert alert-danger mt-2'>
              <?= $error = $validation->getError('usuario'); ?>
            </div>
          <?php } ?>
        </div>

        <div class="mb-3">
          <label for="pass" class="form-label">Contraseña</label>
          <input name="pass" type="password" class="form-control" placeholder="Contraseña (mínimo 3 caracteres)">
          <!-- Error -->
          <?php if ($validation->getError('pass')) { ?>
            <div class='alert alert-danger mt-2'>
              <?= $error = $validation->getError('pass'); ?>
            </div>
          <?php } ?>
        </div>
        <input type="submit" value="Guardar" class="btn btn-success">
         <input type="reset" value="cancelar" class="btn btn-danger">
      </div>
       <p>   ¿Ya tienes cuenta? <a href="<?php echo base_url('login'); ?>">  Iniciar Sesión</a></p>
    </form>
  </div>
</div>
</div>
