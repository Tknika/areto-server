<?php
require_once ("./comunication/hariak/thread/Fork.php");
require_once("./comunication/hariak/serialClass/serialClass.php");

/*require_once './controlDispositivos/ControladorAutomata.php';
require_once './AccesoControladoresDispositivos.php';
*/



class Serial_read_thread_class extends PHP_Fork {
    var $counter;
    var $command;
    
    function executeThread($name) {
        $this->PHP_Fork($name);
        $this->error = 0;
    }


    function run() {
        while (true) {
            $this->error = 0;

            $serialClass=new SerialClass();
            $fileHandler=$serialClass->openCom('r');
            
            if($fileHandler === false ){
                $this->error="I cant open serial device";
                sleep(_WAITONSERIALERROR);
                continue;
            }

            $cmd=$serialClass->readCom($fileHandler);
            if($cmd===FALSE){
                $this->error="I cant read from device";
                sleep(_WAITONSERIALERROR);
                continue;
            }

            $result=$serialClass->closeCom($fileHandler);
            if($fileHandler === false ){
                $this->error="I cant close serial device";
                sleep(_WAITONSERIALERROR);
                continue;
            }

            $cmd=trim($cmd);
            if(!empty($cmd)){
                echo "\n jaso dut cmd:: $cmd ";
                //proba---socket---

                $fp = fsockopen('localhost', PORT, $errno, $errstr, 30);
                $cmd="<sinta case=\"PLC:{$cmd}\" />\n";
echo "\n bidali PLCtik $cmd ";
                fwrite($fp,$cmd);
                usleep(10);
                fclose($fp);
                
                ///////////////////comunicacion con automata/////////////
               
                //AccesoControladoresDispositivos::$ctrlAutomata->procesarComandoSala($cmd);
            }

            $this->setAlive();
        }
    }

}

?>
