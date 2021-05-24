<?php
// https://wiki.swoole.com/#/memory/lock

$start = microtime(true);

$lock = new Swoole\Lock(SWOOLE_MUTEX);

for($i=0; $i<5; $i++) {
    $lock->lock();
    $process = new Swoole\Process(function () use ($i, $lock) {
        sleep(2);
        echo 'i的值：'.$i.PHP_EOL;
    }, false);


    $process->start();
    $lock->unlock();
}

$status = Swoole\Process::wait(true);
$status = Swoole\Process::wait(true);
$status = Swoole\Process::wait(true);
$status = Swoole\Process::wait(true);
$status = Swoole\Process::wait(true);

unset($lock);

// 程序结束时间
$end = microtime(true);
echo "用时：".($end - $start).PHP_EOL;