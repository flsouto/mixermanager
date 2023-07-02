<?php
require(__DIR__.'/init.php');

$zips = $originServer->exec("sudo ls saved/*.zip");

if(!is_dir('backups')){
    mkdir('backups');
}
$zips = explode("\n",$zips);
sort($zips);
$current_zip = basename(end($zips));

foreach($zips as $zip){
    $zip = trim($zip);
    if(empty($zip)) continue;
    $base = basename($zip);
    $is_current = $base === $current_zip;
    if(!file_exists($bkp_f=__DIR__."/backups/$base") || $is_current){
        echo "Copying $zip\n";
        $originServer->download("saved/$base", $bkp_f);
    } else {
        echo "Skipping $zip\n";
    }
    if($clear_origin && file_exists($bkp_f) && !$is_current){
        $out = shell_exec("unzip -t $bkp_f");
        if(stristr($out,"no errors detected")){
            echo "Deleting $base at remote\n";
            $originServer->exec("rm saved/$base");
        }
    }
}

