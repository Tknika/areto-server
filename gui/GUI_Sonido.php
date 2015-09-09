<?php

/**
 * class GUI_Sonido
 *
 */
class GUI_Sonido {

   /*** Attributes: ***/

    public static $SONIDO_ENTRANTE = "entrante";
    public static $SONIDO_SALIENTE = "saliente";

    public static $SONIDO_GENERAL = "general";

    private static $COMANDOS =array ("entrante"=>"ENTRANTE","saliente"=>"SALIENTE","general"=>"GENERAL");


    private $microsOn=array("M1"=>0,"M2"=>0,"M3"=>0,"M4"=>0,"M5"=>0,"M6"=>0,"M12"=>0);
    private $microsVol=array("M1"=>84,"M2"=>84,"M3"=>84,"M4"=>84,"M5"=>84,"M6"=>84,"M12"=>84);
    private $sonidoVol=array("entrante"=>84,"saliente"=>84,"general"=>84);
    private $sonidoOn=array("entrante"=>1,"saliente"=>1,"general"=>1);

    public function  __construct() {

    }
    /**
     *
     *
     * @param int id

     * @return string
     * @access public
     */
    public function getComando($id) {
	system_class::log_message("MMMMMM222222222 id:".$id."  cMD:::". self::$COMANDOS[$id] );
        return self::$COMANDOS[$id];
    } // end of member function getComando

    /**
     *
     *
     * @param int id

     * @param bool on

     * @return
     * @access public
     */
    public function setSonidoOn( $id,  $on ) {

        $this->sonidoOn[$id]=$on;
        $this->enviarEstadoSonido($id);
        //$this->activarPantalla();

    } // end of member function setSonidoOn

    /**
     *
     *
     * @param int id

     * @return
     * @access public
     */
    public function getSonido( $id ) {

        return $this->getEstado($this->sonidoOn[$id]);
    } // end of member function setSonido

    /**
     *
     *
     * @param bool id

     * @return bool
     * @access public
     */
    public function isSonido( $id ) {

        return $this->sonidoOn[$id];
    } // end of member function isSonido

    /**
     *
     *
     * @param int volumen

     * @return
     * @access public
     */
    public function setVolumenGeneral( $volumen ) {

        $this->sonidoVol["general"]=$volumen;
        $this->enviarVolumenGeneral();
//$this->activarPantalla();
    } // end of member function setVolumenGeneral

    /**
     *
     *
     * @return int
     * @access public
     */
    public function getVolumenGeneral( ) {

        return $this->sonidoVol["general"];
    } // end of member function getVolumenGeneral

    /////////////////////////////////////////////////////
    ///////////////NIK SORTUAK HASIERA///////////////////
    /////////////////////////////////////////////////////
    public function setVolumenEntrante( $volumen ) {

        $this->sonidoVol["entrante"]=$volumen;

    } // end of member function setVolumenGeneral
    public function getVolumenEntrante( ) {

        return $this->sonidoVol["entrante"];

    } // end of member function setVolumenGeneral
    public function subirlVolumenEntrante( ) {
        $volumen = $this->subirVolumen($this->getVolumenEntrante());
        $this->setVolumenEntrante($volumen);
    } // end of member function subirlVolumenGeneral
    /**
     * @return
     * @access public
     */
    public function bajarVolumenEntrante( ) {
        $volumen = $this->bajarVolumen($this->getVolumenEntrante());
        $this->setVolumenEntrante($volumen);
    } // end of member function bajarVolumenGeneral





    public function setVolumenSaliente( $volumen ) {

        $this->sonidoVol["saliente"]=$volumen;

    } // end of member function setVolumenGeneral
    public function getVolumenSaliente() {

        return $this->sonidoVol["saliente"];

    } // end of member function setVolumenGeneral
    public function subirlVolumenSaliente( ) {
        $volumen = $this->subirVolumen($this->getVolumenSaliente());
        $this->setVolumenSaliente($volumen);
    } // end of member function subirlVolumenGeneral

    /**
     * @return
     * @access public
     */
    public function bajarVolumenSaliente( ) {
        $volumen = $this->bajarVolumen($this->getVolumenSaliente());
        $this->setVolumenGeneral($volumen);
    } // end of member function bajarVolumenGeneral
    /////////////////////////////////////////////////////
    ///////////NIK SORTUAK BUKAERA///////////////////////
    /////////////////////////////////////////////////////
    /**
     *
     *
     * @param int micro

     * @param bool on

     * @return
     * @access public
     */
    public function setMicroOn( $micro,  $on ) {

	system_class::log_message("MMMMM_ONNNNNsetMicroOn :: ".$micro."  est: ".$on );

        $this->microsOn[$micro]=$on;
           echo "Micrro=".$micro."\n";
        $this->enviarEstadoMicrofono($micro);
        echo "ON=".$on."\n";
        if($on==1)
            $this->enviarVolumenMicro($micro);
        else
            $this->enviarLimpiarVolumenMicro($micro);


    } // end of member function setMicroOn

