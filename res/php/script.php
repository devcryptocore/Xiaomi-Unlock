<?php

    include('connector.php');

    if(isset($_GET['get-main-cards'])){
        $state = 'activo';
        $cats = $con->prepare("SELECT * FROM category WHERE estado = ?");
        $cats -> bind_param('s',$state);
        $cats -> execute();
        $Rcats = $cats->get_result();
        $marcas = "";
        if($Rcats->num_rows > 0){
            while($ct = mysqli_fetch_array($Rcats)){
                $titulo = $ct['titulo'];
                $marca = $ct['marca'];
                $portada = $ct['portada'];
                $video = $ct['video'];
                $videoportada = $ct['videoportada'];
                $marcas .= '
                    <div class="telOption">
                        <span>'.$titulo.'</span>
                        <img src="'.$portada.'" alt="'.$titulo.' image" class="ini-card-image" onclick="gotosource(\'#'.$marca.'\')">
                        <div class="video-sources" onclick="set_video(\''.$video.'\')" style="background-image: url(res/assets/icons/ytb.svg), url('.$videoportada.');"></div>
                    </div>
                ';
            }
            $response = ["status" => "success", "cards" => $marcas];
        }
        else {
            $response = ["status" => "error", "cards" => ""];
        }
        echo json_encode($response);
    }

    if(isset($_GET['get_brands'])){
        $sel = $con->query("SELECT * FROM marcas WHERE estado = 'activo'");
        if($sel->num_rows > 0){
            while($mrk = mysqli_fetch_array($sel)){
                $banner = $mrk['banner'];
                $marca = $mrk['marca'];
                $logo = $mrk['logo'];
                
            }
        }
    }


?>