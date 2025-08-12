<?php
    include('connector.php');
    date_default_timezone_set('America/Bogota');
    $fc = date('Ymd');
    
    if(isset($_GET['setLogin'])){
        $uname = $_POST['username'];
        $upass = $_POST['upass'];

        $verf = $con->prepare("SELECT uname,upassword FROM ingreso WHERE uname=?");
        $verf->bind_param('s',$uname);
        $verf->execute();
        $Rverf = $verf->get_result();
        if($Rverf->num_rows > 0){
            $udat = $Rverf->fetch_assoc();
            if(password_verify($upass,$udat['upassword'])){
                $_SESSION['name'] = $uname;
                $rp = ['status' => 'success', 'response' => '../admin/?adminaccess='.$fc."_admin"];
            }
            else {
                $rp = ['status' => 'wrong', 'response' => 'Contraseña incorrecta'];
            }
        }
        else {
            $rp = ['status' => 'noExists', 'response' => 'Usuario incorrecto'];
        }
        echo json_encode($rp);
    }

?>