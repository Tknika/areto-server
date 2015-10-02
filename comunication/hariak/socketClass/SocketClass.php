
<?php

require_once ('./comunication/hariak/socketClass/xml2Array_class.php');
require_once ('./comunication/hariak/socketClass/flash_class.php');
require_once ('./comunication/hariak/class/system_class.php');
require_once ('./comunication/ConexionServidorCliente.php');
require_once './AccesoGui.php';
require_once './AccesoControladoresDispositivos.php';

class SocketClass {
    private static $read_sockets;
    var $master_socket;
    var $system;
    static $flash_sockets;
    var $download;
    var $sinta_client_class;
    var $changed_socket;
    private static $sockkk;
    private static $id_socket;
    private static $last_cmd;
    private static $last_client;

    function __construct( $id=1 ) {
	self::$id_socket=$id;
        self::$flash_sockets=array();
        //$this->system=new system_class();
        $this->server_socket();
    }


    static function  printSocket() {
        return self::$read_sockets;
    }

    function getFlashSockets(){

        return self::$flash_sockets;

    }
    //---- Function to Send out Messages to Everyone Connected ----------------------------------------

    function quit_socket($socket) {
        $this->noFlashSocket($socket);
        system_class::log_message("sinta_controller.php: quit_socket ");
        socket_shutdown($socket);
        $arrOpt = array('l_onoff' => 1, 'l_linger' => 1);
        socket_set_block($socket);
        socket_set_option($socket, SOL_SOCKET, SO_LINGER, $arrOpt);
        socket_close($socket);

        $index = array_search($socket, self::$read_sockets);
        unset(self::$read_sockets[$index]);


        if(!empty($socket) && is_array(self::$flash_sockets)) {
            $index = array_search($socket, self::$flash_sockets);
            if($index !== false) {
                system_class::log_message("close flash socket !!!!!!");
                unset(self::$flash_sockets[$index]);
            }
        }
    }
    function noFlashSocket($socket){
       if(in_array($socket,self::$flash_sockets)){
            unset(self::$flash_sockets[array_search($socket,self::$flash_sockets)]);
        }
    }

    function identify_socket($socket) {
        system_class::log_message("\n\nflash socket: $socket \n\n");
        self::$flash_sockets[]=$socket;
        return array('local'=>1);
    }

    function flash_cmd($socket, $buf) {

        $objXML = new xml2Array();
        $command = $objXML->parse($buf);

        if ($command===false) {
            system_class::log_message('ERROR: is not valid xml');
            return;
        }



        if($command['where']=='policy-file-request') {
            system_class::log_message('policy request');
            $fl= new flash_class();
            $xml=$fl->security_police();
            system_class::log_message("REQ= $xml ");
            if(socket_write($socket, "$xml\0")===FALSE) {
                system_class::log_message("ERROR writing to sinta: ".socket_strerror(socket_last_error()));
            }

        }elseif(strpos($command['value'],'BUTTON')!==false ) {
        //sintako beste pantaie idatzi beharrekoa
            echo "sinta_controller.php : Button pressed ".$this->changed_socket."\n";
        //$xml='<sinta sarr="'.$command['value'].'"/>';
        //$this->client_reply($socket, $command['value']);


        }elseif(strpos($command['value'],'PLC')!==false) {
            $this->noFlashSocket($socket);
            $cmd=split(':',$command["value"]);
            AccesoControladoresDispositivos::$ctrlAutomata->procesarComandoSala($cmd[1]);
            
        }else{
	    //AMAIARI AGINDUA
            //system_class::log_message("Command:: ".print_r($command,1));

            ConexionServidorCliente::procesarComandoPantalla($command["value"]);
	    system_class::log_message("\nCommand:: -------------------------FIN-----------\n\n");
        }

    }

    static function client_reply($buf) {
	$xml="<sinta sarr=\"".trim($buf)."\" />";
	if(!empty(self::$last_cmd) && $xml==self::$last_cmd){
	    return;
	}
	if(strstr($buf,':')===false){
	  //system_class::log_message("\nNO VALID:::: $xml ");
	  return;
	}

	self::$last_cmd=$xml;
	//system_class::log_message("\n_____client_reply______sid:: ".self::$id_socket." pid: ".posix_getpid()."  ppid: ".posix_getppid());
	

        if(is_array(self::$flash_sockets) && !empty(self::$flash_sockets)) {

	    foreach(self::$flash_sockets as $sk ) {
		system_class::log_message("write to flash socket:: ".print_r($sk,1) ." resp:: $xml"  );
                $len=strlen("$xml\0");
                $result=socket_write($sk, "$xml\0");
                usleep(20);
                if($result===false) {
                    system_class::log_message("ERROR writing to sinta: ".socket_strerror(socket_last_error()));

                }
		//socket batean bakarrik idatzi
		break;

            }

        }
    }

    function server_socket() {
    //---- Start Socket creation for PHP Socket Server -------------------------------------
        system_class::log_message("socket server hasi" );
        if (($master = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) < 0) {
            system_class::log_message("socket_create() failed, reason: " . socket_strerror($master) );
        }
        $this->master_socket=$master;
        system_class::log_message("create_socket");
        socket_set_option($master, SOL_SOCKET,SO_REUSEADDR, 1);
        if (($ret = socket_bind($master, ADDRESS, PORT)) < 0) {
            system_class::log_message("socket_bind() failed, reason: " . socket_strerror($ret) );
        }
        system_class::log_message("create_bind");
        if (($ret = socket_listen($master, 5)) < 0) {
            system_class::log_message("socket_listen() failed, reason: " . socket_strerror($ret) );
        }
        system_class::log_message("listen");
        self::$read_sockets = array($master);

        system_class::log_message("master:: ".print_r($master,1));


        //---- Create Persistent Loop to continuously handle incoming socket messages ---------------------
        while (true) {
            $changed_sockets = self::$read_sockets;
            $num_changed_sockets=socket_select($changed_sockets, $write = NULL, $except = NULL, NULL);

            system_class::log_message("IREKIAK:".join(self::$read_sockets,',')." ALDATUAK:".join($changed_sockets,',')."($num_changed_sockets)");

            if ($num_changed_sockets === false) {
                system_class::log_message("-------->ERROREA SOCKET-EAN<--------------");
            }

            if(empty(self::$read_sockets)) {
                system_class::log_message("SOCKETA HUTSIK DAGO");
                exit;
            }

            foreach($changed_sockets as $socket) {
                $this->changed_socket=$socket;
                if ($socket == $master) { //flash konexio berria
                    if (($client = socket_accept($master)) < 0) {
                        system_class::log_message( "socket_accept() failed: reason: " . socket_strerror($msgsock) );
                        continue;
                    } else {
                        array_push(self::$read_sockets, $client);
                        array_push(self::$flash_sockets, $client);
			self::$last_client=$client;
                    }

                }else { //flash-etik idazten dute

                    $bytes = socket_recv($socket, $buffer, 4096, 0);
                    if (trim($bytes) == 0 ) {
                        $this->quit_socket($socket);
                        continue;
                    }if ($buffer=='bye') {
                        $this->quit_socket($socket);
                        continue;
                    }else {
                        system_class::log_message("\n\n @@@jaso cmd berria====>".trim($buffer)."<=====\n");
                        $arr_buf=explode('>',$buffer);
                        
                        foreach($arr_buf as $buf) {
                            $buf=trim($buf);
                            if(!empty($buf)) {
                                $buf= $buf.'>';
                                system_class::log_message("FLASH CMD: ". trim($buf));
                                $this->flash_cmd($socket, $buf);
                            }
                        }
                    }
                }
            }
        }
    }
}
?>