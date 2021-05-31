<?php
declare (strict_types = 1);

namespace app\listener;
use think\swoole\Websocket;
class WsChat
{
    /**
     * 事件监听处理
     *
     * @return mixed
     */
    public function handle($event,Websocket $ws)
    {
        //
        var_dump($event);
//       $ws  = app('think\swoole\Websocket');

//       $fd =  $ws->getSender();
        //emit('事件名','数据')  给当前客户端发送消息
//        $ws->emit('chat1',$event['message']);

        //发送给指定的客户端 包括发送者
//        $ws->to(2)->emit('chat1',$event['message']);


        //发送给多个指定的客户端 包括发送者
//        $ws->to([2,3])->emit('chat1',$event['message']);

//        $ws->broadcast()->emit('chat1',$event['message']);
        //广播 给连接的所有客户端发送消息 除了发送者
//        $ws->broadcast()->emit('chat1',$event['message']);

        //是否为广播模式
//          var_dump($ws->isBroadcast());

           //指定发送者fd 发送给指定的客户端 假如我是1 模拟2  给34 发送消息  234都收到消息  1没有收到
//        $ws->setSender(2)->to([3,4])->emit('chat1',$event['message']);

//        $ws->to($event['to'])->emit('chat1',$event['message']);



//       $ws->emit('chat1',[
//           'form' =>[
//               'id' => 11,
//               'fd' => $ws->getSender(),
//               'name' => 'xhangz',
//           ],
//           'to' =>[
//               'id' => 69,
//               'fd' => $event['to'],
//               'name' => 'xxxx',
//           ],
//           'message' =>[
//               'id' => 66,
//               'time ' => time(),
//               'content' => 'message',
//           ],
//       ]);

    }
}
