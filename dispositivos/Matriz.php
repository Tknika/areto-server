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
require_once './dao/DaoControl.php';


/**
 * class Matriz
 * @package PHP::dispositivos
 */
abstract class Matriz extends DispositivoIP {
    protected $audio=false;
    protected  $input;
    protected  $output;

    public function __construct($dispositivo) {
        parent::__construct($dispositivo);
    }
    /**
     * Asigna la salida de video out a la entrada in
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @param int $in
     * @param int $out
     * * @access public
     * @link Properties::guardarEstado()
     */
    public function asignarVideo( $in,  $out ) {
        $this->audio=false;
        $this->input=$in;
        $this->output=$out;
        $comando=$this->comandos1[DaoControl::$MATRIZIMAGEN];
        $comando=$this->procesarComando($comando, array($in,$out));
        $this->enviarComando($comando);
        $this->guardarEstado();

    } // end of member function asignarVideo

    /**
     *
     * @param string $comando
     * @param array $parametro
     * @return string
     */
    public function procesarComando($comando,$parametro) {
        
        $comando=str_replace("\$in$", $parametro[0], $comando);
        $comando=str_replace("\$out$", $parametro[1], $comando);
        return $comando;
    }

    /**
     * Carga en los atributos los valores que se encuentran en el archivo estadoDispositivos.properties
     */
    public function cargarEstado() {

        $this->estadoDispositivo=new Properties();
        $this->estadoDispositivo->load(file_get_contents("./estadoDispositivos.properties"));
        $this->output=$this->estadoDispositivo->getProperty($this->disp.".video".$this->input);

        $this->numeroMicrofonosActivos=$this->estadoDispositivo->getProperty("Automata.numeroMicrofonosActivos");
    }

    /**
     * Guarda los valores de los atributos en el archivo estadoDispositivos.properties
     */
    public function guardarEstado() {

        $this->estadoDispositivo=new Properties();
        $this->estadoDispositivo->load(file_get_contents("./estadoDispositivos.properties"));
        $this->estadoDispositivo->setProperty($this->disp.".video".$this->input,$this->output);
        file_put_contents('./estadoDispositivos.properties', $this->estadoDispositivo->toString(true));

    }
} // end of Matriz
?>
