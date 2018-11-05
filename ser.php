<?php
/**
 * Created by IntelliJ IDEA.
 * User: pc
 * Date: 11/5/2018
 * Time: 15:57
 */

use Frame\Services\Protocols\Http;
use Frame\Services\Socket;

include 'Frame/Services/Socket.php';
include 'Frame/Services/Protocols/Http.php';


Socket::ser("tcp://127.0.0.1:9999");
Socket::on('start', function ($bind = null) {
    print "start:{$bind}\n";
});

Socket::on('close', function (Socket $socket) {
    print "i'm closed fd:{$socket->_fd}\n";
});

Socket::on('read', function ($buf, Socket $socket) {
    $msg="i'm a server;\n receive msg:\n" . $buf . "\n";
    if(Http::size($buf)>0){
        $socket->write(Http::encode($msg));
    }
    $socket->write($msg);
});
Socket::loop();