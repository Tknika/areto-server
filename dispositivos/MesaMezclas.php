<?php
/**
 * page-level  package
 *
 *  @package PHP::dispositivos
 *
 */
/**
 * includes
 *
 */
require_once './dispositivos/DispositivoIP.php';


/**
 * class MesaMezclas
 * @package PHP::dispositivos
 */
class MesaMezclas extends DispositivoIP {

    /**
     * Indice asociativo del microfono 1 de la presidencia
     *
     * @var string
     * @static
     * @access public
     */
    public static $MICRO_1 = "M1";
    /**
     * Indice asociativo del microfono 2 de la presidencia
     *
     * @var string
     * @static
     * @access public
     */
    public static $MICRO_2 = "M2";
    /**
     * Indice asociativo del microfono 3 de la presidencia
     *
     * @var string
     * @static
     * @access public
     */
    public static $MICRO_3 ="M3";
    /**
     * Indice asociativo del microfono 4 de la presidencia
     *
     * @var string
     * @static
     * @access public
     */
    public static $MICRO_4 = "M4";
    /**
     * Indice asociativo del microfono  del atril1
     *
     * @var string
     * @static
     * @access public
     */
    public static $ATRIL = "M5";
    /**
     * Indice asociativo del microfono del atril2
     *
     * @var string
     * @static
     * @access public
     */
    public static $ATRIL_2 = "M6";
    /**
     * Indice asociativo de la videoconferencia
     *
     * @var string
     * @static
     * @access public
     */
    public static $VIDEOCONFERENCIA ="videoconferencia";
    /**
     * Indice asociativo del servidor
     *
     * @var string
     * @static
     * @access public
     */
    public static $SERVIDORES = "servidor";
    /**
     * Indice asociativo del microfono inalambrico1
     *
     * @var string
     * @static
     * @access public
     */
    public $MICRO_INALAMBRICO = "inalambrico1";
    /**
     * Indice asociativo del microfono inalambrico2
     *
     * @var string
     * @static
     * @access public
     */
    public $MICRO_INALAMBRICO_2 = "inalambrico2";
    /**
     * Indice asociativo del dvd
     *
     * @var string
     * @static
     * @access public
     */
    public $DVD = "dvd";
    /**
     * Indice asociativo del grabador de dvd
     *
     * @var string
     * @static
     * @access public
     */
    public $DVD_GRABADOR = "grabador";
    /**
     * Canal 1 de la mesa de mezclas
     *
     * @var string
     * @static
     * @access public
     */
    public static $CANAL1="b0";
    /**
     * Canal 2 de la mesa de mezclas
     *
     * @var string
     * @static
     * @access public
     */
    public static $CANAL2="b1";
    /**
     * Valor del volumen cuando se apaga
     *
     * @var int
     * @static
     * @access public
     */
    public static $VOLOFF=0;
    /**
     *Valor del volumen cuando se enciende
     *
     * @var int
     * @static
     * @access public
     */
    public static $VOLON=127;
    /**
     * Volumen maximo de la mesa
     *
     * @var int
     * @static
     * @access public
     */
    public static $VOLMAX = 120;
    /**
     * Volumen minimo de la mesa
     *
     * @var int
     * @static
     * @access public
     */
    public static $VOLMIN = 0;
    /**
     * Valor que indica si vamos a hacer un preset o no
     *
     * @var bool
     * @access private
     */
    private $preset=false;
    /**
     * Fader de cada dispositivo
     *
     * @var array
     * @static
     * @access private
     */
    private static $fader=array("M1"=>1,"M2"=>2,"M3"=>3,"M4"=>4,"M5"=>5,"M6"=>6,"M12"=>12,"videoconferencia"=>9,"servidores"=>10,"inalambrico1"=>11,"inalambrico2"=>12,"dvdL"=>13,"dvdR"=>14,"grabadorL"=>15,"grabadorR"=>16,"master"=>-33,"aux2"=>49);
    /**
     * Volumen de cada dispositivo
     * @var array
     * @access public
     */
    private $volumenEntradas=array("M1"=>100,"M2"=>100,"M3"=>100,"M4"=>100,"M5"=>100,"M6"=>100,"M12"=>100,"videoconferencia"=>100,"servidores"=>100,"inalambrico1"=>100,"inalambrico2"=>100,"dvdL"=>100,"dvdR"=>100,"grabadorL"=>100,"grabadorR"=>100,"master"=>60,"aux2"=>60);

