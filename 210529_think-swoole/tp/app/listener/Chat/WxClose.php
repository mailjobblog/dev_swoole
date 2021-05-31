<?php
declare (strict_types = 1);

namespace app\listener\Chat;
use think\Swoole\Websocket;
class WxClose
{
    /**
     * 事件监听处理
     *
     * @return mixed
     */
    public function handle($event, Websocket $websocket)
    {
        echo "有连接断开了服务，fd的标识是：".$websocket->getSender().PHP_EOL;
    }
}
