<?php

	require 'Inclu/error_hidden.php';
	global $index;
	$index = 1;
	require 'Inclu/Admin_head.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	// LÓGICA DE EJECUCIÓN DEL PROGRAMA DE INSTALACIÓN
	if(isset($_POST['limpia'])){
						global $textConfig;
						$textConfig = "OPCION ELIMINAR TODOS LOS DATOS".PHP_EOL;
						config_one();
						deldirua();
						deldirub();
						deldiruc();
						deltables();
						rewrite();
			 			show_form();
	} elseif(isset($_POST['config'])){
			$_SESSION['inst'] = "noinst";						
		if($form_errors = validate_form()){
			show_form($form_errors);
			} else { process_form();
					require 'Inclu/my_bbdd_clave.php';
					require 'Conections/conection.php';
					mysqli_report(MYSQLI_REPORT_OFF);
					global $db;
					@$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
					if (!$db){ 	global $dbconecterror; // PARA LOG
								$dbconecterror = $db_name." * ".mysqli_connect_error();
								global $text;
								$text = $dbconecterror;
								ini_log();
								print ("** NO CONECTA A BBDD ".$db_name."</br>".mysqli_connect_error());
								show_form();
						} elseif($db) { config_one();
										crear_tablas();
										ayear();
										global $tablepf;
										print($tablepf);
										}
								} // Fin else process_form()
		} else { inittot();
				 show_form();}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function inittot(){

	require 'Conections/conection.php';
	if(isset($cero_conection)){
		// EL ARCHIVO DE CONEXIÓN ES EL ORIGINAL O SE HA SOBREESCRITO
			global $text;
			$text = "ARCHIVO DE CONEXIÓN ORIGINAL\n";
			ini_log();
			$_SESSION['inst'] = "noinst";
			global $inst;
			$inst = '';
	}else{
		// SE INTENTA LA CONEXION A LA BBDD
		// SI NO ES POSIBLE CONECTAR SE APLICAN LOS PARAMETROS "noinst"
		// SI CONSIGUE CONECTAR MUESTRA LAS OPCIONES DISPONIBLES AL USUARIO

	require 'Inclu/error_hidden.php';
	require 'Inclu/my_bbdd_clave.php';
	require 'Conections/conection.php';
	global $db;
	mysqli_report(MYSQLI_REPORT_OFF);
	$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$db){ //print ("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
				$_SESSION['inst'] = "noinst";
				global $inst;
				$inst = '';
	}else{
		//echo "HA CONECTADO CON LA BBDD<br>";
	global $inst;
	$inst = 1;

	/* VERIFICO LAS TABLAS CON LA CLAVE EN LA BBDD */
	require 'config/num_tab_clave_bd.php';
	/* VERIFICO SI EXISTEN TABLAS EN LA BBDD */
	require 'config/num_tab_bd.php';

	/* DETECTA LA CONEXIÓN SIN TABLAS CON CLAVE COINCIDENTE O SIN TABLA ADMIN */
	if(($inst == 1)&&(($countcl < 1)||($countcl < 4)||($countbamd < 1))){
		$_SESSION['inst'] = "inst";
		global $link;
		$link = "<tr>
					<th align='center' class='BorderInf'>
						<font color='#FF0000'>
							0 EXISTE UNA INSTALACION ERRONEA EN BBDD".$infoAdm.$infoTAdmin.$infoTClave.$infoTBbdd."
						</font>
					</th>
				</tr>
				<tr>
					<th align='center'>
						INICIAR UNA INSTALACIÓN LIMPIA
					</th>
				</tr>
				<tr>
			<form name='limpia' action='$_SERVER[PHP_SELF]' method='post' >
				<td  align='center'>
			<input type='submit' value='ELIMINE TODOS LOS DATOS DEL SISTEMA' class='botonrojo' />
			<input type='hidden' name='limpia' value=1 />
			</br></br>
				</td>
			</fomr>
				</tr>";
		global $text;
		$text ="FORMULARIO CONFIG: EXISTE UNA INSTALACION ERRONEA EN LA BBDD";
		ini_log();
	}
	/* DETECTA LA CONEXIÓN Y UNA INSTALACIÓN INCOMPLETA SIN ADMINISTRADOR */
	else if(($inst == 1)&&($countadm < 1)){
		$_SESSION['inst'] = "inst";
		global $link;
		$link = "<tr>
					<th align='center' class='BorderInf'>
						<font color='#FF0000'>
							1 EXISTE UNA INSTALACION INCOMPLETA
							<br>
							SIN ADMINISTRADOR
							".$infoAdm.$infoTClave.$infoTBbdd."
						</font>
					</th>
				</tr>
				<tr>
					<th align='center'>
						CONTINUAR CON ESTA INSTALACIÓN
					</th>
				</tr>
				<tr>
					<td align='center' class='BorderInf'>
						<a href='config/config2.php'>
							CREE EL USUARIO ADMINISTRADOR
			 			</a>
					</td>
				</tr>
				<tr>
					<th align='center'>
						INICIAR UNA INSTALACIÓN LIMPIA
					</th>
				</tr>
				<tr>
			<form name='limpia' action='$_SERVER[PHP_SELF]' method='post' >
				<td  align='center'>
			<input type='submit' value='ELIMINE TODOS LOS DATOS DEL SISTEMA' class='botonrojo' />
			<input type='hidden' name='limpia' value=1 />
				</td>
			</fomr>
				</tr>";
		global $text;
		$text ="FORMULARIO CONFIG: EXISTE UNA INSTALACION INCOMPLETA";
		ini_log();
	/* DETECTA LAS TABLAS CON CLAVE Y LAS DE LA BBDD */
	}elseif(($inst == 1)&&(($countcl >= 4)||($totTablas >= 4))){
			$_SESSION['inst'] = "inst";
			global $link;
			$link = "<tr>
						<th align='center' class='BorderInf'>
							<font color='#FF0000'>
							2 EXISTE UNA INSTALACION ANTERIOR
							".$infoAdm.$infoTAdmin.$infoTClave.$infoTBbdd."
							</font>
						</th>
					</tr>
					<tr>
						<th align='center'>
							MANTENER TABLAS Y DIRECTORIOS
						</th>
					</tr>
					<tr>
				<form name='inscancel' action='config/config2.php' method='post' >
						<td align='center' class='BorderInf'>
				<input type='submit' value='CONTINUE CON LA CONFIGURACIÓN ACTUAL' class='botonverde' />
				<input type='hidden' name='inscancel' value=1 />
				</br></br>
						</td>
				</form>
					</tr>
					<tr>
						<th align='center'>
							INICIAR UNA INSTALACIÓN LIMPIA
						</th>
					</tr>
					<tr>
				<form name='limpia' action='$_SERVER[PHP_SELF]' method='post' >
					<td  align='center'>
				<input type='submit' value='ELIMINE TODOS LOS DATOS DEL SISTEMA' class='botonrojo' />
				<input type='hidden' name='limpia' value=1 />
				</br></br>
					</td>
				</fomr>
					</tr>";
		global $text;
		$text ="FORMULARIO CONFIG: EXISTE UNA INSTALACION ANTERIOR";
		ini_log();

	}else{ 	$_SESSION['inst'] = "noinst";
			global $link;
		   	$link = "<tr>
		   				<td>
							<a href='config/config2.php'>
		   						CREE EL USUARIO ADMINISTRADOR
							</a>
						</td>
					</tr>";
				} // FIN NO HAY DATOS EN LA BBDD
			} // FIN CONDICIONAL SI CONECTO A LA BBDD

	} // FIN PRIMER ELSE

}	// FIN FUNCTION

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function config_one(){

	if(isset($_SESSION['showf'])){unset($_SESSION['showf']);}
	
	$_SESSION['inst'] = "noinst";

	if(file_exists('config/year.txt')){unlink("config/year.txt");
					$data1 = PHP_EOL."\tUNLINK config/year.txt";}
			else {print("DON`T UNLINK config/year.txt </br>");
					$data1 = PHP_EOL."\tDON'T UNLINK config/year.txt";}

	if(file_exists('config/ayear.php')){unlink("config/ayear.php");
					$data2 = PHP_EOL."\tUNLINK config/ayear.php";}
			else {print("DON'T UNLINK config/ayear.php </br>");
					$data2 = PHP_EOL."\tDON'T UNLINK config/ayear.php";}

	if(!file_exists('config/year.txt')){
			if(file_exists('config/year_Init_System.txt')){
				copy("config/year_Init_System.txt", "config/year.txt");
				$data3 = PHP_EOL."\tRENAME config/year_Init_System.txt TO config/year.txt";
			} else {print("DON'T RENAME config/year_Init_System.txt TO config/year.txt </br>");
				$data3 = PHP_EOL."\tDON'T RENAME config/year_Init_System.txt TO config/year.txt";}
			}

	if(!file_exists('config/ayear.php')){
			if(file_exists('config/ayear_Init_System.php')){
				copy("config/ayear_Init_System.php", "config/ayear.php");
				$data4 = PHP_EOL."\tRENAME config/ayear_Init_System.php TO config/ayear.php";
			} else {print("DON'T RENAME config/ayear_Init_System.php TO config/ayear.php </br>");
				$data4 = PHP_EOL."\tDON'T RENAME config/ayear_Init_System.php TO config/ayear.php";}
			}
			
	global $text; global $textConfig;
	$text = $textConfig."SUSTITUCION DE ARCHIVOS:".$data1.$data2.$data3.$data4;
	ini_log();

	} // FIN FUNCTION

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function deldirua(){

	require 'Inclu/my_bbdd_clave.php';
	require 'Conections/conection.php';
	require 'Conections/conect.php';

	global $table_name_a;
	$table_name_a = "`".$_SESSION['clave']."admin`";

	global $sqldu;
	$sqldu = "SELECT * FROM `$db_name`.$table_name_a";
	$qdu = mysqli_query($db, $sqldu);
	if(!$qdu){}
	else{
		// BORRA DIRECTORIOS DENTRO DEL USUARIO
		while($rown = mysqli_fetch_assoc($qdu)){
				$carpeta1 = "Users/".$rown['ref']."/img_admin";
				if(file_exists($carpeta1)){ $dir1 = $carpeta1."/";
											$handle1 = opendir($dir1);
											while ($file1 = readdir($handle1))
													{if (is_file($dir1.$file1))
														{unlink($dir1.$file1);}
													}
											rmdir ($carpeta1);
											} else {}
											
				$carpeta2 = "Users/".$rown['ref']."/log";
				if(file_exists($carpeta2)){ $dir2 = $carpeta2."/";
											$handle2 = opendir($dir2);
											while ($file2 = readdir($handle2))
													{if (is_file($dir2.$file2))
														{unlink($dir2.$file2);}
													}
											rmdir ($carpeta2);
											} else {}

		} // FIN DEL WHILE
	 global $text;
	 $text = "BORRADO DATOS EN SUBDIRECTORIOS USUARIOS.";
	 ini_log();

	} // SE CUMPLE EL QUERY
} // FIN FUNCTION

