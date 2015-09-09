<?php

define('ITZALI','0000407E0000000000000000000000000000ok');
define('PIZTU', '000043FE07D007D007D007D007D007D007D0ok');
define('DEVICE', '/dev/ttyS0');

class SerialClass {
  
    function execute($cmd){
      //echo "\ncmd:: $cmd";
      $a=exec($cmd,$out,$result);
      //echo "\nout: ".print_r($out,1);
      //echo "\nres: ".print_r($result,1);
    }
    function conf(){
      $cmd='stty -F '.DEVICE.' 9600 parenb -parodd cs7 hupcl cstopb cread clocal -crtscts ignbrk -brkint -ignpar -parmrk -inpck -istrip -inlcr -igncr -icrnl -ixon -ixoff -iuclc -ixany -imaxbel -iutf8 -opost -olcuc -ocrnl -onlcr -onocr -onlret -ofill -ofdel nl0 cr0 tab0 bs0 vt0 ff0 -isig -icanon -iexten -echo -echoe -echok -echonl -noflsh -xcase -tostop -echoprt -echoctl -echoke raw';

      $this->execute($cmd);
    }

    function openCom($mode){
        $fileHandler = fopen(DEVICE, $mode );
        return $fileHandler;

    }

    function closeCom($fileHandler){
         fclose($fileHandler);

    }

    function writeCom($fileHandler,$cmd){
      $this->conf();
      fwrite($file, "$cmd");

    }

    function readCom($fileHandler){
      $this->conf();
      $content=fread($fileHandler, 4);
      return $content;

    }

}

?>