    /**
     *
     *
     * @param int micro

     * @return string
     * @access public
     */
    public function getMicro( $micro ) {

	system_class::log_message("MMMMM_ONNNNN estado:: ".$micro."  est: ".$this->microsOn[$micro] );
        return $this->getEstado($this->microsOn[$micro]);
    } // end of member function getMicro

    /**
     *
     *
     * @param int micro

     * @return bool
     * @access public
     */
    public function isMicroOn( $micro ) {

        return $this->microsOn[$micro];
    } // end of member function isMicroOn

    /**
     *
     *
     * @param int micro

     * @param int volumen

     * @return
     * @access public
     */
    public function setVolumenMicro( $micro,  $volumen ) {

        $this->microsVol[$micro]=$volumen;

        $this->enviarVolumenMicro($micro);

    //activar y enviar volumen micro
    } // end of member function setVolumenMicro

    /**
     *
     *
     * @param int micro

     * @return int
     * @access public
     */
    public function getVolumenMicro( $micro ) {

        return $this->microsVol[$micro];
    } // end of member function getVolumenMicro

    /**
     *
     *
     * @param bool estado

     * @return string
     * @access public
     */
    public function getEstado( $estado ) {

        if ($estado==1) {
            return "ON";
        } else {
            return "OFF";
        }
    } // end of member function getEstado

    /**
     *
     *
     * @param int volumen

     * @return
     * @access public
     */
    public function subirVolumen( $volumen ) {
        if ($volumen < 100) {
            $volumen = $volumen + 10;
        } else {
            $volumen = 100;
        }
        return $volumen;
    } // end of member function subirVolumen

    /**
     *
     *
     *
     * @param int volumen

     * @return
     * @access public
     */
    public function bajarVolumen( $volumen ) {
        if ($volumen > 0) {
            $volumen = $volumen - 10;
        } else {
            $volumen = 0;
        }
        return $volumen;

    } // end of member function bajarVolumen

    /**
     *
     *
     * @return
     * @access public
     */
    public function subirlVolumenGeneral( ) {
        $volumen = $this->subirVolumen($this->getVolumenGeneral());
        $this->setVolumenGeneral($volumen);
    } // end of member function subirlVolumenGeneral

    /**
     *
     *
     * @return
     * @access public
     */
    public function bajarVolumenGeneral( ) {
        $volumen = $this->bajarVolumen($this->getVolumenGeneral());
        $this->setVolumenGeneral($volumen);
    } // end of member function bajarVolumenGeneral

    /**
     *
     *
     * @param int micro

     * @return
     * @access public
     */
    public function subirVolumenMicro( $micro ) {

        $volumen = $this->subirVolumen($this->getVolumenMicro($micro));
        $this->setVolumenMicro($micro, $volumen);
    } // end of member function subirVolumenMicro

    /**
     *
     *
     * @param int micro

     * @return
     * @access public
     */
    public function bajarVolumenMicro( $micro ) {
        $volumen = $this->bajarVolumen($this->getVolumenMicro($micro));
        $this->setVolumenMicro($micro, $volumen);
    } // end of member function bajarVolumenMicro


    /**
     *
     *
     * @param int micro

     * @return
     * @access public
     */
    public function activarMicroPresidencia( $micro ) {
        $this->setMicroOn($micro, 1);
        $this->enviarVolumenMicro($micro);
    } // end of member function activarMicroPresidencia

    /**
     *
     *
     * @param int micro

     * @return
     * @access public
     */
    public function desactivarMicroPresidencia( $micro ) {
        $this->setMicroOn($micro, 0);
        $this->enviarlimpiarVolumenMicro($micro);
    } // end of member function desactivarMicroPresidencia

    /**
     *
     *
     * @return
     * @access public
     */
    public function activarSonidoContraparte( ) {
        $this->setSonidoOn(self::$SONIDO_ENTRANTE, 1);
    } // end of member function activarSonidoContraparte

    /**
     *
     *
     * @return
     * @access public
     */
    public function desactivarSonidoContraparte( ) {
        $this->setSonidoOn(self::$SONIDO_ENTRANTE, 0);
    } // end of member function desactivarSonidoContraparte

