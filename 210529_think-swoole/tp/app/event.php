<?php
// 事件定义文件
return [
    'bind'      => [
    ],

    'listen'    => [
        'AppInit'  => [],
        'HttpRun'  => [],
        'HttpEnd'  => [],
        'LogLevel' => [],
        'LogWrite' => [],

        // 聊天事件注册
        'swoole.websocket.Open' => array(
            app\listener\Chat\WsOpen::class
        ),
        'swoole.websocket.Close' => array(
            app\listener\Chat\WsClose::class
        ),
        'swoole.websocket.Message' => array(
            app\listener\Chat\WsMessage::class
        ),

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

        // 注册 task 异步任务
        'swoole.task' => array(
            app\listener\Task\EmailTask::class,
        ),
    ],

    'subscribe' => [
    ],
];
