<?php

/**
* class GUI_Escenarios
* 
*/
class GUI_Escenarios {

/**
 * Atributo para iniciar el escenario Enviar_Clases
 * @var string
 * @access private
 * @static
 */
private static $ENVIAR_CLASE = "ENVIAR_CLASES";
    /**
     * Atributo para iniciar el escenario Recibir_Clases
     * @var string
     * @access private
     * @static
     */
private static $RECIBIR_CLASE = "RECIBIR_CLASES";
    /**
     * Atributo para iniciar el escenario Clase_Local
     * @var string
     * @access private
     * @static
     */
private static $CLASE_LOCAL = "CLASE_LOCAL";
    /**
     * Atributo para iniciar el escenario Seminario/Clase
     * @var string
     * @access private
     * @static
     */
private static $SEMINARIO_CLASE = "SEMINARIO/CLASE";
    /**
     * Atributo para iniciar el escenario Pelicula
     * @var string
     * @access private
     * @static
     */
private static $PELICULA = "PELICULA";


    /**
     * Atributo que indica el estado de la videoconferencia
     *
     * @var bool
     */
private $estadoVideoconferencia = false;

    /**
     * Atributo que guarda el valor del comando pulsado en la pantalla
     *
     * @var string
     */
private $comando = "";

public function  __construct() {}
/**
     * Metodo para dar valor al atributo $comando y enviarlo  a la pantalla para
     * mostrar en ella la accion realizada
* 
* @param string comando 
* @access public
*/
public function setComando( $comando ) {

    $this->comando=$comando;
    $this->enviarComando();
$this->activarPantalla();
} // end of member function setComando

/**
     * Metodo para obtener el valor del atributo comando
* 
     * @return string $comando
* @access public
*/
public function getComando( ) {

    return $this->comando;

} // end of member function getComando

/**
     * Metodo para actualizar el valor del estado de la videoconferencia
* 
* @param bool estado 
* @access public
*/
public function setEstadoVideoConferencia( $estado ) {

    $this->estadoVideoconferencia=$estado;
    $this->enviarEstadoVideoconferencia();
} // end of member function setEstadoVideoConferencia

/**
     * Metodo que devuelve el estado de la videoconferencia
* 
     * @return string
* @access public
*/
public function getEstadoVideoConferencia( ) {

    if($this->estadoVideoconferencia)
        return "VIDEOCONFERENCIA:TRUE";
    else
        return "VIDEOCONFERENCIA:FALSE";

} // end of member function getEstadoVideoConferencia

/**
     * Metodo que señala en la pantalla que que se a pulsado el boton de enviar clase
* 
*
* @access public
*/
public function escenarioEnviarClase( ) {

    $this->setEstadoVideoConferencia(true);
    $this->setComando(self::$ENVIAR_CLASE);


} // end of member function escenarioEnviarClase

/**
     * Metodo que señala en la pantalla que que se a pulsado el boton de recibir clase
* 
*
* @access public
*/
public function escenarioRecivirClase( ) {

     $this->setEstadoVideoConferencia(true);
    $this->setComando(self::$RECIBIR_CLASE);

} // end of member function escenarioRecivirClase


/**
     * Metodo que señala en la pantalla que que se a pulsado el boton de clase local
* 
*
* @access public
*/
public function escenarioClaseLocal( ) {

     $this->setEstadoVideoConferencia(false);
    $this->setComando(self::$CLASE_LOCAL);

} // end of member function escenarioClaseLocal

/**
     * Metodo que señala en la pantalla que que se a pulsado el boton de seminario
* 
*
* @access public
*/
public function escenarioSeminario( ) {

     $this->setEstadoVideoConferencia(false);
    $this->setComando(self::$SEMINARIO_CLASE);

} // end of member function escenarioSeminario

/**
     * Metodo que señala en la pantalla que que se a pulsado el boton de pelicula
* 
*
* @access public
*/
public function escenarioPelicula( ) {

     $this->setEstadoVideoConferencia(false);
    $this->setComando(self::$PELICULA);

} // end of member function escenarioPelicula

/**
     * Metodo que crea el comando y se lo envia a la pantalla
* 
*
* @access public
*/
public function enviarComando( ) {

    $cmd = new ComandoFlash("MENU","ESCENARIOS", $this->getComando(), "");
    $this->enviarPeticion($cmd->getComando());

} // end of member function enviarComando

/**
     * Metodo que crea el comando con el estado de la videoconferencia y lo envia a
     * la pantalla
* 
* @access public
*/
public function enviarEstadoVideoconferencia( ) {

    $cmd = new ComandoFlash("SISTEMA", "MENU", $this->getEstadoVideoconferencia());
		$this->enviarPeticion($cmd->getComando());

} // end of member function enviarEstadoVideoConferencia

/**
     * Metodo que envia el comando a la pantalla
* 
     * @param string comando
*
* @access public
*/
public function enviarPeticion( $comando ) {

     SocketClass::client_reply($comando);

} // end of member function enviarPeticion

/**
* 
*
     *
* @access public
*/
 public function activarPantalla() {

            $pantallaActual=new Properties();
        $pantallaActual->load(file_get_contents("./pantallaActiva.properties"));
            $pantallaActual->setProperty("Pantalla.activa",3);
        file_put_contents('./pantallaActiva.properties',     $pantallaActual->toString(true));


       // $this->pantalla_activa=$pantalla;
    } // end of member function setPantallaActiva
/**
* 
*
* @access public
*/
public function dibujarPantalla( ) {

    $this->enviarComando();
    $this->activarPantalla();

} // end of member function dibujarPantalla

/**
* 
*
     *
* @access public
*/
public function dibujarEscenarioMenu( ) {

    $this->enviarEstadoVideoconferencia();

} // end of member function dibujarEscenarioMenu


} // end of GUI_Escenarios
?>
