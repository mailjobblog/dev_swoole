# ThinkPHP 6.0 测试 think-swoole

## 基础环境

- thinkPHP 6.6
- think-swoole 3.1

## 框架安装

### 安装vendor依赖

```shell
composer update
```

#### 测试框架是否安装成功

https://www.kancloud.cn/manual/thinkphp6_0/1037481#_61

#### 测试swoole是否安装成功

https://www.kancloud.cn/manual/thinkphp6_0/1359700

## Task异步任务测试

https://github.com/mailjobblog/dev_swoole/tree/master/210529_think-swoole/tp/app/listener/Task

## RPC远程调度测试

https://github.com/mailjobblog/dev_swoole/tree/master/210529_think-swoole/tp/app/rpc

## 简单的单聊测试

https://github.com/mailjobblog/dev_swoole/tree/master/210529_think-swoole/tp/app/listener/Chat

## room聊天室测试

https://github.com/mailjobblog/dev_swoole/tree/master/210529_think-swoole/tp/app/listener/RoomChat

## 常见问题

### 事件注册的名称绑定命名规范

**问题描述：** 在 `app/event.php` 事件监听中绑定的类似 `open、close、message` 等命名上面有什么规范

```php
<?php
return [
    /** ...此处省略... **/
    'listen'    => [
        /** ...此处省略... **/
        // 聊天事件注册
        'swoole.websocket.Open' => array(
            app\listener\Chat\WsOpen::class
        ),
        'swoole.websocket.Close' => array(
            app\listener\Chat\WsClose::class
        ),
        'swoole.websocket.Message' => array(
            app\listener\Chat\WsMessage::class
        ),
        /** ...此处省略... **/
    ],
    /** ...此处省略... **/
];
```

**问题解答：**

首先 `swoole.websocket` 命名是一个固定的命名，可以追一下 think-swoole的源码就明白了  
其他的 `open、close、message` 其实可以自定义命名，但是也有规范。实际think-swoole用到了反射，如果随意命名会导致无法注入服务   
这部分的命名要参考前端绑定的事件命名，两者必须要匹配上，这样才可以被后端的服务正确的反射   
例如图中，`emit` 发送消息绑定的是 `message` 事件。到达后端后，后端会根据 `event` 里注册 `swoole.websocket.Message` 找到 `app\listener\Chat\WsMessage::class` 然后注入进去

![](http://img.github.mailjob.net/20210531202737.png)

### task事件注册命名有什么不同吗

**问题描述：** 在 `app/event.php` task命名的 `swoole.task` 有规范吗

```php
<?php
return [
    /** ...省略... **/
    'listen'    => [
        /** ...省略... **/

        // 注册 task 异步任务
        'swoole.task' => array(
            app\listener\Task\EmailTask::class,
        ),
    ],
    /** ...省略... **/
];
```

**问题解答：**

执行流程描述是这样的，在 `app/controller/Task/TaskTest.php` 中 `server` 调用 `task` 事件时，服务会把 `event` 事件绑定中的 `swoole.task` 中的类注入进来，由于 `controller` 中 `task` 调用的时候制定了 `EmailTask` 的事件类，所以服务交由 `EmailTask` 进行处理  
对于task异步任务 `swoole.task` 是一个固定的写法，没法更改
=======
>>>>>>> c42ba9bda29ef9a3574659b6e76248d8c1c19435
