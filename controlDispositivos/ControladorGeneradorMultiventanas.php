<?php
/**
 * @package PHP::controladoresDispositivos
  */

/**
 * Description of controladorGeneradorMultiventanas
 *
 * Clase que se encargara de enviar las ordenes adecuadas a la clase
 * GeneradorMultiventana.
 *
 * @author amaia
 *
 * @package PHP::controladoresDispositivos
 */
class controladorGeneradorMultiventanas {

/**
 * Atributo que guardara la instancia de la clase GeneradorMultiventana
 *
 * @var GeneradorMultiventana
 * @access private
 * @static
 */
    private static $generadorMultiventanas;

    public function  __construct() {
        self::$generadorMultiventanas=new GeneradorMultiventana("GeneradorMultiventanas");
    }

    /**
     * Metodo para poner la entrada 1 en la ventana 1
     *
     * @access public
     */
    public function input1Ventana1() {

        self::$generadorMultiventanas->inputXVentanaY(1,1);

    }

    /**
     * Metodo para poner la entrada 1 en la ventana 2
     *
     * @access public
     */
    public function input1Ventana2() {

        self::$generadorMultiventanas->inputXVentanaY(1,2);

    }

    /**
     * Metodo para poner la entrada 2 en la ventana 1
     *
     * @access public
     */
    public function input2Ventana1() {

        self::$generadorMultiventanas->inputXVentanaY(2,1);

    }

    /**
     * Metodo para poner la entrada 2 en la ventana 2
     *
     * @access public
     */
    public function input2Ventana2() {

        self::$generadorMultiventanas->inputXVentanaY(2,2);

    }

    /**
     * Metodo para poner la entrada 3 en la ventana 1
     *
     * @access public
     */
    public function input3Ventana1() {

        self::$generadorMultiventanas->inputXVentanaY(3,1);

    }

    /**
     * Metodo para poner la entrada 3 en la ventana 2
     *
     * @access public
     */
    public function input3Ventana2() {

        self::$generadorMultiventanas->inputXVentanaY(3,2);

    }

    /**
     * Metodo para poner el preset $id
     *
     * @access public
     * @param int $id
     */
    public function preset( $id ) {

        self::$generadorMultiventanas->preset($id);

    } // end of member function eragiketa_berria

}
?>
