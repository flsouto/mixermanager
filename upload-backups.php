b<?php

require_once(__DIR__."/init.php");

$zips = glob(__DIR__."/backups/*.zip");

rsort($zips);

foreach($backup_servers as $server){
    $bserver = new RemoteServer($server['host'], $server['path']);
    $sent = array_filter( explode("\n",$bserver->exec("ls")) );

    foreach($zips as $i => $zip){
        $is_current = !$i;
        if(!in_array($base=basename($zip), $sent)||$is_current){
            echo "Sending $base to $bserver\n";
            $bserver->upload($zip);
        }
    }

}

shell_exec("rm gh-backup.zip 2>&1");
foreach(array_slice($zips,0,30) as $zip){
    shell_exec("zip -j gh-backup.zip $zip");
}

echo "Uploading zip to github\n";
shell_exec("gh release upload backups gh-backup.zip --clobber");

