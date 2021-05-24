<?php
// 程序开始时间
$start = microtime(true);

// 数据定义
$info = array(
    "status" => 1,
    "mailto" => "12345@qq.com",
    "smsto" => "123456"
);

/**
 * 开启两个进程
 *
 * 发送邮件进程 + 发送短信进程
 */
$mail_process = new Swoole\Process('sendMail',true);
$mail_process->start();// fork 一个子进程

$sms_process = new Swoole\Process('sendSMS',true);
$sms_process->start();

/**
 * 读取管道的内容
 */
echo $mail_process->read();
echo PHP_EOL;
echo $sms_process->read();
echo PHP_EOL;

// 回收结束调用的子进程
Swoole\Process::wait(true);// true 为阻塞
Swoole\Process::wait(true);

// 程序结束时间
$end = microtime(true);
echo "用时：".($end - $start).PHP_EOL;

/**
 * 发送邮件进程程序
 */
function sendMail(Swoole\Process $worker){
    global $info;

    // 模拟业务执行
    sleep(2);

    // 写入到管道
    $worker->write("子进程的pid：".$worker->pid."......邮件发送地址：".$info['mailto']);
}

/**
 * 发送短信进程程序
 */
function sendSMS(Swoole\Process $worker){
    global $info;
    if($info['status']==1){
        sleep(3);
        echo "短信息发送地址：".$info['smsto'];
    }
}