function deldirub(){

	$carpetat = "Users/temp";
	if(file_exists($carpetat)){ $dirt = $carpetat."/";
								$handlet = opendir($dirt);
								while ($filet = readdir($handlet))
										{if (is_file($dirt.$filet))
											{unlink($dirt.$filet);}
										}
								rmdir ($carpetat);
								} else {}

		require 'Inclu/my_bbdd_clave.php';
		require 'Conections/conection.php';
		require 'Conections/conect.php';

	global $table_name_a;
	$table_name_a = "`".$_SESSION['clave']."admin`";

	global $sqldu;
	$sqldu = "SELECT * FROM `$db_name`.$table_name_a";
	$qdu = mysqli_query($db, $sqldu);
	if(!$qdu){}
	else{
		// BORRA DIRECTORIOS DEL USUARIO
		while($rowu = mysqli_fetch_assoc($qdu)){
			$carpeta4 = "Users/".$rowu['ref'];
			if(file_exists($carpeta4)){ $dir4 = $carpeta4."/";
										$handle4 = opendir($dir4);
										while ($file4 = readdir($handle4))
												{if (is_file($dir4.$file4))
													{unlink($dir4.$file4);}
												}
										rmdir ($carpeta4);
										} else {}
									}
		global $text;
		$text = "BORRADO DATOS Y SUBDIRECTORIOS USUARIOS.";
		ini_log();

		} // SE CUMPLE EL QUERY

	} // FIN FUNCTION

