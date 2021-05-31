<?php
namespace app\controller;

use app\BaseController;

class Index extends BaseController
{
    public function index()
    {
         return 'project 111';
    }

    public function hello($name = 'ThinkPHP6')
    {
        return 'hello,' . $name;
    }  //\Swoole\Server $server
    public function task(\think\swoole\Manager $manager){

//       $server_app =  app('swoole.server');
//
//        var_dump(get_class($server_app));

      $server =   $manager->getServer();
        var_dump(get_class($manager->getServer()));

//        $server->task(\app\listener\EamilTask::class);



        return '后面的逻辑';
//        var_dump(get_class($server));

    }
}
