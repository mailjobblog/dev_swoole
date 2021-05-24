<?php
// https://wiki.swoole.com/wiki/page/p-coroutine.html

echo 'start'.PHP_EOL;

go(function(){

    co::sleep(3);

    echo 'i am Coroutine'.PHP_EOL;

});

echo 'end'.PHP_EOL;