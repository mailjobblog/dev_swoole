<?php

/**
 * 设置事件库
 * https://www.php.net/manual/zh/class.eventbase.php
 */
$eventBase = new EventBase();

/**
 * 定义事件类
 * https://www.php.net/manual/zh/event.construct.php
 * base 要关联的事件库
 * fd 计时器使用 -1，信号则使用信号编号
 * what （Event::TIMEOUT | Event::PERSIST）表示定时并且不结束
 * cb 事件的回调函数
 */
$event = new Event($eventBase, -1, Event::TIMEOUT | Event::PERSIST, function(){
    // 事件类的动作
    echo microtime(true). ": 我第一次来了\n";
});

/**
 * 将事件挂起 设置事件时间
 * https://www.php.net/manual/zh/event.add.php
 */
$event->add(2);// 2 秒


// 重复上面的功能
$event1 = new Event($eventBase, -1, Event::TIMEOUT | Event::PERSIST, function(){
    echo microtime(true). ": 嘎嘎嘎嘎，我又来了\n";
});
$event1->add(0.5); // 0.5 秒

/**
 * 调度未解决的事件 将事件变成活动状态
 * https://www.php.net/manual/zh/eventbase.loop.php
 */
$eventBase->loop();