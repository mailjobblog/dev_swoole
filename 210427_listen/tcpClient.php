<?php
$client = new Swoole\Client(SWOOLE_SOCK_TCP);
if (!$client->connect('49.233.105.235', 9501, -1)) {
    exit("connect failed. Error: {$client->errCode}\n");
}
$data = [
    // 'method'=>'machineInfo',
    'method' => 'machineStop',
    'msg' => 'jace',
    'data' => '666',
    'code' => 9,
];
$client->send(json_encode($data));
echo $client->recv();
$client->close();
