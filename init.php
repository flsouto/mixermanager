<?php

require_once(__DIR__."/RemoteServer.php");

$config = require_once(__DIR__."/config.php");
extract($config);

$remoteServer = new RemoteServer($remote_server, $remote_path);


