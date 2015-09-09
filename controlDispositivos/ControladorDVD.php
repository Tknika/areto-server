<?php
/**
 * @package PHP::controladoresDispositivos
 */
/**
 * includes
 */
require_once './dispositivos/LectorDVD.php';

/**
 * Description of ControladorDVD
 *
 * Clase que se encargara de enviar las ordenes adecuadas a la clase
 * LectorDVD
 *
 * @author amaia
 *
 * @package PHP::controladoresDispositivos
 */
class ControladorDVD {

/**
 * Atributo que guardara la instancia de la clase LectorDVD
 *
 * @var LectorDVD
 * @access private
 * @static
 */
    private static $dvd;

    public function  __construct() {

        self::$dvd=new LectorDVD("Dvd");

    }


    /**
     * Metodo para encender (si esta apagado) o apagar (si esta encendido) el dvd
     *
     * @access public
     *
     */
    public function onOffDVD( ) {

        self::$dvd->onOff();

    } // end of member function onOffDVD

    /**
     * Metodo para encender el dvd
     *
     * @access public
     */
    public function encenderDVD( ) {

        self::$dvd->encender();

    } // end of member function encenderDVD

    /*
     * Metodo para apagar el dvd
     *
     * @access public
     */
    public function apagarDVD( ) {

        self::$dvd->apagar();

    } // end of member function apagarDVD

    /**
     * Metodo para ir al capitulo anterior del dvd
     *
     * @access public
     */
    public function anteriorDVD( ) {

        self::$dvd->rStep();

    } // end of member function anteriorDVD

    /**
     * Metodo para ir al siguiente capitulo del dvd
     *
     * @access public
     */
    public function siguienteDVD( ) {

        self::$dvd->fStep();

    } // end of member function siguienteDVD

    /**
     * Metodo para rebobinar el dvd
     *
     * @access public
     */
    public function atrasDVD( ) {

        self::$dvd->rew();

    } // end of member function atrasDVD

    /**
     * Metodo para adelantar el dvd
     *
     * @access public
     */
    public function adelanteDVD( ) {
        self::$dvd->ffwd();
    } // end of member function adelanteDVD

    /**
     * Metodo para reproducir el dvd
     *
     * @access public
     */
    public function playDVD( ) {

        self::$dvd->play();
    }

    /**
     * Metodo para pausar el dvd
     *
     * @access public
     */
    public function pausarDVD( ) {

        self::$dvd->pause();

    } // end of member function pausarDVD

    /**
     * Metodo para parar el dvd
     *
     * @access public
     */
    public function stopDVD( ) {

        self::$dvd->stop();

    } // end of member function stopDVD

    /**
     * Metodo para subir en el menu del dvd
     *
     * @access public
     */
    public function arribaDVD( ) {

        self::$dvd->upMenu();

    } // end of member function arribaDVD

    /**
     * Metodo para bajar en el menu del dvd
     *
     * @access public
     */
    public function abajoDVD( ) {

        self::$dvd->downMenu();

    } // end of member function abajoDVD

    /**
     * Metodo para moverse a la derecha en el menu del dvd
     *
     * @access public
     */
    public function derechaDVD( ) {

        self::$dvd->rightMenu();

    } // end of member function derechaDVD

    /**
     * Metodo para moverse a la izquierda en el menu del dvd
     *
     * @access public
     */
    public function izquierdaDVD( ) {

        self::$dvd->leftMenu();

    } // end of member function izquierdaDVD

    /**
     * Metodo para seleccionar la opcion del menu del dvd
     *
     * @access public
     */
    public function aceptarDVD( ) {

        self::$dvd->enterDVD();

    } // end of member function aceptarDVD

    /**
     * Metodo para ir al menu del dvd
     *
     * @access public
     */
    public function menuDVD( ) {

        self::$dvd->menu();

    } // end of member function menuDVD

}
?>
