<?php
$fp = stream_socket_client("tcp://127.0.0.1:8000");

fwrite($fp, "niHaoYa");

var_dump(fread($fp,65535));