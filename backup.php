<?php
require(__DIR__.'/init.php');
extract(config());

$zips = $remoteServer->exec("sudo ls saved/*.zip");

if(!is_dir('backups')){
    mkdir('backups');
}

foreach(explode("\n",$zips) as $zip){
    $zip = trim($zip);
    if(empty($zip)) continue;
    $base = basename($zip);
    if(!file_exists($bkp_f=__DIR__."/backups/$base")){
        echo "Copying $zip\n";
        $remoteServer->download("saved/$base", $bkp_f);
    } else {
        echo "Skipping $zip\n";
    }
    if($clear_remote && file_exists($bkp_f)){
        $out = shell_exec("unzip -t $bkp_f");
        if(stristr($out,"no errors detected")){
            echo "Deleting $base at remote\n";
            $remoteServer->exec("rm saved/$base");
        }
    }
}

