<?php

	require 'Admin_Botonera.php';

	if (isset($modifadmin)){ 
		global $title;
		$title = "<img src='../Users/".$_SESSION['refcl']."/img_admin/".$_POST['myimg']."' height='44px' width='33px' />
					</br>MODIFIQUE LOS DATOS DEL ADMINISTRADOR";
		global $title2;
		$title2 = "<input name='ref' type='hidden' value='".$_SESSION['refcl']."' />".$defaults['ref'];
		global $title3;
		$title3 = "MODIFICAR DATOS USUARIO";
		global $title4;
		$title4 = "modifica";
		global $closewin;
		$closewin = "<tr><td colspan=3 style='text-align:right !important;' class='BorderSup BorderInf'>
			<form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
				<input type='submit' value='CERRAR VENTANA' class='botonrojo' />
				<input type='hidden' name='closewin' value=1 />
			</form></td></tr>"; 
	}
	elseif (!isset($modifadmin)){ 
		global $title;
		$title = "DATOS DEL NUEVO ADMINISTRADOR";
		global $title2;
		$title2 = "SE GENERA LA CLAVE AUTOMÁTICAMENTE";
		global $title3;
		$title3 = "REGISTRARME CON ESTOS DATOS";
		global $title4;
		$title4 = "oculto";
		if(isset($config2)){ global $closewin;
							 $closewin = ""; }
		else { 	global $closewin;
				$closewin = "<tr><td colspan=3 style='text-align:center;' class='BorderInf'>".$inciobajas.$inicioadmin."</td></tr>";
					}
	 }

	print("<table style=\"margin-top:6px\">
				<tr>
					<th colspan=2 class='BorderInf'>".$title."</th>
				</tr>".$closewin."
				
		<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>

			<input name='id' type='hidden' value='".@$defaults['id']."' />				
			<input name='myimg' type='hidden' value='".@$_POST['myimg']."' />					
						
				<tr>
					<td style='text-align:right !important; width:140px;' >	
						<font color='#FF0000'>*</font> Ref User:
					</td>
					<td style='text-align:left !important; width:290px;'>
						".$title2." 
					</td>
				</tr>
					
				<tr>
					<td style='text-align:right !important;'>	
						<font color='#FF0000'>*</font> NOMBRE:
					</td>
					<td style='text-align:left !important;'>
		<input type='text' name='Nombre' id='Nombre' size=28 maxlength=25 pattern='[a-zA-Z\s]{3,25}' placeholder='MI NOMBRE' value='".$defaults['Nombre']."' required />
					</td>
				</tr>
				<tr>
					<td style='text-align:right !important;'>
						<font color='#FF0000'>*</font> APELLIDOS:
					</td>
					<td style='text-align:left !important;'>
		<input type='text' name='Apellidos' id='Apellidos' size=28 maxlength=25 pattern='[a-zA-Z\s]{3,25}' placeholder='MIS APELLIDOS' value='".$defaults['Apellidos']."' required />
					</td>
				</tr>
				<tr>
					<td style='text-align:right !important;'>
						<font color='#FF0000'>*</font> DOCUMENTO:
					</td>
					<td style='text-align:left !important;'>");
	
	// INICIO SI ES USER O PLUS SE LIMITA EL FORMULARIO 
	if((@$_SESSION['Nivel'] == 'user') || (@$_SESSION['Nivel'] == 'plus')){ 

		print("	<input type='hidden' name='doc' value='".$defaults['doc']."' />".$defaults['doc']);

		}

	else { print("<select name='doc'>");
					foreach($doctype as $option => $label){
						print ("<option value='".$option."' ");
						if($option == $defaults['doc']){print ("selected = 'selected'");}
														print ("> $label </option>");
													}	
			print ("</select>");
		}
	// FIN SI ES USER O PLUS SE LIMITA EL FORMULARIO 

			print("</td>
				</tr>

				<tr>
					<td style='text-align:right !important;'>
						<font color='#FF0000'>*</font> N&Uacute;MERO:
					</td>
					<td style='text-align:left !important;'>");

		// INICIO SI ES USER O PLUS SE LIMITA EL FORMULARIO 
		if((@$_SESSION['Nivel'] == 'user') || (@$_SESSION['Nivel'] == 'plus')){
			print("<input type='hidden' name='dni' value='".$defaults['dni']."' />".$defaults['dni']);
		} else {
			print("<input type='text' name='dni' id='dni' size=12 maxlength=8 pattern='[0-9]{8,8}' placeholder='NUM. DOC.' value='".$defaults['dni']."' required />");
		}
		// FIN SI ES USER O PLUS SE LIMITA EL FORMULARIO 

			print("</td>
				</tr>
				<tr>
					<td style='text-align:right !important;'>
						<font color='#FF0000'>*</font> CONTROL:
					</td>
					<td style='text-align:left !important;'>");

		// INICIO SI ES USER O PLUS SE LIMITA EL FORMULARIO 
		if((@$_SESSION['Nivel'] == 'user') || (@$_SESSION['Nivel'] == 'plus')){
			print("<input type='hidden' name='ldni' value='".$defaults['ldni']."' />".$defaults['ldni']);
		} else {
			print("<input type='text' name='ldni' id='ldni' size=4 maxlength=1 pattern='[A-Z]{1,1}' value='".$defaults['ldni']."' required />");
		}
		// FIN SI ES USER O PLUS SE LIMITA EL FORMULARIO 

		print("		</td>
				</tr>
				<tr>
					<td style='text-align:right !important;'>
						<font color='#FF0000'>*</font> MAIL:
					</td>
					<td style='text-align:left !important;'>
		<input type='mail' name='Email' id='Email' size=42 maxlength=50 placeholder='MI EMAIL EN MINUSCULAS' value='".$defaults['Email']."' required />
					</td>
				</tr>	
				<tr>
					<td style='text-align:right !important;'>
						<font color='#FF0000'>*</font> NIVEL USER:
					</td>
					<td style='text-align:left !important;'>");

	// INICIO SI ES USER O PLUS SE LIMITA EL FORMULARIO 
	if((@$_SESSION['Nivel'] == 'user') || (@$_SESSION['Nivel'] == 'plus')){ 

		print("<input type='hidden' name='Nivel' value='".$defaults['Nivel']."' />".$defaults['Nivel']);

		} else { print("<select name='Nivel'>");
						foreach($Nivel as $optionnv => $labelnv){
							print ("<option value='".$optionnv."' ");
							if($optionnv == $defaults['Nivel']){print ("selected = 'selected'");}
																print ("> $labelnv </option>");
														}	
				print ("</select>");
		}
	// FIN SI ES USER O PLUS SE LIMITA EL FORMULARIO 

			print("</td>
				</tr>
				<tr>
					<td style='text-align:right !important;'>
						<font color='#FF0000'>*</font> USER NICK:
					</td>
					<td style='text-align:left !important;'>");

	// INICIO SI ES USER O PLUS SE LIMITA EL FORMULARIO 
	if((@$_SESSION['Nivel'] == 'user') || (@$_SESSION['Nivel'] == 'plus')){

	print("	<input type='hidden' name='Usuario' value='".$defaults['Usuario']."' />".$defaults['Usuario']."
				</td></tr>
			<input type='hidden' name='Usuario2' value='".$defaults['Usuario2']."' />");

	} else {
		print("<input type='text' name='Usuario' id='Usuario' size=12 maxlength=10 pattern='[a-z A-Z 0-9\s]{3,10}' placeholder='MI NICK' value='".$defaults['Usuario']."' required />
		</td></tr>
		<tr><td style='text-align:right !important;'><font color='#FF0000'>*</font> USER NICK:
		</td><td style='text-align:left !important;'>
			<input type='text' name='Usuario2' id='Usuario2' size=12 maxlength=10 pattern='[a-z A-Z 0-9\s]{3,10}' placeholder='MI NICK' value='".$defaults['Usuario2']."' required />
		</td></tr>");
}
	// FIN SI ES USER O PLUS SE LIMITA EL FORMULARIO 

		print("<tr>
					<td style='text-align:right !important;'>
						<font color='#FF0000'>*</font> PASSWORD:
					</td>
					<td style='text-align:left !important;'>");

	// INICIO SI ES USER O PLUS SE LIMITA EL FORMULARIO 

	if((@$_SESSION['Nivel'] == 'user') || (@$_SESSION['Nivel'] == 'plus')){ 

		print("<input type='hidden' name='Password' value='".$defaults['Password']."' />".$defaults['Password']."
				</td></tr>
			<input type='hidden' name='Password2' value='".$defaults['Password2']."' />");
	} else { 
		print("<input type='text' name='Password' size=12 maxlength=10 value='".$defaults['Password']."' />
				</td>
				</tr><tr>
				<td style='text-align:right !important;'><font color='#FF0000'>*</font> PASSWORD:</td>
				<td style='text-align:left !important;'>
	<input type='text' name='Password2' id='Password2' size=12 maxlength=10 pattern='[a-z A-Z 0-9\s]{3,10}' placeholder='MI PASSWORD' value='".$defaults['Password2']."' required />
				</td></tr>");
		}
	// FIN SI ES USER O PLUS SE LIMITA EL FORMULARIO 

		print("	<tr>
					<td style='text-align:right !important;'>
						<font color='#FF0000'>*</font> DIRECCION:
					</td>
					<td style='text-align:left !important;'>
	<input type='text' name='Direccion' id='Direccion' size=42 maxlength=60 placeholder='MI DIRECCION' value='".$defaults['Direccion']."' required />
					</td>
				</tr>
				<tr>
					<td style='text-align:right !important;'>
						<font color='#FF0000'>*</font> TELEFONO 1:
					</td>
					<td style='text-align:left !important;'>
		<input type='text' name='Tlf1' id='Tlf1' size=12 maxlength=9 pattern='[0-9]{9,9}' placeholder='TELEFONO 1' value='".$defaults['Tlf1']."' required />
					</td>
				</tr>
				
				<tr>
					<tr>
					<td style='text-align:right !important;'> TELEFONO 2:
					</td>
					<td style='text-align:left !important;'>
		<input type='text' name='Tlf2' id='Tlf2' size=12 maxlength=9 pattern='[0-9\s]{9,9}' placeholder='TELEFONO 2' value='".$defaults['Tlf2']."' />
					</td>
				</tr>");
		 
		global $imgform;
		if($imgform == "config2") {

		print("	<tr>
					<td style='text-align:right !important;'>
						<font color='#FF0000'>*</font> FOTOGRAFIA:
					</td>
					<td style='text-align:left !important;'>
		<input type='file' name='myimg' value='".@$defaults['myimg']."' required />						
					</td>
				</tr>");
			} else { }	

	print("	<tr>
				<td colspan='2' style='text-align:right !important;' class='BorderSup BorderInf'>
					<input type='submit' value='".$title3."' class='botonverde' />
					<input type='hidden' name='".$title4."' value=1 />
				</td>
			</tr>
				</form>".$closewin."
		</table>"); 

?>