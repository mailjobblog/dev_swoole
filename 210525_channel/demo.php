<?php
$scheduler = new Swoole\Coroutine\Scheduler;

// 通道的构造方法
$channel = new Swoole\Coroutine\Channel();

// 生产者协程
$scheduler->add(function() use ($channel){

    // 向通道内写入数据
    $channel->push('wo-Shi-Channel');

    // 通道计数
    $length = $channel->length();

    echo "1# channel length: ".$length.PHP_EOL;
    echo '1# Coroutine'.PHP_EOL;

});

// 消费者协程
$scheduler->add(function() use ($channel){

    Swoole\Coroutine::sleep(1);

    $status = $channel->stats();
    var_dump($status);

    $length = $channel->length();

    for($i=0;$i<$length;$i++) {
        $value = $channel->pop();
        echo "2# value is ".$value.PHP_EOL;
    }

    echo '2# Coroutine2222222222222222'.PHP_EOL;

});

$scheduler->start();