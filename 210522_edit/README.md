# Swoole 中代码实现的几种方式

## 面向过程

### 官方匿名函数实现

```php
$server->on('connect', function ($server, $fd){
    echo "connection open: {$fd}\n";
});
```

### 方法实现

```php
$server->on('connect', 'fun');

function fun($server, $fd){
    echo "connection open: {$fd}\n";
}
```

## 面向对象

### 对象类

```php
$server->on('connect', ['Test', 'fun']);

class Test{
    public function fun($server, $fd){
        echo "connection open: {$fd}\n";
    }
}
```

### 静态方法类

```php
$server->on('connect', 'Test::fun');

class Test{
    static public function fun($server, $fd){
        echo "connection open: {$fd}\n";
    }
}
```