# socket聊天之私聊测试

## 简单测试socket服务是否成功

### 服务端配置

在 `app/swoole.php` 配置文件中，将要 `websocket.enable` 修改为 `true`  
默认 false，如果改为 true 则会把 http 的服务升级为 websocket 服务  

```php
<?php
use think\swoole\websocket\socketio\Handler;
return [
    /** ...此处省略... **/
    'websocket'  => [
        'enable'        => true,
        /** ...此处省略... **/
    ],
    /** ...此处省略... **/
];
```

运行以下命令启动框架

```shell
php think swoole
```

![](http://img.github.mailjob.net/20210530194038.png)

### 客户端配置

swoole文档中的websocket客户端配置：https://wiki.swoole.com/#/start/start_ws_server?id=%E8%BF%90%E8%A1%8C%E7%A8%8B%E5%BA%8F  

根据文档中的要求，配置 websocket 客户端  

本文中配置的 websocket html 下载地址：https://github.com/mailjobblog/dev_swoole/blob/master/210529_think-swoole/html_socket_test/websocket_connect_test.html

**测试**

可以在本地，直接打开这个 `html` 文件，查看 `console` 控制台是否成功

![](http://img.github.mailjob.net/20210530200129.png)

经过服务测试，发现并没有问题，那么接下来可以正式开始聊天的开发了。

## 聊天开发

**创建实现类**

此处 Open，Message，Close 的是 websocket 具备的 3 个基本事件的实现  
命名参考的是 swoole 文档中，websocket 服务端的命名，当然也可以自定义命名  

```shell
# 连接成功
php think make:listener Chat/WxOpen
# 消息发送
php think make:listener Chat/WxMessage
# 连接关闭
php think make:listener Chat/WxClose
```

**在 `app/event.php` 中注册以上3个服务**

```php
<?php
return [
    /** ...此处省略... **/
    'listen'    => [
        /** ...此处省略... **/
        // 聊天事件注册
        'swoole.websocket.Open' => array(
            app\listener\Chat\WxConnect::class
        ),
        'swoole.websocket.Message' => array(
            app\listener\Chat\WxChat::class
        ),
        'swoole.websocket.Close' => array(
            app\listener\Chat\WxClose::class
        ),
        /** ...此处省略... **/
    ],
    /** ...此处省略... **/
];
```

**除了上面在 `event.php` 中注册事件的方法外，还可以在 `config/swoole.php` 中注册服务，如下所示**

```php
<?php
use think\swoole\websocket\socketio\Handler;
return [
    /** ...此处省略... **/
    'websocket'  => [
        /** ...此处省略... **/
        'listen'        => [
            'open' => 'app\listener\Chat\WxConnect',
            'message' => 'app\listener\Chat\WxChat',
            'close' => 'app\listener\Chat\WxClose',
        ],
        /** ...此处省略... **/
    ],
    /** ...此处省略... **/
];
```

### 对象类的常用方法总结

```text
\think\Swoole\Websocket类对象方法：

broadcast：设置进行广播消息发送
isBroadcast：判断当前是否是广播模式
to：设置收件人fd或聊天室名（可以数组设置多个）
getTo：获取收件人fd或聊天室名
join：当前客户端加入到指定聊天室（可以多个）
leave：当前客户端离开指定聊天室（可以多个）
emit：消息发送
close：关闭当前连接
getSender：获取当前客户端id（即fd）
setSender：设置发件人的fd
```
