# 通过监听服务去关闭指定的TCP服务

## 需求描述

某直播平台，需要观察员去不定时的抽查直播平台的内容，对于直播网站不良的直播进行封禁和停播的处理。

## 服务分布

- 业务处理的TCP服务端口：9501
- 监听服务的端口：9556
- TCP服务：9505

## 代码实现过程

- 使用面向对象的语言实现该逻辑
- 通过对业务服务的操作，进而处理tcp服务的需求

## 测试过程

```shell
# 启动tcp服务
php server/tcpServer.php

# 启动业务服务
php admin/adminServer.php

# 进行测试
php test/xxxClient.php
```