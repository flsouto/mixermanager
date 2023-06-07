<?php

require_once(__DIR__."/init.php");

$bserver = new RemoteServer($backup_server, $backup_path);

$sent = array_filter( explode("\n",$bserver->exec("ls")) );

foreach(glob(__DIR__."/backups/*.zip") as $zip){
    if(!in_array($base=basename($zip), $sent)){
        echo "Sending $base\n";
        $bserver->upload($zip);
    }
}
