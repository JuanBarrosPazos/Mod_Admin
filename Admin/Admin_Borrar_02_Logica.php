<?php

if /*(*/($_SESSION['Nivel'] == 'admin')/* || ($_SESSION['Nivel'] == 'plus'))*/{

    master_index();

    if (@$_POST['oculto2']){ show_form();
                                global $InfoLog;
                                $InfoLog = "** ADMIN BORRAR SELECCIONADO ";
                                UserLog();
                            }
    elseif($_POST['borrar']){	process_form();
                                Feedback();
                                global $InfoLog;
                                $InfoLog = "** ADMIN BORRADO ";
                                UserLog();
        } else {show_form();}
} else { require '../Inclu/table_permisos.php'; }

?>