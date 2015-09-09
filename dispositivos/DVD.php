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
 * class DVD. Clase abstracta de la que heredaran otros dispositivos con caracteristicas parecidas al dvd
 * @package PHP::dispositivos
 */
abstract class DVD extends DispositivoIP {


    function  __construct($dispositivo) {
        $this->estado="off";
        $this->disp=$dispositivo;
        parent::__construct($dispositivo);
        //$this->cargarEstado();

    }
    /**
     *
     * @static
     * @access public
     */
    public static $PLAY = "PLAY";

    /**
     *
     * @static
     * @access public
     */
    public static $STOP = "STOP";

    /**
     *
     * @static
     * @access public
     */
    public static $PAUSE = "PAUSE";

    /**
     *
     * @static
     * @access public
     */
    public static $REW = "REW";

    /**
     *
     * @static
     * @access public
     */
    public static $FFW = "FFW";

    /**
     *
     * @static
     * @access public
     */
    public static $NEXT = "NEXT";

    /**
     *
     * @static
     * @access public
     */
    public static $PREV = "PREV";
    /**
     *
     * @static
     * @access public
     */
    public static $MENU = "MENU";

    /**
     *
     * @static
     * @access public
     */
    public static $UP = "UP";

    /**
     *
     * @static
     * @access public
     */
    public static $DOWN = "DOWN";

    /**
     *
     * @static
     * @access public
     */
    public static $RIGHT = "RIGHT";

    /**
     *
     * @static
     * @access public
     */
    public static $LEFT = "LEFT";
    /**
     *
     * @static
     * @access public
     */
    public static $ON = "ON";

    /**
     *
     * @static
     * @access public
     */
    public static $OFF = "OFF";
/**
     *
     * @static
     * @access public
     */
    public static $ENTER = "ENTER";


    /**
     * Metodo para encender el dispositivo (grabador o el lector del dvd)
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function encender( ) {

        $comando=$this->comandos1[DaoControl::$ENCENDER];
        $this->enviarComando($comando);
        $this->setEstado(self::$ON);
        $this->guardarEstado();

    } // end of member function encender

    /**
     * Metodo para apagar el dispositivo (grabador o el lector del dvd)
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function apagar( ) {

        $comando=$this->comandos1[DaoControl::$APAGAR];
        $this->enviarComando($comando);
        $this->setEstado(self::$OFF);
        $this->guardarEstado();

    } // end of member function apagar

    /**
     * Metodo para reproducir el dvd (grabador o el lector del dvd)
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function play( ) {
	if($this->getEstado=='PLAY'){
		$this->enterDVD();

	}
	else{
        	$comando=$this->comandos1[DaoControl::$PLAY];

        $this->enviarComando($comando);
        $this->setEstado(self::$PLAY);}
        $this->guardarEstado();

    } // end of member function play

    /**
     * Metodo para la reproduccion (grabador o el lector del dvd)
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function stop( ) {

        $comando=$this->comandos1[DaoControl::$STOP];
        $this->enviarComando($comando);
        $this->setEstado(self::$STOP);
        $this->guardarEstado();

    } // end of member function stop

    /**
     * Metodo para pausar la reproduccion (grabador o el lector del dvd)
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function pause( ) {

        $comando=$this->comandos1[DaoControl::$PAUSE];
        $this->enviarComando($comando);
        $this->setEstado(self::$PAUSE);
        $this->guardarEstado();

    } // end of member function pause

    /**
     * Metodo para rebobinar la reproduccion (grabador o el lector del dvd)
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function rew( ) {
	
        $comando=$this->comandos1[DaoControl::$REW];
        $this->enviarComando($comando);
        $this->setEstado(self::$REW);
        $this->guardarEstado();

    } // end of member function rew

    /**
     * Metodo para avanzar la reproduccion (grabador o el lector del dvd)
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function ffwd( ) {

        $comando=$this->comandos1[DaoControl::$FFWD];
        $this->enviarComando($comando);
        $this->setEstado(self::$FFW);
        $this->guardarEstado();

    } // end of member function ffwd

    /**
     * Metodo para OK,ACEPTAR o ENTER del dispositivo (grabador o el lector del dvd)
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function enterDVD( ) {
	echo "\nestado actual=".$this->getEstado()."\n";
	if($this->getEstado()=='ENTER'){
		$this->play();
}
	else{
       		 $comando=$this->comandos1[DaoControl::$ENTER];

$this->setEstado(self::$ENTER);
        $this->enviarComando($comando);}
        $this->guardarEstado();

    } // end of member function enterDVD

    /**
     * Metodo para subir una posicion en el menu (grabador o el lector del dvd)
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function upMenu( ) {

        $comando=$this->comandos1[DaoControl::$UP];
        $this->setEstado(self::$UP);
        $this->enviarComando($comando);
        $this->guardarEstado();

    } // end of member function upMenu

    /**
     * Metodo para bajar una posicion en el menu (grabador o el lector del dvd)
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function downMenu( ) {

        	$comando=$this->comandos1[DaoControl::$DOWN];
        	$this->enviarComando($comando);
        $this->setEstado(self::$DOWN);
        $this->guardarEstado();

    } // end of member function downMenu

    /**
     * Metodo para ir una posicion a la izquierda en el menu (grabador o el lector del dvd)
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function leftMenu( ) {

        $comando=$this->comandos1[DaoControl::$LEFT];
        $this->enviarComando($comando);
        $this->setEstado(self::$LEFT);
        $this->guardarEstado();

    } // end of member function leftMenu

    /**
     * Metodo para ir una posicion a la derecha en el menu (grabador o el lector del dvd)
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function rightMenu( ) {

        $comando=$this->comandos1[DaoControl::$RIGHT];
        $this->enviarComando($comando);
        $this->setEstado(self::$RIGHT);
        $this->guardarEstado();

    } // end of member function rightMenu

    /**
     * Carga en los atributos los valores que se encuentran en el archivo estadoDispositivos.properties
     */
    public function cargarEstado() {

        $this->estadoDispositivo=new Properties();
        $this->estadoDispositivo->load(file_get_contents("./estadoDispositivos.properties"));
        if(strcmp($this->disp,"Dvd")==0)
            $this->estado=$this->estadoDispositivo->getProperty("Dvd.estado");
        else
            $this->estado=$this->estadoDispositivo->getProperty("GrabadorDvd.estado");
        $this->numeroMicrofonosActivos=$this->estadoDispositivo->getProperty("Automata.numeroMicrofonosActivos");
    }

    /**
     * Guarda los valores de los atributos en el archivo estadoDispositivos.properties
     */
    public function guardarEstado() {

        $this->estadoDispositivo=new Properties();
        $this->estadoDispositivo->load(file_get_contents("./estadoDispositivos.properties"));
        if(strcmp($this->disp,"Dvd")==0)
            $this->estadoDispositivo->setProperty("Dvd.estado",$this->estado);
        else
            $this->estadoDispositivo->setProperty("GrabadorDvd.estado",$this->estado);
        file_put_contents('./estadoDispositivos.properties', $this->estadoDispositivo->toString(true));

    }

} // end of DVD
?>
