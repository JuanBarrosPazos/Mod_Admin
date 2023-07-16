<?php

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	/* VALIDAMOS EL CAMPO NOMBRE. */
	
	if(strlen(trim($_POST['Nombre'])) == 0){
		$errors [] = "NOMBRE: CAMPO OBLIGATORIO";
		}
	
	elseif (strlen(trim($_POST['Nombre'])) < 3){
		$errors [] = "NOMBRE: MAS DE DOS CARACTERES";
		}
		
	elseif (!preg_match('/^[^0-9@´`\'áéíóú#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]+$/',$_POST['Nombre'])){
		$errors [] = "NOMBRE: SOLO TEXTO SIN ACENTOS";
		}
		
	/* VALIDAMOS EL CAMPO APELLIDOS. */
	
		if(strlen(trim($_POST['Apellidos'])) == 0){
		$errors [] = "APELLIDOS: CAMPO OBLIGATORIO";
		}
	
	elseif (strlen(trim($_POST['Apellidos'])) < 4){
		$errors [] = "APELLIDOS: MAS DE TRES CARACTERES";
		}
		
	elseif (!preg_match('/^[^0-9@´`\'áéíóú#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]+$/',$_POST['Apellidos'])){
		$errors [] = "APELLIDOS: SOLO TEXTO SIN ACENTOS";
		}
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	/* VALIDAMOS EL CAMPO  NUMERO DNI/NIF */
	global $db;
	global $sqldni;
	global $qdni;
	global $db_name;

	$sqldni =  "SELECT * FROM `$db_name`.$table_name_a WHERE $table_name_a.`dni` = '$_POST[dni]'";
	$qdni = mysqli_query($db, $sqldni);
	if(!$qdni){

	}else{ 
		$rowdni = mysqli_fetch_assoc($qdni);
	}
	
	if ($_POST['id'] == @$rowdni['id']){}
	elseif(mysqli_num_rows($qdni)!= 0){
		
		$errors [] = "NUMERO DNI/NIF: YA EXISTE";
		}
		
	elseif ($_POST['doc'] == 'DNI') {

		if(strlen(trim($_POST['dni'])) == 0){
		$errors [] = "NUMERO DNI/NIF: CAMPO OBLIGATORIO";
		}

	elseif (!preg_match('/^[\d]+$/',$_POST['dni'])){
		$errors [] = "NUMERO DNI/NIF: SOLO NUMEROS";
		}

	elseif (strlen(trim($_POST['dni'])) < 8){
		$errors [] = "NUMERO DNI/NIF: MAS DE 7 CARACTERES";
		}

	}
	
	/* VALIDAMOS EL CAMPO  
							NUMERO NIE/NIF  XYZ - 
							NIF ESPECIAL KLM - 
							NIF PERSONAS JURIDICAS Y ENTIDADES EN GENERAL 
	*/

	/* VALIDACION COMUN A TODAS LAS OPCIONES */
	
	if (($_POST['doc'] == 'NIE') || ($_POST['doc'] == 'NIFespecial') || ($_POST['doc'] == 'NIFsa') || ($_POST['doc'] == 'NIFsrl') || ($_POST['doc'] == 'NIFscol') || ($_POST['doc'] == 'NIFscom') || ($_POST['doc'] == 'NIFcbhy') || ($_POST['doc'] == 'NIFscoop') || ($_POST['doc'] == 'NIFasoc') || ($_POST['doc'] == 'NIFcpph') || ($_POST['doc'] == 'NIFsccspj') || ($_POST['doc'] == 'NIFee') || ($_POST['doc'] == 'NIFcl') || ($_POST['doc'] == 'NIFop') || ($_POST['doc'] == 'NIFcir') || ($_POST['doc'] == 'NIFoaeca') || ($_POST['doc'] == 'NIFute') || ($_POST['doc'] == 'NIFotnd') || ($_POST['doc'] == 'NIFepenr')) {

		if(strlen(trim($_POST['dni'])) == 0){
		$errors [] = "NUMERO NIE/NIF: CAMPO OBLIGATORIO";
		}

	elseif (strlen(trim($_POST['dni'])) < 8){
		$errors [] = "NUMERO NIE/NIF: MAS DE 7 CARACTERES";
		}
		
	elseif (!preg_match('/\b[a-zA-Z]/',$_POST['dni'])){
		$errors [] = "NUMERO NIE/NIF: FALTA LA LETRA";
		}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:"·\(\)=¿?!¡\[\]\{\};,\/:\.\*\s]+$/',$_POST['dni'])){
		$errors [] = "NUMERO NIE/NIF: SIN CARACTERES ESPECIALES";
		}

	elseif (!preg_match('/^[^a-z]+$/',$_POST['dni'])){
		$errors [] = "NUMERO NIE/NIF: SOLO MAYUSCULAS";
		}
		
	
	/* SE VALIDAN LAS LETRAS DEL CAMPO NUMERO NIE/NIF */	
		
	elseif ($_POST['doc'] == 'NIE') {
		
		if (preg_match('/^[^XYZ]+$/',$_POST['dni'])){	// SOLO SE ADMINTE XYZ //
		$errors [] = "NUMERO NIE/NIF: LETRA INVALIDA SOLO X,Y,Z.";
		}
			}
					
	elseif ($_POST['doc'] == 'NIFespecial') {	// SOLO SE ADMINTE KLM //
		
		if (preg_match('/^[^KLM]+$/',$_POST['dni'])){
	$errors [] = "NUMERO NIF ESPECIAL LETRA INVALIDA SOLO K,L,M.";
		}
			}
			
	elseif ($_POST['doc'] == 'NIFsa') {	// SOLO SE ADMITE A //
		
		if (preg_match('/^[^A]+$/',$_POST['dni'])){
	$errors [] = "NUMERO NIF SOCIEDAD ANONIMA: LETRA INVALIDA SOLO A.  ";
		}
			}
			
	elseif ($_POST['doc'] == 'NIFsrl') {	// SOLO SE ADMITE B //
		
		if (preg_match('/^[^B]+$/',$_POST['dni'])){
	$errors [] = "NUMERO NIF SOCIEDAD RESPONSABILIDAD LIMITADA: LETRA INVALIDA SOLO B.";
		}
			}
		
	elseif ($_POST['doc'] == 'NIFscol') {	// SOLO SE ADMITE C //
		
		if (preg_match('/^[^C]+$/',$_POST['dni'])){
	$errors [] = "NUMERO NIF SOCIEDAD COLECTIVA: LETRA INVALIDA SOLO C.";
		}
			}
			
	elseif ($_POST['doc'] == 'NIFscom') {	// SOLO SE ADMITE D //
		
		if (preg_match('/^[^D]+$/',$_POST['dni'])){
	$errors [] = "NUMERO NIF SOCIEDAD COMANDITARIA: LETRA INVALIDA SOLO D.";
		}
			}
			
	elseif ($_POST['doc'] == 'NIFcbhy') {	// SOLO SE ADMITE E //
		
		if (preg_match('/^[^E]+$/',$_POST['dni'])){
	$errors [] = "NUMERO NIF COMUNIDAD BIENES Y HERENCIAS YACENTES: LETRA INVALIDA SOLO E.";
		}
			}
			
	elseif ($_POST['doc'] == 'NIFscoop') {	// SOLO SE ADMITE F //
		
		if (preg_match('/^[^F]+$/',$_POST['dni'])){
	$errors [] = "NUMERO NIF SOCIEDAD COOPERATIVA: LETRA INVALIDA SOLO F.";
		}
			}
			
	elseif ($_POST['doc'] == 'NIFasoc') {	// SOLO SE ADMITE G //
		
		if (preg_match('/^[^G]+$/',$_POST['dni'])){
	$errors [] = "NUMERO NIF ASOCIACIONES: LETRA INVALIDA SOLO G.";
		}
			}
			
	elseif ($_POST['doc'] == 'NIFcpph') {	// SOLO SE ADMITE H //
		
		if (preg_match('/^[^H]+$/',$_POST['dni'])){
	$errors [] = "NUMERO NIF COMUNIDAD PROPIETARIOS PROPIEDAD HORIZONTAL: LETRA INVALIDA SOLO H.";
		}
			}
			
	elseif ($_POST['doc'] == 'NIFsccspj') {	// SOLO SE ADMITE J //
		
		if (preg_match('/^[^J]+$/',$_POST['dni'])){
	$errors [] = "NUMERO NIF SOCIEDAD CIVIL CON O SIN PERSONALIDAD JURIDICA: LETRA INVALIDA SOLO J.";
		}
			}
			
	elseif ($_POST['doc'] == 'NIFee') {	// SOLO SE ADMITE N //
		
		if (preg_match('/^[^N]+$/',$_POST['dni'])){
		$errors [] = "NUMERO NIF ENTIDAD EXTRANJERA: LETRA INVALIDA SOLO N.";
		}
			}
			
	elseif ($_POST['doc'] == 'NIFcl') {	// SOLO SE ADMITE P //
		
		if (preg_match('/^[^P]+$/',$_POST['dni'])){
		$errors [] = "NUMERO NIF CORPORACION LOCAL: LETRA INVALIDA SOLO P.";
		}
			}
			
	elseif ($_POST['doc'] == 'NIFop') {	// SOLO SE ADMITE Q //
		
		if (preg_match('/^[^Q]+$/',$_POST['dni'])){
		$errors [] = "NUMERO NIF ORGANISMO PUBLICO: LETRA INVALIDA SOLO Q.";
		}
			}
			
	elseif ($_POST['doc'] == 'NIFcir') {	// SOLO SE ADMITE R //
		
		if (preg_match('/^[^R]+$/',$_POST['dni'])){
		$errors [] = "NUMERO NIF CONGRAGACIONES INSTITUCIONES RELIGIOSAS: LETRA INVALIDA SOLO R.";
		}
			}
			
	elseif ($_POST['doc'] == 'NIFoaeca') {	// SOLO SE ADMITE S //
		
		if (preg_match('/^[^S]+$/',$_POST['dni'])){
		$errors [] = "NUMERO NIF ORGANISMOS ADMIN ESTADO Y COMUNIDADES AUTONOMAS: LETRA INVALIDA SOLO S.";
		}
			}
		
	elseif ($_POST['doc'] == 'NIFute') {	// SOLO SE ADMITE U //
		
		if (preg_match('/^[^U]+$/',$_POST['dni'])){
		$errors [] = "NUMERO NIF UNION TEMPORAL DE EMPRESAS: LETRA INVALIDA SOLO U.";
		}
			}
		
	elseif ($_POST['doc'] == 'NIFotnd') {	// SOLO SE ADMITE V //
		
		if (preg_match('/^[^V]+$/',$_POST['dni'])){
		$errors [] = "NUMERO NIF OTROS TIPOS NO DEFINIDOS: LETRA INVALIDA SOLO V.";
		}
			}
		
	elseif ($_POST['doc'] == 'NIFepenr') {	// SOLO SE ADMITE W //
		
		if (preg_match('/^[^W]+$/',$_POST['dni'])){
		$errors [] = "NUMERO NIF ESTABLECIMIENTOS PERMANENTES ENTIDADES NO RESIDENTES: LETRA INVALIDA SOLO W.";
		}
			}
		
			} /* FIN PRIMER CONDICIONAL IF DEL CAMPO NUMERO */
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	/* VALIDAMOS LA LETRA DE CONTROL DEL DNI */

			/* DEFINO EL ALGORITMO PARA EL CALCULO DE LA LETRA CONTROL DEL DNI */
		
						$letras = 'TRWAGMYFPDXBNJZSQVHLCKE';
						$dni = $_POST['dni'];
						$indice = intval($_POST['dni'])%23;
						$letra = $letras[$indice];
	
			/* FIN DEL ALGORITMO DE DEFINICION DEL LA LETRA CONTROL DEL DNI */
	
	if ($_POST['doc'] == 'DNI') {
		
		if(strlen(trim($_POST['ldni'])) == 0){
		$errors [] = "LETRA DNI: CAMPO OBLIGATORIO";
		}

	elseif (!preg_match('/^[^0-9@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]+$/',$_POST['ldni'])){
		$errors [] = "LETRA CONTROL DNI: Solo texto";
		}

	elseif (!preg_match('/^[^a-z]+$/',$_POST['ldni'])){
		$errors [] = "LETRA CONTROL DNI: SOLO MAYUSCULAS";
		}

	elseif (trim($_POST['ldni'] != $letra)){
	$errors [] = "LETRA CONTROL DNI: LETRA NO CORRECTA $letra IS OK.";
		}
	}
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	/* VALIDAMOS LA LETRA DE CONTROL DE NIE EXTRANJEROS NORMAL Y ESPECIALES */
	
		/* DEFINO DEL ALGORITMO PARA EL CALCULO DE LA LETRA CONTROL DEL NIE NORMAL */

		// Si es un NIE hay que cambiar la primera letra por 0, 1 ó 2 dependiendo de si es X, Y o Z.
					$dni2 = $_POST['dni'];
					$dni2 = strtoupper($dni2);
				 
					$letra2 = substr($dni2, -1, 1);
					$numero = substr($dni2, 0, 8);
 
		// Si es un NIE hay que cambiar la primera letra por 0, 1 ó 2 dependiendo de si es X, Y o Z.
	
					$numero = str_replace(array('X', 'Y', 'Z'), array(0, 1, 2), $numero);	
				 
					$modulo = (int) $numero % 23;
					$letras_validas = "TRWAGMYFPDXBNJZSQVHLCKE";
					$letra2 = substr($letras_validas, $modulo, 1);
		//	print ("ESTA ES LA LETRA NIE $letra2 </br>");
	
		/* FIN DE LA FUNCION PARA EL CALCULO DE LA LETRA CONTROL DEL NIE NORMAL */


		/* DEFINO EL ALGORITMO PARA EL CALCULO DE LA LETRA CONTROL DEL NIE/NIF ESPECIAL */

		global $num1;	global $num2;	global $num3;	global $num4;
		global $num5;	global $num6;	global $num7;

		if(strlen(trim($_POST['dni'])) == 0){ }
		else {	$dni3 = $_POST['dni'];
			
				$num1 = $dni3[1];
				$num2 = $dni3[2];
				$num3 = $dni3[3];
				$num4 = $dni3[4];
				$num5 = $dni3[5];
				$num6 = $dni3[6];
				$num7 = $dni3[7];
			}

			$sumaa = $num2 + $num4 + $num6 ;
			// print ("LA SUMA A: $num2 + $num4 + $num6 = $sumaa </br>");
			
			$sumab1 = $num1 * 2;
			$sumab1 = "$sumab1";
			if ($sumab1 < 10){ 	$sumab1st = "0$sumab1";
								$sumab1tot = ($sumab1st[0] + $sumab1st[1]);
														}
								elseif ($sumab1 > 9) { 	$sumab1st = "$sumab1";
														$sumab1tot = ($sumab1st[0] + $sumab1st[1]);}
			$sumab3 = $num3 * 2;
			$sumab3 = "$sumab3";
			if ($sumab3 < 10){ 	$sumab3st = "0$sumab3";
								$sumab3tot = ($sumab3st[0] + $sumab3st[1]);
														}
								elseif ($sumab3 > 9) { 	$sumab3st = "$sumab3";
														$sumab3tot = ($sumab3st[0] + $sumab3st[1]);}
			$sumab5 = $num5 * 2;
			$sumab5 = "$sumab5";
			if ($sumab5 < 10){ 	$sumab5st = "0$sumab5";
								$sumab5tot = ($sumab5st[0] + $sumab5st[1]);
														}
								elseif ($sumab5 > 9) { 	$sumab5st = "$sumab5";
														$sumab5tot = ($sumab5st[0] + $sumab5st[1]);}
			$sumab7 = $num7 * 2;
			$sumab7 = "$sumab7";
			if ($sumab7 < 10){ 	$sumab7st = "0$sumab7";
								$sumab7tot = ($sumab7st[0] + $sumab7st[1]);
														}
								elseif ($sumab7 > 9) { 	$sumab7st = "$sumab7";
														$sumab7tot = ($sumab7st[0] + $sumab7st[1]);}
			
			$sumab = $sumab1tot + $sumab3tot + $sumab5tot + $sumab7tot;
			
			/* 
			print ("LA SUMA B: ( $num1 x 2 = $sumab1 => $sumab1st[0] + $sumab1st[1] = $sumab1tot ) + ( $num3 x 2 = $sumab3 => $sumab3st[0] + $sumab3st[1] = $sumab3tot ) + ( $num5 x 2 = $sumab5 => $sumab5st[0] + $sumab5st[1] = $sumab5tot ) + ( $num7 x 2 = $sumab7 => $sumab7st[0] + $sumab7st[1] = $sumab7tot ) = ($sumab1tot + $sumab3tot + $sumab5tot + $sumab7tot) =$sumab </br>");
			*/
			
			$sumatot = $sumaa + $sumab;
			// print ("SUMA A $sumaa + SUMA B $sumab = SUMA TOTAL $sumatot </br>");
			
			$sumatotc = $sumatot;
			
			if (@$sumatotc[1] == 0) {	$sumacont = 0;
										// print ("TOTAL SUMA CONTROL = $sumacont </br>");
													}
													
				else {	$sumacont = 10 - $sumatotc[1];
								// print ("TOTAL SUMA CONTROL = 10 - $sumatotc[1] = $sumacont </br>");
														}
														
			$nifcontrolnumero = "0123456789";
			$nifcontrolletra = "JABCDEFGHI";
			 
			$nifnumero = $nifcontrolnumero[$sumacont];
			$nifletra = $nifcontrolletra[$sumacont];
			
			// print ("NUMERO: $nifnumero </br>");
			// print ("LETRA: $nifletra </br>");


		/* FIN DEL LA FUNCION PARA EL CALCULO DE LA LETRA CONTROL DEL NIE/NIF ESPECIAL */


		/* CONDICIONAL PARA TODOS LOS NIE/NIF */
		
	if (($_POST['doc'] == 'NIE') || ($_POST['doc'] == 'NIFespecial') || ($_POST['doc'] == 'NIFsa') || ($_POST['doc'] == 'NIFsrl') || ($_POST['doc'] == 'NIFscol') || ($_POST['doc'] == 'NIFscom') || ($_POST['doc'] == 'NIFcbhy') || ($_POST['doc'] == 'NIFscoop') || ($_POST['doc'] == 'NIFasoc') || ($_POST['doc'] == 'NIFcpph') || ($_POST['doc'] == 'NIFsccspj') || ($_POST['doc'] == 'NIFee') || ($_POST['doc'] == 'NIFcl') || ($_POST['doc'] == 'NIFop') || ($_POST['doc'] == 'NIFcir') || ($_POST['doc'] == 'NIFoaeca') || ($_POST['doc'] == 'NIFute') || ($_POST['doc'] == 'NIFotnd') || ($_POST['doc'] == 'NIFepenr')) 
	
	{
		if(strlen(trim($_POST['ldni'])) == 0){
		$errors [] = "LETRA CONTROL NIE/NIF: CAMPO OBLIGATORIO";
		}
		

		/* CONDICIONAL PARA TODOS LOS NIE/NIF CON LETRA DE CONTROL */
		
	elseif(($_POST['doc'] == 'NIE') || ($_POST['doc'] == 'NIFespecial') || ($_POST['doc'] == 'NIFee') || ($_POST['doc'] == 'NIFcl') || ($_POST['doc'] == 'NIFop') || ($_POST['doc'] == 'NIFcir') || ($_POST['doc'] == 'NIFoaeca') || ($_POST['doc'] == 'NIFepenr'))
	
	{		
		if (!preg_match('/^[^0-9@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]+$/',$_POST['ldni'])){
		$errors [] = "LETRA CONTROL NIE/NIF: SOLO TEXTO";
		}
		
	elseif (!preg_match('/^[^a-z]+$/',$_POST['ldni'])){
		$errors [] = "LETRA CONTROL NIE/NIF: SOLO MAYUSCULAS.";
		}
		
		
		/* CONDICIONAL PARA VALIDAR LA LETRA CONTROL DEL NIE/NIF NORMAL*/
		
	elseif ($_POST['doc'] == 'NIE') {
		
		if (trim($_POST['ldni'] != $letra2)){
	$errors [] = "LETRA CONTROL NIE EXTRANJEROS: LETRA NO CORRECTA";
		}

	}
			
		/* CONDICIONAL PARA VALIDAR LA LETRA CONTROL DEL NIF ESPECIAL Y OTROS CON LETRA */
		
	elseif (($_POST['doc'] == 'NIFespecial') || ($_POST['doc'] == 'NIFee') || ($_POST['doc'] == 'NIFcl') || ($_POST['doc'] == 'NIFop') || ($_POST['doc'] == 'NIFcir') || ($_POST['doc'] == 'NIFoaeca') || ($_POST['doc'] == 'NIFepenr')) {
		
		if (trim($_POST['ldni'] != $nifletra)){
	$errors [] = "LETRA CONTROL NIF ESPECIAL LETRA NO CORRECTA";
		}

	}
		
			} 	/* FIN CONDICIONAL PARA TODOS LOS NIE/NIF CON LETRA DE CONTROL */
				
				
		/* CONDICIONAL PARA TODOS LOS NIF CON NUMERO DE CONTROL */
		
	elseif (($_POST['doc'] == 'NIFsa') || ($_POST['doc'] == 'NIFsrl') || ($_POST['doc'] == 'NIFscol') || ($_POST['doc'] == 'NIFscom') || ($_POST['doc'] == 'NIFcbhy') || ($_POST['doc'] == 'NIFscoop') || ($_POST['doc'] == 'NIFasoc') || ($_POST['doc'] == 'NIFcpph') || ($_POST['doc'] == 'NIFsccspj') || ($_POST['doc'] == 'NIFute') || ($_POST['doc'] == 'NIFotnd')) {
		
		if (!preg_match('/^[\d]+$/',$_POST['ldni'])){
		$errors [] = "NUMERO CONTROL NIF ESPECIAL SOLO NUMEROS";
		}
		
			/* CONDICIONAL PARA VALIDAR EL NUMERO DE CONTROL */
		
	else {
		
		if (trim($_POST['ldni'] != $nifnumero)){
	$errors [] = "NUMERO CONTROL NIF ESPECIAL NUMERO INCORRECTO";
		}

	}
			} 		/* fIN CONDICIONAL PARA TODOS LOS NIF CON NUMERO DE CONTROL */

			} /* FIN PRIMER IF */
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	/* VALIDAMOS EL CAMPO NIVEL. */
	
	if(strlen(trim($_POST['Nivel'])) == 0){
		$errors [] = "NIVEL: CAMPO OBLIGATORIO";
		}
	
	/* VALIDAMOS EL CAMPO MAIL. */
	
	global $db;
	global $sqlml;
	global $qml;
	global $db_name;

	$sqlml =  "SELECT * FROM `$db_name`.$table_name_a WHERE $table_name_a.`Email` = '$_POST[Email]'";
	$qml = mysqli_query($db, $sqlml);
	if(!$qml){ }else{ $rowml = mysqli_fetch_assoc($qml); }

	if ($_POST['id'] == @$rowml['id']){}
	elseif(mysqli_num_rows($qml)!= 0){
		$errors [] = "MAIL: YA EXISTE";
		}
		
	if(strlen(trim($_POST['Email'])) == 0){
		$errors [] = "MAIL: CAMPO OBLIGATORIO";
		}
	
	elseif (strlen(trim($_POST['Email'])) < 5 ){
		$errors [] = "MAIL: ESCRIBA MAS DE 5 CARACTERES";
		}
		
	elseif (!preg_match('/^[^A-Z]+$/',$_POST['Email'])){
		$errors [] = "MAIL: SOLO MINUSCULAS";
		}

	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:*\s]+@([-a-z0-9]+\.)+[a-z]{2,}$/',$_POST['Email'])){
		$errors [] = "MAIL: DIRECCION NO VALIDA";
		}
		
