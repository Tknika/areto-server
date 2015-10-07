<?php
/**
 * @package PHP::controladoresGuiDispositivos
 */
/**
 * Clases necesarias para el control
 */
require_once './AccesoControladoresDispositivos.php';
require_once './AccesoGui.php';

/**
 * Description of ControlGuiEscenarios
 *
 * Clase que se encargara de enviar los comandos necesarios a los dispositivos
 * que se utilizen en cada escenario y a sus respectivas pantallas
 *
 * @author amaia
 *
 * @package PHP::controladoresGuiDispositivos
 */
class ControlGuiEscenarios {

/**
 * Metodo para dejar la sala preparada para recivir una clase
 *
 * @access public
 */
    public function enviarClases( ) {

        AccesoGui::$guiSistema->esperarInicioSistema();
        AccesoControladoresDispositivos::$ctrlLuz->setLucesEscenarios(LuzTecho::$ESCENARIO_ENVIAR_CLASE);
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(1,1);
        

        AccesoControladoresDispositivos::$ctrlAutomata->escenarioEnviarClase();
        if(!AccesoControladoresDispositivos::$ctrlPantallas->isEncendidaPresidencia()) {
            AccesoControladoresDispositivos::$ctrlPantallas->encenderPresidencia();
            AccesoGui::$guiPantallas->pantallaPresidenciaEncender();
            usleep(3000000);
            AccesoControladoresDispositivos::$ctrlPantallas->verEntradaPresidenciaAV1();
        } else {
            AccesoControladoresDispositivos::$ctrlPantallas->quitarPIPPresidencia();

        }
        usleep(1000000);
        AccesoControladoresDispositivos::$ctrlGuiPantalla->presidenciaVideoConferencia();
        AccesoControladoresDispositivos::$ctrlPlasma->encender();
        AccesoGui::$guiPlasma->encenderPlasma();
        AccesoControladoresDispositivos::$ctrlProyectores->encenderCentral();
        AccesoControladoresDispositivos::$ctrlProyectores->encenderPizarra();
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(7,8);
        //AccesoControladoresDispositivos::$ctrlGuiPantalla->presidenciaVideoconferencia();
        AccesoControladoresDispositivos::$ctrlFoco->encender();
        AccesoControladoresDispositivos::$ctrlMesaMezclas->preset90();
	//AccesoControladoresDispositivos::$ctrlMesaMezclas->desactivarMicPresidencia("M1");
        AccesoControladoresDispositivos::$ctrlGuiPlasma->verVideoconferenciaEnPlasma();//begiratzeko
        AccesoControladoresDispositivos::$ctrlProyectores->activarCentral();
        AccesoControladoresDispositivos::$ctrlProyectores->activarPizarra();
        usleep(3000);
        AccesoControladoresDispositivos::$ctrlGuiProyectores->verPCSalaEnCentral();
        AccesoControladoresDispositivos::$ctrlGuiProyectores->verPCSalaEnPizarra();
        AccesoControladoresDispositivos::$ctrlMesaMezclas->activarNuestroSonido();//volumen videoconferencia on
        AccesoControladoresDispositivos::$ctrlVideoconferencia->conectar();
        AccesoGui::$guiSistema->mostrarMenu();
        AccesoGui::$guiMenus->menuPrincipal(true);
        //AccesoGui::$guiEscenarios->enviarEstadoVideoconferencia();
        //AccesoGui::$guiEscenarios->escenarioEnviarClase();
        AccesoGui::$guiVideoconferencia->dibujarPantalla();
	AccesoControladoresDispositivos::$ctrlProyectores->estadoCentral();
	AccesoControladoresDispositivos::$ctrlProyectores->estadoPizarra();
        sleep(1);
    }// end of member function enviarClases

