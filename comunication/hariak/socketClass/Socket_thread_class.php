<?php
require_once ("./comunication/hariak/thread/Fork.php");
require_once("./comunication/hariak/socketClass/SocketClass.php");
require_once ('./comunication/hariak/class/system_class.php');

define('_WAITONERROR',60);

class Socket_thread_class extends PHP_Fork {
    var $counter;
    var $command;
    var $flashSockets;
    var $socket;

    function executeThread($name) {
        $this->PHP_Fork($name);
        $this->error = 0;
    }


    function run() {
        //while (true) {
            $this->error = 0;
            $this->socket=new SocketClass(rand());

            $this->setAlive();
        //}
    }

    function getCounter() {
        // parent process can call this facility method
        // in order to get back the actual value of the counter
        return $this->getVariable('counter');
    }

}

?>
