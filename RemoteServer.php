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

    function upload($local, $remote=""){
        if(empty($remote)){
            $remote = $this->path;
        }
        shell_exec("scp $local $this->host:$remote");
    }

}

