<?php
require_once 'Net/Socket.php';
define('_PROPERTIES_FILE','extronInit.properties');

class extronInit {
  
  function __construct(){
    $cmdInit=$this->loadProperties();
    foreach ($cmdInit as $cmd ){
      $this->sendCommand($cmd['host'],$cmd['cmd']);
    }
  }
  function loadProperties(){
    if(!is_file(_PROPERTIES_FILE)){
      echo "\nERROR:: I not found "._PROPERTIES_FILE." file\n";
      return;
    }
    $rows=file(_PROPERTIES_FILE);
    $cmdInit=array();
    foreach($rows as $row){
      $row1=trim($row);
      if(empty($row1))continue;
      $row2=explode('#',$row1);
      $cmd=explode(';',$row2[0]);
      
      $cmdInit[]=array('host'=>$cmd[0],'cmd'=>$cmd[1]);
    }
    return $cmdInit;
    
  }
  
  function sendCommand($address,$command){
    $socket = new Net_Socket() ;

    // open connection
 
    $socket->connect("$address", 23, true, 3);
    
    $socket->writeLine($command);
    echo "\naddress:: $address command $comando";
    sleep(1);
    $respuesta=trim($socket->read(200));
    echo "\n respuesta: $respuesta\n";
    $socket->disconnect();
    echo "\ndisconnect..\n";
  
  }
}
$a=new extronInit();
?>