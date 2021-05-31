<?php
declare (strict_types = 1);

namespace app\listener;

class WsRoomChat
{
    /**
     * 事件监听处理
     *
     * @return mixed
     */
    public function handle($event)
    {
        //$fd = $ws->getSender();
        $ws = app('think\swoole\websocket');
//        $ws->to(['room1','room2']);//同时给多给room 发消息
        //给指定的room 内 全部客户端发送消息
        $ws->to($event['room'])->emit('roomchatcallback',$event['message']);

    }
}
