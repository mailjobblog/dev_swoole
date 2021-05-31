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
<<<<<<< HEAD
        'swoole.websocket.Open' => array(
            app\listener\Chat\WsOpen::class
        ),
        'swoole.websocket.Close' => array(
            app\listener\Chat\WsClose::class
        ),
        'swoole.websocket.Message' => array(
            app\listener\Chat\WsMessage::class
=======
        'swoole.websocket.Connect' => array(
            app\listener\Chat\WxConnect::class
        ),
        'swoole.websocket.Chat' => array(
            app\listener\Chat\WxChat::class
        ),
        'swoole.websocket.Close' => array(
            app\listener\Chat\WxClose::class
>>>>>>> c42ba9bda29ef9a3574659b6e76248d8c1c19435
        ),

        // 注册 task 异步任务
        'swoole.task' => array(
            app\listener\Task\EmailTask::class,
        ),
    ],

    'subscribe' => [
    ],
];
