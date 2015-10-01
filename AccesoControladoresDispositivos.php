<?php
require_once './controlDispositivos/ControlMesaMezclas.php';
require_once './controlDispositivos/ControlVideoconferencia.php';
require_once './controlDispositivos/ControladorAutomata.php';
require_once './controlDispositivos/ControladorCamaraDocumentos.php';
require_once './controlDispositivos/ControladorCamara.php';
require_once './controlDispositivos/ControlVideoconferencia.php';
require_once './controlDispositivos/ControladorDVD.php';
require_once './controlDispositivos/ControladorGrabadorDVD.php';
require_once './controlDispositivos/ControladorFocos.php';
require_once './controlDispositivos/ControladorGeneradorMultiventanas.php';
require_once './controlDispositivos/ControladorLucesTecho.php';
require_once './controlDispositivos/ControladorMatrizVGA.php';
require_once './controlDispositivos/ControladorMatrizVideo.php';
require_once './controlDispositivos/ControlPantallas.php';
require_once './controlDispositivos/ControladorPlasma.php';
require_once './controlDispositivos/ControladorProyectores.php';
require_once './controlDispositivos/ControladorLuces.php';
require_once './dispositivos/GeneradorMultiventana.php';

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AccesoControladoresDispositivos
 *
 * @author amaia
 */
class AccesoControladoresDispositivos {
/** Aggregations: */

/** Compositions: */

   /*** Attributes: ***/
/**
 *
 * @static
 * @access public
 */
    public static $ctrlGuiProyectores;
    /**
     *
     * @static
     * @access public
     */
    public static $ctrlGuiPantalla;
    /**
     *
     * @static
     * @access public
     */
    public static $ctrlPantallas;
    /**
     *
     * @static
     * @access public
     */
    public static $ctrlCamaras;
  


    /**
     *
     * @static
     * @access public
     */
    public static $ctrlProyectores;

    /**
     *
     * @static
     * @access public
     */
    public static $ctrlDvd;

    /**
     *
     * @static
     * @access public
     */
    public static $ctrlDvdGrabador;

    /**
     *
     * @static
     * @access public
     */
    public static $ctrlFoco;

    /**
     *
     * @static
     * @access public
     */
    public static $ctrlGeneradorMultiventanas;

    /**
     *
     * @static
     * @access public
     */
    public static $ctrlLuzTecho;

    /**
     *
     * @static
     * @access public
     */
    public static $ctrlMatrizVGA;

    /**
     *
     * @static
     * @access public
     */
    public static $ctrlMatrizVideo;

    /**
     *
     * @static
     * @access public
     */
    public static $ctrlMesaMezclas;


    /**
     *
     * @static
     * @access public
     */
    public static $ctrlPlasma;
/**
     *
     * @static
     * @access public
     */
    public static $ctrlGuiPlasma;


    /**
     *
     * @static
     * @access public
     */
    public static $ctrlVideoconferencia;

    /**
     *
     * @static
     * @access public
     */
    public static $ctrlVisorDocumentos;


    /**
     *
     * @static
     * @access public
     */
    public static $ctrlAutomata;
    public static $ctrlLuz;

   public function __construct() {
       self::$ctrlMesaMezclas=new ControlMesaMezclas();
       self::$ctrlDvd=new ControladorDVD();
       self::$ctrlDvdGrabador=new ControladorGrabadorDVD();
       self::$ctrlPantallas=new ControlPantallas();
       self::$ctrlCamaras=new ControladorCamara();
       self::$ctrlMatrizVideo=new controladorMatrizVideo();
       self::$ctrlMatrizVGA=new ControladorMatrizVGA();
       self::$ctrlVisorDocumentos=new ControladorCamaraDocumentos();
       self::$ctrlPlasma=new ControladorPlasma();
       self::$ctrlProyectores=new ControladorProyectores();
       self::$ctrlAutomata=new ControladorAutomata();

       self::$ctrlLuz=new ControladorLuces();
       self::$ctrlFoco=new ControladorFocos();
       self::$ctrlGuiPantalla=new ControladorGuiPantallas();
       self::$ctrlGuiProyectores=new ControladorGuiProyectores();
       self::$ctrlGuiPlasma=new ControladorGuiPlasmas();
       self::$ctrlVideoconferencia=new ControlVideoconferencia();
  
       self::$ctrlLuzTecho=new ControladorLucesTecho();
       self::$ctrlGeneradorMultiventanas=new controladorGeneradorMultiventanas();
    }


}
?>