function deldiruc(){

		// BORRA DIRECTORIO USUARIOS
			$carpeta5 = "Users";
			if(file_exists($carpeta5)){ $dir5 = $carpeta5."/";
										$handle5 = opendir($dir5);
										while ($file5 = readdir($handle5))
												{if (is_file($dir5.$file5))
													{unlink($dir5.$file5);}
												}
										//rmdir ($carpeta5);
										} else {}
	global $text;
	$text = "BORRADO DIRECTORIOS USUARIOS.";
	ini_log();

} // FIN FUNCTION


function deltables(){

	require 'Inclu/my_bbdd_clave.php';
	require 'Conections/conection.php';
	require 'Conections/conect.php';

	/*************		BORRAMOS TODAS LAS TABLAS DE USUARIOS Y SISTEMA		***************/

	/* Se busca las tablas en la base de datos */
	/* REFERENCIA DEL USUARIO O $_SESSION['iniref'] = $_POST['ref'] */
	/* $nom PARA LA CLAVE USUARIO ACOMPAÑANDA DE _ O NO */
	global $nom;
	$nom = $_SESSION['clave']."%"; // SOLO COINCIDEN AL PRINCIPIO
	$nom = "LIKE '$nom'";
	
	//$consulta = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME $nom ";

	// CONSULTA PARA BORRAR TODAS LAS TABLAS
	//$consulta = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$db_name' AND TABLE_NAME LIKE '%' ";

	// CONSULTA PARA BORRAR LAS TABLAS CON LA CLAVE DE INSTALACION
	$consulta = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$db_name' AND TABLE_NAME $nom";
	$respuesta = mysqli_query($db, $consulta);
	//$count = mysqli_num_rows($respuesta);
	//print("* NUMERO TABLAS: ".$count."<br>");
	//print("* CLAVE TABLA USUARIO: ".$nom."<br>");

	//global $fila;
	//$fila = mysqli_fetch_row($respuesta);

if(!$respuesta){
print("<font color='#FF0000'>300 Se ha producido un error: </font></br>".mysqli_error($db)."</br>");
	} else { 
		while ($fila = mysqli_fetch_row($respuesta)) {
			if($fila[0]){
		/* PROCEDEMOS A BORRAR LAS TABLAS DEL USUARIO */
			global $sqlt;
			$sqlt = "DROP TABLE `$db_name`.`$fila[0]` ";
			if(mysqli_query($db, $sqlt)){
				} else {
					//print ("<font color='#FF0000'>*** </font></br> ".mysqli_error($db).".</br>");
							} 
		/* HASTA AQUI BORRA TABLAS */
					} // FIN IF $FILA[0]
				} // FIN WHILE

		// SE GRABAN LOS DATOS EN LOG
		global $text;
		$text = "BORRAMOS TODAS LAS TABLAS DE USUARIOS Y SISTEMA.";
		ini_log();
   
	} // FIN ELSE !$respuesta

}

