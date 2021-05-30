<?php
declare (strict_types = 1);

namespace app\listener\Task;
/**
 * 邮件发送异步处理类
 *
 * @package app\listener\TaskTest
 */
class EmailTask
{
    /**
     * 事件监听处理
     *
     * @return mixed
     */
    public function handle($event)
    {
        echo 'task任务开始处理：'.microtime(true).PHP_EOL;

        // 模拟异步任务处理时间
        sleep(5);

        echo 'task任务处理结束咯：'.microtime(true).PHP_EOL;
    }
}
