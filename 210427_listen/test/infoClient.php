<?php
$client = new Swoole\Client(SWOOLE_SOCK_TCP);
if (!$client->connect('127.0.0.1', 9501, -1)) {
    exit("connect failed. Error: {$client->errCode}\n");
}
$data = [
    'method' => 'tcpServerInfo',
    'msg' => 'jace',
    'data' => '我是一个来自客户端的请求，我想看看tcp服务的服务详情',
    'code' => 1,
];
$client->send(json_encode($data));
echo $client->recv();
$client->close();
