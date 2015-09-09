<?php
require_once './comunication/hariak/socketClass/SocketClass.php';

/**
 * 
 * @package PHP::gui
 */
/**
 * class GUI_Dispositivos
 *
 * Clase que se encarga de marcar en la pantalla el dispositivo seleccionado y su
 * respectiva pantalla en caso de que la tenga
 *
 * @package PHP::gui
 */
class GUI_Dispositivos
{
/**
 * Atributo que guarda el valor del dispositivo seleccinado en la pantalla
 *
 * @var string
 */
private $dispositivo = "";

 public function activarPantalla() {


            $pantallaActual=new Properties();
        $pantallaActual->load(file_get_contents("./pantallaActiva.properties"));
            $pantallaActual->setProperty("Pantalla.activa",7);
        file_put_contents('./pantallaActiva.properties',     $pantallaActual->toString(true));


       // $this->pantalla_activa=$pantalla;
    } // end of member function setPantallaActiva
  /**
     * Metodo para dar valor al atributo dispositivo y enviarselo a la pantalla
   * 
   * @param string dispositivo 
   * @access public
   */
  public function setDispositivo( $dispositivo ) {

      $this->dispositivo=$dispositivo;
      $this->enviarDispositivo();
      //$this->activarPantalla();
  } // end of member function setDispositivo

  /**
   * Metodo que devuelve el dispositivo seleccinado en la pantalla
   * 
   * @return string
   * @access public
   */
  public function getDispositivo( ) {

      return  $this->dispositivo;

  } // end of member function getDispositivo

  /**
   * Metodo que marca el boton del dvd y muestra la pantalla con sus funciones
   * 
   * @access public
   */
  public function seleccionarDVD( ) {

      $this->setDispositivo("DVD");
      AccesoGui::$guiLectorDVD->dibujarPantalla();

  } // end of member function seleccionarDVD

  /**
   * Metodo que marca el boton de la camara en la pantalla
   * 
   * @param int camara 
   * @access public
   */
  public function seleccionarCamara( $camaraId ) {

$this->setDispositivo("CAMARA_".$camaraId);

} // end of member function seleccionarCamara

  /**
   * Metodo que marca el boton de redThinkClient
   * 
   * @access public
   */
  public function seleccionarRedThinkClient( ) {

      $this->setDispositivo("RED_THINK_CLIENT");

  } // end of member function seleccionarRedThinkClient

  /**
   * Metodo que marca el boton del plasma
   * 
   * @access public
   */
  public function seleccionarPlasma( ) {

      $this->setDispositivo("PLASMA");
     AccesoGui::$guiPlasma->dibujarPantalla();
  } // end of member function seleccionarPlasma

  /**
   * Metodo que marca el boton de la camara de documentos y muestra la pantalla
   * con sus funciones
   * 
   * @access public
   */
  public function seleccionarCamaraDocumentos( ) {

      $this->setDispositivo("CAMARA_DE_DOCUMENTOS");
      AccesoGui::$guicamaraDocumentos->dibujarPantalla();

  } // end of member function seleccionarCamaraDocumentos

  /**
   * Metodo que marca el boton del grabador de dvd y muestra la pantalla
   * con sus funciones
   * 
   * @access public
   */
  public function seleccionarDVDGrab( ) {

      $this->setDispositivo("DVDGRAB");
      AccesoGui::$guiGrabadorDVD->dibujarPantalla();

  } // end of member function seleccionarDVDGrab

  /**
   *  Metodo que marca el boton del proyector central y muestra la pantalla
   * con sus funciones
   * 
   * @access public
   */
  public function seleccionarProyectorCentral( ) {

      $this->setDispositivo("PROYECTOR_CENTRAL");
      AccesoGui::$guiProyectores->setProyectorActivo("PROYECTOR_CENTRAL");
      AccesoGui::$guiProyectores->dibujarPantalla("PROYECTOR_CENTRAL");


      AccesoGui::$guiPantallas->dibujarPantalla("PANTALLA_ELECTRICA");
  } // end of member function seleccionarProyectorCentral

