<div class="container">
  <div class="row">
    <div class="col-lg-3 col-sm-3">
      <h4>Información</h4>
      <ul class="row">
        <li class="col-lg-12 col-sm-12 col-xs-3"><a href="about">Acerca de</a></li>
        <li class="col-lg-12 col-sm-12 col-xs-3"><a href="agents">Agentes</a></li>         
        <li class="col-lg-12 col-sm-12 col-xs-3"><a href="blog">Blog</a></li>
        <li class="col-lg-12 col-sm-12 col-xs-3"><a href="contact">Contacto</a></li>
      </ul>
    </div>

    <div class="col-lg-3 col-sm-3">
      <h4>Hoja informativa</h4>
      <p>¡Entérate de las últimas propiedades en nuestro mercado!.</p>
      <form id="form_suscriptions_side" class="form-inline" role="form" onsubmit="return false;">
        <input type="text" id="email_suscription_" name="email_suscription_" placeholder="Escriba su dirección de correo" class="form-control">
        <button id="notifynowemail" class="btn btn-success" onclick="javascript: form_suscriptions_side();" type="button">¡Notificarme!</button>
      </form>
    </div>
    
    <?php
      $DataObject = $Conexion->query("SELECT * FROM contact_us ORDER BY id DESC LIMIT 1");

      if ($DataObject->num_rows > 0){
          $DObject = $DataObject->fetch_array(MYSQLI_ASSOC);

          $tb_AboutTitle      = $DObject['whoami'];
          $tb_AboutLocation   = $DObject['location'];
          $tb_AboutEmail      = $DObject['email'];
          $tb_AboutPhone      = $DObject['phone'];
          $fb                 = $DObject['fb'];
          $tt                 = $DObject['tt'];
          $gp                 = $DObject['gp'];
          $li                 = $DObject['li'];
      } else {
          $tb_AboutTitle      = "";
          $tb_AboutLocation   = "";
          $tb_AboutEmail      = "";
          $tb_AboutPhone      = "";
          $fb                 = "#";
          $tt                 = "#";
          $gp                 = "#";
          $li                 = "#";
      }
    ?>

    <div class="col-lg-3 col-sm-3">
      <h4>Síguenos en</h4>
      <a href="<?php echo $fb; ?>" style="margin:5px;" title="Perfil de Facebook" >
        <i class="fa fa-facebook-square fa-3x" aria-hidden="true"></i>
      </a>
      <a href="<?php echo $tt; ?>" style="margin:5px;" title="Perfil de Twitter" >
        <i class="fa fa-twitter-square fa-3x" aria-hidden="true"></i>
      </a>
      <a href="<?php echo $gp; ?>" style="margin:5px;" title="Perfil de Google Plus" >
        <i class="fa fa-google-plus-square fa-3x" aria-hidden="true"></i>
      </a>
      <a href="<?php echo $li; ?>" style="margin:5px;" title="Perfil de LinkedLn" >
        <i class="fa fa-linkedin-square fa-3x" aria-hidden="true"></i>
      </a>
    </div>

    <div class="col-lg-3 col-sm-3">
      <h4>Contáctenos</h4>
      <p><b><?php echo $tb_AboutTitle; ?></b><br>
      <span class="glyphicon glyphicon-map-marker"></span> <?php echo $tb_AboutLocation; ?> <br>
      <span class="glyphicon glyphicon-envelope"></span> <?php echo $tb_AboutEmail; ?><br>
      <span class="glyphicon glyphicon-earphone"></span> <?php echo $tb_AboutPhone; ?></p>
    </div>
  </div>

  <p class="copyright">Copyright <?php echo date("Y"); ?> Todos los derechos reservados.	</p>

  <button type="button" id="button_modal_click" style="display:none;" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#loginpop">
    
  </button>
</div>

<?php
  @session_start();
  if (@$_SESSION['login'] == 1){
    ?>
      <div id="loginpop" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="row">

              <div class="imagen_login">
                <img src="images/login.jpg">
              </div>

              <div class="col-sm-12 login">
              <p>La sesión está abierta</p>         
                  <button type="button" id="GoControlPanel" class="btn btn-success">Ir al panel de control</button><br/><br/>
                  <button type="button" id="LogoutNow" class="btn btn-success">Cerrar sesión</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php
  } else {
    ?>
      <div id="loginpop" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="row">

              <div class="imagen_login">
                <img src="images/login.jpg">
              </div>

              <div class="col-sm-12 login">
              <p>Acceder al panel</p>
                <form role="form" id="FormLogin">
                  <div class="form-group">
                    <label class="sr-only" for="exampleInputEmail2">Nombre de usuario</label>
                    <input type="username" name="username" class="form-control" id="exampleInputEmail2" placeholder="Nombre de usuario">
                  </div>
                  <div class="form-group">
                    <label class="sr-only" for="exampleInputPassword2">Contraseña</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword2" placeholder="Contraseña">
                  </div>
                  
                  <button type="button" id="StartSession" class="btn btn-success">Iniciar sesión</button>
                </form>   
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php
  }
?>

<div class="ok">
  <p>Registrado con éxito!.</p>
</div>

<div class="fail">
  <p>Ha ocurrido un error!.</p>
</div>

<?php
  include ("php/modals.php");
?>

<script src="js/script.js"></script>