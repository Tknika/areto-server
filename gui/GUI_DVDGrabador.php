<?php

/**
 * 
 * @package PHP::gui
 */
/**
 * class GUI_ADVDGrabador
 *
 * Clase que se encarga de dibujar en la pantalla las acciones relacionadas con
 * el gravador de dvd
 *
 * @package PHP::gui
 */
class GUI_DVDGrabador
{

/**
 * Atributo que guarda el valor del comando pulsado en la pantalla
 *
 * @var string
 */
 private $comando = "";
 /**
 * Atributo que guarda el valor del volumen del grabador de dvd en la pantalla
 *
 * @var string
 */
  private $volumen = 84;
 

  public function  __construct() {}
   public function activarPantalla() {


            $pantallaActual=new Properties();
        $pantallaActual->load(file_get_contents("./pantallaActiva.properties"));
            $pantallaActual->setProperty("Pantalla.activa",10);
        file_put_contents('./pantallaActiva.properties',     $pantallaActual->toString(true));
    } // end of member function setPantallaActiva
  /**
     * Metodo para dar valor al atributo $comando y lo envia a pa pantalla
   * 
     * @param string $comando
     * @param int $posicion
   */
  public function setComando( $comando ) {
      $this->comando=$comando;
      $this->enviarComando();
      //$this->activarPantalla();
  } // end of member function setComando

  /**
     * Metodo que devuelve el ultimo comando seleccinado en la pantalla
   * 
   * @return string
   * @access public
   */
  public function getComando( ) {
      return $this->comando;
  } // end of member function getComando

  /**
   * Metodo que actualiza el atributo volumen y lo envia a la pantalla
   * 
   * @param int volumen 
   * @access public
   */
  public function setVolumen( $volumen ) {
      $this->volumen=$volumen;
      $this->enviarVolumen();
      //$this->activarPantalla();
  } // end of member function setVolumen_

  /**
   * Metodo que devuelve el volumen marcado en la pantalla
   * 
   * @return int
   * @access public
   */
  public function getVolumen( ) {
      return $this->volumen;

  } // end of member function getVolumen

  /**
   * Metodo que sube el valor del volumen de la pantalla
   * 
   * @access public
   */
  public function subirVariableVolumen( ) {
      $vol = $this->getVolumen();
    if ($vol < 100) {
    	$vol = $vol + 8;
    }
    else {
    	$vol = 100;
    }
    $this->setVolumen(vol);
  } // end of member function subirVolumen

  /**
   * Metodo que baja el valor del volumen de la pantalla
   * 
   * @access public
   */
  public function bajarVariableVolumen( ) {
      $vol = $this->getVolumen();
    if ($vol > 0) {
    	$vol = $vol - 8;
    }
    else {
    	$vol = 0;
    }
    $this->setVolumen(vol);
  } // end of member function bajarVolumen

  /**
   * Metodo que marca el boton encender en la pantalla
   * 
   * @access public
   */
  public function encenderGrabadorDVD( ) {
      $this->setComando("ENCENDER_GRAB");
  } // end of member function encenderGrabadorDVD

  /**
   * Metodo que marca el boton parar grabacion en la pantalla
   * 
   * @access public
   */
  public function pararGrabadorDVD( ) {
       $this->setComando("PARAR_GRABACION");
  } // end of member function pararGrabadorDVD

  /**
   * Metodo que marca el boton apagar en la pantalla
   * 
   * @access public
   */
  public function apagarGrabadorDVD( ) {
       $this->setComando("APAGAR_GRAB");
  } // end of member function apagarGrabadorDVD

  /**
   * Metodo que marca el boton de la funcion de dvd en la pantalla
   * 
   * @access public
   */
  public function ponerDVDGrabadorDVD( ) {
       $this->setComando("PONER_DVD");
  } // end of member function ponerDVDGrabadorDVD

  /**
   * Metodo que marca el boton de la funcion de tv en la pantalla
   * 
   * @access public
   */
  public function ponerTVGrabadorDVD( ) {
       $this->setComando("PONER_TV");
  } // end of member function ponerTVGrabadorDVD

  /**
   * Metodo que marca el boton de subir el canal en la pantalla
   * 
   * @access public
   */
  public function canalArribaGrabadorDVD( ) {
       $this->setComando("CANAL_ARRIBA");
      
  } // end of member function canalArribaGrabadorDVD

  /**
   * Metodo que marca el boton de bajar el canal en la pantalla
   * 
   * @access public
   */
  public function canalAbajoGrabadorDVD( ) {
       $this->setComando("CANAL_ABAJO");
  } // end of member function canalAbajoGrabadorDVD

  /**
   * Metodo que marca el boton fuente del dvd en la pantalla
   * 
   * @access public
   */
  public function sourceGrabadorDVD( ) {
       $this->setComando("SOURCE");
  } // end of member function sourceGrabadorDVD

  /**
   * Metodo que marca el boton grabar en la pantalla
   * 
   * @access public
   */
  public function grabarGrabadorDVD( ) {
       $this->setComando("GRABANDO");
  } // end of member function grabarGrabadorDVD
  /**
   * Metodo que marca el boton de subir el volumen en la pantalla
   *
   * @access public
   */
public function subirVolumen( ) {
       $this->setComando("SUBIR_VOLUMEN_GRAB");
       $this->subirVariableVolumen();
  }

  /**
   * Metodo que marca el boton de bajar el volumen en la pantalla
   *
   * @access public
   */
  public function bajarVolumen( ) {
       $this->setComando("BAJAR_VOLUMEN_GRAB");
       $this->bajarVariableVolumen();
  }
  /**
   * Metodo que dibuja el estado de toda la pantalla del grabador de dvd
   * 
   * @param string comando 
   * @access public
   */
  public function dibujarPantalla( $comando ) {
      $this->activarPantalla();
     $this->enviarComando();
     $this->enviarVolumen();
  } // end of member function dibujarPantalla


/**
 * Metodo que envia el ultimo comando pulsado en la pantalla
 *
 * @access public
 */

public function enviarComando() {
    $cmd = new ComandoFlash("DVDGRAB", $this->getComando(),"");
    $this->enviarPeticion($cmd->getComando());
  }
/**
 * Metodo que envia el volumen del grabador de dvd a la pantalla
 *
 */
  public function enviarVolumen() {
    $cmd = new ComandoFlash("DVDGRAB", "VOLUMEN",$this->getVolumen());
    $this->enviarPeticion($cmd->getComando());
}
/**
 * Metodo que envia el comando a la pantalla
 *
 * @param string $comando
 */
public function enviarPeticion($comando){
     SocketClass::client_reply($comando);
}
}// end of GUI_DVDGrabador
?>
