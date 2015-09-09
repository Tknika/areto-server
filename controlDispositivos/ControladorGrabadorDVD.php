<?php
/**
 * @package PHP::controladoresDispositivos
 */
/**
 * includes
 */
require_once './dispositivos/GrabadorDVD.php';

/**
 * Description of ControladorGrabadorDVD
 *
 * Clase que se encargara de enviar las ordenes adecuadas a la clase
 * GrabadorDVD.
 *
 * @author amaia
 *
 * @package PHP::controladoresDispositivos
 */
class ControladorGrabadorDVD {

/**
 * Atributo que guardara la instancia de la clase GrabadorDVD
 *
 * @var GrabadorDVD
 * @access private
 * @static
 */
    private static $dvdGrabador;

    public function  __construct() {

        self::$dvdGrabador=new GrabadorDVD("DvdGrabador");
    }

    /**
     * Metodo para apagar (si esta encendido) el grabador de dvd
     *
     * @access public
     */
    public function apagar( ) {

        self::$dvdGrabador->apagar();

    } // end of member function apagar

    /**
     * Metodo para encender (si esta apagado) el grabador de dvd
     *
     * @access public
     */
  public function encender( ) {

        self::$dvdGrabador->apagar();

    } // end of member function apagar

    /**
     * Metodo para grabar con el grabador dvd
     *
     * @access public
     */
    public function grabar( ) {

        self::$dvdGrabador->grabar();

    } // end of member function grabar

    /**
     * Metodo para parar la grabacion
     *
     * @access public
     */
    public function pararGrabacionGrab( ) {

        self::$dvdGrabador->stop();

    } // end of member function pararGrabacion

    /**
     * Metodo para utilizar el dvd con las funciones de dvd
     *
     * @access public
     */
    public function ponerDVD( ) {

        self::$dvdGrabador->ponerDVD();

    } // end of member function ponerDVD

    /**
     * Metodo para utilizar el grabador de dvd con las funciones de TV
     *
     * @access public
     */
    public function ponerTV( ) {

        self::$dvdGrabador->ponerTV();

    } // end of member function ponerTV

    /**
     * Metodo para subir de canal
     *
     * @access public
     */
    public function canalArriba( ) {

        self::$dvdGrabador->subirCanal();

    } // end of member function canalArriba

    /**
     * Metodo para bajar de canal
     *
     * @access public
     */
    public function canalAbajoGrabador( ) {

        self::$dvdGrabador->bajarCanal();

    } // end of member function canalAbajo

    /**
     * Metodo para seleccionar el origen de reproduccion del grabador
     *
     * @access public
     */
    public function sourceGrab( ) {

        self::$dvdGrabador->source();

    } // end of member function source
}
?>
