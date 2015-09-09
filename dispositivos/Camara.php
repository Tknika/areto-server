<?php
/**
 * page-level  package
 *
 * @package PHP::dispositivos
 *
 */
/**
 * includes
 *
 */
require_once './dispositivos/Camaras.php';
require_once './utils/Utils.php';
require_once './estadoDispositivos.properties';

/**
 * Clase que controla las camaras
 *
 * @package PHP::dispositivos
 */
class Camara extends Camaras {


    /**
     * Atributo para acercar el zoom
     *
     * @static
     * @access private
     */
    private static $ZOOMI = "0004";

    /**
     * Atributo para alejar el zoom
     *
     * @static
     * @access private
     */
    private static $ZOOMO = "0400";

    /**
     * Atributo para mover la camara a la derecha
     *
     * @static
     * @access private
     */
    private static $PANR = "0010";

    /**
     * Atributo para mover la camara a la izquierda
     *
     * @static
     * @access private
     */
    private static $PANL = "1000";

    /**
     * Atributo para mover la camara hacia arriba
     *
     * @static
     * @access private
     */
    private static $TILTU = "0800";

    /**
     * Atributo para mover la camara hacia abajo
     *
     * @static
     * @access private
     */
    private static $TILTD = "0008";

    /**
     * Atributo para enfocar la camara
     *
     * @static
     * @access private
     */
    private static $FOCN = "0200";

    /**
     * Atributo para desenfocar la camara
     *
     * @static
     * @access private
     */
    private static $FOCF = "0002";

    /**
     * Atributo para parar la camara
     *
     * @static
     * @access private
     */
    private static $PARARV = "0000";

    /**
     *
     * @private <type>
     */
    private $presetActual="a";

    function  __construct($dispositivo) {

        $this->tipoDispositivo="Camara";
         $this->cameraStatus=new Properties();
        $this->cameraStatus->load(file_get_contents("./sinta.properties"));
        $this->status=$this->cameraStatus->getProperty($this->disp.".status");
        parent::__construct($dispositivo);
        echo($this->ip."-".$this->modeloIPLT."-".$this->strMarca."-".$this->strModelo."-".$this->id_disp."-".$this->tipoPuerto."-".$this->numeroPuerto."-".$this->baudRate."-".$this->timeOut."-".$this->puerto."-".$this->password);

    }

    /**
     * Metodo que indica cual es el identificador de la camara
     *
     * @access public
     * @return string El identificador
     */
    function getIdCamara() {
        return $this->id_disp;
    }

//    /**
//     * Metodo que crea el comando para mover hacia la derecha y envia el comando a la camara
//     *
//     * @access public
//     */
//    public function moverALaDerecha( ) {
//
//        $comando=$this->comandos1["panright"];
//        $comando=$this->procesarComando($comando,self::$PANR);
//        $res=$this->enviarComando($comando);
//
//    } // end of member function moverALaDerecha
//
//     /**
//     * Metodo que crea el comando para mover hacia la izquierda y envia el comando a la camara
//     *
//     * @access public
//     */
    public function moverALaIzquierda( ) {

        $comando=$this->comandos1["panleft"];
        $comando=$this->procesarComando($comando,self::$PANL);
        $res=$this->enviarComando($comando);

    } // end of member function moverALaIzquierda
//
//    /**
//     * Metodo que crea el comando para mover hacia arriba y envia el comando a la camara
//     *
//     * @access public
//     */
    public function moverArriba( ) {

        $comando=$this->comandos1["tiltup"];
        $comando=$this->procesarComando($comando,self::$TILTU);
        $res=$this->enviarComando($comando);

    } // end of member function moverArriba
//
//    /**
//     * Metodo que crea el comando para mover hacia abajo  y envia el comando a la camara
//     *
//     * @access public
//     */
//    public function moverAbajo( ) {
//
//        $comando=$this->comandos1["tiltdown"];
//        $comando=$this->procesarComando($comando,self::$TILTD);
//        $res=$this->enviarComando($comando);
//
//    } // end of member function moverAbajo
//
//    /**
//     * Metodo que crea el comando para desenfocar y envia el comando a la camara
//     *
//     * @access public
//     */
    public function desenfocar() {

        $comando=$this->comandos1["desenfocar"];
        $comando=$this->procesarComando($comando,self::$FOCF);
        $res=$this->enviarComando($comando);

    }


