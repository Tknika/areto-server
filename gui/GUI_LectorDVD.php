<?php

/**
 * class GUI_LectorDVD
 *
 */
class GUI_LectorDVD {



    private $estado = 0;

    private $comando = "APAGAR";

    private $volumen = 84;


    public function  __construct() {
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
    //activar y dibujar
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
     * @param bool estado

     * @return
     * @access public
     */
    public function setEstado( $estado ) {
        $this->estado=$estado;
        $this->enviarEstado();
        //$this->activarPantalla();
    //dibujar y activar
    } // end of member function setEstado

    /**
     *
     *
     * @return bool
     * @access public
     */
    public function getEstado( ) {
        if ($this->estado==1)
            return "ON";
        else
            return "OFF";
    } // end of member function getEstado

    /**
     *
     *
     * @param int volument

     * @return
     * @access public
     */
    public function setVolumen( $volumen ) {
        $this->volumen=$volumen;
        $this->enviarVolumen();
        //$this->activarPantalla();
    
    } // end of member function setVolumen

    /**
     *
     *
     * @return int
     * @access public
     */
    public function getVolumen( ) {
        return $this->volumen;
    } // end of member function getVolumen

    /**
     *
     *
     * @return
     * @access public
     */
    public function subirVolumen( ) {
        $vol = $this->getVolumen();
        if ($vol < 100) {
            $vol = $vol + 8;
        } else {
            $vol = 8;
        }
        $this->setVolumen($vol);
    } // end of member function subirVolumen

    /**
     *
     *
     * @return
     * @access public
     */
    public function bajarVolumen( ) {
        $vol = $this->getVolumen();
        if ($vol > 0) {
            $vol = $vol - 8;
        } else {
            $vol = 0;
        }
        $this->setVolumen($vol);
    } // end of member function bajarVolumen

    /**
     *
     *
     * @return
     * @access public
     */
    public function encenderDVD( ) {
        $this->setEstado(true);
        $this->setComando("ENCENDER");
    } // end of member function encenderDVD

    /**
     *
     *
     * @return
     * @access public
     */
    public function onOffDVD( ) {
        if($this->estado==1) {
            $this->setEstado(0);
            $this->setComando("OFF");
        }
        else {
            $this->setEstado(1);
            $this->setComando("ON");
        }
    } // end of member function onOffDVD

    /**
     *
     *
     * @return
     * @access public
     */
    public function apagarDVD( ) {
        $this->setEstado(0);
        $this->setComando("APAGAR");
    } // end of member function apagarDVD

    /**
     *
     *
     * @return
     * @access public
     */
    public function subirVolumenDVD( ) {
        $this->setComando("SUBIR_VOLUMEN");
        $this->subirVolumen();

    } // end of member function subirVolumenDVD

    /**
     *
     *
     * @return
     * @access public
     */
    public function bajarVolumenDVD( ) {
        $this->setComando("BAJAR_VOLUMEN");
        $this->bajarVolumen();
    } // end of member function bajarVolumenDVD

    /**
     *
     *
     * @return
     * @access public
     */
    public function norteDVD( ) {
        $this->setComando("NORTE");
    } // end of member function norteDVD

    /**
     *
     *
     * @return
     * @access public
     */
    public function surDVD( ) {
        $this->setComando("SUR");
    } // end of member function surDVD

    /**
     *
     *
     * @return
     * @access public
     */
    public function esteDVD( ) {
        $this->setComando("ESTE");
    } // end of member function esteDVD

    /**
     *
     *
     * @return
     * @access public
     */
    public function oesteDVD( ) {
        $this->setComando("OESTE");
    } // end of member function oesteDVD

    /**
     *
     *
     * @return
     * @access public
     */
    public function aceptarDVD( ) {
        $this->setComando("ACEPTAR");
    } // end of member function aceptarDVD

    /**
     *
     *
     * @return
     * @access public
     */
    public function pararDVD( ) {
        $this->setComando("PARAR");
    } // end of member function pararDVD

    /**
     *
     *
     * @return
     * @access public
     */
    public function pausarDVD( ) {
        $this->setComando("PAUSA");
    } // end of member function pausarDVD

    /**
     *
     *
     * @return
     * @access public
     */
    public function retrocederDVD( ) {
        $this->setComando("RETROCEDER");
    } // end of member function retrocederDVD

    /**
     *
     *
     * @return
     * @access public
     */
    public function avanzarDVD( ) {
        $this->setComando("AVANZAR");
    } // end of member function avanzarDVD

    /**
     *
     *
     * @return
     * @access public
     */
    public function anteriorDVD( ) {
        $this->setComando("ANTERIOR");
    } // end of member function anteriorDVD

    /**
     *
     *
     * @return
     * @access public
     */
    public function siguienteDVD( ) {
        $this->setComando("SIGUIENTE");
    } // end of member function siguienteDVD

    /**
     *
     *
     * @return
     * @access public
     */
    public function menuDVD( ) {
        $this->setComando("MENU");
    } // end of member function menuDVD

    /**
     *
     *
     * @return
     * @access public
     */
    public function activarDVD( ) {
        $this->setComando("ACTIVAR");
    } // end of member function activarDVD

    /**
     *
     *
     * @return
     * @access public
     */
    public function enviarComando( ) {
        $cmd = new ComandoFlash("DVD", $this->getComando(), "");
		$this->enviarPeticion($cmd->getComando());
    } // end of member function enviarComando

    /**
     *
     *
     * @return
     * @access public
     */
    public function enviarEstado( ) {
        $cmd = new ComandoFlash("DVD", $this->getEstado(), "");
		$this->enviarPeticion($cmd->getComando());
    } // end of member function enviarEstado

    /**
     *
     *
     * @return
     * @access public
     */
    public function enviarVolumen( ) {
        $cmd = new ComandoFlash("DVD", "VOLUMEN", $this->getVolumen());
		$this->enviarPeticion($cmd->getComando());
    } // end of member function enviarVolumen

    /**
     *
     *
     * @return
     * @access public
     */
    public function enviarPeticion($comando ) {
   
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
            $pantallaActual->setProperty("Pantalla.activa",9);
        file_put_contents('./pantallaActiva.properties',     $pantallaActual->toString(true));


       // $this->pantalla_activa=$pantalla;
    } // end of member function setPantallaActiva
    /**
     *
     *
     * @return
     * @access public
     */
    public function dibujarPantalla( ) {
        echo "entra en la pantalla del dvddddddddddddddddddddddddddddddddddddddddd\n";

$this->activarPantalla();
       $this->enviarEstado();
		$this->enviarComando();
		$this->enviarVolumen();
              
    } // end of member function dibujarPantalla



} // end of GUI_LectorDVD
?>
