## 前言

用于测试 PHP 原生的 Event 事件类

## event_demo.php

基于 EventBase 和 Event 事件类，实现一个简单的事件模型进行测试

## event_socket

利用 event 实现一个 socket 资源。然后用客户端去连接服务端，并且像服务端发送测试消息，完成联通性测试

## event_swoole

基于 swoole 实现一个 event 资源。实现目标如上。