<?php

/**
 * class GUI_Proyectores
 *
 */
require_once('./dispositivos/Proyector.php');


class GUI_Proyectores {

/** Aggregations: */

/** Compositions: */

   /*** Attributes: ***/

    public static $PIZARRA_DIGITAL = "PIZARRA_DIGITAL";
    public static $PROYECTOR_CENTRAL = "PROYECTOR_CENTRAL";

    //Variables de estado
    private $proyector_activo = "";
    private $comando = array("", "");
    private $proyector_on = 0;
    private $pizarra_on = 0;
    private $proyector_muteatu = 0;
    private $pizarra_muteatu = 0;
    private $proyector_central;
    private $pizarra_digital;

    public function  __construct() {
      $this->proyector_central=new Proyector('ProyectorCentral');
      $this->proyector_pizarra=new Proyector('ProyectorPizarra');


    }
    /**
     *
     *
     * @param string proyector

     * @return
     * @access public
     */
    public function obtenerIdProyector( $proyector ) {
        if (strcmp($proyector, self::$PIZARRA_DIGITAL)==0) {
            return 0;
        }
        else if (strcmp($proyector, self::$PROYECTOR_CENTRAL)==0) {
                return 1;
            }
    } // end of member function obtenerIdProyector

    /**
     *
     *
     * @param string proyector

     * @param string comando

     * @return
     * @access public
     */
    public function setComando( $proyector,  $comando ) {

	system_class::log_message("#### 888 #### setComando  $proyector //  $comando ");
        $this->setProyectorActivo($proyector);
        $this->comando[$this->obtenerIdProyector($proyector)]=$comando;
        $this->enviarComando();
    //$this->activarPantalla();

    } // end of member function setComando

    /**
     *
     *
     * @param string proyector

     * @return string
     * @access public
     */
    public function getComando( $proyector ) {
	system_class::log_message("#### 899 #### getComando  $proyector //  $comando ");
        return $this->comando[$this->obtenerIdProyector($proyector)];
    } // end of member function getComando

    /**
     *
     *
     * @param string proyector

     * @return
     * @access public
     */
    public function setProyectorActivo( $proyector ) {
        $this->proyector_activo=$proyector;
        $proyecActual=new Properties();
        $proyecActual->load(file_get_contents("./pantallaActiva.properties"));
        if(strcmp($proyector, "")==0)
            $this->proyector_activo=$proyecActual->getProperty("Proyector.activo");
        $proyecActual->setProperty("Proyector.activo",$this->proyector_activo);
        file_put_contents('./pantallaActiva.properties',     $proyecActual->toString(true));
    } // end of member function setProyectorActivo

    /**
     *
     *
     * @return string
     * @access public
     */
    public function getProyectorActivo( ) {
        return $this->proyector_activo;

    } // end of member function getProyectorActivo

    /**
     *
     *
     * @param bool muteado

     * @return
     * @access public
     */
    public function setProyectorMuteado( $muteado ) {
        $this->proyector_muteatu=$muteado;
        $this->enviarComandoMute();
    //$this->activarPantalla();
    } // end of member function setProyectorMuteado

    /**
     *
     *
     * @param bool muteado

     * @return
     * @access public
     */
    public function setPizarraMuteado( $muteado ) {
        $this->pizarra_muteatu=$muteado;
        $this->enviarComandoMute();
    //$this->activarPantalla();
    } // end of member function setPizarraMuteado

    /**
     *
     *
     * @return bool
     * @access public
     */
    public function isMuteadoProyector( ) {
        return $this->proyector_muteatu;
    } // end of member function isMuteadoProyector

    /**
     *
     *
     * @return bool
     * @access public
     */
    public function isMuteadoPizarra( ) {
        return $this->pizarra_muteatu;
    } // end of member function isMuteadoPizarra

    public function getEstadoMuteadoProyector() {
        if ($this->proyector_muteatu==1) {
            return "MUTE";
        } else {
            return "NO_MUTE";
        }

    }
    /**
     *
     *
     * @return string
     * @access public
     */
    public function getEstadoMuteadoPizarra( ) {
        if ($this->pizarra_muteatu==1) {
            return "MUTE";
        } else {
            return "NO_MUTE";
        }
    } // end of member function getEstadoMuteadoPizarra

    /**
     *
     *
     * @param string proyector

     * @return string
     * @access public
     */
    public function getEstadoMuteado( $proyector ) {
        if (strcmp($proyector, self::$PROYECTOR_CENTRAL)==0) {
            return $this->getEstadoMuteadoProyector();
        } else {
            return $this->getEstadoMuteadoPizarra();
        }
    } // end of member function getEstadoMuteado

    /**
     *
     *
     * @param string proyector

     * @return string
     * @access public
     */
    public function getEstado( $proyector ) {
        if (strcmp($proyector, self::$PROYECTOR_CENTRAL)==0) {
            return $this->getEstadoProyector();
        } else {
            return $this->getEstadoPizarra();
        }
    } // end of member function getEstado

