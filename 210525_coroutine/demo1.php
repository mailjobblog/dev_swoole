<?php
// https://wiki.swoole.com/#/coroutine

echo 'start'.PHP_EOL;

Swoole\Coroutine::create(function(){

    Swoole\Coroutine::sleep(3);

    echo 'i am Coroutine'.PHP_EOL;

});

echo 'end'.PHP_EOL;