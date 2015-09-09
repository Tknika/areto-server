<?php
require_once './controladorPantallasCliente/ControlGuiEscenarios.php';
require_once './controladorPantallasCliente/ControlGuiVideoconferencia.php';
require_once './controladorPantallasCliente/ControladorGuiCamaras.php';
require_once './controladorPantallasCliente/ControladorGuiCamaraDocumentos.php';
require_once './controladorPantallasCliente/ControladorGuiDVD.php';
require_once './controladorPantallasCliente/ControladorGuiDVDGrabador.php';
require_once './controladorPantallasCliente/ControladorGuiLuces.php';
require_once './controladorPantallasCliente/ControladorGuiPantallas.php';
require_once './controladorPantallasCliente/ControladorGuiPlasmas.php';
require_once './controladorPantallasCliente/ControladorGuiProyectores.php';
require_once './controladorPantallasCliente/ControladorGuiRedThinkClient.php';
require_once './controladorPantallasCliente/ControladorGuiSonido.php';
require_once './controladorPantallasCliente/ControladorGuiAlumno.php';
require_once './controladorPantallasCliente/ControladorGuiDispositivos.php';
require_once './utils/ComandoFlash.php';
require_once './controladorPantallasCliente/ControladorGuiSistema.php';
require_once './controladorPantallasCliente/ControladorGuiMenu.php';


/**
 * Description of ConexionServidorCliente
 *
 * @author amaia
 */
class ConexionServidorCliente {
    public static $ctrlGuiEscenarios;
    public static $ctrlGuiVideoconferencia;
    public static $ctrlGuiCamaras;
    public static $ctrlGuiCamaraDocumentos;
    public static $ctrlGuiDvd;
    public static $ctrlGuiGrabador;
    public static $ctrlGuiLuces;
    public static $ctrlGuiPantallas;
    public static $ctrlGuiPlasmas;
    public static $ctrlGuiProyectores;
    public static $ctrlGuiRedThinkClient;
    public static $ctrlGuiSistema;
    public static $ctrlGuiSonido;
    public static $ctrlGuiAlumno;
    public static $ctrlGuiDispositivo;
    public static $ctrlGuiMenu;


    public function __construct() {
        self::$ctrlGuiEscenarios=new ControlGuiEscenarios();
        self::$ctrlGuiVideoconferencia=new ControlGuiVideoconferencia();
        self::$ctrlGuiCamaras=new ControladorGuiCamaras();
        self::$ctrlGuiDvd=new ControladorGuiDVD();
        self::$ctrlGuiGrabador=new ControladorGuiDVDGrabador();
        self::$ctrlGuiLuces=new ControladorGuiLuces();
        self::$ctrlGuiPantallas=new ControladorGuiPantallas();
        self::$ctrlGuiPlasmas=new ControladorGuiPlasmas();
        self::$ctrlGuiProyectores=new ControladorGuiProyectores();
        self::$ctrlGuiRedThinkClient=new ControladorGuiRedThinkClient();
        self::$ctrlGuiSonido=new ControladorGuiSonido();
        self::$ctrlGuiAlumno=new ControladorGuiAlumno();
        self::$ctrlGuiSistema=new ControladorGuiSistema();

        self::$ctrlGuiDispositivo=new ControladorGuiDispositivos();
        self::$ctrlGuiMenu=new ControladorGuiMenu();
        self::$ctrlGuiCamaraDocumentos=new ControladorGuiCamaraDocumentos();
        //self::$ctrlGuiSistema->comprobarSistema();
    }

    public static function procesarComandoPantalla($comando) {

        $cmd = new ComandoFlash($comando);

        if(strcmp($cmd->getEntorno(), "SISTEMA")==0 ) {
            self::$ctrlGuiSistema->procesarComandos($cmd);

        } else   if(strcmp($cmd->getEntorno(), "ESCENARIO")==0) {
	  self::$ctrlGuiEscenarios-> getComandoFlash($cmd);

	}else   if(strcmp($cmd->getEntorno(), "MENU")==0) {
           self::$ctrlGuiMenu->getComandoFlash($cmd);

        } else   if(strcmp($cmd->getEntorno(), "VIDEOCONFERENCIA")==0) {
           self::$ctrlGuiVideoconferencia->getComandoFlash($cmd);

        } else   if(strcmp($cmd->getEntorno(), "MICROFONO")==0) {
           self::$ctrlGuiSonido->getComandoMicroFlash($cmd);

        } else   if(strcmp($cmd->getEntorno(), "SONIDO")==0) {
           self::$ctrlGuiSonido->getComandoSonidoFlash($cmd);

        } else   if(strcmp($cmd->getEntorno(), "DISPOSITIVO")==0) {
           self::$ctrlGuiDispositivo->getComandoFlash($cmd);

        }else   if(strcmp($cmd->getEntorno(), "DVD")==0) {
            self::$ctrlGuiDvd->getComandoFlash($cmd);

        } else   if(strcmp($cmd->getEntorno(), "DVDGRAB")==0) {
            self::$ctrlGuiGrabador->getComandoFlash($cmd);

        } else   if(strcmp($cmd->getEntorno(), "PIZARRA_DIGITAL")==0) {
            self::$ctrlGuiProyectores->getComandoPizarraFlash($cmd);

        } else   if(strcmp($cmd->getEntorno(), "PROYECTOR_CENTRAL")==0) {
            self::$ctrlGuiProyectores->getComandoCentralFlash($cmd);

        } else   if(strcmp($cmd->getEntorno(), "CAMARADOC")==0) {
            self::$ctrlGuiCamaraDocumentos->getComandoFlash($cmd);

        } else   if(strcmp($cmd->getEntorno(), "RED_THINK_CLIENT")==0) {
            self::$ctrlGuiRedThinkClient->getComandoFlash($cmd);

        } else   if(strcmp($cmd->getEntorno(), "PANTALLA_PRESIDENCIA")==0) {
            self::$ctrlGuiPantallas->getComandoFlashPresidencia($cmd);

        } else   if(strcmp($cmd->getEntorno(), "PANTALLA_ENTRADA")==0) {
            self::$ctrlGuiPantallas->getComandoFlashEntrada($cmd);

        } else   if(strcmp($cmd->getEntorno(), "PANTALLA_ELECTRICA")==0) {
            self::$ctrlGuiPantallas->getComandoFlashElectrica($cmd);

        } else   if(strcmp($cmd->getEntorno(), "LUZ")==0) {
             self::$ctrlGuiLuces->getComandoFlash($cmd);

        } else   if(strcmp($cmd->getEntorno(), "PUESTO")==0) {
             self::$ctrlGuiAlumno->getComandoFlash($cmd);

        } else   if(strcmp($cmd->getEntorno(), "PLASMA")==0) {
             self::$ctrlGuiPlasmas->getComandoFlash($cmd);
        }
    }
}
?>