    function  __construct($dispositivo) {

        $this->tipoDispositivo="MesaMezclas";
        $this->mesa=new Properties();
        $this->mesa->load(file_get_contents("./sinta.properties"));
        $this->status=$this->mesa->getProperty($this->tipoDispositivo.".status");
        parent::__construct($dispositivo);
//        $this->cargarEstado();
    }


    /**
     * Metodo para subir el volumen del canal ($canal) y fader ($fader) indicados como parametros
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     * @param string $canal
     * @param int $fader
     */
    public function subirVolumen( $canal,$fader ) {

        
        $volumen = "";
        $this->setVol($fader, $this->getVol($fader) + 10);
        $volumen = $this->getVol($fader);
        //  $comando=$this->comandos1[DaoControl::$SONIDO];
        $comando=$this->procesarComando("", array("canal"=>$canal,"fader"=>self::$fader[$fader],"volumen"=>$volumen));
        $this->guardarEstado();
        $this->enviarComando($comando);
        

    } // end of member function subirVolumen

    /**
     * Metodo para bajar el volumen del canal ($canal) y fader ($fader) indicados como parametros
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     * @param string $canal
     * @param int $fader
     */
    public function bajarVolumen( $canal,$fader ) {

        $this->setVol($fader, $this->getVol($fader) - 10);
        $volumen = $this->getVol($fader);
        //$comando=$this->comandos1[DaoControl::$SONIDO];
        $comando=$this->procesarComando("", array("canal"=>$canal,"fader"=>self::$fader[$fader],"volumen"=>$volumen));
        $this->enviarComando($comando);
        $this->guardarEstado();

    } // end of member function bajarVolumen

    /**
     * Metodo para activar el sonido del canal ($canal) y fader ($fader) indicados como parametros
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     * @param int $canal
     * @param int $fader
     */
    public function encender( $canal,$fader ) {

	$fadernum=63+self::$fader[$fader];
	
	system_class::log_message("ENCENDER MICRO:::: fader1:".$fader." fader2: ".self::$fader[$fader]." canal: ".$canal." fadernum ".$fadernum);

        $comando=$this->procesarComando("",  array("canal"=>$canal,"fader"=>$fadernum,"volumen"=>self::$VOLON));
        $this->guardarEstado();
        $this->enviarComando($comando);

    } // end of member function encender

    /**
     * Metodo para desactivar el sonido del canal ($canal) y fader ($fader) indicados como parametros
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     * @param int $canal
     * @param int $fader
     */
    public function apagar( $canal,$fader ) {

	$fadernum = 63 + self::$fader[$fader];
	system_class::log_message("APAGAR MICRO:::: fader1:".$fader." fader2: ".self::$fader[$fader]." canal: ".$canal." fadernum ".$fadernum);

        $comando=$this->procesarComando("",  array("canal"=>$canal,"fader"=>$fadernum,"volumen"=>self::$VOLOFF));
        $this->guardarEstado();
        $this->enviarComando($comando);

    } // end of member function apagar

    /**
     * Metodo para cargar el preset ($pres) indicado como parametro
     *
     * @access public
     * @param int $pres
     *
     */
    public function preset( $pres ) {


        $this->preset=true;
        // $comando=$this->comandos1[DaoControl::$PRESET];
        $comando=$this->procesarComando("", array("preset"=>$pres,"canal"=>"C0"));
        $this->preset=false;
        $this->enviarComando($comando);

    } // end of member function preset
    /**
     * Devuelve el volumen del microfono ($mic) indicado como parametr
     *
     * @access public
     * @param string $mic
     * @return int
     */
    public function getVol($mic) {

        return $this->volumenEntradas[$mic];

    }

    /**
     * Metodo que actualiza el valor del volumen ($vol) del microfono ($mic)ç
     *
     * @access public
     * @param string $mic
     * @param int $vol
     */
    public function setVol($mic,$vol) {

        if($vol>=self::$VOLMAX)
            $vol=self::$VOLMAX;
        else if($vol<=self::$VOLMIN)
            $vol=self::$VOLMIN;
        $this->volumenEntradas[$mic]=$vol;

    }

    /**
     * Metodo para enviar el comando a la mesa de mezclas. Utilizando el puerto
     * 2006 evitamos enviar el comando del extron
     *
     * @access private
     * @param string $comando
     */
    public  function enviarComando($comando) {

          if($this->status=="" ||  $this->status==0) {
            
            $fp = fsockopen('192.168.0.130', '2006', $errno, $errstr, 30);
            socket_set_timeout($fp,2);
            if($comando["canal"]!="C0")
                $command = pack("ccc", hexdec($comando["canal"]),hexdec($comando["fader"]),hexdec($comando["volumen"]));
            else
                $command = pack("cc", 0xC0,0x59);
            fwrite($fp, $command);
            usleep(2000);
            fclose($fp);
        }
    }

