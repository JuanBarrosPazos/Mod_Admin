<?php

/* VERIFICO SI EXISTEN TABLAS EN LA BBDD */

    // SOLO SI ES CONFIG:
    if(isset($_POST['config'])){
        $db_host = $_POST['host']; 	$db_user = $_POST['user'];
        $db_pass = $_POST['pass']; 	$db_name = $_POST['name'];
    }else{ 
        require 'Conections/conection.php';
    }        
    
    mysqli_report(MYSQLI_REPORT_OFF);
        global $db;
        @$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
    if (!$db){ echo("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
    }else{
        global $tablas;
        $tablas = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$db_name' AND TABLE_NAME LIKE '%'";
            $result = mysqli_query($db, $tablas); 	$totTablas = mysqli_num_rows($result);
        global $infoTBbdd;
        $infoTBbdd = "<p>TABLAS EN LA BASE DE DATOS: ".$totTablas."</p>";
    }
/* FIN VERIFICACION DE TABLAS EN BBDD */

?>