# 协程实现的Demo

## 参考文档

- 新版文档：https://wiki.swoole.com/#/runtime
- 新版文档（协程高级）：https://wiki.swoole.com/#/coroutine
- 新版文档（协程调度）：https://wiki.swoole.com/#/coroutine/scheduler?id=coroutinescheduler
- 旧版文档：https://wiki.swoole.com/wiki/page/p-coroutine.html

## 两种密集表示方法

**CPU密集**

```php
sleep(int second);
```

**IO密集**

```php
Co::sleep(int second);
```

## demo-x.php

是协程的几种写法

## yield.php

手动让出协程的执行权