/* if(trim($_POST['id'] == $rowd['id'])&&(!strcasecmp($_POST['Email'] , $rowd['Email']))){}
			elseif(!strcasecmp($_POST['Email'] , $rowd['Email'])){
				$errors [] = "MAIL: No se puede registrar con este Mail.";
				}	
	
	elseif(!strcasecmp($_POST['Email'] , $rowd['Email'])){
		$errors [] = "MAIL: No se puede registrar con este Mail.";
		}	
*/
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	/* VALIDAMOS EL CAMPO USUARIO. */
	
	global $db;
	global $sqlus;
	global $qus;
	global $db_name;

	$sqlus =  "SELECT * FROM `$db_name`.$table_name_a WHERE $table_name_a.`Usuario` = '$_POST[Usuario]'";
	$qus = mysqli_query($db, $sqlus);
	if(!$qus){ }else{ $rowus = mysqli_fetch_assoc($qus); }
	
	if ($_POST['id'] == @$rowus['id']){}
	elseif(mysqli_num_rows($qus)!= 0){
		$errors [] = "USUARIO: YA EXISTE";
		}

	if(strlen(trim($_POST['Usuario'])) == 0){
		$errors [] = "USUARIO: CAMPO OBLIGATORIO";
		}
	
	elseif (strlen(trim($_POST['Usuario'])) < 3){
		$errors [] = "USUARIO: ESCRIBA MAS DE 3 CARACTERES";
		}
			
	elseif (!preg_match('/^\b[^@#$%&<>\?\[\]\{\}\+\s]+$/',$_POST['Usuario'])){
		$errors [] = "USUARIO: SIN CARACTERES ESPECIALES";
		}

	elseif(trim($_POST['Usuario'] != $_POST['Usuario2'])){
		$errors [] = "USUARIO: NO SON IGUALES LOS CAMPOS USUARIO";
		}
		
		
