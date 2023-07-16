<?php

if (($_SESSION['Nivel'] == 'admin')||($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){

        if (isset($_POST['oculto2'])){ 
                show_form();
                global $nombre;
                $nombre = $_POST['Nombre'];
                global $apellido;
                $apellido = $_POST['Apellidos'];
                global $InfoLog;
                $InfoLog = "** ADMIN MODIFICAR IMG SELECCIONADA ";
                global $InfoLogImg;
                $InfoLogImg = "\t Imagen: ".$_POST['myimg'];
                UserLog();
        } elseif($_POST['imagenmodif']){
          if($form_errors = validate_form()){ show_form($form_errors); }
          else {  process_form();
                  global $InfoLog;
                  $InfoLog = "** ADMIN MODIFICAR IMG MODIFICADA ";
                  global $InfoLogImg;
                  $InfoLogImg = "\t Upload Imagen: ".$destination_file.PHP_EOL."\t Rename Imagen: ".$rename_filename;
                  UserLog();
                            }
        } else { show_form(); }
    } else { require '../Inclu/table_permisos.php'; }

?>