<?php
namespace app\rpc\Service;

use app\rpc\Interfaces\RpcTestInterface;

/**
 * 定义 Rpc 测试类的实现类
 */
class RpcTest implements RpcTestInterface {

    public function create()
    {
        $start = microtime(true);
        sleep(1);
        $end = microtime(true);

        return "数据创建成功，用时：".($end-$start);
    }

    public function select()
    {
        return array(
            "第一条数据文件",
            "two two two Data File",
        );
    }
}