<?php

require_once('./dispositivos/LCD.php');
/**
 * class GUI_Pantallas
 *
 */
class GUI_Pantallas {

/** Aggregations: */

/** Compositions: */

   /*** Attributes: ***/

    public static $PANTALLA_ELECTRICA = "PANTALLA_ELECTRICA";
    public static $PANTALLA_PRESIDENCIA = "PANTALLA_PRESIDENCIA";
    public static $PANTALLA_ENTRADA = "PANTALLA_ENTRADA";


    private static $presidencia;

    private static $entrada;


    //Variables de estado
    private $estado_pantalla_electrica = 0;
    private $pantalla_activa = "";
    private $comando = array("", "", "");
    private $estado=array("","","");


    public function  __construct() {
	self::$presidencia=new LCD("PantallaPresidencia");
        self::$entrada=new LCD("PantallaEntrada");
    }

    /**
     *
     *
     * @param string pantalla

     * @return int
     * @access public
     */
    public function obtenerIdPantalla( $pantalla ) {
        if(strcmp($pantalla, self::$PANTALLA_ELECTRICA)==0) {
            return 0;
        }
        else if(strcmp($pantalla, self::$PANTALLA_PRESIDENCIA)==0) {

                return 1;
            }
            else if(strcmp($pantalla, self::$PANTALLA_ENTRADA)==0) {

                    return 2;
                }
                else

                    return -1;
    } // end of member function obtenerIdPantalla

    /**
     *
     *
     * @param string pantalla

     * @param string comando

     * @return
     * @access public
     */
    public function setComando( $pantalla,  $comando ) {
        $this->setPantallaActiva($pantalla);
        $this->comando[$this->obtenerIdPantalla($this->getPantallaActiva())]=$comando;
        $this->enviarComando();
    //$this->activarPantalla();
    //activar y enviar pantalla
    } // end of member function setComando

    /**
     *
     *
     * @param string pantalla

     * @return string
     * @access public
     */
    public function getComando( $pantalla ) {
        $this->setPantallaActiva($pantalla);
        if(strcmp($this->getPantallaActiva(),self::$PANTALLA_ELECTRICA)==0)
            return $this->getEstadoPantallaElectrica();
        else {
            return $this->comando[$this->obtenerIdPantalla($this->getPantallaActiva())];

        }
    } // end of member function getComando
    /**
     *
     *
     * @param string pantalla

     * @param string comando

     * @return
     * @access public
     */
    public function setComandoEstado( $pantalla,  $comando ) {
        $this->setPantallaActiva($pantalla);

        $this->estado[$this->obtenerIdPantalla($this->getPantallaActiva())]=$comando;
        $this->enviarComandoEstado();
    //activar y enviar pantalla
    } // end of member function setComando

    /**
     *
     *
     * @param string pantalla

     * @return string
     * @access public
     */
    public function getComandoEstado( $pantalla ) {
	$this->setPantallaActiva($pantalla);
        if(strcmp($this->getPantallaActiva(),self::$PANTALLA_ELECTRICA)==0)
            return $this->getEstadoPantallaElectrica();

	if($pantalla=='PANTALLA_PRESIDENCIA'){
	  $st=self::$presidencia->getEstado(LCD::$estadoLCD[LCD::$ENCENDIDO]);
	}else if($pantalla=='PANTALLA_ENTRADA'){
	  $st=self::$entrada->getEstado(LCD::$estadoLCD[LCD::$ENCENDIDO]);
	}

	if (!isset($st['estado']) || strpos($st['estado'],'OK01') === false ){
	  return 'OFF';
	}else{
	  return 'ON';
	}

    } // end of member function getComando
    /**
     *
     *
     * @param string pantalla

     * @return
     * @access public
     */
    public function setPantallaActiva( $pantalla ) {
        $pantallaActual=new Properties();
        $pantallaActual->load(file_get_contents("./pantallaActiva.properties"));
        $this->pantalla_activa=$pantalla;
        if(strcmp($this->pantalla_activa, "")==0) {

            $this->pantalla_activa=$pantallaActual->getProperty("Lcd.activa");

        }


        $pantallaActual->setProperty("Lcd.activa",$pantalla);
        file_put_contents('./pantallaActiva.properties',     $pantallaActual->toString(true));
    } // end of member function setPantallaActiva

    /**
     *
     *
     * @return string
     * @access public
     */
    public function getPantallaActiva( ) {
        return $this->pantalla_activa;
    } // end of member function getPantallaActiva

    /**
     *
     *
     * @param bool estado

     * @return
     * @access public
     */
    public function setEstadoPantallaElectrica( $estado ) {
        $this->estado_pantalla_electrica=$estado;
    } // end of member function setEstadoPantallaElectrica

