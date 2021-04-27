<?php
$client = new Swoole\Client(SWOOLE_SOCK_TCP);
if (!$client->connect('127.0.0.1', 9501, -1)) {
    exit("connect failed. Error: {$client->errCode}\n");
}
$data = [
    'method' => 'tcpServerStop',
    'msg' => 'jace',
    'data' => '我是一个来自客户端的请求，你看code=0，就把服务给我断掉呗',
    'code' => 0,
];
$client->send(json_encode($data));
echo $client->recv();
$client->close();
