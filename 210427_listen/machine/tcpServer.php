<?php
require 'listenServer.php';

use \Swoole\Server;

/**
 * TCP 服务
 */
class tcpServer
{
    /**
     * 定义端口与ip
     */
    private $port = 9505;
    private $host = '0.0.0.0';

    /** 
     * 定义 TCP 服务
     */
    private $server;

    /**
     * TCP 服务初始化 
     */
    public function __construct()
    {
        echo "TCP服务:{$this->host}:{$this->port}\n";
        $this->server = new Server($this->host, $this->port);
        //多端口监听
        (new listenServer($this->server));
        // tcp 服务初始化
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

        $return = $this->sendToAdmin('127.0.0.1', 9501, $data);
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

(new tcpServer())->start();
