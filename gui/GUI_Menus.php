<?php

/**
 * class GUI_Menus
 *
 */
class GUI_Menus {

/** Aggregations: */

/** Compositions: */

   /*** Attributes: ***/

    private $menu = "INICIO";

    public function  __construct() {
    }

    /**
     *
     *
     * @param string menu

     * @return
     * @access public
     */
    public function setMenu( $menu ) {
        $this->menu=$menu;
        $this->enviarMenu();
        
	if (strstr($menu,'ESCENARIO') !== false){
	  $this->activarPantalla(3);
	}else{
	  $this->activarPantalla(2);
	}
	


    //activar pantalla enviar menu
    } // end of member function setMenu

    /**
     *
     *
     * @return string
     * @access public
     */
    public function getMenu( ) {
        return $this->menu;
    } // end of member function getMenu

    /**
     *
     *
     * @return
     * @access public
     */
    public function escenarioMenu( ) {
        $this->setMenu("ESCENARIOS");
	//$this->activarPantalla(3)
    } // end of member function escenarioMenu

    ////////////////errepikatua/////////////
    public function  inicioMenu($f=false) {
	if($f)
	  $this->setMenu("ESCENARIOS:ON");
	else
	  $this->setMenu("ESCENARIOS");

	$this->activarPantalla(3);
    }

    /**
     *
     *
     * @return
     * @access public
     */
    public function llamarColgarMenu( ) {
        $this->setMenu("LLAMARCOLGAR");
 //AccesoGui::$guiVideoconferencia->dibujarPantalla();
    } // end of member function llamarColgarMenu

    /**
     *
     *
     * @return
     * @access public
     */
    public function menuPrincipal( $f=false ) {
	if($f)
	  $this->setMenu("PRINCIPAL:ON");
	else
	  $this->setMenu("PRINCIPAL");
    } // end of member function menuPrincipal

    /**
     *
     *
     * @return
     * @access public
     */
    public function menuSonido( ) {
        $this->setMenu("SONIDO");

    } // end of member function menuSonido

    /**
     *
     *
     * @return
     * @access public
     */
    public function menuLuces( ) {
        $this->setMenu("LUCES");
       // AccesoGui::$guiLuces->dibujarPantalla();

    } // end of member function menuLuces
    public function menuApagar() {
        $this->setMenu("APAGAR");
    }
    /**
     *
     *
     * @return
     * @access public
     */
    private function enviarMenu() {
        $cmd = new ComandoFlash("MENU", $this->getMenu(), "");
        $this->enviarPeticion($cmd->getComando());
    }

    /**
     *
     *
     * @param string comando

     * @return
     * @access public
     */
    public function enviarPeticion( $comando ) {
        SocketClass::client_reply($comando);
    } // end of member function enviarPeticion

    /**
     *
     *
     * @return
     * @access public
     */
   public function activarPantalla($id_pantalla=2) {

        $pantallaActual=new Properties();
        $pantallaActual->load(file_get_contents("./pantallaActiva.properties"));
        $pantallaActual->setProperty("Pantalla.activa",$id_pantalla);
        file_put_contents('./pantallaActiva.properties',     $pantallaActual->toString(true));

       // $this->pantalla_activa=$pantalla;
    } // end of member function setPantallaActiva
    /**
     *
     *
     * @return
     * @access public
     */
    public function dibujarPantalla() {
        //$this->activarPantalla();
        $this->enviarMenu();
        try {
            usleep(500000); // segundu bat itxaroten da Thinclient-ei ez
        // bait die pantaila marrazteko denborarik
        // ematen.
        } catch (Exception $e) {
        }
    }// end of member function dibujarPantalla



    } // end of GUI_Menus
?>
