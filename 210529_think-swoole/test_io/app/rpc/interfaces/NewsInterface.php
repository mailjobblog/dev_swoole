<?php
namespace app\rpc\interfaces;

interface NewsInterface
{
    public function create($data);

    public function lists();

    public function update($id);
}
