<?php
session_start();

	global $docs;
	$docs = 1;
	global $popup;
	$popup = 1;
	
	require '../Inclu/error_hidden.php';
	require '../Inclu/Admin_head.php';
	require '../Conections/conection.php';
	require '../Conections/conect.php';
	require '../Inclu/my_bbdd_clave.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if (($_SESSION['Nivel'] == 'admin')||($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){
				
	global $nombre;
	global $apellido;
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
							
				if($_POST['oculto2']){	process_form();
										UserLog();
											} 
				} else { require '../Inclu/table_permisos.php'; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	global $nombre;
	global $apellido;
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
	
	print("<table align='center'>
				<tr>
					<th colspan=3  class='BorderInf'>
						DATOS DEL USUARIO
					</th>
				</tr>
			");

			global $rutaimg;
			$rutaimg = "src='../Users/".$_POST['ref']."/img_admin/".$_POST['myimg']."'";
			require 'table_data_resum.php';

	print("<tr>
				<td colspan=3 align='right' class='BorderSup'>
					<form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
						<input type='submit' value='CERRAR VENTANA' class='botonrojo' />
						<input type='hidden' name='oculto2' value=1 />
					</form>
				</td>
			</tr>
		</table>"); 

		}
			
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function UserLog(){

	global $nombre;
	global $apellido;
		
	$rf = $_POST['ref'];
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
		
	$ActionTime = date('H:i:s');
	
	global $dir;
	$dir = "../Users/".$_SESSION['ref']."/log";
	
	global $text;
	$text = PHP_EOL."** USERS VER DETALLES ".$ActionTime.PHP_EOL."\t Nombre: ".$nombre." ".$apellido;

	require 'log_write.php';

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Inclu/Admin_Inclu_footer.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* Creado por Juan Barros Pazos 2021 */
?>
