<?php

/**
 * 
 * @package PHP::gui
 */
/**
 * class GUI_CamaraDocumentos
 *
 * Clase que se encarga de dibujar en la pantalla las acciones relacionadas con
 * los alumnos
 *
 * @package PHP::gui
 */
class GUI_Focos
{
/**
 * Atributo que indica que se estan manejando los dos focos
 *
 * @access private
 * @static
 * @var string
 */
private static $FOCOS_TODOS = "FOCO";
/**
 * Atributo que indica que se esta manejando el foco1
 *
 * @access private
 * @static
 * @var string
 */
  private static $FOCO_1 = "FOCO1";
 /**
 * Atributo que indica que se esta manejando el foco2
 *
 * @access private
 * @static
 * @var string
 */
  private static $FOCO_2 = "FOCO2";


  /**
   *
   * @var array
   */
  private $comandosFocos =array("", "", "");
  private $posicion =array(0, 0, 0);
  /**
   * 
   *
   * @param string foco 

   * @return 
   * @access public
   */
  public function obtenerIdFoco( $foco ) {
       if(strcmp($foco, self::$FOCOS_TODOS)){
          return 0;
      }
      else if(strcmp($foco, self::$FOCO_1)){
          return 1;
      }
      else if(strcmp($foco, self::$FOCO_2)){
          return 2;
      }
      else
          return -1;

  } // end of member function obtenerIdFoco

  /**
   * 
   *
   * @param string foco 

   * @param string comando 

   * @return 
   * @access public
   */
  public function setComando( $foco,  $comando ) {
      $this->comandosFocos[$this->obtenerIdFoco($foco)]=$comando;
      //activarpantalla y enviar comando
  } // end of member function setComando

  /**
   * 
   *
   * @param string foco 

   * @return string
   * @access public
   */
  public function getComando( $foco ) {
      return $this->comandosFocos[$this->obtenerIdFoco($foco)];
  } // end of member function getComando

  /**
   * 
   *
   * @param int posicion 

   * @param string foco 

   * @return 
   * @access public
   */
  public function setPosicion( $posicion,  $foco ) {
      $this->posicion[$this->obtenerIdFoco($foco)]=$posicion;
      //activar y enviar
  } // end of member function setPosicion

  /**
   * 
   *
   * @param string foco 

   * @return int
   * @access public
   */
  public function getPosicion( $foco ) {
      return $this->comandosFocos[$this->obtenerIdFoco($foco)];
  } // end of member function getPosicion

  /**
   * 
   *
   * @param string foco 

   * @param int posicion 

   * @return 
   * @access public
   */
  public function posicionFoco( $foco,  $posicion ) {
      $this->setPosicion($foco,$posicion);
  } // end of member function posicionFoco

  /**
   * 
   *
   * @return 
   * @access public
   */
  public function encenderFoco( ) {
       $this->setComando(self::$FOCOS_TODOS,"ON");
  } // end of member function encenderFoco

  /**
   * 
   *
   * @return 
   * @access public
   */
  public function apagarFoco( ) {
        $this->setComando(self::$FOCOS_TODOS,"OFF");
  } // end of member function apagarFoco

  /**
   * 
   *
   * @return 
   * @access public
   */
  public function darLuzFoco1( ) {
        $this->setComando(self::$FOCOS_TODOS,"ON");
  } // end of member function darLuzFoco1

  /**
   * 
   *
   * @return 
   * @access public
   */
  public function darLuzFoco2( ) {
        $this->setComando(self::$FOCOS_TODOS,"ON");
  } // end of member function darLuzFoco2

  /**
   * 
   *
   * @return 
   * @access public
   */
  public function quitarLuzFoco1( ) {
        $this->setComando(self::$FOCOS_TODOS,"OFF");
  } // end of member function quitarLuzFoco1

  /**
   * 
   *
   * @return 
   * @access public
   */
  public function quitarLuzFoco2( ) {
        $this->setComando(self::$FOCOS_TODOS,"OFF");
  } // end of member function quitarLuzFoco2

  /**
   * 
   *
   * @return 
   * @access public
   */
  public function homeFoco( ) {
        $this->setComando(self::$FOCOS_TODOS,"HOME");
  } // end of member function homeFoco

  /**
   * 
   *
   * @param string foco 

   * @return 
   * @access public
   */
  public function enviarComando( $foco ) {
  } // end of member function enviarComando

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
  public function activarPantalla( ) {
  } // end of member function activarPantalla

  /**
   * 
   *
   * @return 
   * @access public
   */
  public function dibujarPantalla( ) {
      $this->activarPantalla();
      $this->activarPantalla();
  } // end of member function dibujarPantalla

 public function getComandoFlash($cmd){
if (strcmp($cmd->getAccion(),"APAGAR")==0) {
     $this->apagarFoco();
    }
    else if (strcmp($cmd->getAccion(),"ENCENDER")==0) {
      $this->encenderFoco();
    }
  }
public function crearComandoPosicionFlash(){

  }


} // end of GUI_Focos
?>
