<?php

	global $db;	 		global $db_host; 		global $db_user;
	global $db_pass; 	global $db_name; 		global $dbconecterror;
	
	/************** CREAMOS LA TABLA ADMIN ***************/

	global $table_name_a;
	$table_name_a = "`".$_SESSION['clave']."admin`";

	$admin = "CREATE TABLE IF NOT EXISTS `$db_name`.$table_name_a (
  `id` int(4) NOT NULL auto_increment,
  `ref` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `Nivel` varchar(8) collate utf8_spanish2_ci NOT NULL default 'amd',
  `Nombre` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `Apellidos` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `myimg` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `doc` varchar(11) collate utf8_spanish2_ci NOT NULL,
  `dni` varchar(8) collate utf8_spanish2_ci NOT NULL,
  `ldni` varchar(1) collate utf8_spanish2_ci NOT NULL,
  `Email` varchar(50) collate utf8_spanish2_ci NOT NULL,
  `Usuario` varchar(10) collate utf8_spanish2_ci NOT NULL,
  `Password` varchar(100) collate utf8_spanish2_ci NOT NULL,
  `Pass` varchar(10) collate utf8_spanish2_ci NOT NULL,
  `Direccion` varchar(60) collate utf8_spanish2_ci NOT NULL,
  `Tlf1` int(9) NOT NULL default 0,
  `Tlf2` int(9) NOT NULL default 0,
  `lastin` datetime collate utf8_spanish2_ci NOT NULL default CURRENT_TIMESTAMP,
  `lastout` datetime collate utf8_spanish2_ci NOT NULL default CURRENT_TIMESTAMP,
  `visitadmin` int(4) collate utf8_spanish2_ci NOT NULL default '0',
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `ref` (`ref`),
  UNIQUE KEY `dni` (`dni`),
  UNIQUE KEY `Email` (`Email`),
  UNIQUE KEY `Usuario` (`Usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db , $admin)){
					global $table1;
					$table1 = "\t* OK TABLA ADMIN.".PHP_EOL;
				} else {
					global $table1;
					$table1 = "\t* L.15 NO OK TABLA ADMIN. ".mysqli_error($db).PHP_EOL;
					
					}

	/************* CREAMOS LA TABLA FEEDBACK ****************/

	global $table_name_f;
	$table_name_f = "`".$_SESSION['clave']."feedback`";

	$feedback = "CREATE TABLE IF NOT EXISTS `$db_name`.$table_name_f (
		`id` int(4) NOT NULL auto_increment,
		`ref` varchar(20) collate utf8_spanish2_ci NOT NULL,
		`Nivel` varchar(8) collate utf8_spanish2_ci NOT NULL default 'amd',
		`Nombre` varchar(25) collate utf8_spanish2_ci NOT NULL,
		`Apellidos` varchar(25) collate utf8_spanish2_ci NOT NULL,
		`myimg` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
		`doc` varchar(11) collate utf8_spanish2_ci NOT NULL,
		`dni` varchar(8) collate utf8_spanish2_ci NOT NULL,
		`ldni` varchar(1) collate utf8_spanish2_ci NOT NULL,
		`Email` varchar(50) collate utf8_spanish2_ci NOT NULL,
		`Usuario` varchar(10) collate utf8_spanish2_ci NOT NULL,
		`Password` varchar(100) collate utf8_spanish2_ci NOT NULL,
		`Pass` varchar(10) collate utf8_spanish2_ci NOT NULL,
		`Direccion` varchar(60) collate utf8_spanish2_ci NOT NULL,
		`Tlf1` int(9) NOT NULL default 0,
		`Tlf2` int(9) NOT NULL default 0,
		`lastin` datetime collate utf8_spanish2_ci NOT NULL default CURRENT_TIMESTAMP,
		`lastout` datetime collate utf8_spanish2_ci NOT NULL default CURRENT_TIMESTAMP,
		`visitadmin` int(4) collate utf8_spanish2_ci NOT NULL default '0',
		`borrado` datetime collate utf8_spanish2_ci NOT NULL default CURRENT_TIMESTAMP,
		UNIQUE KEY `id` (`id`),
		UNIQUE KEY `ref` (`ref`),
		UNIQUE KEY `dni` (`dni`),
		UNIQUE KEY `Email` (`Email`),
		UNIQUE KEY `Usuario` (`Usuario`)
	  ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
			  
		  if(mysqli_query($db, $feedback)){
						  global $table5;
						  $table5 = "\t* OK TABLA FEEDBACK.".PHP_EOL;
			 } else { global $table5;
					  $table5 = "\t* L.56 NO OK TABLA FEEDBACK. ".mysqli_error($db).PHP_EOL;
						  }

	/************* CREAMOS LA TABLA IP CONTROL****************/

	global $table_name_b;
	$table_name_b = "`".$_SESSION['clave']."ipcontrol`";

	$ipcontrol = "CREATE TABLE IF NOT EXISTS `$db_name`.$table_name_b (
  `id` int(4) NOT NULL auto_increment,
  `ref` varchar(20) collate utf8_spanish2_ci NOT NULL default 'anonimo',
  `nivel` varchar(8) collate utf8_spanish2_ci NOT NULL default 'anonimo',
  `ipn` varchar(22) collate utf8_spanish2_ci NOT NULL default 'lost',
  `error`varchar(4) collate utf8_spanish2_ci NOT NULL default '1',
  `acceso` varchar(4) collate utf8_spanish2_ci NOT NULL default '0',
  `date` date collate utf8_spanish2_ci NOT NULL,
  `time` time collate utf8_spanish2_ci NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $ipcontrol)){
					global $table2;
					$table2 = "\t* OK TABLA IP CONTROL. \n";
				} else {
					global $table2;
					$table2 = "\t* L.97 NO OK TABLA IP CONTROL. ".mysqli_error($db)." \n";
					}
					
	/************* CREAMOS LA TABLA VISITAS ADMIN ****************/

	global $table_name_c;
	$table_name_c = "`".$_SESSION['clave']."visitasadmin`";

	$visitas = "CREATE TABLE IF NOT EXISTS `$db_name`.$table_name_c (
  `idv` int(2) NOT NULL,
  `visita` int(10) NOT NULL,
  `admin` int(10) NOT NULL,
  `deneg` int(10) NOT NULL,
  `acceso` int(10) NOT NULL,
  PRIMARY KEY  (`idv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
		
	if(mysqli_query($db, $visitas)){
		global $link;
		print ("<table align='center'>
							".$link."
				</table>");		

		global $table3;
		$table3 = "\t* OK TABLA VISITAS ADMIN.".PHP_EOL;

	$vd = "INSERT INTO `$db_name`.$table_name_c (`idv`, `visita`, `admin`, `deneg`, `acceso`) VALUES
	(69, 0, 0, 0, 0)";
		if(mysqli_query($db, $vd)){
						global $table4;
						$table4 = "\t* OK INIT VALUES EN VISITAS ADMIN.".PHP_EOL;
		} else { global $table4;
				 $table4 = "\t* L.140 NO OK INIT VALUES EN VISITAS ADMIN. ".mysqli_error($db).PHP_EOL;
						}

	} else {global $table3;
			$table3 = "\t* L.122 NO OK TABLA VISITAS ADMIN. ".mysqli_error($db).PHP_EOL;
			//global $table4;
			//$table4 = "\t*  NO OK INIT VALUES EN VISITAS ADMIN. ".mysqli_error($db).PHP_EOL;
			}


	/************	PASAMOS LOS PARAMETROS A .LOG	*****************/
	
		global $data0;
		$datein = date('Y-m-d H:i:s');
		global $text;
		$logdate = date('Y-m-d');
		$text = $text.PHP_EOL."** CONFIG INIT ".$datein;
		$text = $text.PHP_EOL." * ".$db_name;
		$text = $text.PHP_EOL." * ".$db_host;
		$text = $text.PHP_EOL." * ".$db_user;
		$text = $text.PHP_EOL." * ".$db_pass;
		$text = $text.PHP_EOL.$dbconecterror;
		$text = $text.PHP_EOL.$data0.$table1.$table2.$table3.$table4.$table5;

		ini_log();

	/************	COMPROBAMOS LAS TABLAS AGENDA	*****************/

	global $tablasAgendaLog; 
	if(file_exists("../Mod_Agenda/Integra_Admin/CreaTablasAgenda.php")){
		require "../Mod_Agenda/Integra_Admin/CreaTablasAgenda.php";
	} else { $tablasAgendaLog = "\tNO EXISTE EL MODULO AGENDA\n"; }

	/************	COMPROBAMOS LAS TABLAS CONTACTO	*****************/

		global $tablasContactoLog; 
	if(file_exists("../Mod_Contacto/Integra_Admin/CreaTablasContacto.php")){
		require "../Mod_Contacto/Integra_Admin/CreaTablasContacto.php";
	} else { $tablasContactoLog = "\tNO EXISTE EL MODULO CONTACTO\n"; }

	/************	COMPROBAMOS LAS TABLAS CONTA BASIC	*****************/

		global $tablasContaLog;
	if(file_exists("../Mod_Conta/Integra_Admin/CreaTablasConta.php")){
		require "../Mod_Conta/Integra_Admin/CreaTablasConta.php";
		global $text;
		$tablasContaLog = "\t** SE CREAN LOS LOG DEL CBJ EN: ../Mod_Conta/config/logs/".PHP_EOL.$text.PHP_EOL;
	} else { $tablasContaLog = "\tNO EXISTE EL MODULO CONTA BASIC\n"; } 

	/************	SI EXISTE EL CONSTRUCTOR DE TABLAS ARTICULOS	*****************/
	
		global $tblArtic;		
	if(file_exists('../Mod_Contenidos/Integra_Admin/CreaTablasContenido.php')){
		require '../Mod_Contenidos/Integra_Admin/CreaTablasContenido.php';
		global $text;
		$tblArtic = $text.PHP_EOL;
	}else{ /* NO EXISTE EL ARCHIVO */ $tblArtic = "\tNO EXISTE EL MODULO ARTICULOS\n";}

	/************	PASAMOS LOS PARAMETROS A .LOG	*****************/

		$text = $tablasAgendaLog.$tablasContactoLog.$tablasContaLog.$tblArtic.PHP_EOL;

		ini_log();

?>