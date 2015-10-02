<?php
/**
 * @package PHP::controladoresGuiDispositivos
 */

/**
 * Description of ControladorGuiDispositivos
 *
 * Clase que se encargara de enviar los comandos necesarios al a la pantalla, para
 * mostrar la pantalla del dispositivo seleccionado
 *
 * @author amaia
 *
 * @package PHP::controladoresGuiDispositivos
 */
class ControladorGuiDispositivos {
   private$dispositivo = "";



  private static $ID_PANTALLA ="";

  public function  __construct() {}
//  /**
//   *
//   *
//   * @param string dispositivo
//
//   * @return
//   * @access public
//   */
//  public function setDispositivo( $dispositivo ) {
//      $this->dispositivo=$dispositivo;
//  } // end of member function setDispositivo
//
//  /**
//   *
//   *
//   * @return string
//   * @access public
//   */
//  public function getDispositivo( ) {
//      return  $this->dispositivo;
//  } // end of member function getDispositivo

  /**
   *
   *
   * @return
   * @access public
   */
  public function seleccionarDVD( ) {
     
      AccesoGui::$guiDispositivos->seleccionarDVD();

     
  } // end of member function seleccionarDVD

  /**
   *
   *
   * @param int camara

   * @return
   * @access public
   */
  public function seleccionarCamara1( ) {//kamara bakoitzeko bat
 AccesoGui::$guiDispositivos->seleccionarCamara(1);
} // end of member function seleccionarCamara
public function seleccionarCamara2( ) {//kamara bakoitzeko bat
 AccesoGui::$guiDispositivos->seleccionarCamara(2);
} // end of member function seleccionarCamara
public function seleccionarCamara3(  ) {//kamara bakoitzeko bat
 AccesoGui::$guiDispositivos->seleccionarCamara(3);
} // end of member function seleccionarCamara
  /**
   *
   *
   * @return
   * @access public
   */
  public function seleccionarRedThinkClient( ) {
      AccesoGui::$guiDispositivos->seleccionarRedThinkClient();
      AccesoGui::$guiRedThinkClient->dibujarPantalla();
  } // end of member function seleccionarRedThinkClient

  /**
   *
   *
   * @return
   * @access public
   */
  public function seleccionarPlasma( ) {
     AccesoGui::$guiDispositivos->seleccionarPlasma();
     AccesoGui::$guiPlasma->dibujarPantalla();
  } // end of member function seleccionarPlasma

  /**
   *
   *
   * @return
   * @access public
   */
  public function seleccionarCamaraDocumentos( ) {
     AccesoGui::$guiDispositivos->seleccionarCamaraDocumentos();
     AccesoGui::$guicamaraDocumentos->dibujarPantalla();

  } // end of member function seleccionarCamaraDocumentos

  /**
   *
   *
   * @return
   * @access public
   */
  public function seleccionarDVDGrab( ) {
      AccesoGui::$guiDispositivos->seleccionarDVDGrab();
      AccesoGui::$guiGrabadorDVD->dibujarPantalla();
  } // end of member function seleccionarDVDGrab

  /**
   *
   *
   * @return
   * @access public
   */
  public function seleccionarProyectorCentral( ) {
    // AccesoGui::$guiDispositivos->seleccionarProyectorCentral();
    
    
  } // end of member function seleccionarProyectorCentral

  /**
   *
   *
   * @return
   * @access public
   */
  public function seleccionarPizarra( ) {
     AccesoGui::$guiDispositivos->seleccionarPizarra();
      AccesoGui::$guiProyectores->dibujarPantalla("PIZARRA_DIGITAL"); //asmatua aldatzeko
  } // end of member function seleccionarPizarra

  /**
   *
   *
   * @return
   * @access public
   */
  public function seleccionarPantallaElectrica( ) {
      AccesoGui::$guiDispositivos->seleccionarPantallaElectrica();
      AccesoGui::$guiPantallas->dibujarPantalla("PANTALLA_ELECTRICA");
      AccesoGui::$guiProyectores->dibujarPantalla("PROYECTOR_CENTRAL");
  } // end of member function seleccionarPantallaElectrica

