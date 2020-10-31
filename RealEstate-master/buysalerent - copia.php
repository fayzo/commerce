<!DOCTYPE html>
<html lang="es">
  <head>
    <?php include ("php/head.php"); ?>
  </head>

  <body>
    <?php include ("php/header.php"); ?>

    <!-- banner -->
    <div class="inside-banner">
      <div class="container"> 
        <span class="pull-right"><a href="./">Principal</a> / Venta, Alquiler</span>
        <h2>Venta, Alquiler</h2>
      </div>
    </div>

<div class="container">
<div class="properties-listing spacer">

<div class="row">
<div class="col-lg-3 col-sm-4 ">

  <form action="buysalerent.php" method="GET">
      <div class="search-form"><h4><span class="glyphicon glyphicon-search"></span> Hacer una búsqueda</h4>
      <input type="text" name="search" class="form-control" placeholder="Búsqueda de propiedades">
      <div class="row">
        <div class="col-lg-5">
          <select name="business_type" class="form-control">
            <option>Alquiler</option>
            <option>Venta</option>
          </select>
        </div>
        <div class="col-lg-7">
          <select name="price" class="form-control">
            <option>Precio</option>
            <option value="200000">$150,000 - $200,000</option>
            <option value="250000">$200,000 - $250,000</option>
            <option value="300000">$250,000 - $300,000</option>
            <option value="igual">$300,000 - above</option>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <select name="property_type" class="form-control">
            <?php
              $ExOptionsProperty = $Conexion->query("SELECT * FROM property_type;");
              while ($Nr = $ExOptionsProperty->fetch_array(MYSQLI_ASSOC)){
                ?>
                  <option><?php echo $Nr['name_type']; ?></option>
                <?php
              }
            ?>
          </select>
          </div>
      </div>
      <button class="btn btn-primary">Buscar ahora</button>
    </div>
  </form>

    <?php 
      include ("php/hot_property.php"); 
      $quantity = 9;
      $quantData = ceil($Conexion->query("SELECT * FROM article;")->num_rows / $quantity);
    ?>
</div>

<div class="col-lg-9 col-sm-8">
  <div class="sortby clearfix">
    <!-- <div class="pull-left result">Mostrando: <?php echo $quantity; ?> de <?php echo $Conexion->query("SELECT * FROM article;")->num_rows; ?> </div> -->
      <div class="pull-right">
      <select class="form-control">
      <option>Ordernar por</option>
      <option>Precio: De bajo a alto</option>
      <option>Precio: De alto a bajo</option>
    </select></div>
    </div>
<div class="row">
    
    <?php

      if (isset($_GET['pagina'])){
        $num_page = $_GET['pagina'];
        $start = ($num_page > 1) ? ($num_page * $quantity) - $quantity : 0;
      } else {
        $num_page = 1;
        $start = 0;
      }
      
      $GetArticle = $Conexion->query("SELECT * FROM article ORDER BY id_art DESC LIMIT $start, $quantity;");
      
      if (isset($_GET['search'])){
        @$search = $_GET['search'];
        @$business_type = $_GET['business_type'];
        @$price = $_GET['price'];
        @$property_type = $_GET['property_type'];

        $GetArticle = $Conexion->query("SELECT * FROM article WHERE title LIKE %$search% and business_type LIKE %$business_type% and price LIKE %$price% and property_type LIKE %$property_type%;");
      } else if (isset($_GET['type_business'])){
        $GetArticle = $Conexion->query("SELECT * FROM article WHERE business_type='".$_GET['type_business']."' ORDER BY id_art DESC LIMIT $start, $quantity;");
      }

      if (@$GetArticle->num_rows > 0){
          while ($GA = $GetArticle->fetch_array(MYSQLI_ASSOC)){
          $GetImgArt = $Conexion->query("SELECT folder, src FROM publish_img WHERE id_art='".$GA['id_art']."' LIMIT 1;")->fetch_array(MYSQLI_ASSOC);
          ?>
           <!-- properties -->
            <div class="col-lg-4 col-sm-6">
              <div class="properties">
                <div class="image-holder">
                  <img src="<?php echo "Desktop/".$GetImgArt['folder'].$GetImgArt['src']; ?>" class="img-responsive" alt="properties">
                  <div class="status sold"><?php echo $GA['business_type']; ?></div>
                </div>

                <h4>
                  <a href="property-detail.php?id_art=<?php echo $GA['id_art']; ?>" title="<?php echo $GA['title']; ?>">
                    <?php 
                      echo substr($GA['title'],0,22); 
                      if (strlen($GA['title']) > 22){
                        echo "...";
                      }
                    ?>
                  </a>
                </h4>
                <p class="price">Precio: $<?php echo number_format($GA['price'], 2, '.', ','); ?></p>
                
                <div class="listing-detail">
                  <span data-toggle="tooltip" data-placement="bottom" data-original-title="Habitaciones"><?php echo $GA['bed_room']; ?></span> 
                  <span data-toggle="tooltip" data-placement="bottom" data-original-title="Salas"><?php echo $GA['living_room']; ?></span> 
                  <span data-toggle="tooltip" data-placement="bottom" data-original-title="Estacionamientos"><?php echo $GA['parking']; ?></span> 
                  <span data-toggle="tooltip" data-placement="bottom" data-original-title="Cocinas"><?php echo $GA['kitchen']; ?></span> 
                </div>

                <a class="btn btn-primary" href="property-detail.php?id_art=<?php echo $GA['id_art']; ?>">Ver detalles</a>
              </div>
            </div>
          <?php
        }
      } else {
        echo "No hay resultados";
      }
    ?>

    <?php include ("paginacion.php"); ?>

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