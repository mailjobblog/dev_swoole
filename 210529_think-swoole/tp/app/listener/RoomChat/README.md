# room聊天室测试


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