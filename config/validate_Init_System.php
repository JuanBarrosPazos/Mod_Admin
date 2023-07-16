<?php

	$errors = array();
	
	if(strlen(trim($_POST['host'])) == 0){
		$errors [] = "HOST: CAMPO OBLIGATORIO";
		}
	
	elseif (strlen(trim($_POST['host'])) < 4){
		$errors [] = "HOST: MAS DE 3 CARACTERES";
		}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:"·\(\)=\[\]\{\};,:\*\s]+$/',$_POST['host'])){
		$errors [] = "HOST: CARACTERES NO VALIDOS";
		}
		
	elseif (!preg_match('/^[a-z A-Z 0-9 !¡?¿\._]+$/',$_POST['host'])){
		$errors [] = "HOST: CARACTERES NO VALIDOS";
		}

	
	if(strlen(trim($_POST['user'])) == 0){
		$errors [] = "USER: CAMPO OBLIGATORIO";
		}
	
	elseif (strlen(trim($_POST['user'])) < 4){
		$errors [] = "USER: MAS DE 3 CARACTERES";
		}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:"·\(\)=\[\]\{\};,:\*\s]+$/',$_POST['user'])){
		$errors [] = "USER: CARACTERES NO VALIDOS";
		}
		
	elseif (!preg_match('/^[a-z A-Z 0-9 !¡?¿\._]+$/',$_POST['user'])){
		$errors [] = "USER: CARACTERES NO VALIDOS";
		}

	
	if(strlen(trim($_POST['pass'])) == 0){
		$errors [] = "PASS: CAMPO OBLIGATORIO";
		}
	
	elseif (strlen(trim($_POST['pass'])) < 4){
		$errors [] = "PASS: MAS DE 3 CARACTERES";
		}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:"·\(\)=\[\]\{\};,:\*\s]+$/',$_POST['pass'])){
		$errors [] = "PASS: CARACTERES NO VALIDOS";
		}
		
	elseif (!preg_match('/^[a-z A-Z 0-9 !¡?¿\._]+$/',$_POST['pass'])){
		$errors [] = "PASS: CARACTERES NO VALIDOS";
		}

	
	if(strlen(trim($_POST['name'])) == 0){
		$errors [] = "NAME: CAMPO OBLIGATORIO";
		}
	
	elseif (strlen(trim($_POST['name'])) < 4){
		$errors [] = "NAME: MAS DE 3 CARACTERES";
		}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:"·\(\)=\[\]\{\};,:\*\s]+$/',$_POST['name'])){
		$errors [] = "NAME: CARACTERES NO VALIDOS";
		}
		
	elseif (!preg_match('/^[a-z 0-9 !¡?¿\._]+$/',$_POST['name'])){
		$errors [] = "NAME: CARACTERES NO VALIDOS";
		}


	if(strlen(trim($_POST['clave'])) == 0){
		$errors [] = "CLAVE: CAMPO OBLIGATORIO";
		}
	
	elseif (strlen(trim($_POST['clave'])) < 3){
		$errors [] = "CLAVE: MAS DE 2 CARACTERES";
		}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:"·\(\)=\[\]\{\};, !¡?¿\._:\*\s]+$/',$_POST['clave'])){
		$errors [] = "CLAVE: CARACTERES NO VALIDOS";
		}
		
	elseif (!preg_match('/^[a-z 0-9]+$/',$_POST['clave'])){
		$errors [] = "CLAVE: MINUSCULAS Y NUMEROS";
		}

?>