<?php

require_once(__DIR__."/RemoteServer.php");

$config = require_once(__DIR__."/config.php");
extract($config);

$originServer = new RemoteServer($origin_server, $origin_path);


