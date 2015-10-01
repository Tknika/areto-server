<?php
require_once './comunication/hariak/socketClass/SocketClass.php';
require_once('./dispositivos/Plasma.php');
/**
 * class GUI_Plasma
 * 
 */
class GUI_Plasma
{

  /** Aggregations: */

  /** Compositions: */

   /*** Attributes: ***/

 private$comando = "";
 private $encendido = false;
 public function  __construct() {
    $this->plasma_dev=new Plasma("Plasma");

 }

  /**
   * 
   *
   * @param string comando 

   * @return 
   * @access public
   */
  public function setComando( $comando ) {
      $this->comando=$comando;
      $this->enviarComando();
     //$this->activarPantalla();
  } // end of member function setComando

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function getComando( ) {
      return $this->comando;
  } // end of member function getComando

  /**
   * 
   *
   * @param bool encendido 

   * @return 
   * @access public
   */
  public function setEncendido( $encendido ) {
      $this->encendido=$encendido;
      $this->enviarEstado();
    //$this->activarPantalla();
  } // end of member function setEncendido

  /**
   * 
   *
   * @return bool
   * @access public
   */
  public function getEstado( ) {

      $st=$this->plasma_dev->estadoPlasma();


      return $st;
      /*if ($this->encendido)
	return "ON";
      else
	return "OFF";*/
  } // end of member function getEstado

  /**
   * 
   *
   * @return 
   * @access public
   */
  public function encenderPlasma( ) {
      $this->setEncendido(true);
  } // end of member function encenderPlasma

  /**
   * 
   *
   * @return 
   * @access public
   */
  public function apagarPlasma( ) {
      $this->setEncendido(false);
  } // end of member function apagarPlasma

  /**
   * 
   *
   * @return 
   * @access public
   */
  public function verPCSalaEnPlasma( ) {
      $this->setComando("PCSUELO");
  } // end of member function verPCSalaEnPlasma

  /**
   * 
   *
   * @param int portatil 

   * @return 
   * @access public
   */
  public function verPortatilEnPlasma( $portatil ) {
      $this->setComando("PORTATIL".$portatil);
  } // end of member function verPortatilEnPlasma

public function verAtrilEnPlasma(){
   $this->setComando("ATRIL");
}
  /**
   * 
   *
   * @return 
   * @access public
   */
  public function verRedThinkClientEnPlasma( ) {
      $this->setComando("THINK_CLIENT");
  } // end of member function verRedThinkClientEnPlasma

  public function verCamaraDocumentosEnPlasma() {
      $this->setComando("CAMARA_DE_DOCUMENTOS");
  }
  /**
   * 
   *
   * @return 
   * @access public
   */
  public function verDVDEnPlasma( ) {
      $this->setComando("DVD");
  } // end of member function verDVDEnPlasma

  /**
   * 
   *
   * @return 
   * @access public
   */
  public function verDVDGrabEnPlasma( ) {
      $this->setComando("DVDGRAB");
  } // end of member function verDVDGrabEnPlasma

  /**
   * 
   *
   * @param int camara 

   * @return 
   * @access public
   */
  public function verCamaraEnPlasma( $camara ) {
      $this->setComando("CAMARA".$camara);
  } // end of member function verCamaraEnPlasma

  /**
   * 
   *
   * @return 
   * @access public
   */
  public function enviarComando( ) {
      
       $cmd = new ComandoFlash("PLASMA", $this->getComando(), "");
	   $this->enviarPeticion($cmd->getComando());
  } // end of member function enviarComando

  /**
   * 
   *
   * @return 
   * @access public
   */
  public function enviarEstado( ) {
      $cmd = new ComandoFlash("PLASMA", $this->getEstado(), "");
      $this->enviarPeticion($cmd->getComando());
  } // end of member function enviarEstado

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
   public function activarPantalla() {


            $pantallaActual=new Properties();
        $pantallaActual->load(file_get_contents("./pantallaActiva.properties"));
            $pantallaActual->setProperty("Pantalla.activa",15);
        file_put_contents('./pantallaActiva.properties',     $pantallaActual->toString(true));
    } // end of member function setPantallaActiva

  /**
   * 
   *
   * @return 
   * @access public
   */
  public function dibujarPantalla( ) {
      $this->activarPantalla();
      $this->enviarEstado();
      $this->enviarComando();
  } // end of member function dibujarPantalla




} // end of GUI_Plasma
?>
