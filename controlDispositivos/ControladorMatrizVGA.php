<?php

/**
 * @package PHP::controladoresDispositivos
 */
/**
 * includes
 */
require_once './dispositivos/MatrizVGA.php';


/**
 * Description of ControladorMatrizVGA
 *
 * @author amaia
 *
 * @package PHP::controladoresDispositivos
 */
class ControladorMatrizVGA {

/**
 * Atributo que guardara la instancia de la clase MatrizVGA
 *
 * @var MatrizVGA
 * @access private
 * @static
 */
    private static $matrizVGA;

    /**
     * Metodo constructor de la clase, se instancia la matriz que va a controlar
     * la clase
     *
     * @access public
     */
    public function  __construct() {

        self::$matrizVGA=new MatrizVGA("MatrizVGA");

    }

    /**
     * Metodo que enruta el audio de la entrada $in a la salida $out
     *
     * @access public
     * @param int $in
     * @param int $out
     */
    public function asignarAudio( $in,  $out ) {

        self::$matrizVGA->asignarAudio($in,$out);

    } // end of member function asignarAudio

    /**
     * Metodo que enruta el video de la entrada $in a la salida $out
     *
     * @access public
     * @param int $in
     * @param int $out
     */
    public function asignarVideo( $in,  $out ) {

        self::$matrizVGA->asignarVideo($in,$out);

    } // end of member function asignarAudio

}
?>