    /**
     *
     *
     * @param bool encendido

     * @return
     * @access public
     */
    public function setEncendidoProyector( $encendido ) {
        $this->proyector_on=$encendido;
        $this->enviarComandoEstado();
    //$this->activarPantalla();
    } // end of member function setEncendidoProyector

    /**
     *
     *
     * @param bool encendido

     * @return
     * @access public
     */
    public function setEncendidoPizarra( $encendido ) {
        $this->pizarra_on=$encendido;
        $this->enviarComandoEstado();
    //$this->activarPantalla();
    } // end of member function setEncendidoPizarra

    /**
     *
     *
     * @return string
     * @access public
     */
    public function getEstadoProyector( ) {
	//AITOR::Proyectorearen egoera kontsulta egin!!!!!!!!!!
	
	$e=$this->proyector_central->estado();
	system_class::log_message("================= $e ================");
	return $e;

    } // end of member function getEstadoProyector

    /**
     *
     *
     * @return string
     * @access public
     */
    public function getEstadoPizarra( ) {
	//AITOR::Proyectorearen egoera kontsulta egin!!!!!!!!!!
	$e=$this->proyector_pizarra->estado();

	return $e;


    } // end of member function getEstadoPizarra

    /**
     *
     *
     * @return
     * @access public
     */
    public function encenderPizarra( ) {
        $this->setComando(self::$PIZARRA_DIGITAL, "ON");
        $this->setEncendidoPizarra(1);

    } // end of member function encenderPizarra

    /**
     *
     *
     * @return
     * @access public
     */
    public function apagarPizarra( ) {
        $this->setComando(self::$PIZARRA_DIGITAL, "OFF");
        $this->setEncendidoPizarra(0);

    } // end of member function apagarPizarra

    /**
     *
     *
     * @return
     * @access public
     */
    public function desactivarPizarra( ) {
        $this->setComando(self::$PIZARRA_DIGITAL, "MUTE");
        $this->setPizarraMuteado(1);
    } // end of member function desactivarPizarra

    /**
     *
     *
     * @return
     * @access public
     */
    public function activarPizarra( ) {
        $this->setComando(self::$PIZARRA_DIGITAL, "NO_MUTE");
        $this->setPizarraMuteado(0);
    } // end of member function activarPizarra

    /**
     *
     *
     * @return
     * @access public
     */
    public function verDVDEnPizarra( ) {
        $this->setComando(self::$PIZARRA_DIGITAL, "DVD");

    } // end of member function verDVDEnPizarra

    /**
     *
     *
     * @return
     * @access public
     */
    public function verDVDGrabEnPizarra( ) {
        $this->setComando(self::$PIZARRA_DIGITAL, "DVDGRAB");

    } // end of member function verDVDGrabEnPizarra

    /**
     *
     *
     * @param int camara

     * @return
     * @access public
     */
    public function verCamaraEnPizarra( $camara ) {
        $this->setComando(self::$PIZARRA_DIGITAL, "CAMARA_".$camara);

    } // end of member function verCamaraEnPizarra

    /**
     *
     *
     * @return
     * @access public
     */
    public function verVisorDocumentosEnPizarra( ) {
        $this->setComando(self::$PIZARRA_DIGITAL, "CAMARA_DE_DOCUMENTOS");
        $this->setEncendidoPizarra(1);
    } // end of member function verVisorDocumentosEnPizarra

    /**
     *
     *
     * @return
     * @access public
     */
    public function verPCSalaEnPizarra( ) {
        $this->setComando(self::$PIZARRA_DIGITAL, "PC_SUELO");

    } // end of member function verPCSalaEnPizarra

    /**
     *
     *
     * @param int portatil

     * @return
     * @access public
     */
    public function verPortatilEnPizarra( $portatil ) {
        $this->setComando(self::$PIZARRA_DIGITAL, "PORTATIL_".$portatil);

    } // end of member function verPortatilEnPizarra

    /**
     *
     *
     * @return
     * @access public
     */
    public function verAtrilEnPizarra( ) {
        $this->setComando(self::$PIZARRA_DIGITAL, "ATRIL");

    } // end of member function verAtrilEnPizarra

    /**
     *
     *
     * @return
     * @access public
     */
    public function verRedThinkClientEnPizarra( ) {
        $this->setComando(self::$PIZARRA_DIGITAL, "THINK_CLIENT");

    } // end of member function verRedThinkClientEnPizarra

    /**
     *
     *
     * @return
     * @access public
     */
    public function encenderProyectorCentral( ) {
        $this->setEncendidoProyector(1);
        $this->setComando(self::$PROYECTOR_CENTRAL, "ON");

    } // end of member function encenderProyectorCentral

    /**
     *
     *
     * @return
     * @access public
     */
    public function apagarProyectorCentral( ) {
        $this->setEncendidoProyector(0);
        $this->setComando(self::$PROYECTOR_CENTRAL, "OFF");

    } // end of member function apagarProyectorCentral

