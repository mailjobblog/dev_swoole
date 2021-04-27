<?php
require 'Listen.php';

use \Swoole\Server;

class MachineServer
{
    private $port = 9505;
    private $host = '0.0.0.0';

    private $server;

    public function __construct()
    {
        $this->server = new Server($this->host, $this->port);

        //多端口监听
        (new Listen($this->server));

        $this->onEvent();
    }

    public function onEvent()
    {
        $this->server->on('connect', [$this, 'connect']);
        $this->server->on('receive', [$this, 'receive']);
        $this->server->on('close', [$this, 'close']);
    }

    public function connect($server, $fd)
    {
        echo "Client:{$fd}Connect.\n";
    }

    public function receive($server, $fd, $from_id, $data)
    {
        echo '接收到信息';

        $return = $this->sendToAdmin('192.168.56.140', 9501, $data);
        var_dump($return);

        $server->send($fd, $return);
    }

    public function sendToAdmin($ip, $port, $data)
    {
        $client = new Swoole\Client(SWOOLE_SOCK_TCP);
        if (!$client->connect($ip, $port, -1)) {
            exit("connect failed. Error: {$client->errCode}\n");
        }
        $client->send($data);
        $return =  $client->recv();
        $client->close();

        return $return;
    }

    public function close($server, $fd)
    {
        echo "Client:{$fd} Close.\n";
    }

    public function start()
    {
        echo '启动机器服务';
        $this->server->start();
    }
}

(new MachineServer())->start();
