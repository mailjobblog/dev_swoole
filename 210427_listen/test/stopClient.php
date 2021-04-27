<?php
$client = new Swoole\Client(SWOOLE_SOCK_TCP);
if (!$client->connect('127.0.0.1', 9501, -1)) {
    exit("connect failed. Error: {$client->errCode}\n");
}
$data = [
    'method' => 'tcpServerStop',
    'msg' => 'jace',
    'data' => 'I am from client request, if(code=0),stop tcpServer',
    'code' => 0,
];
$client->send(json_encode($data));
echo $client->recv();
$client->close();
