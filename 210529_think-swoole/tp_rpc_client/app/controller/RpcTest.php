<?php
declare (strict_types = 1);

namespace app\controller;

use think\Request;

use rpc\contract\tp_rcp_demo\RpcTestInterface;

class RpcTest
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(RpcTestInterface $rpcTest)
    {
        $r1 = $rpcTest->create();
        echo "客户端调用文件创建返回信息：".$r1."<br>";

        $r2 = $rpcTest->select();
        echo "文件查询返回信息：".json_encode($r2);
    }


}
