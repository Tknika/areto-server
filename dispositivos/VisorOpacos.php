<?php
require_once './dispositivos/Camaras.php';


/**
 * class VisorOpacos
 *
 */
class VisorOpacos extends Camaras {

/**
 * Atributo para poner el estado del visor en encendido
 * @var string $ON
 */
    private static $ON="ON";
    /**
     * Atributo para poner el estado del visor en pagado
     * @var string $OFF
     */
    private static $OFF="OFF";

    function  __construct($dispositivo) {
        $this->encendido=false;
        $this->estado="";
        $this->tipoDispositivo="VisorOpacos";
        parent::__construct($dispositivo);
        echo($this->ip."-".$this->modeloIPLT."-".$this->strMarca."-".$this->strModelo."-".$this->id_disp."-".$this->tipoPuerto."-".$this->numeroPuerto."-".$this->baudRate."-".$this->timeOut."-".$this->puerto."-".$this->password);

    }


    /**
     * Metodo que apaga el visor de opacos
     *
     * @return
     * @access public
     */
    public function apagar() {

        $comando=$this->comandos1[DaoControl::$APAGAR];
        $comando=$this->procesarComando($comando,"");
        $this->setEstado(self::$OFF);
        $this->encendido=0;
        $this->guardarEstado();
        $respuesta=$this->enviarComando($comando);
        return $respuesta;

    } // end of member function apagar

    /**
     * Metodo que enciende el visor de opacos
     *
     * @return
     * @access public
     */
    public function encender( ) {

        $comando=$this->comandos1[DaoControl::$ENCENDER];
        $comando=$this->procesarComando($comando,"");

        $this->setEstado(self::$ON);
        $this->encendido=1;
        $this->guardarEstado();
        $respuesta=$this->enviarComando($comando);
	//echo "respuesta en dispositivo:".$respuesta;
        return $respuesta;

    } // end of member function encender

    /**
     * Metodo que lleva al visor de opacos a una posicion determinada
     *
     * @return string
     * @access public
     */
    public function getEstado() {

        $comando=$this->comandos1[DaoControl::$ESTADO];
        $comando=$this->procesarComando($comando,"");
        $respuesta= $this->enviarComando($comando);
        return $this->procesarRespuesta($respuesta);

    }
    /**
     * Metodo para saber si el visor esta apagado o encendido
     *
     * @return int Si el visor esta apagado 0 y si esta encendido 1
     *
     * @access public
     */
    public function getEstadoOnOff() {

        $comando=$this->comandos1[DaoControl::$ESTADOONOFF];
        $comando=$this->procesarComando($comando,"");
        $respuesta=$this->enviarComando($comando);
	//echo "respuesta:".$respuesta."  substring:".substr($respuesta,5)."\n";
        //return substr($respuesta, 5);
	return $respuesta;

    }

    /**
     * Metodo para crear un array asociativo con los nombres de los valores del
     * estadu y sus valores
     *
     * Ejemplo:
     *
     * Si recivimos el siguiente valor con el estado del dispositivo:
     *
     * ?160Zoom:500 DigitalZoom:000 Focus:AB7 Iris:E52 Power:1 AI:1 Light:1
     * LightBox:0 KeyLock:0 ImageTurn:0 ShowAll:0 Negative:0 Black/White:0 Text:0
     * ResolutionRGB:AUTO ResolutionDVI:VGA/60 Video: OFF Lamp1Blown:0
     * Lamp2Blown:0 OSD-Menu:0
     *
     * El array que devolvera sera el siguiente:
     *
     * Array ( [Zoom] => 500
     *         [DigitalZoom] => 000
     *         [Focus] => AB7
     *         [Iris] => E52
     *         [Power] => 1
     *         [AI] => 1
     *         [Light] => 1
     *         [LightBox] => 0
     *         [KeyLock] => 0
     *         [ImageTurn] => 0
     *         [ShowAll] => 0
     *         [Negative] => 0
     *         [Black/White] => 0
     *         [Text] => 0
     *         [ResolutionRGB] => AUTO
     *         [ResolutionDVI] => VGA/60
     *         [Video] => [OFF] =>
     *         [Lamp1Blown] => 0
     *         [Lamp2Blown] => 0
     *         [OSD-Menu] => 0 [] => )
     *
     * @param string $respuesta
     * @return array
     */
    private function procesarRespuesta($respuesta) {

        $respuesta=substr($respuesta, 4);
        $estado=split(" ", $respuesta);
        $estadoTratado=array();
        foreach ($estado as $propiedad) {
            $lag=split(":", $propiedad);
            $estadoTratado[$lag[0]]=$lag[1];
        }
        return $estadoTratado;

    }

