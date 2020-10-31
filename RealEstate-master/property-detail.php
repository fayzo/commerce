<!DOCTYPE html>
<html lang="es">
  <head>
    <?php include ("php/head.php"); ?>
  </head>

  <body>
    <?php
      include ("php/header.php");

      if (isset($_GET['id_art']) && !empty($_GET['id_art']))
        $ThisId = $_GET['id_art'];
      else 
        header("Location: ./");

      @$GetInfoArticle = $Conexion->query("SELECT * FROM article WHERE id_art='".$ThisId."';");

      if (@$GetInfoArticle->num_rows == 0){ 
        include ("php/notfound.php");
        exit();
      }

      $GIA = $GetInfoArticle->fetch_array(MYSQLI_ASSOC);
    ?>

    <div class="inside-banner">
      <div class="container"> 
        <span class="pull-right">
          <a href="./">Principal</a>
           /
           <?php echo " ".$GIA['business_type']; ?>
        </span>
        <h2><?php echo " ".$GIA['business_type']; ?></h2>
      </div>
    </div>

    <div class="container">
    <div class="properties-listing spacer">

    <div class="row">
    <div class="col-lg-3 col-sm-4 hidden-xs">

      <?php
        include ("php/hot_property.php");
      ?>
      
      </div>
       <!--  <div class="row">
          <div class="col-lg-4 col-sm-5">
            <img src="images/properties/4.jpg" class="img-responsive img-circle" alt="properties"/>
          </div>
          <div class="col-lg-8 col-sm-7">
            <h5><a href="property-detail.html">Integer sed porta quam</a></h5>
            <p class="price">$300,000</p>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-4 col-sm-5">
            <img src="images/properties/1.jpg" class="img-responsive img-circle" alt="properties"/>
          </div>
          <div class="col-lg-8 col-sm-7">
            <h5><a href="property-detail.html">Integer sed porta quam</a></h5>
            <p class="price">$300,000</p>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-4 col-sm-5">
            <img src="images/properties/3.jpg" class="img-responsive img-circle" alt="properties"/>
          </div>
          <div class="col-lg-8 col-sm-7">
            <h5><a href="property-detail.html">Integer sed porta quam</a></h5>
            <p class="price">$300,000</p>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-4 col-sm-5">
            <img src="images/properties/2.jpg" class="img-responsive img-circle" alt="properties"/>
          </div>
          <div class="col-lg-8 col-sm-7">
            <h5><a href="property-detail.html">Integer sed porta quam</a></h5>
            <p class="price">$300,000</p> 
          </div>
        </div>
      </div> -->

      <!-- <div class="advertisement">
        <h4>Advertisements</h4>
        <img src="images/advertisements.jpg" class="img-responsive" alt="advertisement">
      </div> -->
      <!-- </div> -->

    <div class="col-lg-9 col-sm-8 ">

    <h2><?php echo " ".$GIA['title']; ?></h2>
    <div class="row">
      <div class="col-lg-8">
      <div class="property-images">
        <!-- Slider Starts -->
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          
          <?php
            $GetImgArticle = $Conexion->query("SELECT * FROM publish_img WHERE id_art='".$GIA['id_art']."';");
            if ($GetImgArticle->num_rows == 0){
              echo "NO HAY IMÁGENES DISPONIBLES";
            } else {
              ?>
                <ol class="carousel-indicators hidden-xs">
              <?php

                $IteradorIA = $GetImgArticle->num_rows;
                for ($GIAC = 0; $GIAC < $IteradorIA; $GIAC++){
                  if ($GIAC == 0){
                    ?>
                      <li data-target="#myCarousel" data-slide-to="<?php echo $GIAC; ?>" class="active"></li>
                    <?php
                  } else {
                    ?>
                      <li data-target="#myCarousel" data-slide-to="<?php echo $GIAC; ?>" class=""></li>
                    <?php
                  }
                }
              ?>
                </ol>
                
                <div class="carousel-inner">
                  <?php
                    $GIAC = 0;
                    while ($GIAR = $GetImgArticle->fetch_array(MYSQLI_ASSOC)){
                      if ($GIAC == 0){
                        ?>
                          <div class="item active">
                            <img src="<?php echo "Desktop/".$GIAR['folder'].$GIAR['src']; ?>" class="properties" alt="properties" />
                          </div>
                        <?php
                      } else {
                        ?>
                          <div class="item">
                            <img src="<?php echo "Desktop/".$GIAR['folder'].$GIAR['src']; ?>" class="properties" alt="properties" />
                          </div>
                        <?php
                      }
                      $GIAC++;
                    }
                  ?>
                </div>
              <?php
            }
          ?>

          <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
          <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
        </div>
      </div>
      
      <div class="spacer"><h4><span class="glyphicon glyphicon-th-list"></span>Detalles de la propiedad / <?php echo $GIA['property_type']; ?></h4>
      <?php
        echo $GIA['content_es'];
      ?>

      </div>
      <div>
        <?php include ("php/map_location.php"); ?>
      </div>

      </div>
      <div class="col-lg-4">
        <div class="col-lg-12  col-sm-6">
          <div class="property-info">
            <p class="price">
              $
              <?php
                echo number_format($GIA['price'], 2, '.', ',');
              ?>
            </p>
            <p class="area"><span class="glyphicon glyphicon-map-marker"></span>Localidad <p><?php echo $GIA['department'].", ".$GIA['city']." : ".$GIA['local_address']; ?></p>
            
            <div class="profile">
              <?php
                $AgentDetails = $Conexion->query("SELECT * FROM agents WHERE id_agent='".$GIA['id_agent']."';")->fetch_array(MYSQLI_ASSOC);
              ?>
              <span class="glyphicon glyphicon-user"></span> Detalles del agente
              <p>
                <?php echo explode(" ", $AgentDetails['names'])[0]." ".explode(" ", $AgentDetails['lastnames'])[0]; ?>
              </p>
                <?php 
                  if ($AgentDetails['phone_claro'] != ""){
                    echo "<p>Claro: ".$AgentDetails['phone_claro']."</p>";
                  }

                  if ($AgentDetails['phone_movistar'] != ""){
                    echo "<p>Movistar: ".$AgentDetails['phone_movistar']."</p>";
                  }
                ?>
            </div>
          </div>

          <h6><span class="glyphicon glyphicon-home"></span>Disponibilidad</h6>
          <div class="listing-detail">
          <span data-toggle="tooltip" data-placement="bottom" data-original-title="Dormitorios"><?php echo $GIA['bed_room']; ?></span> 
          <span data-toggle="tooltip" data-placement="bottom" data-original-title="Salas"><?php echo $GIA['living_room']; ?></span>
          <span data-toggle="tooltip" data-placement="bottom" data-original-title="Estacionamientos"><?php echo $GIA['parking']; ?></span> 
          <span data-toggle="tooltip" data-placement="bottom" data-original-title="Cocinas"><?php echo $GIA['kitchen']; ?></span> </div>
      </div>

      <div class="col-lg-12 col-sm-6 ">
        <div class="enquiry">
          <h6><span class="glyphicon glyphicon-envelope"></span>Consultar</h6>
          <form role="form" id="SendMessageSuscriptor">
            <input type="hidden" name="sus_article" id="sus_article" value="<?php echo $GIA['title']; ?>" />
            <input type="hidden" name="sus_idArt" id="sus_idArt" value="<?php echo $GIA['id_art']; ?>" />

            <input type="text" id="sus_fullname" name="sus_fullname" class="form-control" placeholder="Nombre completo"/>
            <input type="text" id="sus_email" name="sus_email" class="form-control" placeholder="Correo electrónico"/>
            <input type="text" id="sus_numberphone" name="sus_numberphone" class="form-control" placeholder="Número de teléfono"/>
            <textarea rows="6" id="sus_message" name="sus_message" class="form-control" placeholder="¿Qué tienes en mente?"></textarea>
            <button type="button" id="sus_send_message" class="btn btn-primary" name="sus_send_message">Enviar Mensaje</button>
          </form>
         </div>         
      </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    
    <div class="footer">
      <?php include ("php/footer.php"); ?>
    </div>

  </body>
</html>