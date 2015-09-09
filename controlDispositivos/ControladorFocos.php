<?php
/**
 * @package PHP::controladoresDispositivos
 */
/**
 * includes
 */
require_once './dispositivos/Foco.php';
/**
 * class ControladorFocos
 *
 * Clase que se encargara de enviar las ordenes adecuadas a la clase
 * Focos
 *
 * @package PHP::dispositivos
 */
class ControladorFocos {

/**
 *
 * @var Foco
 * @access private
 * @static
 */
private static $foco;

public function  __construct() {

    self::$foco=new Foco("FocoMovil");

}

    /**
     *
     *
     *
     * @access public
     */
    public function pantallaFoco1( ) {
    } // end of member function pantallaFoco1

    /**
     *
     *
     *
     * @access public
     */
    public function pantallaFoco2( ) {
    } // end of member function pantallaFoco2

    /**
     * Metodo para seleccionar la posicion $posicion de los focos
     *
     * @access public
     * @param int $posicion
     */
    public function preset( $posicion ) {

        self::$foco->posicion($pos);

    } // end of member function preset

    /**
     * Metodo para que los focos se muevan a su posicion inicial
     *
     * @access public
     */
    public function quitarPreset( ) {

        self::$foco->posicionInicial();

    } // end of member function quitarPreset

    /**
     * Metodo para apagar los focos
     *
     * @access public
     */
    public function apagar( ) {

        self::$foco->apagar();

    } // end of member function apagar

    /**
     * Metodo para encender los focos
     *
     * @access public
     */
    public function encender( ) {

        self::$foco->encender();

    } // end of member function encender

    /**
     *  Metodo para mover el foco 1 de izquierda a derecha a la posicion $pos
     *
     * @access public
     * @param int $pos
     */
    public function panFoco1($pos) {

        self::$foco->pan(Foco::$FOCO_1);

    }

    /**
     *  Metodo para mover el foco 2 de izquierda a derecha a la posicion $pos
     *
     * @access public
     * @param int $pos
     */
    public function panFoco2($pos) {

        self::$foco->pan(Foco::$FOCO_2);

    }

    /**
     *  Metodo para mover el foco 1 de arriba a abajo a la posicion $pos
     *
     * @access public
     * @param int $pos
     */
    public function tiltFoco1($pos) {

        self::$foco-tilt(Foco::$FOCO_1);

    }

    /**
     *  Metodo para mover el foco 2 de arriba a abajo a la posicion $pos
     *
     * @access public
     * @param int $pos
     */
    public function tiltFoco2($pos) {

        self::$foco->pan(Foco::$FOCO_2);

    }
    /**
     * Metodo para enfocar los focos a la posicion $pos
     *
     * @access public
     * @param int $pos
     */
    public function posicion($pos){
       
        self::$foco->posicion($pos);
    }

    public function focusFoco1($pos) {
        self::$foco->focus(Foco::$FOCO_1);
    }

    /**
     * Metodo para enfocar con el foco 2 la posicion $pos
     *
     * @access public
     * @param int $pos
     */
    public function focusFoco2($pos) {
        self::$foco->focus(Foco::$FOCO_2);
    }

    public function switchOnFoco1() {

        self::$foco->switchOn(Foco::$FOCO_1);

    }

    public function switchOnFoco2() {

        self::$foco->switchOn(Foco::$FOCO_2);

    }

    public function switchOffFoco1() {

        self::$foco->switchOff(Foco::$FOCO_1);

    }

    public function switchOffFoco2() {

        self::$foco->switchOff(Foco::$FOCO_2);

    }

    public function showLightFoco1() {

        self::$foco->showLight(Foco::$FOCO_1);

    }

    public function showLightFoco2() {

        self::$foco->showLight(Foco::$FOCO_2);

    }

    public function hideLightFoco1() {

        self::$foco->showLight(Foco::$FOCO_1);

    }

    public function hideLightFoco2() {

        self::$foco->showLight(Foco::$FOCO_2);

    }

    /**
     * Metodo para dejar de apuntar al alumno
     *
     * @access public
     */
    public function dejaDeApuntar() {

        self::$foco->dejarDeApuntar();

    }
} // end of ControladorFocos
?>
