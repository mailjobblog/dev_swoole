<?php
declare (strict_types = 1);

namespace app\listener\Chat;
use think\swoole\Websocket;
class WsConnect
{
    /**
     * 事件监听处理
     *
     * @return mixed
     */
    public function handle($event,Websocket $websocket)
    {
        echo '-当前连接的fd:' . $websocket->getSender();
        $websocket->emit('sendfd', $websocket->getSender().'连接了！');
    }
}
