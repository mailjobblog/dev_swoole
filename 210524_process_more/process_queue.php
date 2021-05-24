<?php
// https://wiki.swoole.com/wiki/page/290.html

$start = microtime(true);

$workers = array();

for($i=0; $i<5; $i++) {
    $process = new Swoole\Process(function ($process) use ($i, $workers) {

        // 消息队列代码
        echo $process->pop().PHP_EOL;
        //$process->push('pid is ..'.$process->pid);

        // 模拟业务代码
        sleep(2);

        // 字符串输出
        echo 'i的值：'.$i.PHP_EOL;
    }, false);

    // 使用队列
    $process->useQueue();

    $pid = $process->start();

    // 存储 process 结果集
    $workers[$pid] = $process;
}

foreach($workers as $pid => $process) {

    // 消息队列代码
    $process->push('pid is ..'.$process->pid);
    // echo $process->pop().PHP_EOL;

    // 进程释放
    $status = Swoole\Process::wait(true);

}

// 程序结束时间
$end = microtime(true);
echo "用时：".($end - $start).PHP_EOL;