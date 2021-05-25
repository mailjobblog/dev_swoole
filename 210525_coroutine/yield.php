<?php
// https://wiki.swoole.com/#/coroutine/coroutine?id=yield
// https://wiki.swoole.com/#/coroutine/coroutine?id=resume

/* 在 #1 中让出当前协程的执行权。
 * 然后 #2 协程去作为 resume 去响应
 * */

# 1
$cid = go(function () {
    echo "co 1 start\n";
    Swoole\Coroutine::yield();
    echo "co 1 end\n";
});

# 2
go(function () use ($cid) {
    echo "co 2 start\n";
    co::sleep(0.5);
    co::resume($cid);// resume
    echo "co 2 end\n";
});

Swoole\Event::wait();