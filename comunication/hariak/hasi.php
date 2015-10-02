<?php
require_once('./comunication/hariak/serialClass/Serial_read_thread_class.php');
require_once('./comunication/hariak/socketClass/Socket_thread_class.php');
require_once('./comunication/hariak/class/system_class.php');
require_once ('./comunication/ConexionServidorCliente.php');
require_once './AccesoGui.php';
require_once './AccesoControladoresDispositivos.php';
require_once './status/status_class.php';

// number of executeThreads we want
define ("NUM_THREAD", 1);
// max delay (seconds) that controller can accept from child's ping
define ("CTRL_MAX_IDLE", 3);
// controller will check threads status every CTRL_POLLING_INTERVAL secs.
define ("CTRL_POLLING_INTERVAL", 5);
// The same as previos examples, with the add of the controller ping...



define('SYSLOG','true'); //true -> syslog, false ->stdout

define('LOG_LEVEL',0);
define('ADDRESS','0.0.0.0');
define('PORT','4321');
define('_WAITONSERIALERROR',60);
define('ROOT','/var/www/Tknika2/');
//$ctrl = new SerialThreadController("controllerThread", $executeThread, CTRL_MAX_IDLE, CTRL_POLLING_INTERVAL);


$a = new status_class();
$a->checkStatus();
echo "\n..........CHECK:BUKATUDA...............\n";
$a->initCmd();

echo "\n..........INIT:BUKATUDA...............\n";

new ConexionServidorCliente();

new AccesoControladoresDispositivos();
new AccesoGui();

$executeThread['socket'] = &new Socket_thread_class ('socket');
$executeThread['socket']->start();
echo "Started " . $executeThread['socket']->getName() . " with PID " . $executeThread['socket']->getPid() . "...\n";


$executeThread['read'] = &new Serial_read_thread_class ('read');
$executeThread['read']->start();
echo "Started " . $executeThread['read']->getName() . " with PID " . $executeThread['read']->getPid() . "...\n";


?>
