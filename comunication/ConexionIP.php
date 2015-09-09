<?php
require_once 'Net/Socket.php';

/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConexionIP
 *
 * @author amaia
 */
class ConexionIP {
    private $strModeloExtron; // Nombre del modelo de extron con el que se ha hecho la conexion
    private $strDireccionIP; // Direccion IP en la que esta el extron
    private $strtipo;
    private $intPuertoCom; //Puerto COM (RS-232) del extron
    private $intPuerto; // Puerto en el que esta el extron
    private $socket;
    private $cabecera;
    private $trasera;
    private $conectado;
    private $disp;

    //DEFINICION DE CONSTANTES
    public static $IPL_T_SFI244 = "IPL T SFI244";
    public static $IPL_T_S4 = "IPL T S4";
    public static  $IPL_T_S6 = "IPL T S6";
    public static  $IPL_T_S2 = "IPL T S2";
    public static  $IPL_T = "IPL T";
    public static  $PUERTO_IR = "IR";
    public static  $PUERTO_IO = "IO";
    public static  $PUERTO_COM = "COM";
    function __construct($ip,$puertoSocket,$modeloExtron,$puertoExtron,$tipoPuerto) {
        $this->conectado=false;
        $this->strModeloExtron=$modeloExtron;
        $this->strDireccionIP=$ip;
        $this->strtipo=$tipoPuerto;
        $this->intPuerto=$puertoSocket;
        $this->intPuertoCom=$puertoExtron;

        $this->calcularCabecera();
    }
    public function calcularCabecera() {
    /** Metodo para calcular la cabecera que hay que añadir al mensaje cuando se envia al IPL T
     * @return void
     */

        if (strcmp($this->strModeloExtron,self::$IPL_T_SFI244)==0) {
            if(strcmp($this->strtipo, self::$PUERTO_IR)==0) { // En el caso del IR del DVD no se añade W1RS| solo W1
                $this->cabecera = "W" . $this->intPuertoCom;
            }

            else if(strcmp($this->strtipo, self::$PUERTO_IO)==0) { // En el caso del IO
                    $this->cabecera = "";
                }
                else {
                    $this->cabecera = "W".$this->intPuertoCom."RS|";
                // this.cabecera = this.ESCAPE+ this.intPuertoCom + "RS"+this.LF;
                }
        }
        else {
            $this->cabecera = "W" . $this->intPuertoCom . "RS|";
        }

    }

    public function calcularTrasera() {
    /** Metodo para calcular la trasera que hay que añadir al mensaje cuando se envia al IPL T
     * @return void
     */
        if (strcmp($this->strModeloExtron,self::$IPL_T_SFI244)==0) {

            if(strcmp($this->strtipo, self::$PUERTO_IR)==0) { // En el caso del IR se añade \r\n
                $this->trasera = "\r\n";
            }
            else {
                $this->trasera = "";
            }
        }
    }
    public function conect1() {
   
        $this->socket=new Net_Socket();
        $this->socket->connect($this->strDireccionIP, "23", true, 3 );

    }


    public function write1($comando) {
      

        $comando=$this->cabecera.$comando."\r\n";
        
        $len=strlen($comando);
        $respuesta=trim($this->socket->read(300));
        $this->socket->writeLine($comando);
	if(strcmp($this->strDireccionIP,"192.168.0.130")==0 && $this->intPuertoCom==5)
	  echo "generador multiventanas\n";
	else{
	  if(strpos($comando,"4RS|S")>0)
		  usleep(20000);
	  else
	    usleep($len*100000);
  //        sleep(ceil($len*0.0001) );
	    $respuesta=trim($this->socket->read(100));
	    $respuesta = trim($respuesta, "\x00..\x1F");
	    
	    system_class::log_message( "CMD ip:".$this->strDireccionIP.":".$this->intPuerto." COMANDO: ".trim($comando)." respuesta: ". trim($respuesta) );
	    return $respuesta;
       }
        
 
    }
   
    public function close1() {
  
        $this->socket->disconnect();
    }

}
?>
