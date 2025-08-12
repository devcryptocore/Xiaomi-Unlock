<?php
    date_default_timezone_set('America/Bogota');
    $accode = date('Ymd');
    if(isset($_GET['adminaccess']) && $_GET['adminaccess'] === $accode."_admin"){
        $v = time();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../res/css/style.css?v=<?=$v;?>">
</head>
<body>
    <h1>Administración Xiaomi Unlock</h1>
</body>
</html>
<?php
    }
    else {
        header("Location: ../");
    }
?>