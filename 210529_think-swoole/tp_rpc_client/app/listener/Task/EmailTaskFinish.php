<?php
declare (strict_types = 1);

namespace app\listener\Task;
/**
 * 异步邮件发送成功后的响应
 *
 * @package app\listener\TaskTest
 */
class EmailTaskFinish
{
    /**
     * 事件监听处理
     *
     * @return mixed
     */
    public function handle($event)
    {
        echo "EmailTaskFinish".PHP_EOL;
        $event->finish();
    }
}