    /**
     * Metodo que crea el comando para mover la camara a la posicion indicada
     * por el parametro y lo envia a la camara
     *
     * @param int $presetNum
     * @access public
     */
    public function preset($presetNum) {


        //$preset="preset".$presetNum."camara";
        //$comando=$this->comandos1[$preset];
        $this->presetActual=$presetNum;
        $presetNum=(int)$presetNum;
        $presetNum=dechex($presetNum);
        echo $this->getIdCamara()."id de la camara \n<br>".$presetNum."<br>";
        $comando=$this->procesarComando("", array("preset"=>$presetNum,"id"=>$this->getIdCamara()));
        $res=$this->enviarComando($comando);
        //$this->guardarEstado();

    }

//    /**
//     * Metodo para enfocar y enviar el comando a la camara
//     *
//     * @accesspublic
//     */
    public function enfocar() {

        $comando=$this->comandos1["enfocar"];
        $comando= $this->procesarComando($comando,self::$FOCN);
        $this->enviarComando($comando);

    }
//
//    /**
//     * Acerca el zoom de la camara
//     *
//     * @access public
//     */
    public function acercarZoom() {

        $comando=$this->comandos1["zoommas"];
        $comando= $this->procesarComando($comando,self::$ZOOMI);
        $this->enviarComando($comando);

    }
//
//    /**
//     * Aleja el zoom de la camara
//     *
//     * @access public
//     */
    public function alejarZoom() {

        $comando=$this->comandos1["zoommenos"];
        $comando=$this->procesarComando($comando,self::$ZOOMO);
        $this->enviarComando($comando);

    }

    /**
     * Utilizando los datos del parametro $parametro genera un string con el comando adecuado
     * para la camara
     * @param string  $comando
     * @param array $parametro
     * @return string
     */
    public function procesarComando($comando,$parametro) {

        $PacketLengthByte=0x86;
        $HOA=(int)dechex(substr($parametro["id"], 0,2));
        $LOA=(int)dechex(substr($parametro["id"], 2,2));

        if(strcmp($this->getIdCamara(),"0002")==0) {
            $HOA=0x00;
            $LOA=0x02;
        } elseif(strcmp($this->getIdCamara(),"0001")==0) {
            $HOA=0x00;
            $LOA=0x01;
        }else {
            $HOA=0x00;
            $LOA=0x00;
        }

        $opcode=0x07;
        $data1=0x05;

        if(empty($parametro["preset"])) {
            $data2=0x01;
        }else {
            $data2=(int)hexdec($parametro["preset"]);
        }
        $sD=$PacketLengthByte+$HOA+$LOA+$opcode+$data1+$data2;
        $sH=dechex($sD);
        $csum=(int)($sD & 127);
        $comando = pack("ccccccc", $PacketLengthByte,$HOA,$LOA,$opcode,$data1,$data2,$csum);
        return $comando;


    }

    /**
     * Envia el comando a la camara (sin necesidad de agregarle el comando del extron)
     *
     * @access public
     * @param string $comando
     */
    public function enviarComando($comando) {

        $address='192.168.0.252';

        if(strcmp($this->getIdCamara(),"0002")==0) {

            $port='2005';
        }
        else if(strcmp($this->getIdCamara(),"0001")==0) {

            $port='2003';

        }
        else if(strcmp($this->getIdCamara(),"0000")==0) {

            $port='2004';

        }
       
      if($this->status=="" ||  $this->status==0) {
            $fp = fsockopen($address, $port, $errno, $errstr, 30);
            socket_set_timeout($fp,2);
            fwrite($fp, $comando);
            usleep(10000);
            fclose($fp);

        }

    }

    /**
     * Guarda los valores de los atributos en el archivo estadoDispositivos.properties
     */
    public function guardarEstado() {

        $this->estadoDispositivo=new Properties();
        $this->estadoDispositivo->load(file_get_contents("./estadoDispositivos.properties"));
        $this->estadoDispositivo->setProperty($this->disp.".preset",$this->presetActual);
        //   file_put_contents('./estadoDispositivos.properties', $this->estadoDispositivo->toString(true));

    }

} // end of Camara
?>
