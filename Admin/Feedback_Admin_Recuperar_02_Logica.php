<?php

if ($_SESSION['Nivel'] == 'admin'){

    master_index();

    if (@$_POST['oculto2']){ show_form();
                             global $InfoLog;
                             $InfoLog = "** ADMIN FEEDBACK RECUPERADO ";
                             UserLog();
                            }
    elseif($_POST['modifica']){ process_form();
                                global $InfoLog;
                                $InfoLog = " ";
                                UserLog();
                    } else {show_form();}
    } else { require '../Inclu/table_permisos.php'; }


?>