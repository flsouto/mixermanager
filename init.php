<?php

function config(){
    if(file_exists($f = __DIR__."/config.php")){
        return require $f;
    } else {
        return require __DIR__."/example.config.php";
    }
}

function remote_exec($cmd){
    $config = config();
    return shell_exec("ssh {$config['remote_server']} '(cd {$config['remote_path']}; $cmd)'");
}

function remote_download($from, $to){
    $config = config();
    shell_exec("scp {$config['remote_server']}:{$config['remote_path']}/$from $to");
}


extract(config());

