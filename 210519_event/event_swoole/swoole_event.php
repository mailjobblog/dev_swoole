<?php

$server = stream_socket_server("tcp://0.0.0.0:8000", $errno, $errstr);
var_dump($server);

Swoole\Event::add($server, function($socket){
    // 事件类的动作
    $conn = stream_socket_accept($socket);
    Swoole\Event::add($conn, function($socket){
     // 事件类的动作
     var_dump(fread($socket, 65535));
     fwrite($socket, 'The local time is ' . date('n/j/Y g:i a') . "\n");
     Swoole\Event::del($socket);
     fclose($socket);
    });
});