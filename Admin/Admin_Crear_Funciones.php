<?php

function validate_form(){
	
		/*
		global $sqld;
		global $qd;
		global $rowd;
		*/
		
		require '../Inclu/validate.php';	
		
		return $errors;

	} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	global $db;
	global $db_name;
	
/*	REFERENCIA DE USUARIO	*/
global $rf1;	global $rf2;	global $rf3;	global $rf4;

if (preg_match('/^(\w{1})/',$_POST['Nombre'],$ref1)){	$rf1 = $ref1[1];
														$rf1 = trim($rf1);
														/*print($ref1[1]."</br>");*/
																					}
if (preg_match('/^(\w{1})*(\s\w{1})/',$_POST['Nombre'],$ref2)){	$rf2 = $ref2[2];
																$rf2 = trim($rf2);
																/*print($ref2[2]."</br>");*/
																						}
if (preg_match('/^(\w{1})/',$_POST['Apellidos'],$ref3)){	$rf3 = $ref3[1];
															$rf3 = trim($rf3);
																/*print($ref3[1]."</br>");*/
																						}
if (preg_match('/^(\w{1})*(\s\w{1})/',$_POST['Apellidos'],$ref4)){	$rf4 = $ref4[2];
																	$rf4 = trim($rf4);
																/*print($ref4[2]."</br>");*/
																						}

	global $rf;
	$rf = $rf1.$rf2.$rf3.$rf4.$_POST['dni'].$_POST['ldni'];
	$rf = trim($rf);
	$rf = strtolower($rf);

	$_SESSION['iniref'] = $rf;

	/**************************************/
	
		crear_tablas();

	/**************************************/

	// CREA IMAGEN DE USUARIO.

	global $trf;
	$trf = $_SESSION['iniref'];
	global $vn1;
	$vn1 = "img_admin";
	global $carpetaimg;
	$carpetaimg = "../Users/".$trf."/".$vn1;
	global $new_name;
	$new_name = $trf.".png";
	copy("../Images/untitled.png", $carpetaimg."/".$new_name);

	global $nombre;
	global $apellido;
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
	
	global $table_name_a;
	$table_name_a = "`".$_SESSION['clave']."admin`";

	global $password;
	$password = $_POST['Password'] ;
	global $passwordhash;
	$passwordhash = password_hash($password, PASSWORD_DEFAULT, array ( "cost"=>10));

	global $db_name;
	global $tlf2;
	if(strlen(trim($_POST['Tlf2'])) == 0){
		$tlf2 = 0;
	} else { $tlf2 = $_POST['Tlf2']; }

	$sql = "INSERT INTO `$db_name`.$table_name_a (`ref`, `Nivel`, `Nombre`, `Apellidos`, `myimg`, `doc`, `dni`, `ldni`, `Email`, `Usuario`, `Password`, `Pass`, `Direccion`, `Tlf1`, `Tlf2`) VALUES ('$rf', '$_POST[Nivel]', '$_POST[Nombre]', '$_POST[Apellidos]', '$new_name', '$_POST[doc]', '$_POST[dni]', '$_POST[ldni]', '$_POST[Email]', '$_POST[Usuario]', '$passwordhash', '$password', '$_POST[Direccion]', '$_POST[Tlf1]', '$tlf2')";
		
	if(mysqli_query($db, $sql)){
		
	/*	$fil = "%".$rf."%";
		$pimg =  "SELECT * FROM `$db_name`.$table_name_a WHERE `ref` = '$rf' ";
		$qpimg = mysqli_query($db, $pimg);
		$rowpimg = mysqli_fetch_assoc($qpimg);
		$_SESSION['dudas'] = $rowpimg['myimg'];
		global $dudas;
		$dudas = trim($_SESSION['dudas']);
		print("** ".$rowpimg['myimg']);
	*/
	print( "<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=3 class='BorderInf'>
						SE HA REGISTRADO CON ESTOS DATOS.
					</th>
				</tr>
			");
	
			global $rutaimg;
			$rutaimg = "src='".$carpetaimg."/".$new_name."'";
			require 'table_data_resum.php';

	require 'Admin_Botonera.php';

	print("	<tr>
				<td colspan=3 align='right' class='BorderSup'>
					".$inicioadmin.$inicioadmincrear."
				</td>
			</tr>
		</table>");

	$datein = date('Y-m-d H:i:s');
	
	global $dir;
	$dir = "../Users/".$_SESSION['ref']."/log";

	global $text;
	$text = "** CREADO NUEVO USUARIO ".$datein.PHP_EOL."\t User Ref: ".$rf.PHP_EOL."\t Name: ".$_POST['Nombre']." ".$_POST['Apellidos'].PHP_EOL."\t User: ".$_POST['Usuario'].PHP_EOL."\t Pass: ".$_POST['Password'].PHP_EOL;

	require 'log_write.php';

	} else { print("</br>
				<font color='#FF0000'>
			* Estos datos no son validos, modifique esta entrada: </font></br> ".mysqli_error($db))."
				</br>";
				show_form ();
					}
		} // FIN FUNCTION PROCESS_FORM

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function y(){
	
	global $trf;
	$trf = $_SESSION['iniref'];
	$carpeta = "../Users/".$trf;
	$filename = $carpeta."/ayear.php";
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
}

function modif(){

	$filename = "../Users/".$_SESSION['iniref']."/year.txt";
	$fw2 = fopen($filename, 'w+');
	$date = "".date('Y')."";
	fwrite($fw2, $date);
	fclose($fw2);
	}

function crear_tablas(){
	
	global $db_name;
	global $db;	
	global $dbconecterror;
	
	$trf = $_SESSION['iniref'];
	
// CREA EL DIRECTORIO DE USUARIO.

	global $carpeta;
	$carpeta = "../Users/".$trf;

	if (!file_exists($carpeta)) {
		mkdir($carpeta, 0777, true);
		$data1 = "\t* OK DIRECTORIO USUARIO ".$carpeta."\n";
		}
		else{
		//print("* NO OK DIRECTORIO ".$carpeta."\n");
		$data1 = "\t* NO OK DIRECTORIO USUARIO ".$carpeta."\n";
		}

	if (file_exists($carpeta)) {
		copy("../Images/untitled.png", $carpeta."/untitled.png");
		copy("../Images/pdf.png", $carpeta."/pdf.png");
		copy("../config/ayear_Init_System.php", $carpeta."/ayear.php");
		copy("../config/year.txt", $carpeta."/year.txt");
		copy("../config/SecureIndex2.php", $carpeta."/index.php");
		global $data1;
		$data1 = $data1."\t* OK USER SYSTEM FILES ".$carpeta."\n";
		y();
		modif();
		}
		else{
		print("* NO OK USER SYSTEM FILES ".$carpeta."\n");
		global $data1;
		$data1 = $data1."\t* NO OK USER SYSTEM FILES".$carpeta."\n";
		}
	
// CREA EL DIRECTORIO DE IMAGEN DE USUARIO.

	$vn1 = "img_admin";
	$carpetaimg = "../Users/".$trf."/".$vn1;
	if (!file_exists($carpetaimg)) {
		mkdir($carpetaimg, 0777, true);
		copy("../Images/untitled.png", $carpetaimg."/untitled.png");
		$data2 = "\t* OK DIRECTORIO ".$carpetaimg." \n";
		}
		else{print("* NO OK DIRECTORIO ".$carpetaimg."\n");
		$data2 = "\t* NO OK DIRECTORIO ".$carpetaimg."\n";
		}
	
// CREA EL DIRECTORIO DE LOG DE USUARIO.

	$vn1 = "log";
	$carpetalog = "../Users/".$trf."/".$vn1;
	if (!file_exists($carpetalog)) {
		mkdir($carpetalog, 0777, true);
		$data3 = "\t* OK DIRECTORIO ".$carpetalog."\n";
		}
		else{print("* NO OK EL DIRECTORIO ".$carpetalog."\n");
		$data3 = "\t* NO OK DIRECTORIO ".$carpetalog."\n";
		}
	
	/************	PASAMOS LOS PARAMETROS A .LOG	*****************/
	
	$datein = date('Y-m-d H:i:s');
	
	global $dir;
	$dir = "../Users/".$_SESSION['ref']."/log";

	global $text;
	$text = PHP_EOL."** NUEVO USUARIO CREADOS DIRECTORIOS. ".$datein.PHP_EOL." ".$dbconecterror.$data1.$data2.$data3;

	require 'log_write.php';

	} // FIN FUNCTION CREAR_TABLAS	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=[]){
	
	if(isset($_POST['oculto'])){ $defaults = $_POST; } 
	else {  global $array_cero;
			$array_cero = 1;
			require 'admin_array_total.php';
				}
	
	if ($errors){
		print("	<table align='center'>
					<tr>
						<th style='text-align:center'>
							<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font><br/>
						</th>
					</tr>
					<tr>
						<td style='text-align:left !important'>");
			
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>**</font>  ".$errors [$a]."<br/>");
			}
		print("</td>
				</tr>
				</table>");
					}
		
		global $array_nive_doc;
		$array_nive_doc = 1;
		require 'admin_array_total.php';
	
////////////////////				////////////////////				////////////////////

	global $db;
	global $db_name;

	global $table_name_a;
	$table_name_a = "`".$_SESSION['clave']."admin`";

	$nu =  "SELECT * FROM `$db_name`.$table_name_a WHERE $table_name_a.`dni` <> '$_SESSION[webmaster]'";
		$user = mysqli_query($db, $nu);
		//$ruser = mysqli_fetch_assoc($user);
		$nuser = mysqli_num_rows($user);
	
	if ($nuser >= $_SESSION['nuser']){ 
		print("<table align='center' style=\"margin-top:10px;margin-bottom:170px\">
					<tr align='center'>
						<td>
							<b>
								<font color='red'>
									ACCESO RESTRINGIDO.
								</font>	
							</b>
					</br></br>
		EMPLEADOS PERMITIDOS: ".$_SESSION['nuser'].". Nº EMPLEADOS: ".$nuser.". PARA CONTINUAR:
					</br></br>
		ELIMINE ALGUN EMPLEADO EN BORRAR BAJAS O DAR DE BAJA.
						</td>
					</tr>
				</table>");
			}else{

		global $imgform;
		$imgform = "";
		require 'table_crea_admin.php';

			} // FIN CONDICIONAL NUMERO USUARIOS
	
	} // FIN FUNCTION SHOW_FORM

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
		require '../Inclu_Menu/rutaadmin.php';
		require '../Inclu_Menu/Master_Index.php';
		
	} 
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

?>