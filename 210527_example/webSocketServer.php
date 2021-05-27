<?php
$server = new Swoole\Websocket\Server('0.0.0.0', 10000);

echo "ws://0.0.0.0:10000".PHP_EOL;

# 客户端连接响应
$server->on('open', function($server, $req){
    echo "客户端连接成功: {$req->fd}\n";
});

# 接受客户端消息
$server->on('message', function($server, $frame){
    $message = $frame->data;
    echo "接受到客户端消息: {$message}\n";
    foreach ($server->connections as $fd) {
        $server->push($fd, $message);
    }
});

# 客户端关闭处理
$server->on('close', function($server, $fd){
    echo "客户端关闭连接: {$fd}\n";
});

# 启动服务
$server->start();