<?php
declare (strict_types = 1);

namespace app\listener\Chat;

use think\Container;
use think\Swoole\Websocket;

class WxConnect
{
    /**
     * 事件监听处理
     *
     * @return mixed
     */
    public function handle($event, Websocket $websocket)
    {
        var_dump($websocket->getSender());
        echo '当前连接的fd:' . $websocket->getSender(). PHP_EOL;
        $websocket->emit('sendfd', $websocket->getSender().'连接了！');
    }

    /**
     * 3种调用方式演示
     *
     * demo1: thinkphp提供的方式
     * demo2: 依赖注入方式
     * demo3: container容器的方式
     *
     * 测试说明：
     * 可以用 get_class 获取对象类名查验
     * 还可以用 get_class_methods 返回类中的对象数组
     */
    /*public function demo1(\Swoole\Server $server){
        $websocket = app('think\Swoole\Websocket');
        var_dump($websocket->getSender()); // 获取当前连接的fd
    }
    public function demo2(\think\Swoole\Websocket $websocket){
        var_dump($websocket->getSender());
    }
    public function demo3(Container $container){
        $websocket = $container->make(\think\Swoole\Websocket::class);
        var_dump($websocket->getSender());
    }*/
}
