<?php

// 定义变量
$value = 'thisAttr';

$v = 'waimian';

// fork 出一个子进程
$pid = pcntl_fork();

echo "子进程的PID:{$pid}\n";

// posix_getpid() // 获取当前进程pid
// posix_getppid() // 获取当前进程的上级进程pid

if($pid == 0) { // 子进程空间内

    $v = 'son';
    echo "子进程的空间内：value：{$value}...v:{$v}...\n";

} else if($pid > 0) { // 父进程空间内

    $v = 'father';
    echo "父进程的空间内：value：{$value}...v:{$v}...\n";

} else { // 异常情况

}