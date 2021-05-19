<?php
$fp = stream_socket_client("tcp://127.0.0.1:8000");

fwrite($fp, "niHaoYa6666666666666666");

var_dump(fread($fp,65535));