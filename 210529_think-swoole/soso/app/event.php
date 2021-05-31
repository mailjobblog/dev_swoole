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

        'swoole.websocket.Connect' => [
            app\listener\Chat\WsOpen::class
        ],
        'swoole.websocket.Close' => [
            app\listener\Chat\WsClose::class
        ],
        'swoole.websocket.Chat' => [
            app\listener\Chat\WsChat::class
        ],
    ],

    'subscribe' => [
    ],
];
