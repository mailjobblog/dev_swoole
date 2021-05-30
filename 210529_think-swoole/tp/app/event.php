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
        'swoole.websocket.Connect' => array(
            app\listener\Chat\WxConnect::class
        ),
        'swoole.websocket.Chat' => array(
            app\listener\Chat\WxChat::class
        ),
        'swoole.websocket.Close' => array(
            app\listener\Chat\WxClose::class
        ),

        // 注册 task 异步任务
        'swoole.task' => array(
            app\listener\Task\EmailTask::class,
        ),
    ],

    'subscribe' => [
    ],
];
