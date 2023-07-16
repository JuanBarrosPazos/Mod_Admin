<?php

if ($_SESSION['Nivel'] == 'admin'){

	master_index();

	if (@$_POST['oculto2']){ show_form();
							 global $InfoLog;
							 $InfoLog = "** USER BAJAS BORRAR SELECCIONADO ";
							 global $InfoLogB;
							 $InfoLogB = "";
							 UserLog();
							}
	elseif($_POST['borrar']){	process_form();
								deletedir();
                                global $InfoLog;
                                $InfoLog = "** USER BAJAS BORRARDO ";
								global $InfoLogB;
								$InfoLogB = $deletet.PHP_EOL.$ddr;
								UserLog();
		} else {show_form();}
	} else { require '../Inclu/table_permisos.php'; }

?>