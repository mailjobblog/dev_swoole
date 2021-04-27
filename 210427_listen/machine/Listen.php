<?php

use \Swoole\Server;

/**
 * 监听服务
 */
class Listen
{
    /**
     * 定义端口与ip
     */
    private $port = 9556;
    private $host = '127.0.0.1';

    /** 
     * 定义 TCP 服务
     */
    private $server;

    /**
     * 定义 TCP Listen 服务
     */
    private $listen;

    /**
     * TCP Listen 服务初始化 
     */
    public function __construct($server)
    {
        echo "TCP Listen 服务:{$this->host}:{$this->port}\n";
        $this->server = $server;
        $this->listen = $server->listen($this->host, $this->port, SWOOLE_SOCK_TCP);

        // 多端口监听事件初始化
        $this->onEvents();
    }

    /**
     * 初始化 swoole 事件
     */
    public function onEvents()
    {
        $this->listen->on('connect', [$this, 'connect']);
        $this->listen->on('receive', [$this, 'receive']);
        $this->listen->on('close', [$this, 'close']);
    }

    public function connect($server, $fd)
    {
        echo "Client: {$fd} Connect.\n";
    }

    public function receive($server, $fd, $reactor_id, $data)
    {
        echo "接收到指令\n";
        $data = json_decode($data, true);

        if ($data['code'] == 9) {
            echo 'stop server';
            $this->server->shutdown();
        } else {
            $server->send($fd, $data);
        }
    }

    public function close($server, $fd)
    {
        echo "Client:{$fd} Close.\n";
    }
}
