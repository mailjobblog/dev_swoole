# RPC 远程调度测试

## Server端

即为 tp 目录，可在 tp 目录下查看下方相关的配置文件

### 编写RPC接口

- 在 app 目录下创建 rpc 目录，用作编写 rpc 接口的文件目录
- 在 rcp 目录下创建 Interfces 和 Service 目录，用于定义接口和接口的实现

### 编写Server的RPC配置文件

- 在 `app/swoole.php` 文件中，`rpc.server.services` 注册编写的 rpc 接口类
- 将 `enable` 设置为 `true`，即为打开服务器端的 rpc 允许客户端调用

```php
<?php

use think\swoole\websocket\socketio\Handler;

return [
    /** ...省略... **/
    'rpc'        => [
        'server' => [
            'enable'   => true,
            'port'     => 9999, # 定义 server 的 rpc 的调用端口
            'services' => [ //所有服务类的命名空间  进行注册
                \app\rpc\Service\RpcTestService::class
            ],
        ],
        'client' => [
        ],
    ],
    /** ...省略... **/
];

```

### 启动server的RPC服务

```shell
php think swoole start
或者
php think swoole:rpc
```

![RPC服务端启动](http://img.github.mailjob.net/20210530181104.png)

## Client端

即为 tp_rpc_client 目录，可在 tp_rpc_client 目录下查看下方相关的配置文件

### 编写Client的RPC配置文件

- 在 `app/swoole.php` 文件中，`rpc.client` 注册编写的远程的rpc服务端口和ip
- 可以配置多个rpc服务端
- 服务端的名称可以自定义

```php
<?php

use think\swoole\websocket\socketio\Handler;

return [
    /** ...省略... **/
    'rpc'        => [
        'server' => [
            'enable'   => false,
            'port'     => 9000,
            'services' => [ //所有服务类的命名空间  进行注册
            ],
        ],
        'client' => [
            // 可以配置多个RPC服务端
            'tp_rcp_demo' => [     //服务端的标识，可以自定义
                'host' => '127.0.0.1', // 服务端的IP地址
                'port' => 9999       // 服务器对应的端口
            ],
        ],
    ],
    /** ...省略... **/
];
```

### 客户端创建rpc接口服务

在客户端框架（tp_rcp_client）执行以下命令，则可以获取到 rpc 的接口服务

```shell
php think rpc:interface
```

![RPC客户端创建命令](http://img.github.mailjob.net/20210530181012.png)

成功后，可以看到 `app/rpc.php` 文件

![文件创建成功](http://img.github.mailjob.net/20210530180941.png)

### 客户端准备测试

**创建测试控制器**

```shell
php think  make:controller RpcTest
```

在 RpcTest 编写测试代码，关于调用的接口，可以参照生成的 rcp 里面提供的接口

```php
<?php
declare (strict_types = 1);
namespace app\controller;
use think\Request;
use rpc\contract\tp_rcp_demo\RpcTestInterface;
class RpcTest
{
    public function index(RpcTestInterface $rpcTest)
    {
        $r1 = $rpcTest->create();
        echo "客户端调用文件创建返回信息：".$r1."<br>";

        $r2 = $rpcTest->select();
        echo "文件查询返回信息：".json_encode($r2);
    }
}
```

**定义访问路由**

在 `route/app.php` 添加路由

```php
Route::get('rpc', 'RpcTest/index');
```

**启动服务**

```shell
php think swoole
```

**浏览器访问路由，看到调用远程RPC方法成功**

```text
客户端调用文件创建返回信息：数据创建成功，用时：1.0060729980469
文件查询返回信息：["\u7b2c\u4e00\u6761\u6570\u636e\u6587\u4ef6","two two two Data File"]
```

![rpc客户端调用成功浏览器展示](http://img.github.mailjob.net/20210530182218.png)