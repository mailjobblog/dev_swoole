# Swoole多进程

## 文档

https://wiki.swoole.com/#/process/process?id=__construct

## demo.php 管道读取

- 首先定义两个进程 `发送邮件` 和 `发送短信` 
- 然后启动进程进行执行（可以在sleep模拟业务执行的时间）
- 最后，回收结束运行的子进程（wait 要在 start 之后）

**为什么要 wait 结束子进程**

每个子进程结束后，父进程必须都要执行一次 `wait()` 进行回收，否则子进程会变成僵尸进程，会浪费操作系统的进程资源。

**如果子进程不写入管道数据可以吗**

不可以。主进程会处于阻塞状态，等待子进程的管道数据。

## demo1.php 键盘读取

和 `demo.php` 相比，此处 `redirect_stdin_stdout` 设置为 `false` ，变成了键盘读取。

