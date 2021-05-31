<?php
declare (strict_types = 1);

namespace app\listener\Chat;
use think\swoole\Websocket;
class WsMessage
{
    /**
     * 事件监听处理
     *
     * @return mixed
     */
    public function handle($event,Websocket $websocket)
    {
        var_dump($event);
    }
}
