<?php
/**
 *
 * @package PHP::gui
 */
/**
 * class GUI_Alumno
 *
 * Clase que se encarga de dibujar en la pantalla las acciones relacionadas con
 * los alumnos
 *
 * @package PHP::gui
 */
class GUI_Alumno {

/**
 * Atributo que guarda el valor del comando pulsado en la pantalla
 *
 * @var string
 */
    private $comando = "";
    /**
     * Atributo que guarda la posicion del alumno activo
     * @var int
     */
    private $posicion = 0;

    /**
     * Metodo para dar valor a los atributos $comando y $posicion
     *
     * @param string $comando
     * @param int $posicion
     */
    public function setComando( $comando,$posicion ) {

        $this->comando=$comando;
        $this->posicion=$posicion;
        $this->enviarComando();
        //$this->activarPantalla(17);
    //activvar y enviar pantalla
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
     * Metodo que devuelve la posicion del alumno activo
     *
     * @return int
     * @access public
     */
    public function getPosicion( ) {

        return $this->posicion;

    } // end of member function getPosicion

    /**
     * Metodo que señala en la pantalla al alumno que pide la palabra
     *
     * @param int $alumno
     * @access public
     */
    public function alumnoPidePalabra( $alumno ) {

        $this->setComando("PIDE_PALABRA", $alumno);

    } // end of member function alumnoPidePalabra

    /**
     * Metodo que señala en la pantalla al alumno que tiene la palabra
     *
     * @param int $alumno
     * @access public
     */
    public function alumnoTienePalabra( $alumno ) {

        $this->setComando("TIENE_PALABRA", $alumno);

    } // end of member function alumnoTienePalabra

    /**
     *  Metodo que señala en la pantalla que le quita la palabra al alumno
     *
     * @param int $alumno
     * @access public
     */
    public function alumnoNoTienePalabra( $alumno ) {

        $this->setComando("NO_TIENE_PALABRA", $alumno);

    } // end of member function alumnoNoTienePalabra

    /**
     * Metodo que crea el comando necesario para que la pantalla muestre la accion
     * realizada
     *
     * @access public
     */
    public function enviarComando( ) {

        $cmd = new ComandoFlash("PUESTO", $this->getComando(),$this->getPosicion());
        $this->enviarPeticion($cmd->getComando());

    } // end of member function enviarComando

    /**
     * Metodo que manda el comando al cliente
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
     * @param string pantalla

     * @return
     * @access public
     */
    public function activarPantalla() {


            $pantallaActual=new Properties();
        $pantallaActual->load(file_get_contents("./pantallaActiva.properties"));
            $pantallaActual->setProperty("Pantalla.activa",17);
        file_put_contents('./pantallaActiva.properties',     $pantallaActual->toString(true));


       // $this->pantalla_activa=$pantalla;
    } // end of member function setPantallaActiva

    /**
     * Metodo para dibujar la pantalla
     * @access public
     */
    public function dibujarPantalla( ) {
$this->activarPantalla();
        $this->enviarComando();

    } // end of member function dibujarPantalla

/**
 *
 *
 */
//    public function crearComandoFlash() {
//
//        $comando=new ComandoFlash("PUESTO",$this->getComando(),$this->getPosicion());
//        $this->enviarPeticion($comando);
//        print_r($comando);
//
//    }


} // end of GUI_Alumno
?>
