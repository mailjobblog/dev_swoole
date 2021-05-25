<?php
// 设置一个容量为50的channel
$chan = new \Swoole\Coroutine\Channel(50);
function t4(\Swoole\Coroutine\Channel $chan) {
    Co::sleep(0.005);    #1
    $chan->push([__METHOD__=>__LINE__]);    #2
}

function t5(\Swoole\Coroutine\Channel $chan) {
    Co::sleep(0.005);    #3
    $chan->push([__METHOD__=>__LINE__]);    #4
}

function t6(\Swoole\Coroutine\Channel $chan) {
    Co::sleep(0.005);    #5
    $chan->push([__METHOD__=>__LINE__]);    #6
}
go("t4", $chan);
go("t5", $chan);
go("t6", $chan);

// cousume协程：c1
go(function() use($chan) {
    // chan元素个数
    $chanNum = 3;
    // chan有数据时
    while($chanNum>0) {    #7
        $item = $chan->pop();    #8
        var_dump($item);    #9
        $chanNum --;
    }
});