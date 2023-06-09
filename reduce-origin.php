<?php

require(__DIR__.'/init.php');

$amount = $argv[1]??10;
$count = $originServer->exec("ls loops/*.mp3 | wc -l");

$exceeds = $count - 1000;

if($exceeds > 0){
    $rm_amount = min($exceeds, $amount);
    echo "Removing $rm_amount\n";
    $list = $originServer->exec("cd loops; ls *.mp3 -t | tail -n $rm_amount > /dev/shm/remove; rm $(cat /dev/shm/remove); cat /dev/shm/remove;");
    echo $list;
}

