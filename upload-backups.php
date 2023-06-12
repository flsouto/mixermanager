<?php

require_once(__DIR__."/init.php");

foreach($backup_servers as $server){
    print_r($server);
    $bserver = new RemoteServer($server['host'], $server['path']);
    $sent = array_filter( explode("\n",$bserver->exec("ls")) );

    foreach(glob(__DIR__."/backups/*.zip") as $zip){
        if(!in_array($base=basename($zip), $sent)){
            echo "Sending $base to $bserver\n";
            $bserver->upload($zip);
        }
    }

}