  /**
   *
   *
   * @return
   * @access public
   */
  public function seleccionarPantallaEntrada( ) {
      AccesoGui::$guiDispositivos->seleccionarPantallaEntrada();
       AccesoGui::$guiPantallas->dibujarPantalla("PANTALLA_ENTRADA"); //asmatua aldatzeko
  } // end of member function seleccionarPantallaEntrada

  /**
   *
   *
   * @return
   * @access public
   */
  public function seleccionarPantallaPresidencia( ) {
      AccesoGui::$guiDispositivos->seleccionarPantallaPresidencia();
      AccesoGui::$guiPantallas->dibujarPantalla("PANTALLA_PRESIDENCIA"); //asmatua aldatzeko
  } // end of member function seleccionarPantallaPresidencia

  /**
   *
   *
   * @return
   * @access public
   */
  public function seleccionarFoco1() {
      AccesoGui::$guiDispositivos->seleccionarFocos(1);
      //$this->setDispositivo("FOCO_"+$idFoco);
  } // end of member function seleccionarFocos

  /**
   *
   *
   * @return
   * @access public
   */
  public function seleccionarPCSuelo( ) {
      AccesoGui::$guiDispositivos->seleccionarPCSuelo();
  } // end of member function seleccionarPCSuelo

  /**
   *
   *
   * @return
   * @access public
   */
  public function seleccionarLuces( ) {
     AccesoGui::$guiDispositivos->seleccionarLuces();
  } // end of member function seleccionarLuces

  /**
   *
   *
   * @return
   * @access public
   */
  public function seleccionarVideoconferencia( ) {
      AccesoGui::$guiDispositivos->seleccionarVideoconferencia();
  } // end of member function seleccionarVideoconferencia

  /**
   *
   *
   * @return
   * @access public
   */
  public function enviarDispositivo( ) {
      //komandoa sortu ENTORNO:ACCION:ATRIBUTO itxurarekin
  } // end of member function enviarDispositivo

  public function getComandoFlash($cmd){
    if (strcmp($cmd->getAccion(),"CAMARA_1")==0) {
      $this->seleccionarCamara1();
    
    }else if (strcmp($cmd->getAccion(),"CAMARA_2")==0) {
      $this->seleccionarCamara2();
    
    }else if (strcmp($cmd->getAccion(),"CAMARA_3")==0) {
      $this->seleccionarCamara3();
    
    }else if (strcmp($cmd->getAccion(),"FOCO_MOVIL")==0) {
      $this->seleccionarFocos1();
    
    }else if (strcmp($cmd->getAccion(),"PANTALLA_PRESIDENCIA")==0) {
      $this->seleccionarPantallaPresidencia();
    
    }else if (strcmp($cmd->getAccion(),"PANTALLA_ENTRADA")==0) {
      $this->seleccionarPantallaEntrada();
    
    }else if (strcmp($cmd->getAccion(),"PANTALLA_ELECTRICA")==0) {
      $this->seleccionarPantallaElectrica();
    
    }else if (strcmp($cmd->getAccion(),"PIZARRA_DIGITAL")==0) {
      $this->seleccionarPizarra();
    
    }else if (strcmp($cmd->getAccion(),"PROYECTOR_CENTRAL")==0) {
      $this->seleccionarProyectorCentral();
    
    }else if (strcmp($cmd->getAccion(),"DVD")==0) {
      $this->seleccionarDVD();
    
    }else if (strcmp($cmd->getAccion(),"DVDGRAB")==0) {
      $this->seleccionarDVDGrab();
    
    }else if (strcmp($cmd->getAccion(),"CAMARA_DE_DOCUMENTOS")==0) {
      $this->seleccionarCamaraDocumentos();
    
    }else if (strcmp($cmd->getAccion(),"PLASMA")==0) {
      $this->seleccionarPlasma();
    
    }else if (strcmp($cmd->getAccion(),"RED_THINK_CLIENT")==0) {
      $this->seleccionarRedThinkClient();
    }

  }
}
?>
