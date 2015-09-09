<?php

/**
 * class GUI_Camaras
 * 
 */
class GUI_Camaras
{

  /** Aggregations: */

  /** Compositions: */

   /*** Attributes: ***/

 public static $CAMARA_ALUMNO1 = "CAMARA_1";
  public static $CAMARA_ALUMNO2 = "CAMARA_2";
  public static $CAMARA_PRESIDENCIA = "CAMARA_3";

  //Variables de estado
  private $domo_activo ="CAMARA_3";
  private $comandoCamara =array("", "", "");
  private $posicion = array(0, 0, 0);

  public function  __construct() {
        }
  /**
   * 
   *
   * @param int domo 

   * @return int
   * @access public
   */
  public function obtenerIdCamara( $domo ) {
      if(strcmp($domo, self::$CAMARA_ALUMNO1)){
          return 0;
      }
      else if(strcmp($domo, self::$CAMARA_ALUMNO2)){
          return 1;
      }
      else if(strcmp($domo, self::$CAMARA_PRESIDENCIA)){
          return 2;
      }
      else
          return -1;

  } // end of member function obtenerIdCamara

  /**
   * 
   *
   * @param string domo 

   * @param string comando 

   * @return 
   * @access public
   */
  public function setComando( $domo,  $comando ) {
      $this->setCamaraActiva($domo);
      $this->comandoCamara[$this->obtenerIdCamara($domo)]=$comando;
      //activar y dibujar pantalla
  } // end of member function setComando

  /**
   * 
   *
   * @param string domo 

   * @return 
   * @access public
   */
  public function getComando( $domo ) {
      return $this->comandoCamara[$this->obtenerIdCamara($domo)];
  } // end of member function getComando

  /**
   * 
   *
   * @param string domo 

   * @param int preset 

   * @return 
   * @access public
   */
  public function setPosicion( $domo,  $preset ) {
       $this->setCamaraActiva($domo);
      $this->posicion[$this->obtenerIdCamara($domo)]=$preset;
      //enviar posicion
  } // end of member function setPosicion

  /**
   * 
   *
   * @param string domo 

   * @return int
   * @access public
   */
  public function getPosicion( $domo ) {
      return $this->posicion[$this->obtenerIdCamara($domo)];
  } // end of member function getPosicion

  /**
   * 
   *
   * @param string domo 

   * @return 
   * @access public
   */
  public function setCamaraActiva( $domo ) {
      $this->domo_activo=$domo;
  } // end of member function setCamaraActiva

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function getCamaraActiva( ) {
      return $this->domo_activo;
  } // end of member function getCamaraActiva

  /**
   * 
   *
   * @param string domo 

   * @return 
   * @access public
   */
  public function camaraPararMovimiento( $domo ) {

       $this->setComando($domo, "PARAR");
  } // end of member function camaraPararMovimiento

  /**
   * 
   *
   * @param string domo 

   * @param int preset 

   * @return 
   * @access public ERREPIKATUTA??????
   */
  public function posicionCamara( $domo,  $preset ) {
         $this->setComando($domo, "PARAR");
  } // end of member function setPosicionCamara

  /**
   * 
   *
   * @param string domo 

   * @return 
   * @access public
   */
  public function acercarCamara( $domo ) {
         $this->setComando($domo, "ACERCAR");
  } // end of member function acercarCamara

  /**
   * 
   *
   * @param string domo 

   * @return 
   * @access public
   */
  public function alejarCamara( $domo ) {
         $this->setComando($domo, "ALEJAR");
  } // end of member function alejarCamara

  /**
   * 
   *
   * @param string domo 

   * @return 
   * @access public
   */
  public function enfocarCamara( $domo ) {
         $this->setComando($domo, "ENFOCAR");
  } // end of member function enfocarCamara

  /**
   * 
   *
   * @param string domo 

   * @return 
   * @access public
   */
  public function desenfocarCamara( $domo ) {
         $this->setComando($domo, "DESENFOCAR");
  } // end of member function desenfocarCamara

  /**
   * 
   *
   * @param string domo 

   * @return 
   * @access public
   */
  public function panRightCamara( $domo ) {
         $this->setComando($domo, "PANR");
  } // end of member function panRightCamara

  /**
   * 
   *
   * @param string domo 

   * @return 
   * @access public
   */
  public function panLeftCamara( $domo ) {
         $this->setComando($domo, "PANL");
  } // end of member function panLeftCamara

  /**
   * 
   *
   * @param string domo 

   * @return 
   * @access public
   */
  public function tiltUpCamara( $domo ) {
         $this->setComando($domo, "TILTUP");
  } // end of member function tiltUpCamara

  /**
   * 
   *
   * @param string domo 

   * @return 
   * @access public
   */
  public function tiltDownCamara( $domo ) {
         $this->setComando($domo, "TILTDOWN");
  } // end of member function tiltDownCamara

  /**
   * 
   *
   * @return 
   * @access public
   */
  public function enviarComando( ) {
  } // end of member function enviarComando

  /**
   * 
   *
   * @return 
   * @access public
   */
  public function enviarPosicion( ) {
  } // end of member function enviarPosicion

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
  } // end of member function dibujarPantalla


 public function getComandoFlash($cmd){
if (strcmp($cmd->getAccion(),"ACERCAR")==0) {
      $this->acercarCamara($cmd->getEntorno());
    }
    else if (strcmp($cmd->getAccion(),"ALEJAR")==0) {
      $this->alejarCamara($cmd->getEntorno());
    }
    else if (strcmp($cmd->getAccion(),"PANR")==0) {
      $this->panRightCamara($cmd->getEntorno()==0);
    }
    else if (strcmp($cmd->getAccion(),"PANL")==0) {
      $this->panLeftCamara($cmd->getEntorno());
    }
    else if (strcmp($cmd->getAccion(),"TILTUP")==0) {
      $this->tiltUpCamara($cmd->getEntorno());
    }
    else if (strcmp($cmd->getAccion(),"TILTDOWN")==0) {
      $this->tiltDownCamara($cmd->getEntorno());
    }

    else if (strcmp($cmd->getAccion(),"PARAR")==0) {
      $this->camaraPararMovimiento($cmd->getEntorno());
    }
    else if (strcmp($cmd->getAccion(),"POSICION")==0) {
      $this->posicionCamara($cmd->getEntorno(),$cmd->getAtributo());
    }
// if(strcmp($tipoComando, "COMANDO")==0)
$comandoFlash=$this->crearComandoFlash($cmd->getEntorno());
//else if(strcmp($tipoComando, "POSICION")==0)
$comandoFlash=$this->crearComandoPosicionFlash($cmd->getEntorno());
     return $comandoFlash;

  }

public function crearComandoFlash($camara){
  //$comando="";


        $comando=new ComandoFlash($camara,$this->getComando($camara),"");
        print_r($comando);
       return $comando;

}
public function crearComandoPosicionFlash($camara){
  //$comando="";


        $comando=new ComandoFlash($camara,"POSICION",$this->getPosicion($camara));
        print_r($comando);
       return $comando;

}
} // end of GUI_Camaras
?>