    /**
     * Metodo para dejar la sala preparada para enviar una clase
     *
     * @access public
     */
    public function recivirClases( ) {
        AccesoGui::$guiSistema->esperarInicioSistema();

        AccesoControladoresDispositivos::$ctrlLuz->setLucesEscenarios(LuzTecho::$ESCENARIO_RECIBIR_CLASE);
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(1,1);
        ConexionServidorCliente::$ctrlGuiPantallas->bajarPantallaElectrica();
        AccesoControladoresDispositivos::$ctrlAutomata->encenderLuzSala(Automata::$intensidades["media"]);//intensidad media
        AccesoControladoresDispositivos::$ctrlLuz->encenderLucesSuelo();
        if(!AccesoControladoresDispositivos::$ctrlPantallas->isEncendidaPresidencia()) {
            ConexionServidorCliente::$ctrlGuiPantallas->presidenciaEncender();
            usleep(5000000);
            AccesoControladoresDispositivos::$ctrlPantallas->verEntradaPresidenciaAV1();
        }else {
            AccesoControladoresDispositivos::$ctrlPantallas->quitarPIPPresidencia();
        }
        usleep(1000000);
        ConexionServidorCliente::$ctrlGuiPantallas->presidenciaVideoConferencia();
        ConexionServidorCliente::$ctrlGuiPlasmas->encender();
        ConexionServidorCliente::$ctrlGuiProyectores->encenderCentral();
        ConexionServidorCliente::$ctrlGuiProyectores->encenderPizarra();
        AccesoControladoresDispositivos::$ctrlFoco->encender();
        AccesoControladoresDispositivos::$ctrlMesaMezclas->preset90();
AccesoControladoresDispositivos::$ctrlMesaMezclas->desactivarMicPresidencia("M1");
        ConexionServidorCliente::$ctrlGuiPlasmas->verVideoSalaEnPlasma();
        ConexionServidorCliente::$ctrlGuiProyectores->activarCentral();
        ConexionServidorCliente::$ctrlGuiProyectores->activarPizarra();
        ConexionServidorCliente::$ctrlGuiProyectores->verPCSalaEnCentral();
        ConexionServidorCliente::$ctrlGuiProyectores->verVideoconferenciaEnPizarra();
        AccesoControladoresDispositivos::$ctrlMesaMezclas->activarNuestroSonido();
        AccesoControladoresDispositivos::$ctrlVideoconferencia->conectar();
        AccesoGui::$guiEscenarios->escenarioRecivirClase();
        AccesoGui::$guiMenus->menuPrincipal(true);
        AccesoGui::$guiSistema->mostrarMenu();
        AccesoGui::$guiEscenarios->enviarEstadoVideoconferencia();
	AccesoControladoresDispositivos::$ctrlProyectores->estadoCentral();
	AccesoControladoresDispositivos::$ctrlProyectores->estadoPizarra();


    } // end of member function recivirClases

    /**
     * Metodo para dejar la sala preparada para una clase local
     *
     * @access public
     */
    public function claseLocal( ) {


        AccesoGui::$guiSistema->esperarInicioSistema();

        AccesoControladoresDispositivos::$ctrlLuz->setLucesEscenarios(LuzTecho::$ESCENARIO_CLASE_LOCAL);
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(1,1);
        ConexionServidorCliente::$ctrlGuiPantallas->bajarPantallaElectrica();
        usleep(500000);
        AccesoControladoresDispositivos::$ctrlAutomata->encenderLuzSala(Automata::$intensidades["media"]);
        AccesoControladoresDispositivos::$ctrlFoco->apagar();
        ConexionServidorCliente::$ctrlGuiPantallas->pipEnPantallaPresi();//control_pantallas.pipEnPantallaPresi()
        ConexionServidorCliente::$ctrlGuiPlasmas->encender();
        AccesoControladoresDispositivos::$ctrlMesaMezclas->preset90();
//AccesoControladoresDispositivos::$ctrlMesaMezclas->desactivarMicPresidencia("M1");
        ConexionServidorCliente::$ctrlGuiProyectores->encenderCentral();
        ConexionServidorCliente::$ctrlGuiProyectores->encenderPizarra();
        //ConexionServidorCliente::$ctrlGuiProyectores->activarCentral();
        //ConexionServidorCliente::$ctrlGuiProyectores->activarPizarra();
        //usleep(3000000);
        ConexionServidorCliente::$ctrlGuiProyectores->verPCSalaEnPizarra();
        ConexionServidorCliente::$ctrlGuiProyectores->verPCSalaEnCentral();
        //usleep(3000000);
        AccesoGui::$guiSistema->esperarInicioSistema();
        AccesoControladoresDispositivos::$ctrlPlasma->verVideoSalaEnPlasma();
        AccesoGui::$guiEscenarios->escenarioClaseLocal();
        AccesoGui::$guiMenus->menuPrincipal(true);
        AccesoGui::$guiSistema->mostrarMenu();
        AccesoGui::$guiEscenarios->enviarEstadoVideoconferencia();
	AccesoControladoresDispositivos::$ctrlProyectores->estadoCentral();
	AccesoControladoresDispositivos::$ctrlProyectores->estadoPizarra();
    } // end of member function claseLocal

