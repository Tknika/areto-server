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
 * class Pantallas
 * @package PHP::dispositivos
 */
abstract class Pantallas extends DispositivoIP {

/**
 *
 * @var string
 * @access protected
 * @static
 */
    protected  static $ON = "ON";

    /**
     *
     * @var string
     * @access protected
     * @static
     */
    protected static $OFF = "OFF";

    /**
     *
     * @var string
     * @access protected
     * @static
     */
    protected static $VCX = "VC";

    /**
     *
     * @var string
     * @access protected
     * @static
     */
    protected static $VGA = "VGA";
    /**
     *
     * @var string
     * @access protected
     */
    protected $parametroComando="";
    /**
     *
     * @var string
     * @access protected
     */
    protected $vcNum="";
    /**
     *
     * @var string
     * @access protected
     */
    protected $idPip;
    protected $encenderApagar=false;
    protected $encendidaVector=array(1=>false,2=>false);


    function  __construct($dispositivo) {

        parent::__construct($dispositivo);
        $this->encendidaVector[$this->id_disp]=false;

    }

    /**
     * Metodo que enciende la pantalla
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function encender( ) {

        $this->encenderApagar=true;
        $comando=$this->comandos1[DaoControl::$ENCENDER];
        $comando=$this->procesarComando($comando,$this->parametroComando);
        $respuesta=$this->enviarComando($comando);
        $this->setEstado(self::$ON);
        $this->encendido=true;
        $this->guardarEstado();
       return $respuesta;
        

    } // end of member function encender

    /**
     * Metodo que apaga la pantalla
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function apagar( ) {
        $this->encenderApagar=true;
        $comando=$this->comandos1[DaoControl::$APAGAR];
        $comando=$this->procesarComando($comando,$this->parametroComando);
        $respuesta=$this->enviarComando($comando);
        $this->setEstado(self::$OFF);
        $this->encendido=false;
        $this->guardarEstado();
        return $respuesta;

    } // end of member function apagar

    /**
     * Devuelve si la pantalla esta encendida o no
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()

     * @return bit
     */
    public function isEncendida() {

        return  $this->encendidaVector[$this->id_disp];

    }

    /**
     * Metodo para ver la entrada AV de la pantalla que indica el parametro
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @param int $idVC
     * @access public
     * @link Properties::guardarEstado()
     *
     */
    public function verEntradaPantallaAV( $idVC ) {
        usleep(5000000);
        $this->encenderApagar=false;
        $comando=$this->comandos1[DaoControl::$VC];
        $this->vcNum=$idVC;
        $comando=$this->procesarComando($comando,$this->parametroComando);
        $respuesta=$this->enviarComando($comando);
        $this->setEstado(self::$VCX.$idVC);
        $this->guardarEstado();
       return $respuesta;

    } // end of member function verEntradaPantallaAV

    /**
     * Metodo para ver la entrada AV1 de la pantalla
     *
     * @access public
     */
    public function verEntradaPantallaAV1() {

        return $this->verEntradaPantallaAV(1);

    } // end of member function verEntradaPantallaAV

    /**
     * Metodo para ver la entrada AV2 de la pantalla
     *
     * @access public
     */
    public function verEntradaPantallaAV2() {

        return $this->verEntradaPantallaAV(2);

    } // end of member function verEntradaPantallaAV

    //    /**
    //     * Metodo para ver la entrada AV3 de la pantalla
    //     */
    //    public function verEntradaPantallaAV3() {
    //
    //        $this->verEntradaPantallaAV(3);
    //
    //    }

    /**
     * Metodo para ver la entrada VGA de la pantalla
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     *
     */
    public function verEnPantallaVGA( ) {
    //komandoa prozesatzerakoan vc sarreraren zenbakia zeazten da, VGAk zenbakirik
    //behar ez dunez kate hutsarekin konkatenatzen da
        usleep(5000000);
        $this->vcNum="";
        $comando=$this->comandos1[DaoControl::$VGA];
        $comando=$this->procesarComando($comando,$this->parametroComando);
        $respuesta=$this->enviarComando($comando);
        $this->setEstado(self::$VGA);
        $this->guardarEstado();
        return $respuesta;

    } // end of member function verEnPantallaVGA

    /**
     * Guarda los valores de los atributos en el archivo estadoDispositivos.properties
     */
    public function guardarEstado() {

        $this->estadoDispositivo=new Properties();
        $this->estadoDispositivo->load(file_get_contents("./estadoDispositivos.properties"));
        $this->estadoDispositivo->setProperty($this->disp.".estado",$this->estado);
        file_put_contents('./estadoDispositivos.properties', $this->estadoDispositivo->toString(true));

    }


}
?>
