<div class="container-fluid">
    <div class="side-body padding-top">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <a href="#">
                    <div class="card red summary-inline">
                        <div class="card-body">
                            <i class="icon fa fa-inbox fa-4x"></i>
                            <div class="content">
                                <?php
                                    $CountVisit = $Conexion->query("SELECT * FROM count_visit;");
                                    if ($CountVisit->num_rows == 0){
                                        $CountVisit = 0;
                                    } else {
                                        $CountVisit = $CountVisit->num_rows;
                                    }
                                ?>
                                <div class="title"><?php echo $CountVisit; ?></div>
                                <div class="sub-title">Visitantes</div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <a href="users">
                    <div class="card yellow summary-inline">
                        <div class="card-body">
                            <!-- <i class="icon fa fa-comments fa-4x"></i> -->
                            <i class="icon fa fa-users fa-4x"></i>
                            <div class="content">
                                <?php
                                    $CountUsers = $Conexion->query("SELECT * FROM admin_info;");
                                    if ($CountUsers->num_rows == 0){
                                        $CountUsers = 0;
                                    } else {
                                        $CountUsers = $CountUsers->num_rows;
                                    }
                                ?>
                                <div class="title"><?php echo $CountUsers; ?></div>
                                <div class="sub-title">Usuarios</div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <a href="articles">
                    <div class="card green summary-inline">
                        <div class="card-body">
                            <i class="icon fa fa-tags fa-4x"></i>
                            <div class="content">

                                <?php
                                    $CountArticle = $Conexion->query("SELECT * FROM article;");
                                    if ($CountArticle->num_rows == 0){
                                        $CountArticle = 0;
                                    } else {
                                        $CountArticle = $CountArticle->num_rows;
                                    }
                                ?>

                                <div class="title"><?php echo $CountArticle; ?></div>
                                <div class="sub-title">Artículos</div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <a href="agents">
                    <div class="card blue summary-inline">
                        <div class="card-body">
                            <i class="icon fa fa-user-secret fa-4x"></i>
                            <div class="content">

                            <?php
                                $CountAgent = $Conexion->query("SELECT * FROM agents;");
                                if ($CountAgent->num_rows == 0){
                                    $CountAgent = 0;
                                } else {
                                    $CountAgent = $CountAgent->num_rows;
                                }
                            ?>

                                <div class="title"><?php echo $CountAgent; ?></div>
                                <div class="sub-title">Agentes</div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row  no-margin-bottom">
            <div class="col-sm-6 col-xs-12">
                <div class="card card-success">
                    <div class="card-header">
                        <div class="card-title">
                            <div class="title"><i class="fa fa-comments-o"></i> Mensajes recientes</div>
                        </div>
                        <div class="clear-both"></div>
                    </div>
                    <div class="card-body no-padding">
                        <ul class="message-list">

                            <?php
                                include ("build/CalcDate.php");
                                $ConexMessage = $Conexion->query("SELECT * FROM sus_message ORDER BY id DESC LIMIT 4;");

                                while ($CM = $ConexMessage->fetch_array(MYSQLI_ASSOC)){
                                    $GetImgArt = $Conexion->query("SELECT folder, src FROM publish_img WHERE id_art='".$CM['id_art']."' LIMIT 1;")->fetch_array(MYSQLI_ASSOC);
                                    
                                    ?>
                                        <a href="#" onclick="LoadMessage(<?php echo $CM['id']; ?>);">
                                            <li>
                                                <img src="<?php echo "../".$GetImgArt['folder'].$GetImgArt['src']; ?>" width="60px" height="60px" class="profile-img pull-left">
                                           
                                                <div class="message-block">
                                                    <div><span class="username"><?php echo $CM['fullname']; ?></span> <span class="message-datetime"><?php echo nicetime(date("Y-m-d H:i", $CM['date_log_unix'])); ?></span>
                                                    </div>
                                                    <div class="message">
                                                        <?php 
                                                            echo substr($CM['message'], 0, 260); 

                                                            if (strlen($CM['message']) > 260){
                                                                echo "...";
                                                            }
                                                        ?>
                                                    </div>
                                                </div>

                                            </li>
                                        </a>
                                    <?php
                                }
                            ?>

                            <form id="SendIdMessage">
                                <input type="hidden" id="IdMessage" name="IdMessage" value="" />
                            </form>

                            <a href="#" id="message-load-more" onclick="javascript: CallModalMessage();">
                                <li class="text-center load-more">
                                    <i class="fa fa-refresh"></i> Cargar más...
                                </li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xs-12">
                <div class="card card-success">
                    <div class="card-header">
                        <div class="card-title">
                            <div class="title"><i class="fa fa-comments-o"></i> Mensajes favoritos</div>
                        </div>
                        <div class="clear-both"></div>
                    </div>
                    <div class="card-body no-padding">
                        <ul class="message-list">

                            <?php
                                $ConexMessage = $Conexion->query("SELECT * FROM sus_message WHERE favorite='1' ORDER BY id DESC LIMIT 4;");

                                if ($ConexMessage->num_rows > 0){
                                    while ($CM = $ConexMessage->fetch_array(MYSQLI_ASSOC)){
                                        $GetImgArt = $Conexion->query("SELECT folder, src FROM publish_img WHERE id_art='".$CM['id_art']."' LIMIT 1;")->fetch_array(MYSQLI_ASSOC);
                                        
                                        ?>
                                            <a href="#" onclick="LoadMessage(<?php echo $CM['id']; ?>);">
                                                <li>
                                                    <img src="<?php echo "../".$GetImgArt['folder'].$GetImgArt['src']; ?>" width="60px" height="60px" class="profile-img pull-left">
                                               
                                                    <div class="message-block">
                                                        <div><span class="username"><?php echo $CM['fullname']; ?></span> <span class="message-datetime"><?php echo nicetime(date("Y-m-d H:i", $CM['date_log_unix'])); ?></span>
                                                        </div>
                                                        <div class="message">
                                                            <?php 
                                                                echo substr($CM['message'], 0, 260); 
    
                                                                if (strlen($CM['message']) > 260){
                                                                    echo "...";
                                                                }
                                                            ?>
                                                        </div>
                                                    </div>
    
                                                </li>
                                            </a>
                                        <?php
                                    }
                                }

                            ?>

                            <form id="SendIdMessage">
                                <input type="hidden" id="IdMessage" name="IdMessage" value="" />
                            </form>

                            <a href="#" id="message-load-more" onclick="javascript: CallModalMessageFav();">
                                <li class="text-center load-more">
                                    <i class="fa fa-refresh"></i> Cargar más...
                                </li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
        <?php include ("build/modals.php"); ?>
        </div>
    </div>
</div>