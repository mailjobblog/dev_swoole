<?php
declare (strict_types = 1);

namespace app\listener;

use think\swoole\websocket\Room;

class WsRoomJoin
{
    /**
     * 事件监听处理
     *
     * @return mixed
     */
    public function handle($event,\think\swoole\websocket $websocket,Room $room)
    {
//        var_dump($event);
//        echo 'fd为:'.$websocket->getSender().'想加入房间'."\n";


//        $room= app('think\swoole\websocket\Room');
//        var_dump(get_class_methods($room));
        //获取指定房间下有哪些客户端
//        var_dump($room->getClients($event['room']));
//
        $websocket->join($event['room']); //当前连接 加入room
//        $websocket->join([$event['room'],'zb','yx']); //当前客户端加入多个指定Room
//
//        var_dump($room->getClients($event['room']));

        //获取指定客户端加入了哪些房间

//        var_dump( $room->getRooms(intval($websocket->getSender())));

        $websocket->emit('joincallback','恭喜'.$websocket->getSender().'加入'.$event['room'].'成功');

    }
}
