<?php
/**
 * @package PHP::controladoresGuiDispositivos
 */
/**
 * Clases necesarias para el control
 */
require_once './AccesoControladoresDispositivos.php';
require_once './controlDispositivos/ControladorGrabadorDVD.php';
/**
 * Description of ControladorGuiDVD
 *
 * Clase que se encargara de enviar los comandos necesarios al dvd y a su pantalla
 *
 * @author amaia
 *
 * @package PHP::controladoresGuiDispositivos
 */
class ControladorGuiDVDGrabador {



//
//    /**
//     *
//     *
//     * @return
//     * @access public
//     */
//    public function pantallaDVDGrabador( ) {
//    } // end of member function pantallaDVDGrabador

/**
 * Metodo para que reproducir el dvd en el proyector central
 *
 * @access public
 */
    public function seleccionarDVDGrabador( ) {
        AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_DVD_GRABADOR, MatrizVideo::$OUTPUT_PROYECTOR_CENTRAL);
        AccesoControladoresDispositivos::$ctrlProyectores->entradaVCCentral();

    } // end of member function seleccionarDVDGrabador

    /**
     * Metodo para subir el volumen del grabador de dvd y marcar en la pantalla
     * la barra del volumen actual y el boton de subir el volumen
     *
     * @access public
     */
    public function subirVolumen( ) {
        AccesoControladoresDispositivos::$ctrlMesaMezclas->activarSonidoDVDGrab();
        AccesoControladoresDispositivos::$ctrlMesaMezclas->subirVolumenDVDGrab();
        AccesoGui::$guiGrabadorDVD->subirVolumen();

    } // end of member function subirVolumen

    /**
     * Metodo para bajar el volumen del grabador de dvd y marcar en la pantalla
     * la barra del volumen actual y el boton de bajar el volumen
     *
     * @access public
     */
    public function bajarVolumen( ) {

        AccesoControladoresDispositivos::$ctrlMesaMezclas->bajarVolumenDVDGrab();
        AccesoGui::$guiGrabadorDVD->bajarVolumen();

    } // end of member function bajarVolumen

    /**
     * Metodo para apagar el grabador de dvd, marcar el boton de apagar y
     * desactivar el sonido
     *
     * @access public
     */
    public function apagar( ) {
        AccesoControladoresDispositivos::$ctrlDvdGrabador->apagar();
        AccesoControladoresDispositivos::$ctrlMesaMezclas->desactivarSonidoDVDGrab();
        AccesoGui::$guiGrabadorDVD->apagarGrabadorDVD();


    } // end of member function apagar
    /**
     * Metodo para apagar el grabador de dvd, marcar el boton de apagar y
     * desactivar el sonido
     *
     * @access public
     */
    public function encender( ) {
        AccesoControladoresDispositivos::$ctrlDvdGrabador->encender();
        AccesoControladoresDispositivos::$ctrlMesaMezclas->activarSonidoDVDGrab();
        AccesoGui::$guiGrabadorDVD->encenderGrabadorDVD();


    } // e
    /**
     * Metodo para grabar y marcar el boton de grabado en la pantalla
     *
     * @access public
     */
    public function grabar( ) {
        AccesoControladoresDispositivos::$ctrlDvdGrabador->grabar();
        AccesoGui::$guiGrabadorDVD->grabarGrabadorDVD();


    } // end of member function grabar


    /**
     * Metodo para parar la grabacion, marcar el boton
     *
     * @access public
     */
    public function pararGrabacion( ) {
        AccesoControladoresDispositivos::$ctrlDvdGrabador->pararGrabacionGrab( );
        AccesoGui::$guiGrabadorDVD->pararGrabadorDVD();


    } // end of member function pararGrabacion

    //    /**
    //     * Metodo para poner el grabador de dvd en funcion dvd
    //     *
    //     * @access public
    //     */
    //    public function ponerDVD( ) {
    //        AccesoControladoresDispositivos::$ctrlDvdGrabador->ponerDVD();
    //                 AccesoGui::$guiGrabadorDVD->ponerDVDGrabadorDVD();
    //
    //    } // end of member function ponerDVD
    //
    //      /**
    //     * Metodo para poner el grabador de dvd en funcion tv
    //     *
    //     * @access public
    //     */
    //    public function ponerTV( ) {
    //        AccesoControladoresDispositivos::$ctrlDvdGrabador->ponerTV();
    //        AccesoControladoresDispositivos::$ctrlMesaMezclas->activarSonidoDVDGrab();
    //         AccesoGui::$guiGrabadorDVD->ponerTVGrabadorDVD();
    //
    //    } // end of member function ponerTV

    /**
     * Metodo para subir el canal de television y marcar el boton de subir
     *
     * @access public
     */
    public function canalArriba( ) {
        AccesoControladoresDispositivos::$ctrlDvdGrabador->canalArriba();
        AccesoGui::$guiGrabadorDVD->canalArribaGrabadorDVD();

    } // end of member function canalArriba

    /**
     * Metodo para bajar el canal de television y marcar el boton de bajar
     *
     * @access public
     */
    public function canalAbajo( ) {
        AccesoControladoresDispositivos::$ctrlDvdGrabador->canalAbajoGrabador();
        AccesoGui::$guiGrabadorDVD->canalAbajoGrabadorDVD();

    } // end of member function canalAbajo

    /**
     * Metodo para seleccionar la fuente del grabador y marcar el boton
     *
     * @access public
     */
    public function source( ) {
        AccesoControladoresDispositivos::$ctrlDvdGrabador->sourceGrab();
        AccesoGui::$guiGrabadorDVD->sourceGrabadorDVD();

    } // end of member function source

    public function getComandoFlash($cmd) {

        if(strcmp($cmd->getAccion(), "SUBIR_VOLUMEN_GRAB")==0) {
            $this->subirVolumen();

        }
        else if (strcmp($cmd->getAccion(),"BAJAR_VOLUMEN_GRAB")==0) {
                $this->bajarVolumen();

            }
            else if (strcmp($cmd->getAccion(),"ENCENDER_GRAB")==0) {
                    $this->encender();
                }
                else if (strcmp($cmd->getAccion(),"APAGAR_GRAB")==0) {
                        $this->apagar();
                    }
                    else if (strcmp($cmd->getAccion(),"PONER_DVD")==0) {
                            $this->ponerDVD();
                        }
                        else if (strcmp($cmd->getAccion(),"PONER_TV")==0) {
                                $this->ponerTV();
                            }
                            else if (strcmp($cmd->getAccion(),"CANAL_ARRIBA")==0) {
                                    $this->canalArriba();
                                }
                                else if (strcmp($cmd->getAccion(),"CANAL_ABAJO")==0) {
                                        $this->canalAbajo();
                                    }
                                    else if (strcmp($cmd->getAccion(),"SOURCE")==0) {
                                            $this->source();
                                        }
                                        else if (strcmp($cmd->getAccion(),"GRABAR")==0) {
                                                $this->grabar();
                                            }
                                            else if (strcmp($cmd->getAccion(),"PARAR_GRABACION")==0) {
                                                    $this->pararGrabacion();
                                                }
    //      if(strcmp($tipoComando, "COMANDO")==0)
    //        $comandoFlash=$this->crearComandoFlash();
    //
    //        $comandoFlash=$this->crearComandoSonidoFlash();
    //        return $comandoFlash;

    }




} // end of ControladorDVDGrabador
?>
