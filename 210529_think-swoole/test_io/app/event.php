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
        'swoole.task' => [
            app\listener\EamilTask::class
        ],
        'swoole.finish' => [
            app\listener\EamilTaskFinish::class
        ],

        'swoole.websocket.Connect' => [
            app\listener\WsConnect::class
        ],
        'swoole.websocket.Close' => [
            app\listener\WsClose::class
        ],
        'swoole.websocket.Chat' => [
            app\listener\WsChat::class
        ],

        'swoole.websocket.Join' => [
            app\listener\WsRoomJoin::class
        ],
        'swoole.websocket.Leave' => [
            app\listener\WsRoomLeave::class
        ],
        'swoole.websocket.RoomChat' => [
            app\listener\WsRoomChat::class
        ],

    ],

    'subscribe' => [
    ],
];
