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

        // 注册 task 异步任务
        'swoole.task' => array(
            app\listener\Task\EmailTask::class,
        ),
    ],

    'subscribe' => [
    ],
];
