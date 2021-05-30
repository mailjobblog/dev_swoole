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

本文中配置的html下载地址：



```shell
# 连接成功
php think make:listener Chat/WxOpen
# 消息发送
php think make:listener Chat/WxMessage
# 连接关闭
php think make:listener Chat/WxClose
# 连接成功
php think make:listener RoomChat/WxOpen
# 消息发送
php think make:listener RoomChat/WxMessage
# 连接关闭
php think make:listener RoomChat/WxClose
```


