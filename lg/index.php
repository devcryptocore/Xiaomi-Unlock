<?php
    date_default_timezone_set('America/Bogota');
    $accode = date('Ymd');
    if(isset($_GET['access']) && $_GET['access'] === $accode){
        $v = time();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Xiaomi Unlock</title>
    <link rel="stylesheet" href="../res/css/style.css?v=<?=$v;?>">
    <link rel="stylesheet" href="style.css?v=<?=$v;?>">
    <script src="lg.js?v=<?=$v;?>"></script>
</head>
<body>
    <div class="fcont">
        <form id="lgform">
            <div class="inpcon">
                <label for="uname">Usuario</label>
                <input type="text" name="username" id="uname" class="nimput" placeholder="Usuario" required autocomplete="off">
            </div>
            <div class="inpcon">
                <label for="upass">Contraseña</label>
                <input type="password" name="upass" id="upass" class="nimput" placeholder="Contraseña" required autocomplete="off">
                <input type="checkbox" id="showhide">
                <label for="showhide" class="showhide"></label>
            </div>
            <div class="inpcon" style="align-items: center;">
                <label style="visibility: hidden;">.</label>
                <input type="submit" value="Ingresar" class="sbtn view-more-button">
            </div>
        </form>
    </div>
</body>
</html>
<?php
    }
    else {
        header("Location: ../");
    }
?>