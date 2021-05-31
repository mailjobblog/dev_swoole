<?php
declare (strict_types=1);

namespace app\listener;

use think\swoole\Websocket;
//use think\Container;

class WsConnect
{
    /**
     * 事件监听处理
     *
     * @return mixed
     */
    public function handle($event, Websocket $websocket)
    {
//        var_dump(get_class(app('think\swoole\Websocket')));
//        var_dump(get_class($container->make(Websocket::class)));
//        var_dump(get_class_methods($websocket));
//        $websocket->emit();

//        var_dump($event);  user_id-fd
////        echo $event->get('user_id');
        echo '-当前连接的fd:' . $websocket->getSender();
        $websocket->emit('sendfd', $websocket->getSender().'连接了！');
    }
}
