<nav class="navbar navbar-default navbar-fixed-top navbar-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-expand-toggle">
                <i class="fa fa-bars icon"></i>
            </button>
            <ol class="breadcrumb navbar-breadcrumb">
                <li class="active">Real Estate - Panel de control</li>
            </ol>
            <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                <i class="fa fa-th icon"></i>
            </button>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                <i class="fa fa-times icon"></i>
            </button>
            <li>
                <a href="#" onclick="javascript: GoMainNow();" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-home fa-2x" style="margin-right: 10px"></i>Página principal</a>
            </li>

            <?php
                $QuantitySus = $Conexion->query("SELECT * FROM suscriptions WHERE viewed='No';")->num_rows;
                $QuantityMsg = $Conexion->query("SELECT * FROM sus_message;")->num_rows;
                $QuantityTotal = $QuantitySus + $QuantityMsg;
            ?>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-comments-o fa-2x"></i></a>
                <ul class="dropdown-menu animated fadeInDown">
                    <li class="title">
                        Notificaciones <span class="badge pull-right"><?php echo $QuantityTotal; ?></span>
                    </li>
                    <li class="message">
                        No hay nuevas notificaciones
                    </li>
                </ul>
            </li>


            <li class="dropdown danger">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-star-half-o fa-2x"></i> <?php echo $QuantityTotal; ?></a>
                <ul class="dropdown-menu danger  animated fadeInDown">
                    <li class="title">
                        Notificaciones <span class="badge pull-right"><?php echo $QuantityTotal; ?></span>
                    </li>
                    <li>
                        <ul class="list-group notifications">
                            <a href="#" onclick="OpenListSuscriptions();">
                                <li class="list-group-item" >
                                    <span class="badge"><?php echo $QuantitySus; ?></span> <i class="fa fa-exclamation-circle icon"></i> Nuevas suscripciones
                                </li>
                            </a>
                            <a href="./">
                                <li class="list-group-item">
                                    <span class="badge danger"><?php echo $QuantityMsg; ?></span> <i class="fa fa-comments icon"></i> Mensajes de posibles clientes
                                </li>
                            </a>
                            <!-- <a href="#">
                                <li class="list-group-item message">
                                    Ver todo
                                </li>
                            </a> -->
                        </ul>
                    </li>
                </ul>
            </li>
            
            <li class="dropdown profile">
                <a href="#" class="dropdown-toggle dpd-menu-open" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-user fa-2x" style="margin-right: 10px"></i><?php echo @$_SESSION['username']; ?><span class="caret"></span></a>
                <ul class="dropdown-menu animated fadeInDown">
                    <li class="profile-img">
                       
                        <i class="fa fa-camera fa-2x icon-camera-change" onclick="javascript: OpenModalChangeIMG();" aria-hidden="true" title="Cambiar imagen de perfil"></i>

                        <div class="add_new_img_perfil">
                            <?php
                                $QImg = $Conexion->query("SELECT * FROM img_perfil WHERE username='".$_SESSION['username']."' ORDER BY id DESC LIMIT 1;");
                                $ObjectImg = $QImg->fetch_array(MYSQLI_ASSOC);

                                if ($QImg->num_rows == 1){
                                    ?>
                                        <img src="../<?php echo $ObjectImg['folder'].$ObjectImg['src']; ?>" class="profile-img" />
                                    <?php
                                } else if ($QImg->num_rows <= 0){
                                    ?>
                                        <img src="../img/img-default/bg_default.jpg" class="profile-img" />
                                    <?php
                                }
                            ?>
                        </div>
                    </li>
                    <li>
                        <div class="profile-info">
                            <h4 class="username"><?php echo @$_SESSION['username']; ?></h4>
                            <p id="pEmail_user"><?php echo $Conexion->query("SELECT email FROM admin_info WHERE username='".$_SESSION['username']."';")->fetch_array(MYSQLI_ASSOC)['email']; ?></p>
                            <div class="btn-group margin-bottom-2x" role="group">
                                <button type="button" class="btn btn-primary" onclick="javascript: MenuConfig();"><i class="fa fa-cogs"></i>Configuración</button>
                                <button type="button" onclick="javascript: window.location.href='../php/logout.php';" class="btn btn-default"><i class="fa fa-sign-out"></i>Cerrar sesión</button>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>