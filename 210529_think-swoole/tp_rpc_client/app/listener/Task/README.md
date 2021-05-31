# Task 异步任务测试

## 修改服务端口

在swoole的配置文件 `config/swoole.php` 修改访问端口

```shell
swoole.port = xxxx
```

## Task创建

### 创建 task 处理类

```shell
# task 任务处理
php think make:listener TaskTest/EmailTask

# 任务处理完毕响应
php think make:listener TaskTest/EmailTaskFinish
```

### 注册task事件

在事件管理文件 `app/event.php` 进行事件注册文件的修改

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

## 测试

### 创建测试控制器

```shell
php think make:controller TaskTest/TaskTest
```

### 创建访问路由

在路由文件 `route/app.php` 配置访问 task 控制的的路由

```php
Route::get('test', 'app\\controller\\Task\\TaskTest/index');
```

### 服务器启动框架

```shell
php think swoole
```

### 访问测试

可以看到 task 任务的执行并不会阻塞 task Controller 里面代码的执行  
task mail 里面阻塞了 5 秒，由截图也可以观察到  

![浏览器截图](http://img.github.mailjob.net/20210530172420.png)

![服务器截图](http://img.github.mailjob.net/20210530172454.png)