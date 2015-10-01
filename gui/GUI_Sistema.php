<?php

/**
 * class GUI_Sistema
 *
 */
class GUI_Sistema {

    private $comando = "BIENVENIDO";

    private $menu = false;

    public function  __construct() {
    }
    /**
     *
     *
     * @param bool on
     * @access public
     */
    public function setMenuOn( $on ) {
        $this->menu=$on;
        $this->enviarMenu();
    } // end of member function setMenuOn

    /**
     *
     *
     * @return bool
     * @access public
     */
    public function getMenuOn( ) {
        return $this->menu;
    } // end of member function getMenuOn


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
     * @param string comando
     * @access public
     */
    public function setComando( $comando) {
        $this->comando=$comando;
        $this->enviarComando($comando);
    } // end of member function setComando


    /**
     *
     *
     * @access public
     */
    public function iniciarSistema( ) {
        $this->esperarInicioSistema();
    } // end of member function iniciarSistema
    public function enviarResultadoComprobacionSistema($message) {
        if(!empty($message)){
            $this->enviarAlert($message);
        }
        $this->setComando("XML_LOAD");
    } // end of member function iniciarSistema

    /**
     *
     * @access public
     */
    public function bienvenidaSistema( $f=false ) {
        $this->ocultarMenu();
	system_class::log_message("CMD bienvenidaSistema!!!!! ".var_dump($f,1));
    
	if($f)
	  $this->setComando("BIENVENIDO:ON");
	else
	  $this->setComando("BIENVENIDO");

    } // end of member function bienvenidaSistema

    /**
     *
     *
     * @return
     * @access public
     */
    public function salirSistema( ) {
        $this->setComando("OFF");
    } // end of member function salirSistema

    /**
     *
     *
     * @return
     * @access public
     */
    public function mostrarMenu( ) {
        $this->setMenuOn(true);
        $this->enviarMenu();

    } // end of member function mostrarMenu

    /**
     *
     *
     * @return
     * @access public
     */
    public function ocultarMenu( ) {
        $this->setMenuOn(false);
    } // end of member function ocultarMenu

    /**
     *
     * @return
     * @access public
     */
    public function esperarInicioSistema() {
        $this->setComando("INICIANDO");

    } // end of member function esperarInicioSistema

    /**
     *
     *
     * @param int tiempo
     * @access public
     */
    public function esperarSalirSistema() {
        $this->setComando("SALIENDO");
    } // end of member function esperarSalirSistema
    /**
     *
     */
    public function stopEsperaSistema() {
        $this->setComando("ESPERA:STOP");
    } // end of member function esperarSalirSistema

    /**
     *
     *
     * @return
     * @access public
     */
    public function enviarMenu( ) {
        $atrib;
        if ($this->menu) {
            $atrib = "MOSTRAR";
        }
        else {
            $atrib = "OCULTAR";
        }
        $cmd=new ComandoFlash("SISTEMA","MENU",$atrib);
        $this->enviarPeticion($cmd->getComando());
    } // end of member function enviarMenu
    public function enviarAlert($message) {

        $cmd=new ComandoFlash("ALERT","X",$message);
        $this->enviarPeticion($cmd->getComando());
    } // end of member function enviarMenu
    /**
     *
     *
     * @return
     * @access public
     */
    public function enviarComando( ) {
        $cmd=new ComandoFlash("SISTEMA",$this->getComando());
        $this->enviarPeticion($cmd->getComando());
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
    public function activarPantalla() {

	$pantallaActual=new Properties();
        $pantallaActual->load(file_get_contents("./pantallaActiva.properties"));
        $pantallaActual->setProperty("Pantalla.activa",1);
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
        $this->enviarComando();
        $this->enviarMenu();
    } // end of member function dibujarPantalla


} // end of GUI_Sistema
?>
