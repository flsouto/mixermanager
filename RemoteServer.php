<?php

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

