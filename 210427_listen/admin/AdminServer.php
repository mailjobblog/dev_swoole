<?php

use \Swoole\Server;
use \Swoole\Client;

/**
 * TCP 服务
 */
class AdminServer
{
    /**
     * 定义连接 ip 与 端口
     */
    private $port = '9501';
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
        echo "TCP 服务:{$this->host}:{$this->port}\n";
        // 创建 server 对象
        $this->server = new Server($this->host, $this->host);
        // 初始化事件
        $this->onEvents();
    }

    /**
     * 初始化 swoole 事件
     */
    private function onEvents()
    {
        // 监听连接进入事件
        $this->server->on('connect', [$this, 'connect']);
        // 监听数据接收事件
        $this->server->on('receive', [$this, 'receive']);
        // 监听连接关闭事件
        $this->server->on('close', [$this, 'close']);
    }

    /**
     * 监听连接
     */
    private function connect($server, $fd)
    {
        echo "Client: {$fd} Connect.\n";
    }

    /**
     * 接收事件
     */
    private function receive($server, $fd, $reactor_id, $data)
    {
        echo "接收到了来自 client 的数据\n";
        // $server->send($fd, "Server: {$data}");

        var_dump($data);
        $data = json_decode($data, true);
        $this->{$data['method']}($server, $fd, $reactor_id, $data);
    }

    /**
     * 关闭事件
     */
    private function close($server, $fd)
    {
        echo "Client: {$fd} Close.\n";
    }

    /**
     * 启动服务
     */
    public function start()
    {
        echo '启动后台服务';
        $this->server->start();
    }

    /////////////////////////////////////////////////////
    //
    //  业务代码
    //
    /////////////////////////////////////////////////////

    /**
     * 停止被监控的服务程序
     */
    public function machineStop($server, $fd, $from_id, $data)
    {
        echo '去停止机器';
        $return =   $this->sendToMachine('127.0.0.1', 9556, json_encode($data));
        //TODO 处理其他事情
        echo '机器停止了';
        $server->send($fd, json_encode(['code' => 200, 'msg' => 'machine stop ok']));
    }

    /**
     * 查看被监控服务详情
     */
    public function machineInfo($server, $fd, $from_id, $data)
    {
        //返回
        $server->send($fd, json_encode(['code' => 200, 'msg' => 'return info ok']));
    }

    /**
     * 向被监控的服务发送数据
     */
    public function sendToMachine($ip, $port, $data)
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

(new AdminServer())->start();