    /**
     *
     *
     * @return bool
     * @access public
     */
    public function getEstadoPantallaElectrica( ) {

        if ($this->estado_pantalla_electrica==1) {
            return "BAJADA";
        } else {
            return "SUBIDA";
        }
    } // end of member function getEstadoPantallaElectrica

    /**
     *
     *
     * @return
     * @access public
     */
    public function bajarPantallaElectrica( ) {
        $this->setEstadoPantallaElectrica(1);
        $this->setComando(self::$PANTALLA_ELECTRICA, "ABAJO");
    } // end of member function bajarPantallaElectrica

    /**
     *
     *
     * @return
     * @access public
     */
    public function subirPantallaElectrica( ) {
        $this->setEstadoPantallaElectrica(0);
        $this->setComando(self::$PANTALLA_ELECTRICA, "ARRIBA");
    } // end of member function subirPantallaElectrica

    /**
     *
     *
     * @return
     * @access public
     */
    public function pantallaPresidenciaMezcla( ) {
        $this->setComando(self::$PANTALLA_PRESIDENCIA, "MOSTRAR_CONTRAPARTE_Y_NUESTRA_IMAGEN");
    } // end of member function pantallaPresidenciaMezcla

    /**
     *
     *
     * @return
     * @access public
     */
    public function pantallaPresidenciaNuestra( ) {
        $this->setComando(self::$PANTALLA_PRESIDENCIA, "MOSTRAR_NUESTRA_IMAGEN");
    } // end of member function pantallaPresidenciaNuestra

    /**
     *
     *
     * @return
     * @access public
     */
    public function pantallaPresidenciaPCSuelo( ) {
        $this->setComando(self::$PANTALLA_PRESIDENCIA, "PC_SUELO");
    } // end of member function pantallaPresidenciaPCSuelo

    /**
     *
     *
     * @return
     * @access public
     */
    public function pantallaPresidenciaPortatil1( ) {
        $this->setComando(self::$PANTALLA_PRESIDENCIA, "PORTATIL1");
    } // end of member function pantallaPresidenciaPortatil1

    /**
     *
     *
     * @return
     * @access public
     */
    public function pantallaPresidenciaPortatil2( ) {
        $this->setComando(self::$PANTALLA_PRESIDENCIA, "PORTATIL2");
    } // end of member function pantallaPresidenciaPortatil2

    /**
     *
     *
     * @return
     * @access public
     */
    public function pantallaPresidenciaPortatil3( ) {
        $this->setComando(self::$PANTALLA_PRESIDENCIA, "PORTATIL3");
    } // end of member function pantallaPresidenciaPortatil3

    /**
     *
     *
     * @return
     * @access public
     */
    public function pantallaPresidenciaAtril( ) {
        $this->setComando(self::$PANTALLA_PRESIDENCIA, "ATRIL");
    } // end of member function pantallaPresidenciaAtril

    /**
     *
     *
     * @return
     * @access public
     */
    public function pantallaPresidenciaRedThinkClient( ) {
        $this->setComando(self::$PANTALLA_PRESIDENCIA, "THINK_CLIENT");
    } // end of member function pantallaPresidenciaRedThinkClient

    /**
     *
     *
     * @return
     * @access public
     */
    public function pantallaPresidenciaVisorDocumentos( ) {
        $this->setComando(self::$PANTALLA_PRESIDENCIA, "CAMARA_DE_DOCUMENTOS");
    } // end of member function pantallaPresidenciaVisorDocumentos

    /**
     *
     *
     * @return
     * @access public
     */
    public function pantallaPresidenciaDVD( ) {
        $this->setComando(self::$PANTALLA_PRESIDENCIA, "DVD");

    } // end of member function pantallaPresidenciaDVD

    /**
     *
     *
     * @return
     * @access public
     */
    public function pantallaPresidenciaDVDGrab( ) {
        $this->setComando(self::$PANTALLA_PRESIDENCIA, "DVDGRAB");
    } // end of member function pantallaPresidenciaDVDGrab

    /**
     *
     *
     * @return
     * @access public
     */
    public function pantallaPresidenciaContra( ) {
        $this->setComando(self::$PANTALLA_PRESIDENCIA, "MOSTRAR_CONTRAPARTE");
    } // end of member function pantallaPresidenciaContra

    /**
     *
     *
     * @return
     * @access public
     */
    public function pantallaPresidenciaEncender( ) {
        $this->setComandoEstado(self::$PANTALLA_PRESIDENCIA, "ON");
    } // end of member function pantallaPresidenciaEncender

    /**
     *
     *
     * @return
     * @access public
     */
    public function pantallaPresidenciaApagar( ) {
        $this->setComandoEstado(self::$PANTALLA_PRESIDENCIA, "OFF");
    } // end of member function pantallaPresidenciaApagar

