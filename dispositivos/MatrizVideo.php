<?php
require_once './dispositivos/Matriz.php';


/**
 * class MatrizVideo
 *
 */
class MatrizVideo extends Matriz {

/** Aggregations: */

/** Compositions: */

   /*** Attributes: ***/

/**
 *
 * @static
 * @access public
 */
    public static $INPUT_CAMARA_1 = 1;

    /**
     *
     * @static
     * @access public
     */
    public static $INPUT_CAMARA_2 = 2;

    /**
     *
     * @static
     * @access public
     */
    public static $INPUT_CAMARA_3 = 3;

    /**
     *
     * @static
     * @access public
     */
    public static $INPUT_VIDEOCONFERENCIA = 4;

    /**
     *
     * @static
     * @access public
     */
    public static $INPUT_ESCALADOR = 5;

    /**
     *
     * @static
     * @access public
     */
    public static $INPUT_DVD_GRABADOR = 7;

    /**
     *
     * @static
     * @access public
     */
    public static $INPUT_DVD_REPRODUCTOR = 8;

    /**
     *
     * @static
     * @access public
     */
    public static $OUTPUT_PROYECTOR_PIZARRA = 8;

    /**
     *
     * @static
     * @access public
     */
    public static $OUTPUT_PROYECTOR_CENTRAL = 2;

    /**
     *
     * @static
     * @access public
     */
    public static $OUTPUT_PL_ASMA = 1;

    /**
     *
     * @static
     * @access public
     */
    public static $OUTPUT_MONITOR_PASILLO = 6;

    /**
     *
     * @static
     * @access public
     */
    public static $OUTPUT_LCD_PRESIDENCIA = 5;

    /**
     *
     * @static
     * @access public
     */
    public static $OUTPUT_PIP1 = 7;

    /**
     *
     * @static
     * @access public
     */
    public static $OUTPUT_PIP2 = 4;

    /**
     * @var int
     * @static
     * @access public
     */
    public static $OUTPUT_SERVIDOR_VIDEOCONFERENCIA = 3;

   
    function  __construct($dispositivo) {

        $this->tipoDispositivo="MatrizVideo";
        parent::__construct($dispositivo);
        echo($this->ip."-".$this->modeloIPLT."-".$this->strMarca."-".$this->strModelo."-".$this->id_disp."-".$this->tipoPuerto."-".$this->numeroPuerto."-".$this->baudRate."-".$this->timeOut."-".$this->puerto."-".$this->password);

 }

/**
 * Guarda los valores de los atributos en el archivo estadoDispositivos.properties
 */
    public function guardarEstado() {

 parent::guardarEstado();
    }

} // end of MatrizVideo
?>
