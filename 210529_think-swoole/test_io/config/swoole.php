<?php

use think\swoole\websocket\socketio\Handler;
use think\swoole\websocket\socketio\Parser;

return [
    'server'     => [
        'host'      => env('SWOOLE_HOST', '0.0.0.0'), // 监听地址
        'port'      => env('SWOOLE_PORT', 9505), // 监听端口
        'mode'      => SWOOLE_PROCESS, // 运行模式 默认为SWOOLE_PROCESS
        'sock_type' => SWOOLE_SOCK_TCP, // sock type 默认为SWOOLE_SOCK_TCP
        'options'   => [ // Swoole 服务的配置，可以根据 Swoole 手册额外增加其它的 Swoole 配置
            'pid_file'              => runtime_path() . 'swoole.pid',//服务启动以后进程ID存放文件
            'log_file'              => runtime_path() . 'swoole.log',//Swoole 的日志文件
            'daemonize'             => false,//守护进程模式设置，true 后台运行
            // Normally this value should be 1~4 times larger according to your cpu cores.
            'reactor_num'           => swoole_cpu_num(), //后台启动的 Reactor 线程数
            'worker_num'            => swoole_cpu_num(),//设置启动的 Worker 进程数
            'task_worker_num'       => swoole_cpu_num(),//配置 Task 进程数
            'enable_static_handler' => true,//开启静态文件请求处理功能，需配合 document_root
            'document_root'         => root_path('public'),//配置静态文件根目录
            'package_max_length'    => 20 * 1024 * 1024,//配置发送输出缓存区内存尺寸
            'buffer_output_size'    => 10 * 1024 * 1024,//配置发送输出缓存区内存尺寸
            'socket_buffer_size'    => 128 * 1024 * 1024,//设置客户端连接最大允许占用内存数量
        ],
    ],
    'websocket'  => [
        'enable'        => true,//开启websocket服务
        'handler'       => Handler::class,
        'parser'        => Parser::class,
        'ping_interval' => 25000,//心跳检测
        'ping_timeout'  => 60000,
        'room'          => [    //聊天室 fd存储
            'type'  => 'table',
            'table' => [
                'room_rows'   => 4096,
                'room_size'   => 2048,
                'client_rows' => 8192,
                'client_size' => 2048,
            ],
            'redis' => [
                'host'          => '127.0.0.1',
                'port'          => 6379,
                'max_active'    => 3,
                'max_wait_time' => 5,
            ],
        ],
        'listen'        => [
//            'chat' => 'app\listener\chat'
        ],
        'subscribe'     => [],//websocket事件订阅
    ],
    'rpc'        => [
        'server' => [
             'enable'   => true,
             'port'     => 9666,
             'services' => [ //所有服务类的命名空间  进行注册
//                 \app\rpc\server\NewsServer::class,
             ],
        ],
//        'client' => [ //要调用远程服务器的信息
//
//            // 可以有更多服务端
//            //'xxx' => [                //服务端的标识，可以自定义
//            //   'host' => '127.0.0.1', // 服务端的IP地址
//            //    'port' => 9000        // 服务器对应的端口
//            //],
//
//        ],
    ],
    'hot_update' => [//热更新
        'enable'  => env('APP_DEBUG', false),//是否开启热更新
        'name'    => ['*.php'],//监控哪些类型的文件变动
        'include' => [app_path()],//监控哪些路径下的文件变动
        'exclude' => [],//排除目录
    ],
    //连接池
    'pool'       => [
        'db'    => [
            'enable'        => true,
            'max_active'    => 3,
            'max_wait_time' => 5,
        ],
        'cache' => [
            'enable'        => true,
            'max_active'    => 3,
            'max_wait_time' => 5,
        ],
        //自定义连接池
    ],
    'coroutine'  => [ //协程
        'enable' => true,
        'flags'  => SWOOLE_HOOK_ALL,
    ],
    'tables'     => [],
    //每个worker里需要预加载以共用的实例
    'concretes'  => [],
    //重置器
    'resetters'  => [],
    //每次请求前需要清空的实例
    'instances'  => [],
    //每次请求前需要重新执行的服务
    'services'   => [],
];
