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
require_once './Properties.php';
require_once './dao/DaoControl.php';


/**
 * class Dispositivo
 * @package PHP::dispositivos
 */
abstract class Dispositivo {

    /**
     *
     * @var <type>
     */
    protected $tipoDispositivo;
    /**
     *
     * @var <type>
     */
    protected $estadoDispositivo;
   /**
    *
    * @var <type>
    */
    protected $id_disp;
    /**
     *
     * @var <type>
     */
    protected $strTipo='daturik ez';
    /**
     *
     * @var <type>
     */
    protected $strMarca;
    /**
     *
     * @var <type>
     */
    protected $strModelo;
    /**
     *
     * @var <type>
     */
    protected $puerto;
    /**
     *
     * @var <type>
     */
    protected $tipoPuerto;
    /**
     *
     * @var <type>
     */
    protected $numeroPuerto;
    /**
     *
     * @var <type>
     */
    protected $ip;
    /**
     *
     * @var <type>
     */
    protected $modeloIPLT;
    /**
     *
     * @var <type>
     */
    protected $strDescripcion;
    /**
     *
     * @var <type>
     */
    protected $comandos,$comandos1;
    /**
     *
     * @var <type>
     */
    protected $password;
    /**
     *
     * @var <type>
     */
    protected $baudRate;
    /**
     *
     * @var <type>
     */
    protected $timeOut;
    /**
     *
     * @var <type>
     */
    protected $dato_id;
    /**
     *
     * @var <type>
     */
    private $dato_Tipo;
    /**
     *
     * @var <type>
     */
    private $datos;
    /**
     *
     *
     * @access private
     */
	
    protected $propiedades;
    /**
     *
     * @var <type>
     */
    protected $encendido=false;
    /**
     *
     * @var <type> 
     */
    protected $estado;
    /**
     *
     * @access private
     */
    // protected $comandos;
protected $nombreDispositivo;
    function  __construct($dispositivo) {
        $this->obtenerPropiedades($dispositivo);
	$this->nombreDispositivo=$dispositivo;
        $this->estado="";

    }
    /**
     *
     *
     * @return array
     * @access public
     */
    public function obtenerComandos( ) {

    } // end of member function obtenerComandos

    /**
     *
     *
     * @return Properties
     * @access public
     */
    private function obtenerPropiedades($dispositivo) {
        $this->propiedades = new Properties();
        $this->propiedades->load(file_get_contents('sinta.properties'));
        $this->ip=$this->propiedades->getProperty($this->tipoDispositivo.".Ip");
        $this->strMarca=$this->propiedades->getProperty($this->tipoDispositivo.".Marca");
        $this->strModelo=$this->propiedades->getProperty($this->tipoDispositivo.".Modelo");
        $this->tipoPuerto=$this->propiedades->getProperty($dispositivo.".PortType");
        $this->numeroPuerto=$this->propiedades->getProperty($dispositivo.".PortNum");
        $this->id_disp=$this->propiedades->getProperty($dispositivo.".Id");
        $this->modeloIPLT=$this->propiedades->getProperty($this->tipoDispositivo.".ModeloIPLT");
        $this->puerto=$this->propiedades->getProperty($dispositivo.".Port");
        $this->baudRate=$this->propiedades->getProperty($dispositivo.".BaudRate");
        $this->timeOut=$this->propiedades->getProperty($dispositivo.".TimeOut");
        $this->password=$this->propiedades->getProperty($dispositivo.".Password");
        echo $this->strMarca. " eta ".$this->strModelo;
        if(strcmp("Automata", $dispositivo)!=0) {
            $this->obtenerDatosDispositivo($this->strMarca,$this->strModelo);
            $this->cargarComandosDispositivo($this->dato_id);}

 


    } // end of member function obtenerPropiedades
    private function cargarComandosDispositivo($identificador) {
   
        $this->comandos=DaoControl::obtenerComandos($identificador);
        $i=0;
        while(count($this->comandos)>$i) {
            $comando[$this->comandos[$i]['nombre']]=$this->comandos[$i]['cadena'];
            $i++;
        }
        $this->comandos1=$comando;

    }
    private function obtenerDatosDispositivo($marca,$modelo) {

        $this->datos=DaoControl::obtenerDispositivo($marca,$modelo);
        $this->dato_id=$this->datos['id_disp'];
        $this->dato_Tipo=$this->datos['tipo'];
        $dato_Marca =$this->datos['marca'];
        $dato_Modelo =$this->datos['modelo'];
        $dato_Descripcion =$this->datos['descripcion'];
    }
    public function isEncendido() {
        return $this->encendido;
    }
    public function setEstado($estado) {
        $this->estado=$estado;
    }
    public function getEstado() {
        return $this->estado;
    }
    /**
     *
     *
     * @param string comando

     * @return
     * @abstract
     * @access public
     */
    abstract public function enviarComando( $comando );

    /**
     *
     *
     * @param string comando

     * @return string
     * @abstract
     * @access public
     */
    abstract public function procesarComando( $comando, $parametro1 );





} // end of Dispositivo
?>
