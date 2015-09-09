<?php
/**
 * @package PHP::controladoresGuiDispositivos
 */
/**
 * Clases necesarias para el control
 */
require_once './AccesoControladoresDispositivos.php';
/**
 * Description of ControladorGuiPlasmas
 *
 * Clase que se encargara de enviar a las pantallas(electrica, entrada y presidencia)
 * y a la pantalla del cliente los comandos necesarios para controlar los dispositivos
 * y que estas acciones queden marcadas en la pantalla de cada uno
 *
 * @author amaia
 *
 * @package PHP::controladoresGuiDispositivos
 */
class ControladorGuiPlasmas {

/**
 * Metodo para encender el plasma y marcar en su pantalla que esta encendido
 *
 * @access public
 */
    public function encender() {

        $respuesta=AccesoControladoresDispositivos::$ctrlPlasma->encender();
        if($respuesta!=1)
            AccesoGui::$guiPlasma->encenderPlasma();

    } // end of member function encender

    /**
     * Metodo para apagar el plasma y marcar en su pantalla que esta apagado
     *
     * @access public
     */
    public function apagar( ) {

        $respuesta=AccesoControladoresDispositivos::$ctrlPlasma->apagar();
        if($respuesta!=1)
            AccesoGui::$guiPlasma->apagarPlasma();

    } // end of member function apagar

    /**
     * Metodo para mostrar en el plasma el pc de la sala, para ello activara la
     * entrada VGA del plasma y enrutara el video y el audio(el audio al canal7???)
     * del pc al plasma.
     *
     * @access public
     */
    public function verPcSalaEnPlasma( ) {

        $respuesta=AccesoControladoresDispositivos::$ctrlPlasma->verPcSalaEnPlasma();
        if ($respuesta!=1) {
            AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(1,4);
            usleep(100000);
            AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(1,1);
            AccesoGui::$guiPlasma->verPCSalaEnPlasma();
            AccesoGui::$guiDispositivos->seleccionarPCSuelo();
        }
    } // end of member function verPcSalaEnPlasma

    /**
     * Metodo para mostrar en el plasma el portatil1, para ello activara la
     * entrada VGA del plasma y enrutara el video y el audio(el audio al canal7???)
     * del portatil1 al plasma.
     *
     * @access public
     */
    public function verPortatil1EnPlasma( ) {

        $respuesta=AccesoControladoresDispositivos::$ctrlPlasma->verPortatil1EnPlasma();
        if ($respuesta!=1) {
            AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(2,4);
            try {
                usleep(100000);
            }catch (Exception $e ) {

            }
            AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(2,1);
            AccesoGui::$guiPlasma->verPortatilEnPlasma(1);
        }
    } // end of member function verPortatil1EnPlasma

    /**
     * Metodo para mostrar en el plasma el portatil2, para ello activara la
     * entrada VGA del plasma y enrutara el video y el audio(el audio al canal7???)
     * del portatil2 al plasma.
     *
     * @access public
     */
    public function verPortatil2EnPlasma( ) {
        $respuesta=AccesoControladoresDispositivos::$ctrlPlasma->verPortatil2EnPlasma();
        if ($respuesta!=1) {
            AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(3,4);
            try {
                usleep(100000);
            }catch (Exception $e ) {

            }
            AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(3,1);
            AccesoGui::$guiPlasma->verPortatilEnPlasma(2);
        }
    } // end of member function verPortatil2EnPlasma

    /**
     * Metodo para mostrar en el plasma el portatil3, para ello activara la
     * entrada VGA del plasma y enrutara el video y el audio(el audio al canal7???)
     * del portatil3 al plasma.
     *
     * @access public
     */
    public function verPortatil3EnPlasma( ) {

        $respuesta=AccesoControladoresDispositivos::$ctrlPlasma->verPortatil3EnPlasma();
        if ($respuesta!=1) {
            AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(4,4);
            try {
                usleep(100000);
            }catch (Exception $e ) {

            }
            AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(4,1);
            AccesoGui::$guiPlasma->verPortatilEnPlasma(3);
        }
    } // end of member function verPortatil3EnPlasma