    /**
     *
     *
     * @return
     * @access public
     */
    public function subirSonidoContraparte( ) {
        $this->setSonidoOn(self::$SONIDO_ENTRANTE, 0);
    } // end of member function subirSonidoContraparte

    /**
     *
     *
     * @return
     * @access public
     */
    public function bajarSonidoContraparte( ) {
        $this->setSonidoOn(self::$SONIDO_ENTRANTE, 0);
    } // end of member function bajarSonidoContraparte

    /**
     *
     *
     * @return
     * @access public
     */
    public function activarSonidoSaliente( ) {
        $this->setSonidoOn(self::$SONIDO_SALIENTE, 1);
    } // end of member function activarSonidoSaliente

    /**
     *
     *
     * @return
     * @access public
     */
    public function desactivarSonidoSaliente( ) {
        $this->setSonidoOn(self::$SONIDO_SALIENTE, 0);
    } // end of member function desactivarSonidoSaliente

    /**
     *
     *
     * @return
     * @access public
     */
    public function activarSonidoGeneral( ) {
        $this->setSonidoOn(self::$SONIDO_GENERAL, 1);
        $this->enviarVolumenGeneral();
    //enviarvolumen general
    } // end of member function activarSonidoGeneral

    /**
     *
     *
     * @return
     * @access public
     */
    public function desactivarSonidoGeneral( ) {
        $this->setSonidoOn(self::$SONIDO_GENERAL, 0);
        $this->enviarLimpiarVolumenGeneral();
    } // end of member function desactivarSonidoGeneral

    /**
     *
     *
     * @param string comando

     * @return
     * @access public
     */
    public function enviarPeticion( $comando ) {
        SocketClass::client_reply($comando->getComando());

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
            $pantallaActual->setProperty("Pantalla.activa",5);
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
        try {
            usleep(1000000); // segundu bat itxaroten da Thinclient-ei ez
        // bait die pantaila marrazteko denborarik
        // ematen.
        } catch (Exception $e) {
        }
        foreach ($this->microsOn as $micro=>$estado) {
            if ($estado==1) {

                $this->enviarVolumenMicro($micro);

            }else {

                $this->enviarLimpiarVolumenMicro($micro);

            }
            $this->enviarEstadoMicrofono($micro);

        }

        $this->enviarEstadoSonido(self::$SONIDO_ENTRANTE);
        $this->enviarEstadoSonido(self::$SONIDO_SALIENTE);
        $this->enviarEstadoSonido(self::$SONIDO_GENERAL);
        if($this->isSonido(self::$SONIDO_GENERAL)==1) {

            $this->enviarVolumenGeneral();
        }else {
            $this->enviarLimpiarVolumenGeneral();
        }
    } // end of member function dibujarPantalla


    public function enviarVolumenGeneral() {
        $comando=new ComandoFlash("SONIDO","VOLUMEN",$this->getVolumenGeneral());
        $this->enviarPeticion($comando);

    }
    public function enviarLimpiarVolumenGeneral() {
        $comando=new ComandoFlash("SONIDO","VOLUMEN","0");
        $this->enviarPeticion($comando);

    }
    public function enviarVolumenMicro($micro) {
echo "VOLUMEN MICRO ".$micro."= ".$this->getVolumenMicro($micro)."\n";
       //$comando=new ComandoFlash("MICROFONO",substr($micro, -1).":VOLUMEN",$this->getVolumenMicro($micro));
       $comando=new ComandoFlash("MICROFONO",substr($micro, 1).":VOLUMEN",$this->getVolumenMicro($micro));
       echo "new comando egin du\n";
       $this->enviarPeticion($comando);

    }
    public function enviarLimpiarVolumenMicro($micro) {
	//$comando=new ComandoFlash("MICROFONO",substr($micro, -1).":VOLUMEN","0");
        $comando=new ComandoFlash("MICROFONO",substr($micro, 1).":VOLUMEN","0");
        $this->enviarPeticion($comando);

    }
    public function enviarEstadoMicrofono($micro) {
	//$comando=new ComandoFlash("MICROFONO",substr($micro, -1),$this->getMicro($micro));

	system_class::log_message("");
        $comando=new ComandoFlash("MICROFONO",substr($micro, 1),$this->getMicro($micro));
        $this->enviarPeticion($comando);

    }
    public function enviarEstadoSonido($id) {
        $comando=new ComandoFlash("SONIDO",$this->getComando($id),$this->getSonido($id));
        $this->enviarPeticion($comando);

    }
} // end of GUI_Sonido
?>
