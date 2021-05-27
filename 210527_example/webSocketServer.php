<?php
$server = new Swoole\Websocket\Server('0.0.0.0', 9502);

$server->on('open', function($server, $req) {
    echo "connection open: {$req->fd}\n";
});

$server->on('message', function($server, $frame) {
    echo "received message: {$frame->data}\n";
    $server->push($frame->fd, json_encode(['hello', 'world']));
    Co::sleep(5);
    $server->push($frame->fd, json_encode(['22222', '33333']));
});

$server->on('close', function($server, $fd) {
    echo "connection close: {$fd}\n";
});

$server->start();