    /**
     * Metodo para mostrar en el plasma el portatil4, para ello activara la
     * entrada VGA del plasma y enrutara el video y el audio(el audio al canal7???)
     * del portatil4 al plasma.
     *
     * @access public
     */
    public function verPortatil4EnPlasma( ) {

        $respuesta=AccesoControladoresDispositivos::$ctrlPlasma->verPortatil4EnPlasma(); {
            AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(9,4);
            try {
                usleep(100000);
            }catch (Exception $e ) {

            }
            AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(9,1);
            AccesoGui::$guiPlasma->verPortatilEnPlasma(4);
        }
    } // end of member function verPortatil4EnPlasma

    /**
     * Metodo para mostrar en el plasma el atril, para ello activara la
     * entrada VGA del plasma y enrutara el video y el audio(el audio al canal7???)
     * del atril al plasma.
     *
     * @access public
     */
    public function verAtrilEnPlasma( ) {
        $respuesta=AccesoControladoresDispositivos::$ctrlPlasma->verAtrilEnPlasma();
        if ($respuesta!=1) {
            AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(9,4);
            try {
                usleep(100000);
            }catch (Exception $e ) {

            }
            AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(9,1);
            AccesoGui::$guiPlasma->verAtrilEnPlasma();
        }
    } // end of member function verAtrilEnPlasma

    /**
     * Metodo para mostrar en el plasma el visor de documentos, para ello activara
     * la entrada VGA del plasma y enrutara el video del visor al plasma.
     *
     * @access public
     */
    public function verVisorDocumentosEnPlasma( ) {

        $respuesta=AccesoControladoresDispositivos::$ctrlVisorDocumentos->encender();
        if ($respuesta!=1) {
            AccesoControladoresDispositivos::$ctrlPlasma->verVisorDocumentosEnPlasma();
            AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(8,4);
            AccesoGui::$guiPlasma->verCamaraDocumentosEnPlasma();
            AccesoGui::$guiDispositivos->seleccionarCamaraDocumentos( );
        }
    } // end of member function verVisorDocumentosEnPlasma

