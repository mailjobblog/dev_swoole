<?php
// fork 一个子进程
$pid = pcntl_fork();

if( $pid == 0) # 子进程空间内
{
    //注意在php创建消息队列，第二个参数会直接转成字符串，可能会导致通讯失败
    $msg_key = ftok(__DIR__,'u');
    $msg_queue = msg_get_queue($msg_key);
    // 子进程发送消息
    msg_send($msg_queue,10,"我是子进程发送的消息");
    exit();
}
else if ($pid) # 父进程空间内
{
    //注意在php创建消息队列，第二个参数会直接转成字符串，可能会导致通讯失败
    $msg_key = ftok(__DIR__,'u');
    $msg_queue = msg_get_queue($msg_key);
    msg_receive($msg_queue, 10, $message_type, 1024, $message);
    var_dump($message);

    // 父进程接收消息
    pcntl_wait($status);
    msg_remove_queue($msg_queue);
}
