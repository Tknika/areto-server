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
class GUI_CamaraDocumentos {

/**
 * Atributo que guarda el valor del comando pulsado en la pantalla
 *
 * @var string
 */
    private $comando = "";
    /**
     * Atributo que nos indica en la pantalla si la camara de documentos esta encendida
     * o no
     * @var bool
     */
    private $encendido = false;//edo 0

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
        //$this->activarPantalla();

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
     * Metodo para cambiar el valor del atributo encendido y enviarselo a la pantalla
     * para que se marque como a apagado o encendido
     *
     * @param bool encendido
     * @access public
     */
    public function setEncendido( $encendido ) {

        $this->encendido=$encendido;
        $this->enviarComandoEstado();
        //$this->activarPantalla();

    } // end of member function setEncendido

    /**
     * Metodo que nos devuelve si la camara de documentos esta encendida o no en
     * la pantalla
     *
     * @return bool
     * @access public
     */
    public function isEncendido( ) {

        return $this->encendido;

    //javan, camaratik zuzenean jasotzen du parametroa, moldatu
    } // end of member function isEncendido

    /**
     * Metodo para convertir los valores del atributo encendido de booleanos a strings
     *
     * @return string
     * @access public
     */
    public function getEstado( ) {
        if ($this->encendido)
            return "ON";
        else
            return "OFF";

    } // end of member function getEstado

    /**
     * Metodo que señala en la pantalla que que se a pulsado el boton de subir foco
     * en la pantalla
     *
     * @access public
     */
    public function camaraDocumentosSubirFoco( ) {

        $this->setComando("SUBIR_FOCO");

    } // end of member function camaraDocumentosSubirFoco

    /**
     * Metodo que señala en la pantalla que que se a pulsado el boton de bajar foco
     * en la pantalla
     *
     * @access public
     */
    public function camaraDocumentosBajarFoco( ) {

        $this->setComando("BAJAR_FOCO");

    } // end of member function camaraDocumentosBajarFoco

    /**
     * Metodo que señala en la pantalla que que se a pulsado el boton de acercar
     * el zoom en la pantalla
     *
     * @access public
     */
    public function camaraDocumentosAcercarZoom( ) {

        $this->setComando("ACERCAR_FOCO");

    } // end of member function camaraDocumentosAcercarZoom

    /**
     * Metodo que señala en la pantalla que que se a pulsado el boton de alejar el
     * zoom en la pantalla
     *
     * @access public
     */
    public function camaraDocumentosAlejarZoom( ) {

        $this->setComando("ALEJAR_FOCO");

    } // end of member function camaraDocumentosAlejarZoom

    /**
     * Metodo que señala en la pantalla que que se a pulsado el boton de DINA 3
     * en la pantalla
     *
     * @access public
     */
    public function camaraDocumentosA3() {

        $this->setComando("DINA_A3");

    } // end of member function camaraDocumentosA3

    /**
     * Metodo que señala en la pantalla que que se a pulsado el boton de DINA 4
     * en la pantalla
     *
     * @access public
     */
    public function camaraDocumentosA4( ) {

        $this->setComando("DINA_A4");

    } // end of member function camaraDocumentosA4

    /**
     * Metodo que señala en la pantalla que que se a pulsado el boton de encender
     * la lampara del foco
     *
     * @access public
     */
    public function camaraDocumentosEncenderLampara( ) {

        $this->setComando("ENCENDER_LAMPARA");

    } // end of member function camaraDocumentosEncenderLampara

    /**
     * Metodo que señala en la pantalla que que se a pulsado el boton de apagar
     * la lampara del foco
     *
     * @access public
     */
    public function camaraDocumentosApagarLampara( ) {

        $this->setComando("APAGAR_LAMPARA");

    } // end of member function camaraDocumentosApagarLampara

    /**
     * Metodo que señala en la pantalla que que se a pulsado el boton de encender
     * el foco
     *
     * @access public
     */
    public function camaraDocumentosEncender( ) {
        $this->setEncendido(true);
    } // end of member function camaraDocumentosEncender

    /**
     * Metodo que señala en la pantalla que que se a pulsado el boton de apagar
     * el foco
     *
     * @access public
     */
    public function camaraDocumentosApagar( ) {
        $this->setEncendido(false);
    } // end of member function camaraDocumentosApagar


    /**
     * Metodo para enviar el comando a la pantalla
     *
     * @param string comando
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
            $pantallaActual->setProperty("Pantalla.activa",14);
        file_put_contents('./pantallaActiva.properties',     $pantallaActual->toString(true));


       // $this->pantalla_activa=$pantalla;
    } // end of member function setPantallaActiva
    /**
     * Metodo para dibujar la pantalla enviando el estado y el comando seleccinado
     * al cliente
     *
     * @access public
     */
    public function dibujarPantalla( ) {
$this->activarPantalla();
        $this->enviarComando();
        $this->enviarComandoEstado();

    } // end of member function dibujarPantalla


    /**
     * Metodo para crear y enviar el comando seleccinado en la pantalla
     *
     * @access public
     */
    public function enviarComando() {

        $comando=new ComandoFlash("CAMARADOC",$this->getComando(),"");
        $this->enviarPeticion($comando->getComando());

    }
    /**
     * Metodo para crear y enviar el estado de la camara de documentos a la pantalla
     *
     * @access public
     */
    public function enviarComandoEstado() {

        $comando=new ComandoFlash("CAMARADOC",$this->getEstado(),"");
        $this->enviarPeticion($comando->getComando());

    }



} // end of GUI_CamaraDocumentos
?>
