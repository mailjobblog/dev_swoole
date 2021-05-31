<?php
declare (strict_types = 1);

namespace app\listener\Chat;
use think\swoole\Websocket;
class WsClose
{
    /**
     * 事件监听处理
     *
     * @return mixed
     */
    public function handle($event, Websocket $ws)
    {
        echo "{$ws->getSender()} - 关闭 \n";
        $ws->emit('sendfd', $ws->getSender().'断开连接了！');
    }
}
