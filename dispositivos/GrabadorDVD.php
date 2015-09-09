<?php
/**
 * page-level  package
 *
 *  @package PHP::dispositivos
 *
 */
/**
* includes
*
*/
require_once './dispositivos/DVD.php';


/**
 * class GrabadorDVD
 *
 * Clase que se encargara de enviar al Grabador de dvd las ordenes adecuadas
 * para su manejo
 *
 *  @package PHP::dispositivos
 */
class GrabadorDVD extends DVD {


/**
 *
 * @static
 * @access private
 */
    private static $GRABANDO = "GRABANDO";

    function  __construct($dispositivo) {
        $this->tipoDispositivo="DvdGrabador";
        parent::__construct($dispositivo);
        echo($this->ip."-".$this->modeloIPLT."-".$this->strMarca."-".$this->strModelo."-".$this->id_disp."-".$this->tipoPuerto."-".$this->numeroPuerto."-".$this->baudRate."-".$this->timeOut."-".$this->puerto."-".$this->password);

    }

    /**
     * Pone el grabador dvd en funcion dvd
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function ponerDVD( ) {

        $comando=$this->comandos1[DaoControl::$DVD];
        $this->enviarComando($comando);
        $this->guardarEstado();
    } // end of member function ponerDVD

    /**
     * Pone el grabador dvd en funcion TV
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function ponerTV( ) {
   
        $comando=$this->comandos1[DaoControl::$TV];
        $this->enviarComando($comando);
        $this->guardarEstado();
    } // end of member function ponerTV

     /**
     * Cambia el source del dvd
      *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function source( ) {

        $comando=$this->comandos1[DaoControl::$SOURCE];
        $this->enviarComando($comando);
        $this->guardarEstado();
    } // end of member function okMenu

     /**
     * Sube el canal
      *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function subirCanal( ) {
 
        $comando=$this->comandos1[DaoControl::$CANALMAS];
        $this->enviarComando($comando);
        $this->guardarEstado();
    } // end of member function subirCanal

     /**
     * Baja el canal
      *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function bajarCanal( ) {

        $comando=$this->comandos1[DaoControl::$CANALMENOS];
        $this->enviarComando($comando);
        $this->guardarEstado();
    } // end of member function bajarCanal

     /**
     * Graba lo q este reproduciendo el dvd
      *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function grabar() {
    
        $comando=$this->comandos1[DaoControl::$REC];
        $this->enviarComando($comando);
        $this->setEstado(self::$GRABANDO);
        $this->guardarEstado();
    }

   public function procesarComando($comando,$parametro) {
    }
} // end of GrabadorDVD
?>