    /**
     * Metodo para dejar la sala preparada para una clase seminarioClase
     *
     * @access public
     */
    public function seminarioClase( ) {


        AccesoGui::$guiSistema->esperarInicioSistema();

        AccesoControladoresDispositivos::$ctrlLuz->setLucesEscenarios(LuzTecho::$ESCENARIO_SEMINARIO_CLASE);
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(1,1);
        AccesoControladoresDispositivos::$ctrlAutomata->encenderLuzSala(Automata::$intensidades["maxima"]);
        usleep(500000);
        ConexionServidorCliente::$ctrlGuiPantallas->subirPantallaElectrica();
        AccesoControladoresDispositivos::$ctrlFoco->apagar();
        ConexionServidorCliente::$ctrlGuiPlasmas->encender();
	//Comentado mientras se repara el visor de opacos.
        //ConexionServidorCliente::$ctrlGuiCamaraDocumentos->camaraDocumentosApagar();
        ConexionServidorCliente::$ctrlGuiProyectores->apagarPizarra();
        ConexionServidorCliente::$ctrlGuiProyectores->apagarCentral();
        AccesoControladoresDispositivos::$ctrlMesaMezclas->preset90();
	AccesoControladoresDispositivos::$ctrlMesaMezclas->desactivarMicPresidencia("M1");
        ConexionServidorCliente::$ctrlGuiPantallas->pipEnPantallaPresi();
        AccesoGui::$guiEscenarios->escenarioSeminario();
        AccesoGui::$guiMenus->menuPrincipal(true);
        AccesoGui::$guiSistema->mostrarMenu();
        AccesoGui::$guiEscenarios->enviarEstadoVideoconferencia();
	AccesoControladoresDispositivos::$ctrlProyectores->estadoCentral();
	AccesoControladoresDispositivos::$ctrlProyectores->estadoPizarra();
    } // end of member function seminarioClase

    /**
     * Metodo para dejar la sala preparada para ver una pelicula
     *
     * @access public
     */
    public function pelicula( ) {


        AccesoGui::$guiSistema->esperarInicioSistema();

        AccesoControladoresDispositivos::$ctrlLuz->setLucesEscenarios(LuzTecho::$ESCENARIO_PELICULA);
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(1,1);
        ConexionServidorCliente::$ctrlGuiPantallas->bajarPantallaElectrica();
        usleep(500000);
        AccesoControladoresDispositivos::$ctrlAutomata->encenderLuzSala(Automata::$intensidades["minima"]);
        if(!AccesoControladoresDispositivos::$ctrlPantallas->isEncendidaPresidencia()) {
            ConexionServidorCliente::$ctrlGuiPantallas->presidenciaEncender();
        }
        else {
            AccesoControladoresDispositivos::$ctrlPantallas->quitarPIPPresidencia();
        }
        usleep(3000000);
        AccesoControladoresDispositivos::$ctrlFoco->apagar();
        ConexionServidorCliente::$ctrlGuiPlasmas->apagar();
        ConexionServidorCliente::$ctrlGuiProyectores->apagarPizarra();
        AccesoControladoresDispositivos::$ctrlMesaMezclas->preset90();
	AccesoControladoresDispositivos::$ctrlMesaMezclas->desactivarMicPresidencia("M1");
        ConexionServidorCliente::$ctrlGuiPantallas->presidenciaDVD();
        usleep(100000);
        AccesoControladoresDispositivos::$ctrlPantallas->verEntradaPresidenciaAV1();
        ConexionServidorCliente::$ctrlGuiProyectores->encenderCentral();
        ConexionServidorCliente::$ctrlGuiProyectores->activarCentral();
        AccesoGui::$guiSistema->esperarInicioSistema();
        usleep(5000000);
        ConexionServidorCliente::$ctrlGuiProyectores->verDVDEnCentral();
        ConexionServidorCliente::$ctrlGuiDvd->onOffDVD();
        //Comentado mientras se repara la visor de opacos
	//ConexionServidorCliente::$ctrlGuiCamaraDocumentos->camaraDocumentosApagar();//apagarDoc
        usleep(100000);
        AccesoGui::$guiSistema->esperarInicioSistema();
        AccesoGui::$guiEscenarios->escenarioPelicula();
        AccesoGui::$guiMenus->menuPrincipal(true);
        AccesoGui::$guiSistema->mostrarMenu();
        AccesoGui::$guiEscenarios->enviarEstadoVideoconferencia();
        usleep(3000000);
        ConexionServidorCliente::$ctrlGuiDvd->playDVD();
        AccesoGui::$guiDispositivos->seleccionarDvd();
	AccesoControladoresDispositivos::$ctrlProyectores->estadoCentral();
	AccesoControladoresDispositivos::$ctrlProyectores->estadoPizarra();

    } // end of member function pelicula



    /**
     * Metodo para examinar la accion del comando recivido por la pelicula flash para
     * seleccionar el escenario de la clase
     *
     * @param ComandoFlash $cmd
     */
    public function getComandoFlash($cmd) {
        if (strcmp($cmd->getAccion(),"ENVIAR_CLASES")==0) {
            $this->enviarClases();
        } else if (strcmp($cmd->getAccion(),"RECIBIR_CLASES")==0) {
                $this->recivirClases();
            } else if (strcmp($cmd->getAccion(),"CLASE_LOCAL")==0) {
                    $this->claseLocal();
                } else if (strcmp($cmd->getAccion(),"SEMINARIO/CLASE")==0) {
                        $this->seminarioClase();
                    } else if (strcmp($cmd->getAccion(),"PELICULA")==0) {
                            $this->pelicula();
                        }
    }
} // end of ControlEscenarios
?>
