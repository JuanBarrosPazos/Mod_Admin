<?php

	//error_reporting (0);

	$errors = array();

	global $table_name_a;
	$table_name_a = "`".$_SESSION['clave']."admin`";

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require "../config/validateComun.php";
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

		/* VALIDAMOS EL CAMPO my_img */


	if(isset($_POST['modifica'])){

		$limite = 500 * 1024;
		
		$ext_permitidas = array('jpg','JPG','gif','GIF','png','PNG','bmp','BMP');
		$extension = substr(@$_FILES['myimg']['name'],-3);
		// print($extension);
		// $extension = end(explode('.', $_FILES['myimg']['name']) );
		$ext_correcta = in_array($extension, $ext_permitidas);

		/* $tipo_correcto = preg_match('/^image\/(gif|png|jpg|bmp)$/', $_POST['myimg']); */

			if(strlen(trim ($_POST['myimg'])) == 0){
				$errors [] = "Ha de seleccionar un archivo.";
				global $img;
				$img = $_SESSION['myimgcl'];
						}
				}

/* La función devuelve el array errors. */
	
/* Creado por Juan Barros Pazos 2021 */
?>