    /**
     *
     *
     * @return
     * @access public
     */
    public function activarProyectorCentral( ) {

        $this->setComando(self::$PROYECTOR_CENTRAL, "NO_MUTE");

    } // end of member function activarProyectorCentral

    /**
     *
     *
     * @return
     * @access public
     */
    public function desactivarProyectorCentral( ) {

        $this->setComando(self::$PROYECTOR_CENTRAL, "MUTE");

    } // end of member function desactivarProyectorCentral

    /**
     *
     *
     * @return
     * @access public
     */
    public function verDVDEnProyectorCentral( ) {
        $this->setComando(self::$PROYECTOR_CENTRAL, "DVD");
    } // end of member function verDVDEnProyectorCentral

    /**
     *
     *
     * @return
     * @access public
     */
    public function verDVDGrabEnProyectorCentral( ) {
        $this->setComando(self::$PROYECTOR_CENTRAL, "DVDGRAB");
    } // end of member function verDVDGrabEnProyectorCentral

    /**
     *
     *
     * @param int camara

     * @return
     * @access public
     */
    public function verCamaraEnProyectorCentral( $camara ) {
        $this->setComando(self::$PROYECTOR_CENTRAL, "CAMARA_".$camara);
    } // end of member function verCamaraEnProyectorCentral

    /**
     *
     *
     * @return
     * @access public
     */
    public function verVisorDocumentosEnProyectorCentral( ) {
        $this->setComando(self::$PROYECTOR_CENTRAL, "CAMARA_DE_DOCUMENTOS");
    } // end of member function verVisorDocumentosEnProyectorCentral

    /**
     *
     *
     * @return
     * @access public
     */
    public function verPCSalaEnProyectorCentral( ) {
        $this->setComando(self::$PROYECTOR_CENTRAL, "PC_SUELO");
    } // end of member function verPCSalaEnProyectorCentral

    /**
     *
     *
     * @param int portatil

     * @return
     * @access public
     */
    public function verPortatilEnProyectorCentral( $portatil ) {
        $this->setComando(self::$PROYECTOR_CENTRAL, "PORTATIL".$portatil);
    } // end of member function verPortatilEnProyectorCentral

    /**
     *
     *
     * @return
     * @access public
     */
    public function verAtrilEnProyectorCentral( ) {
        $this->setComando(self::$PROYECTOR_CENTRAL, "ATRIL");
    } // end of member function verAtrilEnProyectorCentral

    /**
     *
     *
     * @return
     * @access public
     */
    public function verRedThinkClientEnProyectorCentral( ) {
        $this->setComando(self::$PROYECTOR_CENTRAL, "THINK_CLIENT");
    } // end of member function verRedThinkClientEnProyectorCentral

    /**
     *
     *
     * @return
     * @access public
     */
    public function enviarComando( ) {
	system_class::log_message("#### 1111 enviarComando GUI_Proyectores ####");
	$a=$this->getProyectorActivo();
	$c=$this->getComando($this->getProyectorActivo());
	system_class::log_message("#### 22222  $a /////   $c  ####");
        $cmd = new ComandoFlash($a, $c , "");
	system_class::log_message("#### 33333333 ".$cmd->getComando()." ####");

	//piztutzeko comandoa bidaltzen du, baino egoera errepikatzen du!!!!!!!
	//Itzali ondo egiten du, baino piztu EZ du egiten hurrengo leroa komentatuta
        $this->enviarPeticion($cmd->getComando());

    } // end of member function enviarComando

    /**
     *
     *
     * @return
     * @access public
     */
    public function enviarComandoMute( ) {
        $cmd = new ComandoFlash($this->getProyectorActivo(), $this->getEstadoMuteado($this->getProyectorActivo()), "");
        $this->enviarPeticion($cmd->getComando());
    } // end of member function enviarComandoMute

    /**
     *
     *
     * @return
     * @access public
     */
    public function enviarComandoEstado( ) {
        $cmd = new ComandoFlash($this->getProyectorActivo(), $this->getEstado($this->getProyectorActivo()), "");
        $this->enviarPeticion($cmd->getComando());
    } // end of member function enviarComandoEstado

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
        $pantallaActual->setProperty("Pantalla.activa",12);
        file_put_contents('./pantallaActiva.properties',     $pantallaActual->toString(true));
    } // end of member function setPantallaActiva
    /**
     *
     *
     * @param string proyector

     * @return
     * @access public
     */
    public function dibujarPantalla( $proyector=null ) {

	$this->activarPantalla();
	$this->setProyectorActivo($proyector);
	//$this->enviarComandoMute();
	$this->enviarComandoEstado();
	//$this->enviarComando();
	system_class::log_message("??? 66 ???");

    } // end of member function dibujarPantalla


} // end of GUI_Proyectores
?>
