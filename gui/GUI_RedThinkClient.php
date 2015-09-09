<?php

/**
 * class GUI_RedThinkClient
 * 
 */
class GUI_RedThinkClient
{

  /** Aggregations: */

  /** Compositions: */

   /*** Attributes: ***/
private $comando = "";

public function  __construct() {
}

private function setComando($comando) {
    $this->comando=$comando;
    $this->enviarComando();
    //activar y enviarcomando
}
private function setComandoCamaraDocumentos($comando){
    $this->comando=$comando;
    $this->enviarComandoCamaraDoc();
    //activar y enviarcamaradoc

}
private function getComando(){
    return $this->comando;

}
  /**
   * 
   *
   * @return 
   * @access public
   */
  public function verPCSueloEnRedThinkClient( ) {
       $this->setComando("PC_SUELO");
  } // end of member function verPCSueloEnRedThinkClient

  /**
   * 
   *
   * @return 
   * @access public
   */
  public function verPortatil1EnRedThinkClient( ) {
       $this->setComando("PORTATIL1");
  } // end of member function verPortatil1EnRedThinkClient

  /**
   * 
   *
   * @return 
   * @access public
   */
  public function verPortatil2EnRedThinkClient( ) {
       $this->setComando("PORTATIL2");
  } // end of member function verPortatil2EnRedThinkClient

  /**
   * 
   *
   * @return 
   * @access public
   */
  public function verPortatil3EnRedThinkClient( ) {
       $this->setComando("PORTATIL3");
  } // end of member function verPortatil3EnRedThinkClient

  /**
   * 
   *
   * @return 
   * @access public
   */
  public function verPortatil4EnRedThinkClient( ) {
       $this->setComando("PORTATIL4");
  } // end of member function verPortatil4EnRedThinkClient

  /**
   * 
   *
   * @return 
   * @access public
   */
  public function verAtrilEnRedThinkClient( ) {
       $this->setComando("ATRIL");
  } // end of member function verAtrilEnRedThinkClient

  /**
   * 
   *
   * @return 
   * @access public
   */
  public function verRedthinkClientEnRedThinkClient( ) {
       $this->setComando("THINK_CLIENT");
  } // end of member function verRedthinkClientEnRedThinkClient

  /**
   * 
   *
   * @return 
   * @access public
   */
  public function verVisorDocumentosEnRedThinkClient( ) {
       $this->setComandoCamaraDocumentos("CAMARA_DE_DOCUMENTOS");
  } // end of member function verVisorDocumentosEnRedThinkClient

  /**
   * 
   *
   * @return 
   * @access public
   */
  public function verCamara1EnRedThinkClient( ) {
       $this->setComando("CAMARA_1");
  } // end of member function verCamara1EnRedThinkClient

  /**
   * 
   *
   * @return 
   * @access public
   */
  public function verCamara2EnRedThinkClient( ) {
       $this->setComando("CAMARA_2");
  } // end of member function verCamara2EnRedThinkClient

  /**
   * 
   *
   * @return 
   * @access public
   */
  public function verCamara3EnRedThinkClient( ) {
       $this->setComando("CAMARA_3");
  } // end of member function verCamara3EnRedThinkClient

  /**
   * 
   *
   * @return 
   * @access public
   */
  public function verDVDEnRedThinkClient( ) {
       $this->setComando("DVD");
  } // end of member function verDVDEnRedThinkClient

  /**
   * 
   *
   * @return 
   * @access public
   */
  public function verDVDGrabEnRedThinkClient( ) {
       $this->setComando("DVDGRAB");
  } // end of member function verDVDGrabEnRedThinkClient

  /**
   * 
   *
   * @return 
   * @access public
   */
  public function enviarComando( ) {
      $cmd = new ComandoFlash("RED_THINK_CLIENT", $this->getComando(), "");
	  $this->enviarPeticion($cmd->getComando());
  } // end of member function enviarComando

  /**
   * 
   *
   * @return 
   * @access public
   */
  public function enviarComandoCamaraDoc( ) { 
      $cmd = new ComandoFlash("DISPOSITIVO", $this->getComando(), "");
		  $this->enviarPeticion($cmd->getComando());

  } // end of member function enviarComandoCamaraDoc

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
      $this->enviarComando();
      $this->activarPantalla();
  } // end of member function dibujarPantalla

// public function getComandoFlash($cmd){
//if (strcmp($cmd->getAccion(),"PCSUELO")==0) {
//      $this->verPCSueloEnRedThinkClient();
//    }
//    else if (strcmp($cmd->getAccion(),"PORTATIL1")==0) {
//     $this->verPortatil1EnRedThinkClient();
//    }
//    else if (strcmp($cmd->getAccion(),"PORTATIL2")==0) {
//       $this->verPortatil2EnRedThinkClient();
//    }
//    else if (strcmp($cmd->getAccion(),"PORTATIL3")==0) {
//        $this->verPortatil3EnRedThinkClient();
//    }
//    else if (strcmp($cmd->getAccion(),"PORTATIL4")==0) {
//         $this->verPortatil4EnRedThinkClient();
//    }
//    else if (strcmp($cmd->getAccion(),"ATRIL")==0) {
//          $this->verAtrilEnRedThinkClient();
//    }
//    else if (strcmp($cmd->getAccion(),"THINK_CLIENT")==0) {
//        $this->verRedthinkClientEnRedThinkClient();
//    }
//    else if (strcmp($cmd->getAccion(),"CAMARA_DE_DOCUMENTOS")==0) {
//        $this->verVisorDocumentosEnRedThinkClient();
//    }
//    else if (strcmp($cmd->getAccion(),"DVD")==0) {
//           $this->verDVDEnRedThinkClient();
//      }
//    else if (strcmp($cmd->getAccion(),"DVDGRAB")==0) {
//          $this->verDVDGrabEnRedThinkClient();
//      }
//    else if (strcmp($cmd->getAccion(),"CAMARA_1")==0) {
//        $this->verCamara1EnRedThinkClient();
//    }
//    else if (strcmp($cmd->getAccion(),"CAMARA_2")==0) {
//         $this->verCamara2EnRedThinkClient();
//    }
//    else if (strcmp($cmd->getAccion(),"CAMARA_3")==0) {
//         $this->verCamara3EnRedThinkClient();
//    }
////if(strcmp($tipoComando, "COMANDO")==0)
//  $comandoFlash=$this->crearComandoFlash();
////else if(strcmp($tipoComando, "CAMARADOC")==0)
//  $comandoFlash=$this->crearComandoCamaraDocFlash();
//     return $comandoFlash;
//
//  }
//
//public function crearComandoFlash(){
//  //$comando="";
//
//
//        $comando=new ComandoFlash("RED_THINK_CLIENT",$this->getComando(),"");
//        print_r($comando);
//       return $comando;
//
//}
//public function crearComandoCamaraDocFlash(){
//  //$comando="";
//
//
//        $comando=new ComandoFlash("DISPOSITIVO",$this->getComando(),"");
//          print_r($comando);
//       return $comando;
//
//}


} // end of GUI_RedThinkClient
?>
