<?php

    include('config.php');

    $userhost = DBHOST;
    $userdb = DBNAME;
    $username = DBUSER;
    $userpass = DBPASS;
    
    $con = new mysqli($userhost,$username,$userpass,$userdb);
    if($con->connect_error){
        echo("Error de conexión con la base de datos, code: " . $con->connect_error);
        exit();
    }

?>