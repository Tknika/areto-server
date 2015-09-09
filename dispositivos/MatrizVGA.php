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
require_once './dispositivos/Matriz.php';


/**
 * class MatrizVGA
 * @package PHP::dispositivos
 */
class MatrizVGA extends Matriz {


/**
 *
 * @var int
 * @static
 * @access public
 */
    public static $INPUT_PC_SUELO = 1;

    /**
     *
     * @var int
     * @static
     * @access public
     */
    public static $INPUT_PORTATIL_1 = 2;

    /**
     * @var int
     * @static
     * @access public
     */
    public static $INPUT_PORTATIL_2 = 3;

    /**
     * @var int
     * @static
     * @access public
     */
    public static $INPUT_PORTATIL_3 = 4;

    /**
     * @var int
     * @static
     * @access public
     */
    public static $INPUT_PORTATIL_4 = 5;

    /**
     * @var int
     * @static
     * @access public
     */
    public static $INPUT_PIP = 7;

    /**
     * @var int
     * @static
     * @access public
     */
    public static $INPUT_OPACOS = 8;

    /**
     * @var int
     * @static
     * @access public
     */
    public static $INPUT_ATRIL = 9;

    /**
     * @var int
     * @static
     * @access public
     */
    public static $OUTPUT_PROYECTOR_CENTRAL = 2;

    /**
     * @var int
     * @static
     * @access public
     */
    public static $OUTPUT_PIZARRA_DIGITAL = 3;

    /**
     * @var int
     * @static
     * @access public
     */
    public static $OUTPUT_PLASMA = 4;

    /**
     * @var int
     * @static
     * @access public
     */
    public static $OUTPUT_STREAMING = 5;

    /**
     * @var int
     * @static
     * @access public
     */
    public static $OUTPUT_MONITOR_PASILLO = 6;

    /**
     * @var int
     * @static
     * @access public
     */
    public static $OUTPUT_PIP = 7;

    /**
     * @var int
     * @static
     * @access public
     */
    public static $OUTPUT_ESCALADOR = 8;

    function  __construct($dispositivo) {

        $this->tipoDispositivo="MatrizVGA";
        parent::__construct($dispositivo);
        echo($this->ip."-".$this->modeloIPLT."-".$this->strMarca."-".$this->strModelo."-".$this->id_disp."-".$this->tipoPuerto."-".$this->numeroPuerto."-".$this->baudRate."-".$this->timeOut."-".$this->puerto."-".$this->password);

    }

    /**
     * Metodo que asigna la salida out a la entrada in
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @link Properties::guardarEstado()
     * @param int $in
     * @param int $out
     * @access public
     */
    public function asignarAudio( $in,  $out ) {

        $this->audio=true;
        $this->input=$in;
        $this->output=$out;
        $comando=$this->comandos1[DaoControl::$MATRIZAUDIO];
        $comando=$this->procesarComando($comando, array($in,$out));
        $this->enviarComando($comando);
        $this->guardarEstado();

    } // end of member function asignarAudio

    /**
     * Carga en los atributos los valores que se encuentran en el archivo estadoDispositivos.properties
     */
    public function cargarEstado() {

        $this->estadoDispositivo=new Properties();
        $this->estadoDispositivo->load(file_get_contents("./estadoDispositivos.properties"));
        $this->output=$this->estadoDispositivo->getProperty($this->disp.".audio".$this->input);
        $this->numeroMicrofonosActivos=$this->estadoDispositivo->getProperty("Automata.numeroMicrofonosActivos");
    }

    /**
     * Guarda los valores de los atributos en el archivo estadoDispositivos.properties
     */
    public function guardarEstado() {

        if($this->audio==true) {
            $this->estadoDispositivo=new Properties();
            $this->estadoDispositivo->load(file_get_contents("./estadoDispositivos.properties"));
            $this->estadoDispositivo->setProperty($this->disp.".audio".$this->input,$this->output);
            file_put_contents('./estadoDispositivos.properties', $this->estadoDispositivo->toString(true));
        }
        else
            parent::guardarEstado();

    }




} // end of MatrizVGA
?>
