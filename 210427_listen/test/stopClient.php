<?php
$client = new Swoole\Client(SWOOLE_SOCK_TCP);
if (!$client->connect('127.0.0.1', 9501, -1)) {
    exit("connect failed. Error: {$client->errCode}\n");
}
$data = [
    'method' => 'machineStop',
    'msg' => 'jace',
    'data' => '666',
    'code' => 0,
];
$client->send(json_encode($data));
echo $client->recv();
$client->close();