/*	if(trim($_POST['id'] == $rowd['id'])&&(!strcasecmp($_POST['Usuario'] , $rowd['Usuario']))){}
			elseif(!strcasecmp($_POST['Usuario'] , $rowd['Usuario'])){
				$errors [] = "USUARIO: No se puede registrar con este nombre de usuario.";
				}

	elseif(!strcasecmp($_POST['Usuario'] , $rowd['Usuario'])){
		$errors [] = "USUARIO: No se puede registrar con este nombre de usuario.";
		}	
*/
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	/* VALIDAMOS EL CAMPO PASSWORD. */
	
		if(strlen(trim($_POST['Password'])) == 0){
		$errors [] = "PASSWORD: CAMPO OBLIGATORIO";
		}
	
	elseif (strlen(trim($_POST['Password'])) < 3){
		$errors [] = "PASSWORD: ESCRIBA MAS DE 3 CARACTERES";
		}
			
	elseif (!preg_match('/^\b[^@#$%&<>\?\[\]\{\}\+\s]+$/',$_POST['Password'])){
		$errors [] = "PASSWORD: SIN CARACTERES ESPECIALES";
		}

	elseif(trim($_POST['Password'] != $_POST['Password2'])){
		$errors [] = "PASSWORD: NO SON IGUALES LOS CAMPOS PASSWORD";
		}
	

	/* VALIDAMOS EL CAMPO DIRECCION. */
	
		if(strlen(trim($_POST['Direccion'])) == 0){
		$errors [] = "DIRECCION: CAMPO OBLIGATORIO";
		}
	
	elseif (!preg_match('/^\b[^@#$%&<>\?\[\]\{\}\+]+$/',$_POST['Direccion'])){
		$errors [] = "DIRECCION: SIN CARACTERES ESPECIALES";
		}
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	/* VALIDAMOS EL CAMPO  Tlf1 */
	
	global $db;
	global $db_name;

	$sqltlf1 =  "SELECT * FROM `$db_name`.$table_name_a WHERE $table_name_a.`Tlf1` = '$_POST[Tlf1]' OR $table_name_a.`Tlf2` = '$_POST[Tlf1]' ";
	$qtlf1 = mysqli_query($db, $sqltlf1);
	if(!$qtlf1){ }else{ 
		$countlf1 = mysqli_num_rows($qtlf1);
		$rowtlf1 = mysqli_fetch_assoc($qtlf1);
	}

	if ($_POST['id'] == @$rowtlf1['id']){}
	elseif($countlf1 != 0){
		$errors [] = "TELEFONO 1: YA EXISTE";
		}

	if(strlen(trim($_POST['Tlf1'])) == 0){
		$errors [] = "TELEFONO 1: CAMPO OBLIGATORIO";
		}
	
	elseif ((trim($_POST['Tlf1'])) == (trim($_POST['Tlf2']))){
					$errors [] = "Teléfono 1 y 2: SON IGUALES";
		}

	elseif (!preg_match('/^[\d]+$/',$_POST['Tlf1'])){
		$errors [] = "TELEFONO 1: SOLO NUMEROS";
		}

	elseif (strlen(trim($_POST['Tlf1'])) < 9){
		$errors [] = "TELEFONO 1: NO MENOS DE 9 NUMEROS";
		}
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	/* VALIDAMOS EL CAMPO Tlf2 */
	
	if(strlen(trim($_POST['Tlf2'])) > 0){

		$sqltlf2 =  "SELECT * FROM `$db_name`.$table_name_a WHERE $table_name_a.`Tlf1` = '$_POST[Tlf2]' OR $table_name_a.`Tlf2` = '$_POST[Tlf2]'";
		$qtlf2 = mysqli_query($db, $sqltlf2);
		if(!$qtlf2){ }else{ 
			$rowtlf2 = mysqli_fetch_assoc($qtlf2);
			$countlf2 = mysqli_num_rows($qtlf2);
		}
		
		if ($_POST['id'] == @$rowtlf2['id']){}
		elseif($countlf2 > 0){
				$errors [] = "TELEFONO 2: YA EXISTE";
		}
				
		elseif (!preg_match('/^[\d]+$/',$_POST['Tlf2'])){
			$errors [] = "TELEFONO 2: SOLO NUMEROS";
			}
		
		elseif (strlen(trim($_POST['Tlf2'])) < 9){
			$errors [] = "TELEFONO 2: NO MENOS DE 9 NUMEROS";
			}

		}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

?>