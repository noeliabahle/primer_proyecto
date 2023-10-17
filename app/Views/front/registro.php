<div  class="container-fluid" >
<div class="container mt-1 mb-1 d-flex justify-content-center">
  <div class="card" style="width: 50%;">
    <div class="card-header text-center">
      <!-- titulo del formulario-->
      <h2>Registrar usuario</h2>
    </div>

    <!-- envio de datos a la ruta /enviar-form -->
     <?php $validation = \Config\Services::validation();?>      
    <form method="post" action="<?php echo base_url('/enviar-form') ?>">
        <?=csrf_field();?>
        <?=csrf_field();?>
        <?php if(!empty (session()->getFlashdata('fail'))):?>
        <div class="alert alert-danger"><?=session()->getFlashdata('fail');?></div>
        <?php endif?>
          <?php if(!empty (session()->getFlashData('success'))):?>
          <div class="alert alert-danger"><?=session()->getFlashData('success');?></div>
        <?php endif?>
            <!--termino de codigo a la ruta-->


      <div class="card-body" media="(max-width:768px)">
        <div class="mb-2">
          <label for="nombre" class="form-label">Nombre</label>
          <input name="nombre" type="text" class="form-control" placeholder="Nombre">
          <!--error-->
          <?php if($validation->getError('nombre')) {?>
            <div class='alert alert-danger mt-2'>
              <?= $error = $validation->getError('nombre');?>
            </div>
          <?php }?>
          <!--error-->
        </div>
        <div class="mb-3">
          <label for="apellido" class="form-label">Apellido</label>
          <input type="text" name="apellido" class="form-control"  placeholder="Apellido">
           <!--error-->
          <?php if($validation->getError('apellido')) {?>
            <div class='alert alert-danger mt-2'>
              <?= $error = $validation->getError('apellido');?>
            </div>
          <?php }?>
          <!--error-->
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Correo Electrónico</label>
          <input name="email" type="email" class="form-control"  placeholder="nombre@ejemplo.com">
           <!--error-->
          <?php if($validation->getError('email')) {?>
            <div class='alert alert-danger mt-2'>
              <?= $error = $validation->getError('email');?>
            </div>
          <?php }?>
          <!--error-->
        </div>
        <div class="mb-3">
          <label for="usuario" class="form-label">Usuario</label>
          <input type="text" name="usuario"  class="form-control" placeholder="Usuario">
           <!--error-->
          <?php if($validation->getError('usuario')) {?>
            <div class='alert alert-danger mt-2'>
              <?= $error = $validation->getError('usuario');?>
            </div>
          <?php }?>
          <!--error-->
        </div>
        <div class="mb-3">
          <label for="pass" class="form-label">Contraseña</label>
          <input name="pass" type="password" class="form-control" placeholder="Contraseña (mínimo 4 carácteres)">
           <!--error-->
          <?php if($validation->getError('pass')) {?>
            <div class='alert alert-danger mt-2'>
              <?= $error = $validation->getError('pass');?>
            </div>
          <?php }?>
          <!--error-->
        </div>
        <input type="submit" value="Guardar" class="btn btn-success">
        <input type="reset" value="cancelar" class="btn btn-danger">
      </div>
    </form>
  </div>
</div>
</div>