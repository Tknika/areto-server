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
require_once './dispositivos/Pantallas.php';


/**
 * class LCD
 * @package PHP::dispositivos
 */
class LCD extends Pantallas {

    public static $estadoLCD=array("encendido"=>"a","pip"=>"n","entrada"=>"b");
    public static $ENCENDIDO="encendido";
    public static $PIP_LCD="pip";
    public static $ENTRADA="entrada";
    private $respuesta=array();
    private $last_time='';

    /**
     *
     * @var bool
     * @access private
     */
    private $pip;


    function  __construct($dispositivo) {

        $this->tipoDispositivo="Pantalla";
        parent::__construct($dispositivo);
        echo($this->ip."-".$this->modeloIPLT."-".$this->strMarca."-".$this->strModelo."-".$this->id_disp."-".$this->tipoPuerto."-".$this->numeroPuerto."-".$this->baudRate."-".$this->timeOut."-".$this->puerto."-".$this->password);
        $this->encendido=true;
        $this->estado="";
        $this->pip=array(1=>"false",2=>"false");
        $this->parametroComando=$this->getIdLCD();

    }


    /**
     * Comando para encender el lcd
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function encender( ) {

        $respuesta=parent::encender();
        $this->encendidaVector[$this->id_disp]=true;
	$respuesta=$this->procesarRespuesta($respuesta);

        return  $respuesta;

    } // end of member function apagar

    /**
     * Metodo para apagar el LCD
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function apagar( ) {

        $respuesta=parent::apagar();
        $this->pip[$this->id_disp]=false;
        $this->encendidaVector[$this->id_disp]=false;
        $this->guardarEstado();
	$respuesta=$this->procesarRespuesta($respuesta);
        return $respuesta;

    } // end of member function apagar
    /**
     * Metodo que nos devuelve el estado (encendido o apagado del lcd)
     *
     * @return <type>
     */
    public function getEstado($funcion) {

	$this->loadEstado();
	$now=time();
	
	if($now - $this->last_time < 3){
	  return $this->respuesta;
	}
        $this->pip[$this->id_disp]=false;
        $comando=$this->comandos1[DaoControl::$ESTADO];

        $comando=$this->procesarComando($comando,array("id"=>$this->parametroComando,"funcion"=>$funcion));
        $respuesta=$this->enviarComando($comando);
	$respuesta=$this->procesarRespuesta($respuesta);

	$this->respuesta=$respuesta;
	$this->guardarEstado();

        return $respuesta;
    }


    public function procesarRespuesta($respuesta) {

        $estado=split(" ", $respuesta);
        $respuestaTratada["funcion"]=$estado[0];
        $respuestaTratada["identificador"]=$estado[1];
        $respuestaTratada["estado"]=$estado[2];

        return $respuestaTratada;
    }

    /**
     * Metodo para poner PIP en el LCD
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function ponerPIP( ) {

        usleep(4000000);
        $this->pip[$this->id_disp]=true;
        $comando=$this->comandos1[DaoControl::$PIP];

        $comando=$this->procesarComando($comando,array("id"=>$this->parametroComando));
        $respuesta=$this->enviarComando($comando);
        $respuesta=$this->procesarRespuesta($respuesta);
//        if(stripos($respuesta["estado"], "NG")!==false)
//            echo "Error al enviar el comando ponerPIP al lcd\n";
        return $respuesta;

    } // end of member function ponerPIP

    /**
     * Metodo para quitar PIP del LCD
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function quitarPIP( ) {
    //usleep(4000000);
        $this->pip[$this->id_disp]=false;
        $comando=$this->comandos1[DaoControl::$QUITARPIP];
        $comando=$this->procesarComando($comando,array("id"=>$this->parametroComando));
        $respuesta=$this->enviarComando($comando);
        $respuesta=$this->procesarRespuesta($respuesta);
//        if(stripos($respuesta["estado"], "NG")!==false)
//            echo "Error al enviar el comando quitar pip al lcd\n";
        $this->guardarEstado();
        return $respuesta;

    } // end of member function quitarPIP


    /**
     * Metodo para selecionar la fuente pip indicada por el parametro $idPip
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @param int $idPip
     * @access public
     * @link Properties::guardarEstado()
     */

