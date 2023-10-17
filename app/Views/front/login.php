<div class="container mt-5 mb-5 d-flex justify-content-center" >
  <div class="card" style="width:50%">
    <div class="card-header text-center">
    
       <div class="container-fluid d-flex justify-content-center">
        <!--recuperamos datos con la función Flashdata para mostrarlos-->
        <?php if (session()->getFlashdata('success')) : ?>
            <div class='text-center w-50 alert alert-success alert-dismissible fade show' role='alert'>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif ?>
    </div>

    <?php $validation = \Config\Services::validation(); ?>

  <!--aca termina-->

    <h1 class="titulo">Iniciar Sesión</h1>
    <form class="login_form" method="post" action="<?php echo base_url('/enviarlogin') ?>">
            <div class="form-group">
              <br>
                <label>Correo Electrónico</label>
                <input type="text" name="email" class="form-control">
                <!--Error-->
                <?php if ($validation->getError('email')) { ?>
                    <div class="alert alert-danger mt-2">
                        <?= $validation->getError('email'); ?>
                    </div>
                <?php } ?>
            </div>
            <br>
            <div class="form-group">
                <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                <input name="pass" type="password" class="form-control" id="exampleInputPassword1">
                <!--ERROR-->
                <?php if ($validation->getError('pass')) { ?>
                    <div class="alert alert-danger mt-2">
                        <?= $validation->getError('pass'); ?>
                    </div>

                <?php } ?>
                <br>
                <button type="reset" class="btn btn-primary">Cancelar</button>
                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
           </div>
          <br>
          <p> ¿No tienes cuenta? <a href="<?php echo base_url('registro'); ?>"> Registrate </a></p>
        </form>
  </div>
  </div>
</div>
  
