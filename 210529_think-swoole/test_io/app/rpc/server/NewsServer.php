<?php
namespace app\rpc\server;

use app\rpc\interfaces\NewsInterface;

class NewsServer implements NewsInterface
{
    public function create($data)
    {
        // TODO: Implement create() method.
        // $news->save($data);
        return '创建新闻成功';
    }
    public function lists()
    {
        // TODO: Implement lists() method.

        return '新闻列表';
    }

    public function update($id)
    {
        // ![RPC服务端启动](http://img.github.mailjob.net/20210530181104.png)
        // ![RPC客户端创建命令](http://img.github.mailjob.net/20210530181012.png)
        // ![文件创建成功](http://img.github.mailjob.net/20210530180941.png)
        
        // ![rpc客户端调用成功浏览器展示](http://img.github.mailjob.net/20210530182218.png)

        return '更新'.$id.'成功';
    }
}


