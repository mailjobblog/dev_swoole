<?php

$server = new Swoole\Server("127.0.0.1", 9502);
$msg_key = ftok(__DIR__,'u');

$server->set(array(
    'worker_num'      => 4,
    'task_worker_num' => 4,

    // 使用 sysvmsg 消息队列通信
    'task_ipc_mode' => 2,

    // 设置 linux 消息队列的 KEY
    'message_queue_key' => $msg_key
));

// 把结果返回到 worker进程 触发 onfinish
$server->on('receive', function($server, $fd, $reactor_id, $data) {
    $d = str_repeat('c', 10 * 1024 * 1024);
    $task_id = $server->task($d);
    var_dump("投递任务给task 任务task_id:".$task_id);
    $server->send($fd, "ok");
});

// task 异步任务
$server->on('task', function ($server, $task_id, $reactor_id, $data) {
    var_dump("task进程接收结果:".$data);

    var_dump(posix_getpid());

    sleep(5);

    var_dump("执行完成");

    $server->finish("$data -> OK");
});

$server->on('finish', function ($server, $task_id, $data) {
});


$server->start();
