<?php

    $logdocu = $_SESSION['ref'];
    $logdate = date('Y-m-d');
    $logtext = $text.PHP_EOL;
    $filename = $dir."/".$logdate."_".$logdocu.".log";
    $log = fopen($filename, 'ab+');
    fwrite($log, $logtext);
    fclose($log);

?>