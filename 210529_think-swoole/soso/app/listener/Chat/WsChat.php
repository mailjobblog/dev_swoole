<?php
declare (strict_types = 1);

namespace app\listener\Chat;

class WsChat
{
    /**
     * 事件监听处理
     *
     * @return mixed
     */
    public function handle($event)
    {
        var_dump($event);
    }
}
