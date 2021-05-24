<?php
// https://wiki.swoole.com/#/coroutine/coroutine?id=create

echo 'start'.PHP_EOL;

Go\run(function(){

    co::sleep(3);

    echo 'i am Coroutine'.PHP_EOL;

});

echo 'end'.PHP_EOL;