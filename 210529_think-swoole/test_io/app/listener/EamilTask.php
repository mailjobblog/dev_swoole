<?php
declare (strict_types = 1);

namespace app\listener;

class EamilTask
{
    /**
     * 事件监听处理
     *
     * @return mixed
     */
    public function handle($event)
    {
        //
//        var_dump($event);
        echo '处理前'.time();

        sleep(5);

        echo '处理后'.time();
    }
}
