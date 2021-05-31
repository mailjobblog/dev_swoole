<?php
declare (strict_types=1);

namespace app\listener;

class WsRoomLeave
{
    /**
     * 事件监听处理
     *
     * @return mixed
     */
    public function handle($event)
    {
        //当前连接的 fd   $event['room']
        $ws = app('think\swoole\websocket');
//        $fd = $ws->getSender();
//        $room= app('think\swoole\websocket\Room');

//        var_dump($room->getClients($event['room']));

        $ws->leave( $event['room']);

//        var_dump($room->getClients($event['room']));


        $ws->emit('leavecallback',$ws->getSender().'离开'.$event['room'].'成功');

    }
}
