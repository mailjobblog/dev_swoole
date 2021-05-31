<?php
declare (strict_types = 1);

namespace app\listener\Chat;
use think\swoole\Websocket;
class WsOpen
{
    /**
     * 事件监听处理
     *
     * @return mixed
     */
    public function handle($event,Websocket $websocket)
    {
        echo '当前连接的fd:' . $websocket->getSender() . PHP_EOL;

        $websocket->emit('send_file_fd', $websocket->getSender().'断开连接了,然后我还在sever的close中随便回复了客户端一条信息！');
    }
}
