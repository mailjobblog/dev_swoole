<?php

$serv = new Swoole\Server('0.0.0.0', 9601);

//设置异步任务的工作进程数量
$serv->set([
    'worker_num'      => 4,
    'task_worker_num' => 6
]);

//此回调函数在worker进程中执行
$serv->on('Receive', function ($serv, $fd, $reactor_id, $data) {
    //投递异步任务
    $task_id = $serv->task($data);
    echo "代码继续执行中: id={$task_id}\n";
});

//处理异步任务(此回调函数在task进程中执行)
$serv->on('Task', function ($serv, $task_id, $reactor_id, $data) {
    echo "正在处理异步任务[id={$task_id}]" . PHP_EOL;
    sleep(6);// 睡眠中，模拟任务处理
    //返回任务执行的结果
    $serv->finish("{$data} -> OK");
});

//处理异步任务的结果(此回调函数在worker进程中执行)
$serv->on('Finish', function ($serv, $task_id, $data) {
    echo "异步任务执行完成咯[{$task_id}] Finish: {$data}" . PHP_EOL;
});

$serv->start();
