<?php
declare (strict_types = 1);

namespace app\controller\Task;

use think\Request;
use app\BaseController;

/**
 * TaskTest 任务测试控制器
 *
 * @package app\controller\TaskTest
 */
class TaskTest extends BaseController
{
    /**
     * 测试批量邮件发送
     *
     * @return \think\Response
     */
    public function index(\think\Swoole\Manager $manager)
    {
        echo "task控制器开始处理 Start....".microtime(true).PHP_EOL."<br/>";
        $server = $manager->getServer();
        $server->task(\app\listener\Task\EmailTask::class);
        echo "task控制器处理结束啦啦啦 End....".microtime(true).PHP_EOL."<br/>";
    }

    /**
     * 3种调用方式演示
     *
     * demo1: swoole原生的方式
     * demo2: 依赖注入的方式
     * demo3: thinkphp提供的方式
     *
     * 测试说明：
     * 可以用 get_class 获取对象类名查验
     * 还可以用 get_class_methods 返回类中的对象数组
     */
    public function demo1(\Swoole\Server $server){
        var_dump($server);
    }
    public function demo2(\think\Swoole\Manager $manager){
        var_dump($manager->getServer());
    }
    public function demo3(){
        $server = app('swoole.server');
        var_dump($server);
    }
}
