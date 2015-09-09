<?php
/**
 * @package PHP::controladoresGuiDispositivos
 */
/**
 * Clases necesarias para el control
 */
require_once './controlDispositivos/ControladorDVD.php';
/**
 * Description of ControladorGuiDVD
 *
 * Clase que se encargara de enviar los comandos necesarios al dvd y a su pantalla
 *
 * @author amaia
 *
 * @package PHP::controladoresGuiDispositivos
 */
class ControladorGuiDVD {


//    /**
//     *
//     *
//     * @return
//     * @access public
//     */
//    public function pantallaDVD( ) {
//
//    } // end of member function pantallaDVD

/**
 * Metodo para que reproducir el dvd en el proyector central
 *
 * @access public
 */
    public function seleccionarDVD( ) {

        AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_DVD_REPRODUCTOR,MatrizVideo::$OUTPUT_PROYECTOR_CENTRAL);
        AccesoControladoresDispositivos::$ctrlProyectores->entradaVCCentral();

    } // end of member function seleccionarDVD

    /**
     * Metodo para encender el reproductor de dvd si esta apagado o para apagarlo
     * si esta encendido y marcar el boton on/off de la pantalla
     *
     * @access public
     */
    public function onOffDVD( ) {

        AccesoControladoresDispositivos::$ctrlDvd->onOffDVD();
        AccesoGui::$guiLectorDVD->onOffDVD();

    } // end of member function ctrlOnOffDVD

    //    /**
    //     * Metodo para encender el dvd y marcar el boton de encendido
    //     *
    //     * @access public
    //     */
    //    public function encenderDVD( ) {
    //
    //        AccesoControladoresDispositivos::$ctrlDvd->encenderDVD();
    //        AccesoGui::$guiLectorDVD->encenderDVD();
    //
    //    } // end of member function encenderDVD

    //    /**
    //     *
    //     *
    //     * @return
    //     * @access public
    //     */
    //    public function apagarDVD( ) {
    //        AccesoControladoresDispositivos::$ctrlDvd->apagarDVD();
    //
    //        AccesoGui::$guiLectorDVD->apagarDVD();
    //    //        AccesoGui::$guiLectorDVD->enviarComando();
    //    } // end of member function apagarDVD

    /**
     * Metodo para subir el volumen del reproductor del dvd y marcar en la pantalla
     * la barra del volumen actual y el boton de subir el volumen
     *
     * @access public
     */
    public function subirVolumenDVD( ) {

        AccesoControladoresDispositivos::$ctrlMesaMezclas->subirVolumenDVD();
        AccesoGui::$guiLectorDVD->subirVolumenDVD();

    } // end of member function subirVolumenDVD

    /**
     * Metodo para bajar el volumen del reproductor del dvd y marcar en la pantalla
     * la barra del volumen actual y el boton de bajar el volumen
     *
     * @access public
     */
    public function bajarVolumenDVD( ) {

        AccesoControladoresDispositivos::$ctrlMesaMezclas->bajarVolumenDVD();
        AccesoGui::$guiLectorDVD->bajarVolumenDVD();

    } // end of member function bajarVolumenDVD

    /**
     * Metodo para ir al capitulo anterior del dvd y marcar el boton rstep
     *
     * @access public
     */
    public function anteriorDVD( ) {

        AccesoControladoresDispositivos::$ctrlDvd->anteriorDVD();
        AccesoGui::$guiLectorDVD->anteriorDVD();

    } // end of member function anteriorDVD

    /**
     * Metodo para ir al siguiente capitulo del dvd y marcar el boton fstep
     *
     * @access public
     */
    public function siguienteDVD( ) {

        AccesoControladoresDispositivos::$ctrlDvd->siguienteDVD();
        AccesoGui::$guiLectorDVD->siguienteDVD();

    } // end of member function siguienteDVD

    /**
     * Metodo para rebobinar el dvd y marcar el boton de rebobinar
     *
     * @access public
     */
    public function atrasDVD( ) {

        AccesoControladoresDispositivos::$ctrlDvd->atrasDVD();
        AccesoGui::$guiLectorDVD->retrocederDVD();

    } // end of member function atrasDVD

    /**
     * Metodo para adelantar el dvd y marcar el boton de adelantar
     *
     * @access public
     */
    public function adelanteDVD( ) {

        AccesoControladoresDispositivos::$ctrlDvd->adelanteDVD();
        AccesoGui::$guiLectorDVD->avanzarDVD();

    } // end of member function adelanteDVD

    /**
     * Metodo para reproducir el dvd, marcar el boton del play y activar
     * el sonido del dvd en la mesa de mezclas
     *
     * @access public
     */
    public function playDVD( ) {

        AccesoControladoresDispositivos::$ctrlDvd->playDVD();
        AccesoControladoresDispositivos::$ctrlMesaMezclas->activarSonidoDVD();
        AccesoGui::$guiLectorDVD->activarDVD();//play

    } // end of member function playDVD

    /**
     * Metodo para pausar la reproducion del dvd y marcar el boton de pausa
     *
     * @access public
     */
    public function pausarDVD( ) {

        AccesoControladoresDispositivos::$ctrlDvd->pausarDVD();
        AccesoGui::$guiLectorDVD->pausarDVD();

    } // end of member function pausarDVD

    /**
     * Metodo para parar la reproduccion del dvd, marcar el boton de stop y
     * desactivar el sonido del dvd en la mesa de mezclas
     *
     * @access public
     */
    public function stopDVD( ) {

        AccesoControladoresDispositivos::$ctrlDvd->stopDVD();
        AccesoControladoresDispositivos::$ctrlMesaMezclas->desactivarSonidoDVD();
        AccesoGui::$guiLectorDVD->pararDVD();

    } // end of member function stopDVD

    /**
     * Metodo para moverse hacia arriba en el menu del dvd y marcar el boton
     *
     *
     * @access public
     */
    public function arribaDVD( ) {

        AccesoControladoresDispositivos::$ctrlDvd->arribaDVD();
        AccesoGui::$guiLectorDVD->norteDVD();

    } // end of member function arribaDVD

    /**
     * Metodo para moverse hacia abajo en el menu del dvd y marcar el boton
     *
     *
     * @access public
     */
    public function abajoDVD( ) {

        AccesoControladoresDispositivos::$ctrlDvd->abajoDVD();
        AccesoGui::$guiLectorDVD->surDVD();

    } // end of member function abajoDVD

    /**
     * Metodo para moverse hacia la derecha en el menu del dvd y marcar el boton
     *
     *
     * @access public
     */
    public function derechaDVD( ) {

        AccesoControladoresDispositivos::$ctrlDvd->derechaDVD();
        AccesoGui::$guiLectorDVD->esteDVD();

    } // end of member function derechaDVD

    /**
     * Metodo para moverse hacia la izquierda en el menu del dvd y marcar el boton
     *
     *
     * @access public
     */
    public function izquierdaDVD( ) {

        AccesoControladoresDispositivos::$ctrlDvd->izquierdaDVD();
        AccesoGui::$guiLectorDVD->oesteDVD();

    } // end of member function izquierdaDVD

    /**
     * Metodo para aceptar la seleccion del menu del dvd y marcar el boton
     *
     *
     * @access public
     */
    public function aceptarDVD( ) {

        AccesoControladoresDispositivos::$ctrlDvd->aceptarDVD();
        AccesoGui::$guiLectorDVD->aceptarDVD();

    } // end of member function aceptarDVD

    /**
     * Metodo para ir al menu del dvd y marcar el boton
     *
     *
     * @access public
     */
    public function menuDVD( ) {
        AccesoControladoresDispositivos::$ctrlDvd->menuDVD();
        AccesoGui::$guiLectorDVD->menuDVD();

    } // end of member function menuDVD

    /**
     * Metodo para examinar la accion del comando recivido por la pelicula flash para
     * seleccionar la funcion del reproductor de dvd
     *
     * @param ComandoFlash $cmd
     */
    public function getComandoFlash($cmd) {

        if (strcmp($cmd->getAccion(),  "SUBIR_VOLUMEN")==0) {

            $this->subirvolumenDVD();
        } else if (strcmp($cmd->getAccion(), "BAJAR_VOLUMEN")==0) {

                $this->bajarvolumenDVD();
            } else if (strcmp($cmd->getAccion(), "ENCENDER")==0) {
                    $this->encenderDVD();
                } else if (strcmp($cmd->getAccion(), "ON")==0) {
                        $this->OnOffDVD();
                    } else if (strcmp($cmd->getAccion(), "APAGAR")==0) {
                            $this->apagarDVD();
                        } else if (strcmp($cmd->getAccion(), "NORTE")==0) {
                                $this->arribaDVD();
                            } else if (strcmp($cmd->getAccion(), "SUR")==0) {
                                    $this->abajoDVD();
                                } else if (strcmp($cmd->getAccion(), "ESTE")==0) {
                                        $this->derechaDVD();
                                    } else if (strcmp($cmd->getAccion(), "OESTE")==0) {
                                            $this->izquierdaDVD();
                                        } else if (strcmp($cmd->getAccion(), "ACEPTAR")==0) {
                                                $this->aceptarDVD();
                                            } else if (strcmp($cmd->getAccion(), "ACTIVAR")==0) {
                                                    $this->playDVD();
                                                } else if (strcmp($cmd->getAccion(), "PARAR")==0) {
                                                        $this->stopDVD();
                                                    } else if (strcmp($cmd->getAccion(), "PAUSA")==0) {
                                                            $this->pausarDVD();
                                                        } else if (strcmp($cmd->getAccion(), "RETROCEDER")==0) {
                                                                $this->atrasDVD();
                                                            } else if (strcmp($cmd->getAccion(), "AVANZAR")==0) {
                                                                    $this->adelanteDVD();
                                                                } else if (strcmp($cmd->getAccion(), "RSTEP")==0) {
                                                                        $this->anteriorDVD();
                                                                    } else if (strcmp($cmd->getAccion(), "FSTEP")==0) {
                                                                            $this->siguienteDVD();
                                                                        } else if (strcmp($cmd->getAccion(), "MENU_PANTALLA")==0) {
                                                                                $this->menuDVD();
                                                                            }

    }


} // end of ControladorDVD
?>