    public function fuentePIP($idPip) {

        usleep(2000000);
        $comando=$this->comandos1[DaoControl::$FUENTEPIP];
        $this->idPip=$idPip;

        $comando=$this->procesarComando($comando,array("id"=>$this->parametroComando));
        $respuesta=$this->enviarComando($comando);
        $respuesta=$this->procesarRespuesta($respuesta);

//        if(stripos($respuesta["estado"], "NG")!==false)
//            echo "Error al enviar el comando fuentePIP al lcd\n";
        $this->guardarEstado();
        return $respuesta;

    } // end of member function fuentePIP

    /**
     * Metodo para seleccionar la fuente pip1
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function fuentePIP1() {

        return $this->fuentePIP(3);

    } // end of member function fuentePIP

    /**
     * Metodo para seleccionar la fuente pip2
     *
     * @access public
     */
    public function fuentePIP2() {
        return $this->fuentePIP(2);

    } // end of member function fuentePIP

    /**
     * Devuelve si la pantalla tiene pip
     *
     * @access public
     * @return bit
     */
    public function isPIP( ) {

        return $this->pip[$this->id_disp];

    } // end of member function isPIP

    /**
     * Devuelve el identificador del LCD
     *
     * @access public
     * @return int
     */
    public function getIdLCD() {

        return $this->id_disp;

    }

    /**
     * Metodo que construye el comando de manera que el LCD pueda entenderlo
     *
     * @access protected
     * @param string $comando Comando recogido de la lista de comandos
     * @param string $parametro Para remplazar en $comando
     * @return string Comando preparado para enviar al generador multiventanas
     */
    public function procesarComando($comando,$parametro) {

	if(!is_array($parametro)){
	  $parametro=array('id'=>$parametro);
	}

	$comando=$comando.($this->vcNum);
	$comando=$comando.$this->idPip;
	//solo para el estado del lcd
        if(isset($parametro["funcion"]))
            $comando=str_replace("\$func$",$parametro["funcion"],$comando);
        $comando=str_replace("\$id$",$parametro["id"], $comando);
        $comando=$comando."\n";
        $this->vcNum="";
        $this->idPip="";
	return $comando;
    }

    
    /**
     * Guarda los valores de los atributos en el archivo estadoDispositivos.properties
     */
    public function guardarEstado() {
        parent::guardarEstado();
        $this->estadoDispositivo=new Properties();
        $this->estadoDispositivo->load(file_get_contents("./estadoDispositivos.properties"));
	$this->estadoDispositivo->setProperty($this->disp.".pip",serialize($this->pip));
	$this->estadoDispositivo->setProperty($this->disp.".respuesta",serialize($this->respuesta));
	$this->estadoDispositivo->setProperty($this->disp.".estado",$this->estado);
	$this->estadoDispositivo->setProperty($this->disp.".time", time() );
	file_put_contents('./estadoDispositivos.properties', $this->estadoDispositivo->toString(true));
    }
     /*
     * Cargar ultimo estado desde el archivo estadoDispositivos.properties
     */
    public function loadEstado() {
	//$this->estado();
        $this->estadoDispositivo=new Properties();
        $this->estadoDispositivo->load(file_get_contents("./estadoDispositivos.properties"));
        $this->pip=unserialize($this->estadoDispositivo->getProperty($this->disp.".pip"));
	$this->respouesta=unserialize($this->estadoDispositivo->getProperty($this->disp.".respuesta"));
	$this->estado=$this->estadoDispositivo->getProperty($this->disp.".estado");
	$this->last_time=$this->estadoDispositivo->getProperty($this->disp.".time");
    }

} // end of LCD
?>
