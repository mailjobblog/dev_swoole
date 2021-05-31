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
    public function handle($event, Websocket $websocket)
    {
        echo "{$websocket->getSender()} - 关闭了连接 ".PHP_EOL;

        $websocket->emit('send_file_close', $websocket->getSender().'服务端信息提示，连接断开了');
    }
}
