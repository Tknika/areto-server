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
 * Clase abstracta Camaras
 * @package PHP::dispositivos
 */
abstract class Camaras extends DispositivoIP {


   /*** Attributes: ***/
    function  __construct($dispositivo) {
        parent::__construct($dispositivo);
    }

    /**
     * Metodo abstracto que hace zoom a la camara
     *
     * @abstract
     * @access public
     */
    abstract public function alejarZoom( );

    /**
     * Metodo abstracto que quita zoom a la camara
     *
     * @abstract
     * @access public
     */
    abstract public function acercarZoom( );

    /**
     * Metodo abstracto para enfocar las camaras
     *
     * @abstract
     * @access public
     */
    abstract public function enfocar( );

    /**
     * Metodo abstracto para enfocar las camaras
     *
     * @abstract
     * @access public
     */
    abstract public function desenfocar( );

    /**
     * Metodo abstracto que pone la camara en el preset indicado
     *
     * @param int presetNum
     * @abstract
     * @access public
     */
    abstract public function preset( $presetNum );


} // end of Camaras
?>
