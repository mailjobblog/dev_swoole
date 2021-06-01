# room聊天室测试

## 服务端配置

**运行一下命令，创建实现类**

```shell
php think make:listener RoomChat/WsJoin
php think make:listener RoomChat/WsLeave
php think make:listener RoomChat/WsRoomMessage
```

**配置监听事件**

```php
<?php
// 事件定义文件
return [
    /** ...此处省略... **/
    'listen'    => [
        /** ...此处省略... **/

        // room 聊天室
        'swoole.websocket.Join' => array(
            app\listener\RoomChat\WsJoin::class
        ),
        'swoole.websocket.Leave' => array(
            app\listener\RoomChat\WsLeave::class
        ),
        'swoole.websocket.RoomMessage' => array(
            app\listener\RoomChat\WsRoomMessage::class
        ),
        /** ...此处省略... **/
    ],
    /** ...此处省略... **/
];
```


## Room聊天室对象类的常用方法总结

```text
// 当前客户端加入指定Room     
$ws->join($event['room']);
// 指定客户端加入到指定的Room
ws->setSender(2)->join($event['room']);
// 当前客户端加入多个指定Room
$ws->join(['room1', 'room2']);
// 指定客户端加入到指定的Room
//ws->setSender(2)->join([...]);
$room= app('think\swoole\websocket\Room');
// 获取指定房间下有哪些客户端
$room->getClients($event['room']);
// 获取指定客户端加入了哪些房间
$room->getRooms($ws->getSender())

// 当前客户端离开指定Room
$ws->leave($event['room']);
// 同时离开多个Room
$ws->leave(['room1', 'room2']);
// 指定客户端离开指定Room
$ws->setSender(2)->leave($event['room']);
// 获取到指定Room中的所有客户端
$room = app('think\swoole\websocket\Room');
$room->getClients($event['room']);
//获取指定客户端加入的所有Room
$room->getRooms($ws->getSender());

// 给指定Room内所有客户端发消息 包括当前客户端 当前客户端没有加入该Room也可以发送  
$ws->to('room1')->emit('testcallback', $event);
// 同时给多个Room发送消息
$ws->to(['room1', 'room2'])->emit('testcallback', $event);
```
