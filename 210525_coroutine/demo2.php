<?php
// https://wiki.swoole.com/#/coroutine/scheduler?id=coroutinescheduler

$scheduler = new Swoole\Coroutine\Scheduler;

$scheduler->add(function(){

    Swoole\Coroutine::sleep(3);

    echo 'i am Coroutine'.PHP_EOL;

});

$scheduler->add(function(){

    Swoole\Coroutine::sleep(1);

    echo 'i am Coroutine2222222222222222'.PHP_EOL;

});

$scheduler->start();