    /**
     * Metodo que enciende la lampara del visor de opacos
     *
     * @return
     * @access public
     */
    public function encenderLampara( ) {

        $comando=$this->comandos1[DaoControl::$ENCENDERLAMPARA];
        $comando=$this->procesarComando($comando,"");
        $respuesta=$this->enviarComando($comando);
        return $respuesta;

    } // end of member function encenderLampara

    /**
     * Metodo que apaga la lampara de visor de opacos
     *
     * @return
     * @access public
     */
    public function apagarLampara( ) {

        $comando=$this->comandos1[DaoControl::$APAGARLAMPARA];
        $comando=$this->procesarComando($comando,"");
        $respuesta=$this->enviarComando($comando);
        return $respuesta;


    } // end of member function apagarLampara

    /**
     * Metodo que aleja el zoom del visor de opacos
     *
     * @return
     * @access public
     */
    public function alejarZoom() {

        $comando=$this->comandos1[DaoControl::$ZOOMMENOS];
        $comando=$this->procesarComando($comando,"");
        $respuesta=$this->enviarComando($comando);
	echo "respuesta alejar zoom:".$respuesta."\n";
        return $respuesta;

    }
    /**
     * Metodo que acerca el zoom del visor de opacos
     *
     * @return
     * @access public
     */
    public function acercarZoom() {

        $comando=$this->comandos1[DaoControl::$ZOOMMAS];
        $comando=$this->procesarComando($comando,"");
        $respuesta=$this->enviarComando($comando);
	echo "respuesta acercarZoom:".$respuesta."\n";
        return $respuesta;

    }

    /**
     * Metodo que enfoca el visor de opacos
     *
     * @return
     * @access public
     */
    public function enfocar() {

        $comando=$this->comandos1[DaoControl::$ENFOCAR];
        $comando=$this->procesarComando($comando,"");
        $respuesta=$this->enviarComando($comando);
        return $respuesta;

    }

    /**
     * Metodo que desenfoca el visor de opacos
     *
     * @return
     * @access public
     */
    public function desenfocar() {

        $comando=$this->comandos1[DaoControl::$DESENFOCAR];
        $comando=$this->procesarComando($comando,"");
        $respuesta=$this->enviarComando($comando);
        return $respuesta;

    }

    /**
     * Metodo que lleva al visor de opacos a una posicion determinada
     *
     * @return
     * @access public
     */
    public function preset($presetNum) {

        $comando=$this->comandos1[DaoControl::$PRESET.$presetNum];
        $comando=$this->procesarComando($comando,$presetNum);
        $respuesta=$this->enviarComando($comando);
        return $respuesta;

    }

    /**
     * Utilizando los datos del parametro $parametro genera un string con el comando adecuado
     * para el visor de opacos. El segundo parametro solo se utiliza para el preset
     * @param string  $comando
     * @param string $parametro
     * @return string
     */
    public function procesarComando($comando,$parametro) {

        $comando="_".$comando;
        return $comando;

    }

    /**
     * Guarda los valores de los atributos en el archivo estadoDispositivos.properties
     */
    public function guardarEstado() {

        $this->estadoDispositivo=new Properties();
        $this->estadoDispositivo->load(file_get_contents("./estadoDispositivos.properties"));
        $this->estadoDispositivo->setProperty('Visor.encendido',$this->encendido);
        $this->estadoDispositivo->setProperty('Visor.estado',$this->estado);
        file_put_contents('./estadoDispositivos.properties', $this->estadoDispositivo->toString(true));

    }

} // end of VisorOpacos
?>