    /**
     * Devuelce el comando despues de transformarlo para que la mesa de mezclas lo pueda entender
     * @param string $comando
     * @param array $parametro
     * @return string
     */
    public function procesarComando($comando,$parametro) {


        //print_r($parametro);
        if($this->preset) {
            $preset=dechex($parametro["preset"]-1);
            $arrayComando["preset"]=$preset;
            $arrayComando["canal"]=$parametro["canal"];
        }
        else {
            $volumen=dechex($parametro["volumen"]);
            $hexFader = dechex($parametro["fader"]);
            $arrayComando["volumen"]=$volumen;
            $arrayComando["fader"]=$hexFader;
            $arrayComando["canal"]=$parametro["canal"];
        }
        return $arrayComando;
    }

    public function guardarEstado() {
        $this->estadoDispositivo=new Properties();
        $this->estadoDispositivo->load(file_get_contents("./estadoDispositivos.properties"));
        $this->estadoDispositivo->setProperty("MesaMezclas.micro1",$this->volumenEntradas["M1"]);
        $this->estadoDispositivo->setProperty("MesaMezclas.micro2",$this->volumenEntradas["M2"]);
        $this->estadoDispositivo->setProperty("MesaMezclas.micro3",$this->volumenEntradas["M3"]);
        $this->estadoDispositivo->setProperty("MesaMezclas.micro4",$this->volumenEntradas["M4"]);
        $this->estadoDispositivo->setProperty("MesaMezclas.atril1",$this->volumenEntradas["M5"]);
        $this->estadoDispositivo->setProperty("MesaMezclas.atril2",$this->volumenEntradas["M6"]);
        $this->estadoDispositivo->setProperty("MesaMezclas.videoconferencia",$this->volumenEntradas["videoconferencia"]);
        $this->estadoDispositivo->setProperty("MesaMezclas.servidores",$this->volumenEntradas["servidores"]);
        $this->estadoDispositivo->setProperty("MesaMezclas.inalambrico1",$this->volumenEntradas["inalambrico1"]);
        $this->estadoDispositivo->setProperty("MesaMezclas.inalambrico2",$this->volumenEntradas["inalambrico2"]);
        $this->estadoDispositivo->setProperty("MesaMezclas.dvd",$this->volumenEntradas["dvdL"]);
        $this->estadoDispositivo->setProperty("MesaMezclas.grabadorL",$this->volumenEntradas["grabadorL"]);
        $this->estadoDispositivo->setProperty("MesaMezclas.grabadorR",$this->volumenEntradas["grabadorR"]);
        $this->estadoDispositivo->setProperty("MesaMezclas.master",$this->volumenEntradas["master"]);
        $this->estadoDispositivo->setProperty("MesaMezclas.aux2",$this->volumenEntradas["aux2"]);

        file_put_contents('./estadoDispositivos.properties', $this->estadoDispositivo->toString(true));

    }
    public function reiniciarValores() {
        $this->estadoDispositivo=new Properties();
        $this->estadoDispositivo->load(file_get_contents("./estadoDispositivos.properties"));
        $this->estadoDispositivo->setProperty("MesaMezclas.micro1",100);
        $this->estadoDispositivo->setProperty("MesaMezclas.micro2",100);
        $this->estadoDispositivo->setProperty("MesaMezclas.micro3",100);
        $this->estadoDispositivo->setProperty("MesaMezclas.micro4",100);
        $this->estadoDispositivo->setProperty("MesaMezclas.atril1",100);
        $this->estadoDispositivo->setProperty("MesaMezclas.atril2",100);
        $this->estadoDispositivo->setProperty("MesaMezclas.videoconferencia",100);
        $this->estadoDispositivo->setProperty("MesaMezclas.servidores",100);
        $this->estadoDispositivo->setProperty("MesaMezclas.inalambrico1",100);
        $this->estadoDispositivo->setProperty("MesaMezclas.inalambrico2",100);
        $this->estadoDispositivo->setProperty("MesaMezclas.dvd",100);
        $this->estadoDispositivo->setProperty("MesaMezclas.grabadorL",100);
        $this->estadoDispositivo->setProperty("MesaMezclas.grabadorR",100);
        $this->estadoDispositivo->setProperty("MesaMezclas.master",60);
        $this->estadoDispositivo->setProperty("MesaMezclas.aux2",60);

        file_put_contents('./estadoDispositivos.properties', $this->estadoDispositivo->toString(true));

    }
} // end of MesaMezclas
?>
