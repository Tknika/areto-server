<?php
require_once './gui/GUI_Alumno.php';
require_once './gui/GUI_CamaraDocumentos.php';
require_once './gui/GUI_Camaras.php';
require_once './gui/GUI_DVDGrabador.php';
require_once './gui/GUI_Dispositivos.php';
require_once './gui/GUI_Escenarios.php';
require_once './gui/GUI_Focos.php';
require_once './gui/GUI_LectorDVD.php';
require_once './gui/GUI_Luces.php';
require_once './gui/GUI_Menus.php';
require_once './gui/GUI_Pantallas.php';
require_once './gui/GUI_Proyectores.php';
require_once './gui/GUI_Plasma.php';
require_once './gui/GUI_RedThinkClient.php';
require_once './gui/GUI_Sistema.php';
require_once './gui/GUI_Sonido.php';
require_once './gui/GUI_VideoConferencia.php';


/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AccesoGui
 *
 * @author amaia
 */
class AccesoGui {
    public static $guiAlumno;
    public static $guicamaraDocumentos;
    public static $guiGrabadorDVD;
    public static $guiDispositivos;
    public static $guiEscenarios;
    public static $guiFocos;
    public static $guiLectorDVD;
    public static $guiLuces;
    public static $guiMenus;
    public static $guiPantallas;
    public static $guiPlasma;
    public static $guiProyectores;
    public static $guiRedThinkClient;
    public static $guiSistema;
    public static $guiSonido;
    public static $guiVideoconferencia;

    public function  __construct() {
        self::$guiAlumno=new GUI_Alumno();
        self::$guiDispositivos=new GUI_Dispositivos();
        self::$guiEscenarios=new GUI_Escenarios();
        self::$guiFocos=new GUI_Focos();
        self::$guiGrabadorDVD=new GUI_DVDGrabador();
        self::$guiLectorDVD=new GUI_LectorDVD();
        self::$guiLuces=new GUI_Luces();
        self::$guiMenus=new GUI_Menus();
        self::$guiPantallas=new GUI_Pantallas();
        self::$guiPlasma=new GUI_Plasma();
        self::$guiProyectores=new GUI_Proyectores();
        self::$guiRedThinkClient=new GUI_RedThinkClient();
        self::$guiSistema=new GUI_Sistema();
        self::$guiSonido=new GUI_Sonido();
        self::$guiVideoconferencia=new GUI_VideoConferencia();
        self::$guicamaraDocumentos=new GUI_CamaraDocumentos();
    }
}
?>
