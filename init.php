<?php

function config(){
    if(file_exists($f = __DIR__."/config.php")){
        return require $f;
    } else {
        return require __DIR__."/example.config.php";
    }
}

class RemoteServer{

    function __construct(public $host, public $path){

    }

    function exec($cmd){
        return shell_exec("ssh $this->host '(cd $this->path; $cmd)'");
    }

    function download($from, $to){
        shell_exec("scp $this->host:$this->path/$from $to");
    }

}

extract(config());

$remoteServer = new RemoteServer($remote_server, $remote_path);


