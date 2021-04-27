<?php
$client = new Swoole\Client(SWOOLE_SOCK_TCP);
if (!$client->connect('127.0.0.1', 9501, -1)) {
    exit("connect failed. Error: {$client->errCode}\n");
}
$data = [
    'method' => 'machineInfo',
    'msg' => 'jace',
    'data' => '666',
    'code' => 1,
];
$client->send(json_encode($data));
echo $client->recv();
$client->close();