  /**
   *  Metodo que marca el boton del proyector de la pizarra y muestra la pantalla
   * con sus funciones
   * 
   * @access public
   */
  public function seleccionarPizarra( ) {

      $this->setDispositivo("PIZARRA_DIGITAL");
      AccesoGui::$guiProyectores->dibujarPantalla("PIZARRA_DIGITAL");

  } // end of member function seleccionarPizarra

  /**
   *  Metodo que marca el boton del proyector central y muestra la pantalla
   * con sus funciones y las de la pantalla electrica
   * 
   *
   * @access public
   */
  public function seleccionarPantallaElectrica( ) {
      system_class::log_message("@@11@@@ GUIDispositovos_selecionaarpantallaelectrica........");
      $this->setDispositivo("PANTALLA_ELECTRICA");
      system_class::log_message("@@22@@@ GUIDispositovos_selecionaarpantallaelectrica........");

      AccesoGui::$guiProyectores->setProyectorActivo("PROYECTOR_CENTRAL");
      system_class::log_message("@@33@@@ GUIDispositovos_selecionaarpantallaelectrica........");

      AccesoGui::$guiProyectores->dibujarPantalla("PROYECTOR_CENTRAL");
      system_class::log_message("@@44@@@ GUIDispositovos_selecionaarpantallaelectrica........");

      AccesoGui::$guiPantallas->dibujarPantalla("PANTALLA_ELECTRICA");
      system_class::log_message("@@55@@@ GUIDispositovos_selecionaarpantallaelectrica........");
  } // end of member function seleccionarPantallaElectrica

  /**
   *  Metodo que marca el boton de la pantalla de la entrada y muestra la pantalla
   * con sus funciones
   * 
   * @access public
   */
  public function seleccionarPantallaEntrada( ) {

      $this->setDispositivo("PANTALLA_ENTRADA");
       AccesoGui::$guiPantallas->dibujarPantalla("PANTALLA_ENTRADA");
  } // end of member function seleccionarPantallaEntrada

  /**
   *  Metodo que marca el boton de la pantalla de la presidencia y muestra la
   * pantalla con sus funciones
   * 
   * @access public
   */
  public function seleccionarPantallaPresidencia( ) {

      $this->setDispositivo("PANTALLA_PRESIDENCIA");
      AccesoGui::$guiPantallas->dibujarPantalla("PANTALLA_PRESIDENCIA");
  } // end of member function seleccionarPantallaPresidencia

  /**
   * 
   *
   * @access public
   */
  public function seleccionarFocos($idFoco) {
      $this->setDispositivo("FOCO_"+$idFoco);
  } // end of member function seleccionarFocos

  /**
   * 
   *
   * @access public
   */
  public function seleccionarPCSuelo( ) {
      $this->setDispositivo("PC_SUELO");
  } // end of member function seleccionarPCSuelo

  /**
   * 
   *
   * @access public
   */
  public function seleccionarLuces( ) {
      $this->setDispositivo("LUCES");
     // AccesoGui::$guiLuces->dibujarPantalla();
  } // end of member function seleccionarLuces

  /**
   * 
   *
   * @access public
   */
  public function seleccionarVideoconferencia( ) {
      $this->setDispositivo("VIDEOCONFERENCIA");
      AccesoGui::$guiVideoconferencia->dibujarPantalla();
  } // end of member function seleccionarVideoconferencia

  /**
   * Metodo que crea y envia el comando con el dispositivo seleccionado a la
   * pantalla
   * 
   * @access public
   */
  public function enviarDispositivo( ) {

       $cmd = new ComandoFlash("DISPOSITIVO", $this->getDispositivo(), "");
   $this->enviarPeticion($cmd->getComando());
     

  } // end of member function enviarDispositivo


  /**
   * Metodo que envia a la pantalla el comando
   * 
   * @param string $comando
   * @access public
   */
  public function enviarPeticion($comando) {

     SocketClass::client_reply($comando);

  } // end of member function enviarPeticion

  

  /**
   * Metodo para dibujar la pantalla
   * 
   * @access public
   */
  public function dibujarPantalla( ) {
$this->activarPantalla();
       $this->enviarDispositivo();
	try {
		usleep(500000); // segundu bat itxaroten da Thinclient-ei ez
							// bait die pantaila marrazteko denborarik
							// ematen.
	} catch (Exception $e) {
	}

  } // end of member function dibujarPantalla





} // end of GUIDispositivos
?>
