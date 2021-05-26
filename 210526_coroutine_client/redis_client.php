<?php
use Swoole\Coroutine\Redis;
use function Swoole\Coroutine\run;

// 文档写法
run(function () {
    $redis = new Redis();
    $redis->connect('127.0.0.1', 6379);
    $redis->set('testkey','xiaoming');
    $val = $redis->get('testkey');
    echo $val;
});


// Scheduler 写法
$scheduler = new Swoole\Coroutine\Scheduler;
$scheduler->add(function(){
    $redis = new Redis();
    $redis->connect('127.0.0.1', 6379);
    $redis->set('testkey_sch','lalalalallalaal');
    $val = $redis->get('testkey_sch');
    echo $val;
});
$scheduler->start();