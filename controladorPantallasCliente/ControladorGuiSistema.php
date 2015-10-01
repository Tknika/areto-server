<?php
require_once './AccesoGui.php';
require_once './dispositivos/Sistema.php';


/**
 * Description of ControladorGuiSistema
 *
 * @author amaia
 */
class ControladorGuiSistema {
    private $sistema="BIENVENIDO";
    public function  __construct() {
        $this->sistema=new Sistema();
        #AccesoGui::__construct();
        # No se puede llamar a __construct, al no ser estático (un constructor no puede ser estático)
        # Se ha solucionado de forma provisional instanciando la clase
	      $agui = new AccesoGui();
    }
    public function iniciarSistema() {
        AccesoGui::$guiSistema->esperarInicioSistema(2);
        $this->sistema->iniciarSistema();
    }

    public function comprobarProyectores() {
      $this->sistema->proyector_status();
    }

   
    
    public function comprobarSistema($alert=0) {

        $message=$this->sistema->getEstadoSistema();
        if($alert==1 && empty($message)){
            $message="OK";
        }

	AccesoGui::$guiSistema->enviarResultadoComprobacionSistema($message);



    }
    public function salir() {
        AccesoGui::$guiSonido->esperarSalirSistema(30);
        $this->sistema->salir();
        AccesoGui::$guiSistema->ocultarMenu();
        AccesoGui::$guiSistema->esperarSalirSistema(30);
        try {
            usleep(30000000);//zero bat falta da
        }catch (Exception $e) {

        }
        AccesoGui::$guiSistema->bienvenidaSistema(true);
    }
    public function  procesarComandos($cmd) {
        if(strcmp($cmd->getAccion(), "COMPROBAR")==0) {
            $this->comprobarSistema(1);
            SocketClass::client_reply("BUTTON:COMPROBAR:RELEASE:_level0.comprobar");
        }
        else if(strcmp($cmd->getAccion(), "INICIAR")==0) {
            $this->sistema->iniciarSistema();
	    $this->comprobarProyectores();

            //$this->comprobarSistema();
        }
        else  if(strcmp($cmd->getAccion(), "APAGAR")==0) {
            $this->sistema->salir();
        }
        else  if(strcmp($cmd->getAccion(), "ESTADO")==0) {
            $this->enviarPantallaActiva();
            //$this->comprobarSistema();
//         AccesoGui::$guiSistema->bienvenidaSistema();
//      AccesoGui::$guiSistema->dibujarPantalla();

        } else  if(strcmp($cmd->getAccion(), "LOGCLIENTES")==0) {
            pnlControl.logClientList();
        }
    }
    public function enviarPantallaActiva() {

	//enviar pantalla principal.

        $pantallaActiva=new Properties();
        $pantallaActiva->load(file_get_contents("./pantallaActiva.properties"));
        $activ=$pantallaActiva->getProperty('Pantalla.activa');

        if($activ==1) {//guiSistema

            AccesoGui::$guiSistema->bienvenidaSistema();
            AccesoGui::$guiSistema->dibujarPantalla();
        }
	else if($activ==3) {//guiEscenarios

            AccesoGui::$guiEscenarios->dibujarPantalla();
        }else{
	    AccesoGui::$guiMenus->dibujarPantalla();
	    AccesoGui::$guiMenus->menuPrincipal();
	}
	
        /*if($activ==2) {//guiMenus

            AccesoGui::$guiMenus->dibujarPantalla();
	    AccesoGui::$guiMenus->menuPrincipal();
        }
        if($activ==3) {//guiEscenarios

            AccesoGui::$guiEscenarios->dibujarPantalla();
        }
        if($activ==4) {//guiVideoconferencia

            AccesoGui::$guiMenus->dibujarPantalla();
            AccesoGui::$guiVideoconferencia->dibujarPantalla();
        }
        if($activ==5) {//guiSonido

            AccesoGui::$guiMenus->dibujarPantalla();
            AccesoGui::$guiSonido->dibujarPantalla();
        }
        if($activ==6) {//guiLuces


            AccesoGui::$guiMenus->dibujarPantalla();
            AccesoGui::$guiLuces->dibujarPantalla();

        }
        if($activ==7) {//guiDispositivos

            AccesoGui::$guiMenus->dibujarPantalla();
            AccesoGui::$guiDispositivos->dibujarPantalla();
        }
        if($activ==8) {//guiCamaras

            AccesoGui::$guiMenus->dibujarPantalla();
            AccesoGui::$guiDispositivos->dibujarPantalla();

        }
        if($activ==9) {//guiLectorDVD

            AccesoGui::$guiMenus->dibujarPantalla();
            AccesoGui::$guiDispositivos->dibujarPantalla();
            AccesoGui::$guiLectorDVD->dibujarPantalla();
        }
        if($activ==10) {//guiGrabador

            AccesoGui::$guiMenus->dibujarPantalla();
            AccesoGui::$guiDispositivos->dibujarPantalla();
            AccesoGui::$guiGrabadorDVD->dibujarPantalla();

        }
        if($activ==11) {//guiPantallas

            AccesoGui::$guiMenus->dibujarPantalla();
            AccesoGui::$guiDispositivos->dibujarPantalla();
            AccesoGui::$guiPantallas->dibujarPantalla();
            AccesoGui::$guiProyectores->dibujarPantalla();

        }
        if($activ==12) {//gui proyectores

            AccesoGui::$guiMenus->dibujarPantalla();
            AccesoGui::$guiDispositivos->dibujarPantalla();
            AccesoGui::$guiProyectores->dibujarPantalla();
            AccesoGui::$guiPantallas->dibujarPantalla();

        }
        if($activ==13) {//guiRedThinkclient

            AccesoGui::$guiMenus->dibujarPantalla();
            AccesoGui::$guiDispositivos->dibujarPantalla();
            AccesoGui::$guiRedThinkClient->dibujarPantalla();

        }
        if($activ==14) {//guiCamaraDocumentos

            AccesoGui::$guiMenus->dibujarPantalla();
            AccesoGui::$guiDispositivos->dibujarPantalla();
            AccesoGui::$guicamaraDocumentos->dibujarPantalla();

        }
        if($activ==15) {//guiPlasma

            AccesoGui::$guiMenus->dibujarPantalla();
            AccesoGui::$guiDispositivos->dibujarPantalla();
            AccesoGui::$guiPlasma->dibujarPantalla();

        }
        if($activ==16) {//guiFocos

            AccesoGui::$guiMenus->dibujarPantalla();
            AccesoGui::$guiDispositivos->dibujarPantalla();
            AccesoGui::$guiFocos->dibujarPantalla();

        }
        if($activ==17) {//guiAlumno

            AccesoGui::$guiMenus->dibujarPantalla();
            AccesoGui::$guiDispositivos->dibujarPantalla();
            AccesoGui::$guiAlumno->dibujarPantalla();

        }*/
        AccesoGui::$guiSistema->enviarMenu();
        AccesoGui::$guiEscenarios->dibujarEscenarioMenu();
	

    }
}

?>
