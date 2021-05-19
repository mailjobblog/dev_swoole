<?php
// 建立协议服务
$socket = stream_socket_server("tcp://0.0.0.0:8000", $errno, $errstr);

$eventBase = new EventBase();

/**
 * socket 可读，可写，持续监听
 */
$event = new Event($eventBase, $socket, Event::READ | Event::WRITE | Event::PERSIST, function($socket) {

    $connect = stream_socket_accept($socket);
    $read = fread($connect, 65535);
    var_dump($read);
    fwrite($connect,"this is eventSocketServer \n");
    fclose($connect);

});

$event->add();

$eventBase->loop();