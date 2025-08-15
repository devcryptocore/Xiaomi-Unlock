<?php
    include('../res/php/connector.php');
    header('Content-Type: application/json');
    date_default_timezone_set('America/Bogota');

    if(isset($_GET['new_resource'])){
        // Validación de campos
        if (
            empty($_POST['marca']) || 
            empty($_POST['referencia']) || 
            empty($_POST['modelo']) || 
            empty($_POST['estado']) || 
            !isset($_FILES['imagen'])
        ) {
            echo json_encode(["ok" => false, "mensaje" => "Todos los campos son obligatorios"]);
            exit;
        }

        $marca = $_POST['marca'];
        $referencia = $_POST['referencia'];
        $modelo = $_POST['modelo'];
        $estado = $_POST['estado'];
        $tabla = str_replace(" ","",strtolower($marca));

        $imagen = $_FILES['imagen'];

        // Validar imagen
        $permitidos = ['image/webp', 'image/png'];
        if (!in_array($imagen['type'], $permitidos)) {
            echo json_encode(["ok" => false, "mensaje" => "Formato de imagen no permitido"]);
            exit;
        }
        if ($imagen['size'] > 500 * 1024) {
            echo json_encode(["ok" => false, "mensaje" => "Imagen demasiado pesada"]);
            exit;
        }

        // Crear carpetas dinámicas
        $directorio = '../res/assets/images/mcards/'.$tabla . '/' . $referencia;
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777, true);
        }

        // Guardar imagen
        $ext = pathinfo($imagen['name'], PATHINFO_EXTENSION);
        $ruta_imagen = $directorio . '/' . $modelo . '_' . uniqid() . '.' . $ext;
        move_uploaded_file($imagen['tmp_name'], $ruta_imagen);

        // Insertar en la tabla correspondiente
        $stmt = $con->prepare("INSERT INTO phones (marca, referencia, modelo, tarjeta, estado) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $marca, $referencia, $modelo, $ruta_imagen, $estado);

        if ($stmt->execute()) {
            echo json_encode(["ok" => true, "mensaje" => "Registro guardado correctamente"]);
        } else {
            echo json_encode(["ok" => false, "mensaje" => "Error al guardar en la base de datos"]);
        }

        $stmt->close();
        $con->close();
    }

    if (isset($_GET['mod_resource'])) {
        if (empty($_POST['id'])) {
            echo json_encode(["ok" => false, "mensaje" => "ID del registro es obligatorio"]);
            exit;
        }
        if (
            empty($_POST['marca']) || 
            empty($_POST['referencia']) || 
            empty($_POST['modelo']) || 
            empty($_POST['estado'])
        ) {
            echo json_encode(["ok" => false, "mensaje" => "Todos los campos son obligatorios"]);
            exit;
        }
        $id = intval($_POST['id']);
        $marca = $_POST['marca'];
        $referencia = $_POST['referencia'];
        $modelo = $_POST['modelo'];
        $estado = $_POST['estado'];
        $tabla = str_replace(" ", "", strtolower($marca));
        $ruta_imagen = null;
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $imagen = $_FILES['imagen'];
            $permitidos = ['image/webp', 'image/png'];
            if (!in_array($imagen['type'], $permitidos)) {
                echo json_encode(["ok" => false, "mensaje" => "Formato de imagen no permitido"]);
                exit;
            }
            if ($imagen['size'] > 500 * 1024) {
                echo json_encode(["ok" => false, "mensaje" => "Imagen demasiado pesada"]);
                exit;
            }
            $directorio = '../res/assets/images/mcards/' . $tabla . '/' . $referencia;
            if (!is_dir($directorio)) {
                mkdir($directorio, 0777, true);
            }
            $ext = pathinfo($imagen['name'], PATHINFO_EXTENSION);
            $ruta_imagen = $directorio . '/' . $modelo . '_' . uniqid() . '.' . $ext;
            move_uploaded_file($imagen['tmp_name'], $ruta_imagen);
        }
        if ($ruta_imagen) {
            $stmt = $con->prepare("UPDATE phones SET marca=?, referencia=?, modelo=?, tarjeta=?, estado=? WHERE id=?");
            $stmt->bind_param("sssssi", $marca, $referencia, $modelo, $ruta_imagen, $estado, $id);
        } else {
            $stmt = $con->prepare("UPDATE phones SET marca=?, referencia=?, modelo=?, estado=? WHERE id=?");
            $stmt->bind_param("ssssi", $marca, $referencia, $modelo, $estado, $id);
        }
        if ($stmt->execute()) {
            echo json_encode(["ok" => true, "mensaje" => "Registro actualizado correctamente"]);
        } else {
            echo json_encode(["ok" => false, "mensaje" => "Error al actualizar en la base de datos"]);
        }
        $stmt->close();
        $con->close();
    }

    if(isset($_GET['get_tarjs'])){
        $consu = $con->query("SELECT * FROM phones WHERE estado='activo' ORDER BY marca ASC, referencia ASC");
        if($consu->num_rows > 0){
            $table = "";
            while($rw = mysqli_fetch_array($consu)){
                $marca = $rw['marca'];
                $referencia = $rw['referencia'];
                $modelo = $rw['modelo'];
                $tarjeta = $rw['tarjeta'];
                $estado = $rw['estado'];
                $table .= '
                    <tr>
                        <td>'.$marca.'</td>
                        <td>'.$referencia.'</td>
                        <td>'.$modelo.'</td>
                        <td><img src="'.$tarjeta.'" class="thumbtarj" /></td>
                        <td>'.$estado.'</td>
                        <td class="opcont">
                            <button id="mod" onclick="modcard(\''.$rw['id'].'\')"></button>
                            <button id="del" onclick="delcard(\''.$rw['id'].'\')"></button>
                        </td>
                    </tr>
                ';
            }
            echo json_encode(["response" => $table]);
        }
        else {
            echo json_encode(["response" => "Sin datos"]);
        }
    }

    if(isset($_GET['getBrandModel'])){
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $consu = $con->query("SELECT * FROM phones WHERE marca='$brand' AND referencia='$model' AND  estado='activo' ORDER BY referencia ASC");
        if($consu->num_rows > 0){
            $table = "";
            while($rw = mysqli_fetch_array($consu)){
                $marca = $rw['marca'];
                $referencia = $rw['referencia'];
                $modelo = $rw['modelo'];
                $tarjeta = $rw['tarjeta'];
                $estado = $rw['estado'];
                $table .= '
                    <div class="mob-tarj" onclick="gotomodel(\''.$marca.'\',\''.$modelo.'\')">
                        <img src="'.$tarjeta.'" alt="'.$brand.' Card" class="image-tarj">
                    </div>
                ';
            }
            $model == "pocox5" || $model == "pocox5_2" || $model == "pocox5_3" ? $model = "Xiaomi" : $model = $model;
            echo json_encode(["status" => "success", "title" => $model, "tarjetas" => $table]);
        }
        else {
            echo json_encode(["status" => "NoData"]);
        }
    }

    if(isset($_GET['getSamsung'])){
        $consu = $con->query("SELECT * FROM phones WHERE marca='samsung' AND  estado='activo' ORDER BY referencia ASC");
        if($consu->num_rows > 0){
            $table = "";
            while($rw = mysqli_fetch_array($consu)){
                $marca = $rw['marca'];
                $referencia = $rw['referencia'];
                $modelo = $rw['modelo'];
                $tarjeta = $rw['tarjeta'];
                $estado = $rw['estado'];
                $table .= '
                    <div class="mob-tarj" onclick="gotoitem(\''.$marca.'\',\''.$referencia.'\',\''.$modelo.'\')">
                        <img src="'.$tarjeta.'" alt="'.$marca.' Card" class="image-tarj">
                    </div>
                ';
            }
            echo json_encode(["status" => "success", "tarjetas" => $table]);
        }
        else {
            echo json_encode(["status" => "NoData"]);
        }
    }

    if(isset($_GET['getXiaomi'])){
        $consu = $con->query("SELECT * FROM phones WHERE marca='xiaomi' AND  estado='activo' ORDER BY referencia ASC");
        if($consu->num_rows > 0){
            $table = "";
            while($rw = mysqli_fetch_array($consu)){
                $marca = $rw['marca'];
                $referencia = $rw['referencia'];
                $modelo = $rw['modelo'];
                $tarjeta = $rw['tarjeta'];
                $estado = $rw['estado'];
                $table .= '
                    <div class="mob-tarj" onclick="gotoitem(\''.$marca.'\',\''.$referencia.'\',\''.$modelo.'\')">
                        <img src="'.$tarjeta.'" alt="'.$marca.' Card" class="image-tarj">
                    </div>
                ';
            }
            echo json_encode(["status" => "success", "tarjetas" => $table]);
        }
        else {
            echo json_encode(["status" => "NoData"]);
        }
    }

    if(isset($_GET['getSeries'])){
        $ref = $_POST['ref'];
        $consu = $con->query("SELECT * FROM phones WHERE referencia LIKE '$ref%' ORDER BY referencia ASC");
        if($consu->num_rows > 0){
            $table = "";
            while($rw = mysqli_fetch_array($consu)){
                $marca = $rw['marca'];
                $referencia = $rw['referencia'];
                $modelo = $rw['modelo'];
                $tarjeta = $rw['tarjeta'];
                $estado = $rw['estado'];
                $table .= '
                    <div class="mob-tarj" onclick="gotoitem(\''.$marca.'\',\''.$referencia.'\',\''.$modelo.'\')">
                        <img src="../'.$tarjeta.'" alt="'.$marca.' Card" class="image-tarj">
                    </div>
                ';
            }
            echo json_encode(["status" => "success", "tarjetas" => $table]);
        }
        else {
            echo json_encode(["status" => "NoData"]);
        }
    }

    if(isset($_GET['getItem'])){
        $modelo = $_POST['modelo'];
        $consu = $con->query("SELECT * FROM phones WHERE modelo='$modelo'");
        if($consu->num_rows > 0){
            $table = "";
            $codigo = uniqid();
            while($rw = mysqli_fetch_array($consu)){
                $marca = $rw['marca'];
                $referencia = $rw['referencia'];
                $modelo = $rw['modelo'];
                $tarjeta = $rw['tarjeta'];
                $estado = $rw['estado'];
                $requi = "Unlock Code";
                if($marca == "samsung"){
                    $requi = "Imei";
                }
                $table .= '
                    <div class="mob-tarj">
                        <img src="'.$tarjeta.'" alt="'.$marca.' Card" class="image-tarj">
                    </div>
                    <form id="userform">
                        <div class="nimtext">
                            <p>Por favor ingrese los datos solicitados a continuación:</p>
                        </div>
                        <div class="nimput">
                            <input type="tel" name="telefono" id="phone">
                            <label for="phone">Teléfono</label>
                        </div>
                        <div class="nimput">
                            <input type="text" name="imei" id="imei">
                            <label for="imei">'.$requi.'</label>
                        </div>
                        <input type="hidden" name="marca" value="'.$marca.'">
                        <input type="hidden" name="modelo" value="'.$modelo.'">
                        <input type="hidden" name="tipo" value="unlock">
                        <input type="hidden" name="codigo" value="'.$codigo.'">
                        <input type="submit" value="Solicitar desbloqueo">
                    </form>
                ';
            }
            echo json_encode(["status" => "success", "tarjetas" => $table]);
        }
        else {
            echo json_encode(["status" => "NoData"]);
        }
    }

    if(isset($_GET['solicitar_desbloqueo'])){
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $codigo = $_POST['codigo'];
        $tipo = $_POST['tipo'];
        $telefono = $_POST['telefono'];
        $unic = $_POST['imei'];
        $enlace = "https://wa.me/+573172127507?text=%20*Solicitud%20de%20desbloqueo*%0A%0A✪%20*Tel:*%20%20_".$telefono."_%0A%0A✪%20*IMEI/LK%20CODE:*%20%20_".$unic."_%0A%0A✪%20*El*%20".date('d-m-Y H:i:s')."";
        $ins = $con->prepare("INSERT INTO ordenes (marca,modelo,imei,telefono,tipo,codigo) VALUES (?,?,?,?,?,?)");
        $ins->bind_param('ssssss',$marca,$modelo,$unic,$telefono,$tipo,$codigo);
        $ins->execute();
        if($ins){
            $res = [
                "status" => "success",
                "marca" => $marca,
                "modelo" => $modelo,
                "codigo" => $codigo,
                "tipo" => $tipo,
                "telefono" => $telefono,
                "imei" => $unic,
                "fecha" => date('d-m-Y H:i:s'),
                "enlace" => $enlace
            ];
            echo json_encode($res);
        }
        else {
            echo json_encode(["status" => "error"]);
        }
    }

    if(isset($_GET['modifyCard'])){
        $id = $_POST['id'];
        $consu = $con->query("SELECT * FROM phones WHERE id='$id'");
        if($consu->num_rows > 0){
            $rq = $consu->fetch_assoc();
            $sm="";$xm="";$hn="";$hp="";$io="";$ut="";$st="";$sti="";
            $rq['marca'] == "samsung" ? $sm = "selected" : $sm = "";
            $rq['marca'] == "xiaomi" ? $xm = "selected" : $xm = "";
            $rq['marca'] == "honor" ? $hn = "selected" : $hn = "";
            $rq['marca'] == "hyperos" ? $hp = "selected" : $hp = "";
            $rq['marca'] == "ios" ? $io = "selected" : $io = "";
            $rq['marca'] == "unlocktool" ? $ut = "selected" : $ut = "";
            if(!empty($rq['tarjeta'])){
                $vp = '<img src="'.$rq['tarjeta'].'" id="file-previeww" alt="Vista previa" style="display:flex;">';
            }
            else {
                $vp = '<img id="file-previeww" alt="Vista previa">';
            }
            $rq['estado'] == 'activo' ? $st = 'checked' : '';
            $rq['estado'] == 'inactivo' ? $sti = 'checked' : '';
            echo '
                <div class="container" style="display:flex;">
                    <span class="closexx">X</span>
                    <h2>Modificar</h2>
                    <form id="myModForm" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="'.$rq['id'].'">
                        <select name="marca" id="marcax" required>
                            <option value="">Seleccione marca</option>
                            <option value="samsung" '.$sm.'>Samsung</option>
                            <option value="xiaomi" '.$xm.'>Xiaomi</option>
                            <option value="honor" '.$hn.'>Honor</option>
                            <option value="hyperos" '.$hp.'>Hyper OS</option>
                            <option value="ios" '.$io.'>IOS</option>
                            <option value="unlocktool" '.$ut.'>Unlock Tool</option>
                        </select>
                        <input type="text" name="referencia" id="referenciax" placeholder="Referencia" value="'.$rq["referencia"].'" required>
                        <input type="text" name="modelo" id="modelox" placeholder="Modelo" required value="'.$rq["modelo"].'">
                        <input type="file" id="imagenx" name="imagen" accept=".webp,.png" hidden>
                        <label for="imagenx" class="file-label">Seleccionar imagen</label>
                        '.$vp.'
                        <div class="radio-group">
                            <label><input type="radio" name="estado" value="activo" '.$st.' required> Activo</label>
                            <label><input type="radio" name="estado" value="inactivo" '.$sti.' required> Inactivo</label>
                        </div>
                        <button type="submit">Enviar</button>
                    </form>
                </div>
            ';
        }
    }

    if(isset($_GET['deltar'])){
        $id = $_POST['id'];
        $ruta = $con->query("SELECT tarjeta FROM phones WHERE id ='$id'");
        if($ruta->num_rows > 0){
            $rt = $ruta->fetch_assoc()['tarjeta'];
            $dl = $con->query("DELETE FROM phones WHERE id='$id'");
            if($dl){
                unlink($rt);
                echo 1;
            }
            else {
                echo 0;
            }
        }
        else {
            echo 0;
        }
    }
    if(isset($_GET['getOrders'])){
        $co = $con->query("SELECT * FROM ordenes");
        if($co->num_rows > 0){
            $tab = "";
            while($or = mysqli_fetch_array($co)){
                $tab .= '
                    <tr>
                        <td>'.$or['marca'].'</td>
                        <td>'.$or['modelo'].'</td>
                        <td>'.$or['imei'].'</td>
                        <td>'.$or['telefono'].'</td>
                        <td>'.$or['tipo'].'</td>
                        <td>'.$or['fecha_orden'].'</td>
                        <td>'.$or['fecha_respuesta'].'</td>
                        <td>'.$or['estado'].'</td>
                        <td>'.$or['codigo'].'</td>
                    </tr>
                ';
            }
            echo $tab;
        }
        else {
            echo 0;
        }
    }

?>
