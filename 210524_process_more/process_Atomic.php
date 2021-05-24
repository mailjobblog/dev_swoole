<?php
// https://wiki.swoole.com/#/memory/atomic

$start = microtime(true);

$atomic = new Swoole\Atomic();

for($i=0; $i<5; $i++) {
    $process = new Swoole\Process(function ($process) use ($i, $atomic) {
        
        // 计数器+1
        $atomic->add();

        // 模拟业务执行
        sleep(2);

        // 内容输出
        echo 'i的值：'.$i.PHP_EOL;

    }, false);

    $process->start();
}

$status = Swoole\Process::wait(true);
$status = Swoole\Process::wait(true);
$status = Swoole\Process::wait(true);
$status = Swoole\Process::wait(true);
$status = Swoole\Process::wait(true);

// 获取计数结果
$num = $atomic->get();

echo "计数结果：".$num.PHP_EOL;

// 程序结束时间
$end = microtime(true);
echo "用时：".($end - $start).PHP_EOL;