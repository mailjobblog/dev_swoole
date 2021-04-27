<?php
require 'listenServer.php';

use \Swoole\Server;
use \Swoole\Client;

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
     * 定义管理服务的端口与ip
     */
    private $admin_port = 9501;
    private $admin_host = '127.0.0.1';

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

    /**
     * 初始化 swoole 事件
     */
    public function onEvent()
    {
        $this->server->on('connect', [$this, 'connect']);
        $this->server->on('receive', [$this, 'receive']);
        $this->server->on('close', [$this, 'close']);
    }

    /**
     * 监听连接
     */
    public function connect($server, $fd)
    {
        echo "Client:{$fd}Connect.\n";
    }

    /**
     * 接收事件
     */
    public function receive($server, $fd, $reactor_id, $data)
    {
        echo "接收到的信息\n";

        $return = $this->sendToAdmin($this->admin_host, $this->admin_port, $data);
        var_dump($return);

        $server->send($fd, $return);
    }
    /**
     * 关闭事件
     */
    public function close($server, $fd)
    {
        echo "Client:{$fd} Close.\n";
    }

    /**
     * 启动服务
     */
    public function start()
    {
        echo "启动机器服务\n";
        $this->server->start();
    }

    /////////////////////////////////////////////////////
    //
    //  需求的逻辑代码
    //
    /////////////////////////////////////////////////////

    /**
     * 消息返回
     */
    public function sendToAdmin($ip, $port, $data)
    {
        $client = new Client(SWOOLE_SOCK_TCP);
        if (!$client->connect($ip, $port, -1)) {
            exit("connect failed. Error: {$client->errCode}\n");
        }
        $client->send($data);
        $return =  $client->recv();
        $client->close();
        return $return;
    }
}

(new tcpServer())->start();