function rewrite(){

/*	unlink("Conections/conection.php");*/

	$bddata = '<?php
	global $cero_conection;
	$cero_conection = 1;
	global $db_host;
	global $db_user;
	global $db_pass;
	global $db_name;
	$db_host = ""; 
	$db_user = ""; 
	$db_pass = ""; 
	$db_name = ""; 
	?>';

	$filename = "Conections/conection.php";
	$config = fopen($filename, 'w+');
	fwrite($config, $bddata);
	fclose($config);
	global $data5;
	$data5 = PHP_EOL."\tREWRITE Conections/conection.php";

	// SE GRABAN LOS DATOS EN LOG
	global $text;
	$text = "SE SOBRE ESCRIBE EL ARCHIVO DE CONEXIONES COMO ORIGINAL.";
	ini_log();

} // FIN FUNCTION

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_form(){
	
	require 'config/validate_Init_System.php';
	
	return $errors;

		} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	/************** CREAMOS EL ARCHIVO DE CONFIGURACIÓN **************/

	$host = "'".$_POST['host']."'";
	$user = "'".$_POST['user']."'";
	$pass = "'".$_POST['pass']."'";
	$name = "'".$_POST['name']."'";
	$clave = "'".$_POST['clave']."'";

	$bddata = '<?php
	global $db_host;
	global $db_user;
	global $db_pass;
	global $db_name;
	$db_host = '.$host.'; 
	$db_user = '.$user.'; 
	$db_pass = '.$pass.'; 
	$db_name = '.$name.'; 
	?>';

	/* CREA EL ARCHIVO DE CONEXIONES */

	$filename = "Conections/conection.php";
	$config = fopen($filename, 'w+');
	fwrite($config, $bddata);
	fclose($config);

	global $text;
	$text ="SE CREA EL ARCHIVO DE CONEXIONES ".$filename."\n\$db_host = ".$host."\n\$db_user = ".$user."\n\$db_pass = ".$pass."\n\$db_name = ".$name;
	ini_log();

	global $tablepf;
	$tablepf = "<table>
				<tr>
					<td colspan='2' align='center'>
							SE HA CREADO EL ARCHIVO DE CONEXIONES.
						</br>
							CON LAS SIGUIENTES VARIABLES.
					</td>
				</tr>

				<tr>
					<td style='text-align:right !important;'>VARIABLE HOST ADRESS</td>
					<td style='text-align:left !important;'>\$db_host = ".$host.";</td>		
				</tr>								

				<tr>
					<td style='text-align:right !important;'>VARIABLE USER NAME</td>
					<td style='text-align:left !important;'>\$db_user = ".$user.";</td>		
				</tr>	
												
				<tr>
					<td style='text-align:right !important;'>VARIABLE PASSWORD</td>
					<td style='text-align:left !important;'>\$db_pass = ".$pass.";</td>		
				</tr>	
												
				<tr>
					<td style='text-align:right !important;'>VARIABLE BBDD NAME</td>
					<td style='text-align:left !important;'>\$db_name = ".$name.";</td>		
				</tr>

				<tr>
					<td style='text-align:right !important;'>CLAVE TABLES BBDD</td>
					<td style='text-align:left !important;'>\$clave = ".$clave.";</td>		
				</tr>

				<tr>
		   			<td colspan=2 align='center' class='BorderSup'>
						<a href='config/config2.php'>
		   					CREE EL USUARIO ADMINISTRADOR
						</a>
					</td>
				</tr>
		</table>";

	$_SESSION["clave"] = strtolower($_POST['clave'])."_";
	// CREA EL ARCHIVO my_bbdd_clave.php $_SESSION['clave'].
	$filenameb = "Inclu/my_bbdd_clave.php";
	$fw2b = fopen($filenameb, 'w+');
	$myclave = '<?php $_SESSION[\'clave\'] = "'.$_SESSION["clave"].'"; ?>';
	fwrite($fw2b, $myclave);
	fclose($fw2b);
	// IMPRIMO LOG
	global $text;
	$text = "SE CREA EL ARCHIVO DE BBDD CLAVE ".$filenameb."\n CON BBDD CLAVE: ".$_SESSION["clave"];
	ini_log();

	} // FIN FUNCTION

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function crear_tablas(){

	// CREA EL DIRECTORIO DE USUARIOS.

	global $data0;
	global $carpeta;
	$carpeta = "Users";
	if (!file_exists($carpeta)) {
		mkdir($carpeta, 0777, true);
		$data0 = "\t* OK DIRECTORIO USUARIOS.".PHP_EOL;
		}
	elseif (!file_exists($carpeta)){ print("* NO HA CREADO EL DIRECTORIO ".$carpeta.PHP_EOL);
									 $data0 = "\t* NO OK DIRECTORIO USUARIOS.".PHP_EOL;
									}
	if (file_exists($carpeta)) {
		copy("config/index.php", $carpeta."/index.php");
		$data0 = $data0."\t* OK SECURE INDEX.PHP".PHP_EOL;;
	} else {}

	global $carpetat;
	$carpetat = "Users/temp";
	if (!file_exists($carpetat)) {
		mkdir($carpetat, 0777, true);
		$data0 = $data0."\t* OK DIRECTORIO TEMP.".PHP_EOL;
		}
	elseif (!file_exists($carpeta)){ print("* NO HA CREADO EL DIRECTORIO ".$carpetat.PHP_EOL);
									 $data0 = $data0."\t* NO OK DIRECTORIO TEMP.".PHP_EOL;
									}
	if (file_exists($carpetat)) {
		copy("config/SecureIndex2.php", $carpetat."/index.php");
		$data0 = $data0."\t* OK SECURE INDEX.PHP".PHP_EOL;;
	} else {}

		require 'Inclu/my_bbdd_clave.php';
		require 'config/Inc_Crea_Tablas.php';

	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function modif(){
									   							
	$filename = "config/ayear.php";
	$fw1 = fopen($filename, 'r+');
	$contenido = fread($fw1,filesize($filename));
	fclose($fw1);
	
	$contenido = explode("\n",$contenido);
	$contenido[2] = "'' => 'YEAR',\n'".date('y')."' => '".date('Y')."',";
	$contenido = implode("\n",$contenido);
	
	//fseek($fw, 37);
	$fw = fopen($filename, 'w+');
	fwrite($fw, $contenido);
	fclose($fw);

	global $text;
	$text = "SE COMPRUEBA EL CAMBIO DE AÑO Y SE MODIFICA EL ARCHIVO DE ARRAY ANUAL ".$filename;
	ini_log();

} // FIN FUNCTION

function modif2(){

	$filename = "config/year.txt";
	$fw2 = fopen($filename, 'w+');
	$date = "".date('Y')."";
	fwrite($fw2, $date);
	fclose($fw2);

	global $text;
	$text = "SE COMPRUEBA EL CAMBIO DE AÑO Y SE MODIFICA EL ARCHIVO SI PROCEDE: ".$filename;
	ini_log();

} // FIN FUCNTION

function ayear(){
	$filename = "config/year.txt";
	$fw2 = fopen($filename, 'r+');
	$fget = fgets($fw2);
	fclose($fw2);
	
	if($fget == date('Y')){}
	elseif($fget != date('Y')){ 	modif();
									modif2();
	} // FIN FUNCTION

} // FIN FUNCTION

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=[]){
	
	/* Se pasan los valores por defecto y se devuelven los que ha escrito el usuario. */
	
	if(isset($_POST['config'])){

		require 'config/num_tab_bd.php';

		$defaults = $_POST;
		} else {$defaults = array ( 'host' => '',
									'user' => '',
									'pass' => '',
									'name' => '',
									'clave' => '',);
								   }
	if ($errors){

		print("	<table align='center'>
					<tr>
						<th style='text-align:center'>
							<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font><br/>
						</th>
					</tr>
					<tr>
						<td style='text-align:left'>");
		global $text;
		$text = "show_form(); ERRORES VALIDACION FORMULARIO CONEXIONES BBDD";
		ini_log();

		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>**</font> ".$errors [$a]."<br/>");

				// ESCRIBE ERRORES EN INI_LOG
				global $text;
				$text = $errors[$a];
				$logdate = date('Y-m-d');
				$logtext = "\t ** ".$text.PHP_EOL;
				$filename = "config/logs/ini_log_".$logdate.".log";
				$log = fopen($filename, 'ab+');
				fwrite($log, $logtext);
				fclose($log);
						}
		print("</td>
				</tr>
				</table>");

		} else { }
					
	global $link;
	if($_SESSION['inst'] == "inst"){ print ("<table align='center'>
														".$link."
											</table>");		
	}else{
	print("<table align='center' style=\"margin-top:10px;\">
					<tr>
					<td style='color:red' align='center'>
					INTRODUZCA LOS DATOS DE CONEXI&Oacute;N A LA BBDD.
							</br>
			SE CREAR&Aacute; EL ARCHIVO DE CONEXI&Oacute;N Y LAS TABLAS DE CONFIGURACI&Oacute;N.
					</td>
				</tr>
			</table>
			
			<table align='center' style=\"margin-top:10px;\">
				<tr>
					<th colspan=2 class='BorderInf'>
							INIT CONFIG DATA
					</th>
				</tr>
				
	<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
						
				<tr>
					<td style='text-align:right !important;' width=140px>	
						<font color='#FF0000'>*</font>
						DB HOST ADRESS
					</td>
					<td width=180px>
		<input type='text' name='host' size=25 maxlength=25 value='".$defaults['host']."' />
					</td>
				</tr>
					
				<tr>
					<td style='text-align:right !important;'>	
						<font color='#FF0000'>*</font>
						DB USER NAME
					</td>
					<td>
		<input type='text' name='user' size=25 maxlength=25 value='".$defaults['user']."' />
					</td>
				</tr>
					
				<tr>
					<td style='text-align:right !important;'>	
						<font color='#FF0000'>*</font>
						DB PASSWORD
					</td>
					<td>
		<input type='text' name='pass' size=25 maxlength=25 value='".$defaults['pass']."' />
					</td>
				</tr>
				
				<tr>
					<td style='text-align:right !important;'>	
						<font color='#FF0000'>*</font>
						DB NAME
					</td>
					<td>
		<input type='text' name='name' size=25 maxlength=25 value='".$defaults['name']."' />
					</td>
				</tr>
					
				<tr>
					<td style='text-align:right !important;'	
						<font color='#FF0000'>*</font>
						TABLES SYSTEM CLAVE
					</td>
					<td>
		<input type='text' name='clave' size=25 maxlength=3 value='".$defaults['clave']."' />
					</td>
				</tr>
					
				<tr>
					<td align='right' valign='middle'  class='BorderSup' colspan='2'>
						<input type='submit' value='INIT CONFIG' class='botonverde' />
						<input type='hidden' name='config' value=1 />
					</td>
				</tr>
		</form>														
			</table>"); 
		} // FIN PRINT TABLE
	
	} // FIN FUNCTION SHOW_FOMR	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function ini_log(){

	$ActionTime = date('H:i:s');

	global $text;

    $logdate = date('Y-m-d');

    $logtext = "** ".$ActionTime.PHP_EOL."\t ** ".$text.PHP_EOL;
    $filename = "config/logs/ini_log_".$logdate.".log";
    $log = fopen($filename, 'ab+');
    fwrite($log, $logtext);
    fclose($log);

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require 'Inclu/Admin_Inclu_footer.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* Creado por Juan Barros Pazos 2021 */
?>