    /**
     * Metodo para mostrar en el plasma el reproductor de dvd, para ello activara
     * la entrada AV2 del plasma y enrutara del reproductor al plasma.
     *
     * @access public
     */
    public function verDVDEnPlasma( ) {

        $respuesta=AccesoControladoresDispositivos::$ctrlPlasma->verDVDEnPlasma();
        if ($respuesta!=1) {
            AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_DVD_REPRODUCTOR,MatrizVideo::$OUTPUT_PL_ASMA);
            AccesoGui::$guiPlasma->verDVDEnPlasma();
            AccesoGui::$guiDispositivos->seleccionarDVD();
        }
    } // end of member function verDVDEnPlasma

    /**
     * Metodo para mostrar en el plasma el grabador de dvd, para ello activara
     * la entrada AV2 del plasma y enrutara del grabador al plasma.
     *
     * @access public
     */
    public function verGrabadorDVDEnPlasma( ) {

        $respuesta=AccesoControladoresDispositivos::$ctrlPlasma->verGrabadorDVDEnPlasma();
        if ($respuesta!=1) {
            AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_DVD_GRABADOR,MatrizVideo::$OUTPUT_PL_ASMA);
            AccesoGui::$guiPlasma->verDVDGrabEnPlasma();
            AccesoGui::$guiDispositivos-> seleccionarDVDGrab();
        }
    } // end of member function verGrabadorDVDEnPlasma

    //    /**
    //     *
    //     *
    //     * @return
    //     * @access public
    //     */
    //    public function verCamara1EnPlasma( ) {
    //        AccesoControladoresDispositivos::$ctrlPlasma->verCamara1EnPlasma();
    //         AccesoGui::$guiPlasma->verCamaraEnPlasma(1);
    //    } // end of member function verCamara1EnPlasma
    //
    //    /**
    //     *
    //     *
    //     * @return
    //     * @access public
    //     */
    //    public function verCamara2EnPlasma( ) {
    //        AccesoControladoresDispositivos::$ctrlPlasma->verCamara2EnPlasma();
    // AccesoGui::$guiPlasma->verCamaraEnPlasma(2);
    //    } // end of member function verCamara2EnPlasma
    //
    //    /**
    //     *
    //     *
    //     * @return
    //     * @access public
    //     */
    //    public function verCamara3EnPlasma( ) {
    //        AccesoControladoresDispositivos::$ctrlPlasma->verCamara3EnPlasma();
    // AccesoGui::$guiPlasma->verPCamaraEnPlasma(3);
    //    } // end of member function verCamara3EnPlasma

    /**
     * Metodo para mostrar en el plasma el redThinkClient seleccionado, para ello
     * activara la entrada VGA del plasma y enrutara el redThinkClient al plasma.
     *
     * @access public
     */
    public function verRedThinkClientEnPlasma( ) {

        $respuesta=AccesoControladoresDispositivos::$ctrlPlasma->verRedThinkClientEnPlasma();
        if ($respuesta!=1) {
            AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(5,4);
            try {
                usleep(100000);
            }catch (Exception $e ) {

            }
            AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(5,1);
            AccesoGui::$guiPlasma->verRedThinkClientEnPlasma();
            AccesoGui::$guiDispositivos->seleccionarRedThinkClient( );
        }
    } // end of member function verRedThinkClientEnPlasma

    /**
     * Metodo para mostrar en el plasma la videoconferencia para ello activara
     * la entrada AV2 del plasma y enrutara el video de la videoconferencia al
     * plasma.
     *
     * @access public
     */
    public function verVideoconferenciaEnPlasma( ) {

        $respuesta=AccesoControladoresDispositivos::$ctrlPlasma->verVideoconferenciaEnPlasma();
        if ($respuesta!=1) {
            AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_VIDEOCONFERENCIA,MatrizVideo::$OUTPUT_PL_ASMA);
        }
    } // end of member function verVideoconferenciaEnPlasma

    /**
     * Metodo para mostrar en el plasma el video de la sala, para ello activara
     * la entrada AV2 del plasma y enrutara el video (7,8) y enrutara el escalador
     * al plasma
     *
     * @access public
     */
    public function verVideoSalaEnPlasma( ) {
        $respuesta=AccesoControladoresDispositivos::$ctrlPlasma->verVideoSalaEnPlasma();
        if ($respuesta!=1) {
            AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(7,8);
            AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_ESCALADOR,MatrizVideo::$OUTPUT_PL_ASMA);
        }
    } // end of member function verVideoSalaEnPlasma

    /**
     * Metodo para examinar la accion del comando recivido por la pelicula flash
     * para seleccionar la funcion adecuada del plasma
     *
     * @param ComandoFlash $cmd
     */
    public function getComandoFlash($cmd) {
        if (strcmp($cmd->getAccion(),"ENCENDER")==0) {
            $this->encender();
        }
        else if (strcmp($cmd->getAccion(),"APAGAR")==0) {
                $this->apagar();
            }
            else if (strcmp($cmd->getAccion(),"PCSUELO")==0) {
                    $this->verPCSalaEnPlasma();
                }
                else if (strcmp($cmd->getAccion(),"PORTATIL1")==0) {
                        $this->verPortatil1EnPlasma();
                    }
                    else if (strcmp($cmd->getAccion(),"PORTATIL2")==0) {
                            $this->verPortatil2EnPlasma();
                        }
                        else if (strcmp($cmd->getAccion(),"PORTATIL3")==0) {
                                $this->verPortatil3EnPlasma();
                            }
                            else if (strcmp($cmd->getAccion(),"PORTATIL4")==0) {
                                    $this->verPortatil4EnPlasma();
                                }
                                else if (strcmp($cmd->getAccion(),"ATRIL")==0) {
                                        $this->verAtrilEnPlasma();
                                    }
                                    else if (strcmp($cmd->getAccion(),"THINK_CLIENT")==0) {
                                            $this->verRedThinkClientEnPlasma();
                                        }
                                        else if (strcmp($cmd->getAccion(),"CAMARA_DE_DOCUMENTOS")==0) {
                                                $this->verVisorDocumentosEnPlasma();
                                            }
                                            else if (strcmp($cmd->getAccion(),"DVD")==0) {
                                                    $this->verDVDEnPlasma();
                                                }
                                                else if (strcmp($cmd->getAccion(),"DVDGRAB")==0) {
                                                        $this->verGrabadorDVDEnPlasma();
                                                    }
                                                    else if (strcmp($cmd->getAccion(),"CAMARA_1")==0) {
                                                            $this->verCamara1EnPlasma();
                                                        }
                                                        else if (strcmp($cmd->getAccion(),"CAMARA_2")==0) {
                                                                $this->verCamara2EnPlasma();
                                                            }
                                                            else if (strcmp($cmd->getAccion(),"CAMARA_3")==0) {
                                                                    $this->verCamara3EnPlasma();
                                                                }

    }



} // end of ControladorPlasmas
?>