    /**
     *
     *
     * @return
     * @access public
     */
    public function pantallaEntradaEncender( ) {
        $this->setComandoEstado(self::$PANTALLA_ENTRADA, "ON");
    } // end of member function pantallaEntradaEncender

    /**
     *
     *
     * @return
     * @access public
     */
    public function pantallaEntradaApagar( ) {
        $this->setComandoEstado(self::$PANTALLA_ENTRADA, "OFF");
    } // end of member function pantallaEntradaApagar

    /**
     *
     *
     * @return
     * @access public
     */
    public function pantallaEntradaPortatil1( ) {
        $this->setComando(self::$PANTALLA_PRESIDENCIA, "PORTATIL1");
    } // end of member function pantallaEntradaPortatil1

    /**
     *
     *
     * @return
     * @access public
     */
    public function pantallaEntradaPortatil2( ) {
        $this->setComando(self::$PANTALLA_PRESIDENCIA, "PORTATIL2");
    } // end of member function pantallaEntradaPortatil2

    /**
     *
     *
     * @return
     * @access public
     */
    public function pantallaEntradaPortatil3( ) {
        $this->setComando(self::$PANTALLA_PRESIDENCIA, "PORTATIL3");
    } // end of member function pantallaEntradaPortatil3

    /**
     *
     *
     * @return
     * @access public
     */
    public function pantallaEntradaAtril( ) {
        $this->setComando(self::$PANTALLA_PRESIDENCIA, "ATRIL");
    } // end of member function pantallaEntradaAtril

    /**
     *
     *
     * @return
     * @access public
     */
    public function pantallaEntradaRedThinkClient( ) {
        $this->setComando(self::$PANTALLA_PRESIDENCIA, "THINK_CLIENT");
    } // end of member function pantallaEntradaRedThinkClient


     /**
     *
     *
     * @return
     * @access public
     */
    public function pantallaEntradaPip( ) {
        $this->setComando(self::$PANTALLA_PRESIDENCIA, "PIP");
    } // end of member function pantallaEntradaRedThinkClient

    /**
     *
     *
     * @return
     * @access public
     */
    public function pantallaEntradaKamara1( ) {
        $this->setComando(self::$PANTALLA_PRESIDENCIA, "KAMARA1");
    } // end of member function pantallaEntradaRedThinkClient




    /**
     *
     *
     * @return
     * @access public
     */
    public function pantallaEntradaVisorDocumentos( ) {
        $this->setComando(self::$PANTALLA_PRESIDENCIA, "CAMARA_DE_DOCUMENTOS");
    } // end of member function pantallaEntradaVisorDocumentos

    /**
     *
     *
     * @return
     * @access public
     */
    public function pantallaEntradaDVD( ) {
        $this->setComando(self::$PANTALLA_PRESIDENCIA, "DVD");
    } // end of member function pantallaEntradaDVD

    /**
     *
     *
     * @return
     * @access public
     */
    public function pantallaEntradaDVDGrab( ) {
        $this->setComando(self::$PANTALLA_PRESIDENCIA, "DVDGRAB");
    } // end of member function pantallaEntradaDVDGrab

    /**
     *
     *
     * @return
     * @access public
     */
    public function pantallaEntradaPCSuelo( ) {
        $this->setComando(self::$PANTALLA_PRESIDENCIA, "PC_SUELO");
    } // end of member function pantallaEntradaPCSuelo

    /**
     *
     *
     * @param string pantalla

     * @return
     * @access public
     */
    public function enviarComando() {
        $cmd = new ComandoFlash($this->getPantallaActiva(), $this->getComando($this->getPantallaActiva()), "");
        $this->enviarPeticion($cmd->getComando());
    } // end of member function enviarComando

    /**
     *
     *
     * @param string pantalla

     * @return
     * @access public
     */
    public function enviarComandoEstado() {
        $cmd = new ComandoFlash($this->getPantallaActiva(), $this->getComandoEstado($this->getPantallaActiva()), "");
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

    public function activarPantalla() {

        $pantallaActual=new Properties();
        $pantallaActual->load(file_get_contents("./pantallaActiva.properties"));
        $pantallaActual->setProperty("Pantalla.activa",11);
        file_put_contents('./pantallaActiva.properties',     $pantallaActual->toString(true));

    } // end of member function setPantallaActiva
    /**
     *
     *
     * @param string pantalla

     * @return
     * @access public
     */
    public function dibujarPantalla($pantalla=null) {
        $this->activarPantalla();
        $this->setPantallaActiva($pantalla);
        $this->enviarComando();
        $this->enviarComandoEstado();
    } // end of member function dibujarPantalla



} // end of GUI_Pantallas
?>
