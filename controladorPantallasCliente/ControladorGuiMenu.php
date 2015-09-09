<?php
/**
 * @package PHP::controladoresGuiDispositivos
 */
/**
 * Clases necesarias para el control
 */
require_once './AccesoGui.php';
require_once './utils/ComandoFlash.php';

/**
 * Description of ControladorGuiMenu
 *
 * Clase que se encargara de enviar a la pantalla los comandos necesarios para
 * controlar el menu inferior de la pantalla
 *
 * @author amaia
 *
 * @package PHP::controladoresGuiDispositivos
 */
class ControladorGuiMenu {

    /**
     * Metodo para examinar la accion del comando recivido por la pelicula flash para
     * seleccionar la pestaña y dibujar la pantalla del escenario seleccionado
     *
     * @param ComandoFlash $cmd
     */
    public function escenarioMenu() {
        AccesoGui::$guiMenus->escenarioMenu();
        AccesoGui::$guiEscenarios->dibujarPantalla();
        AccesoGui::$guiMenus->dibujarPantalla();

    }

/**
 * Metodo para mostrar la pestaña de inicio marcada en el menu
 *
 * @access public
 */
    public function inicioMenu() {
        AccesoGui::$guiMenus->inicioMenu();
        AccesoGui::$guiMenus->dibujarPantalla();
    }

/**
 * Metodo para mostrar la pestaña de llamaryColgar en el menu
 *
 * @access public
 */
    public function llamaryColgarMenu() {
        AccesoGui::$guiMenus->llamarColgarMenu();
//llamadas activas funtzioari deitu 
	ConexionServidorCliente::$ctrlGuiVideoconferencia->llamadasActivas();
        AccesoGui::$guiVideoconferencia->dibujarPantalla();
        AccesoGui::$guiMenus->dibujarPantalla();

    }

/**
 * Metodo para mostrar la pestaña de inicio marcada en el menu
 *
 * @access public
 */
    public function menuPrincipal() {
	AccesoGui::$guiMenus->menuPrincipal();
	AccesoGui::$guiMenus->dibujarPantalla();
    }

/**
 * Metodo para mostrar la pestaña de sonido marcada en el menu
 *
 * @access public
 */
    public function menuSonido() {
        AccesoGui::$guiMenus->menuSonido();
        AccesoGui::$guiSonido->dibujarPantalla();
        AccesoGui::$guiMenus->dibujarPantalla();
    }

    /**
     * Metodo para mostrar la pestaña luces marcada en el menu
     *
     * @access public
     */
    public function menuLuces() {
        AccesoGui::$guiMenus->menuLuces();

        AccesoGui::$guiMenus->dibujarPantalla();
        AccesoGui::$guiLuces->dibujarPantalla();
    }
/**
 * Metodo para mostrar la pestaña apagar marcada en el menu
 *
 * @access public
 */
    public function menuApagar() {
        AccesoGui::$guiMenus->menuApagar();
        AccesoGui::$guiMenus->dibujarPantalla();
    }



    /**
     * Metodo para examinar la accion del comando recivido por la pelicula flash para
     * seleccionar la pestaña adecuada
     *
     * @param ComandoFlash $cmd
     */
    public function getComandoFlash($cmd) {
        if (strcmp($cmd->getAccion(),"INICIO")==0) {
            //igual que menu escenarios
            $this ->inicioMenu();

        }
        else if (strcmp($cmd->getAccion(),"APAGAR")==0) {
            $this->menuApagar();

        }
        else if (strcmp($cmd->getAccion(),"ESCENARIOS")==0) {
            $this->escenarioMenu();
        }

        else if (strcmp($cmd->getAccion(),"LLAMARCOLGAR")==0) {
            $this->llamaryColgarMenu();
        }
        else if (strcmp($cmd->getAccion(),"SONIDO")==0) {
            $this->menuSonido();
        }
        else if (strcmp($cmd->getAccion(),"LUCES")==0) {
            $this->menuLuces();
        }
        else if (strcmp($cmd->getAccion(),"PRINCIPAL")==0) {
            $this->menuPrincipal();
        }

    }
}
?>
