<?php

	/* VERIFICO LAS TABLAS CON LA CLAVE EN LA BBDD */
	//$table_name_a = "`".$_SESSION['clave']."admin`";
	//echo $table_name_a."<br>";

	/* DETECTO LOS ADMINISTRADORES EN LA TABLA ADMIN */

		global $table_name_a;
		$table_name_a = "`".$_SESSION['clave']."admin`";
		global $sqladm;
		$sqladm = "SELECT * FROM `$db_name`.$table_name_a";
		$queryadm = mysqli_query($db, $sqladm);
			global $infoAdm;
		if($queryadm){
			$countadm = mysqli_num_rows($queryadm);
			$infoAdm = "<p>USARIOS EN LA TABLA ADMIN: ".$countadm."</p>";
		}else{$infoAdm = "";}
	/* FIN DETECTO LOS ADMINISTRADORES EN LA TABLA ADMIN */

	/* DETECTO LAS TABLAS CON CLAVE EN LA BBDD */
		global $sqltcl;
		global $table_name_cl;
		$table_name_cl = $_SESSION['clave']."%";
		$table_name_cl = "LIKE '$table_name_cl'";
		$sqltcl = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$db_name' AND TABLE_NAME $table_name_cl";
		$querycl = mysqli_query($db, $sqltcl);
		$countcl= mysqli_num_rows($querycl);
		global $infoTCalve;
		$infoTClave = "<p>TABLAS EN BBDD CON CLAVE: ".$_SESSION['clave'].": ".$countcl."</p>";
	/* FIN VERIFICO LAS TABLAS CON LA CLAVE EN LA BBDD */

	/* DETECTO LAS TABLA ADMIN */
		global $sqltbamd;
		global $table_name_tbamd;
		$table_name_tbamd = $_SESSION['clave']."admin";
		$sqltbamd = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$db_name' AND TABLE_NAME LIKE '$table_name_tbamd'";
		$querytbamd = mysqli_query($db, $sqltbamd);
		$countbamd = mysqli_num_rows($querytbamd);
		global $infoTCalve;
		$infoTAdmin = "<p>TABLAS AMINISTRADOR: ".$_SESSION['clave']."admin: ".$countbamd."</p>";
	/* FIN DETECTO LAS TABLA ADMIN */

?>