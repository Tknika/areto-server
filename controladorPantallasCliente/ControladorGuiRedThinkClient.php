<?php

/**
 * class ControladorRedThinkClient
 *
 */
class ControladorGuiRedThinkClient {

/** Aggregations: */

/** Compositions: */

   /*** Attributes: ***/

/**
 *
 * @access private
 */
    private $comando;


    /**
     * PCSUELO,PORTATIL1,PORTATIL2,PORTATIL3,PORTATIL4,ATRIL,THINK_CLIENT,CAMARA_DE_DOCUMENTOS,DVD,DVDGRAB,CAMARA_1,CAMARA_2,CAMARA_3
     *
     * @param string comando

     * @return
     * @access public
     */
    public function procesarComando( $comando ) {
    } // end of member function procesarComando
    public function getComandoFlash($cmd) {
        if (strcmp($cmd->getAccion(),"PCSUELO")==0) {
            $this->verPCSuelo();
        }
        else if (strcmp($cmd->getAccion(),"PORTATIL1")==0) {
                $this->verPortatil1();
            }
            else if (strcmp($cmd->getAccion(),"PORTATIL2")==0) {
                    $this->verPortatil2();
                }
                else if (strcmp($cmd->getAccion(),"PORTATIL3")==0) {
                        $this->verPortatil3();
                    }
                    else if (strcmp($cmd->getAccion(),"PORTATIL4")==0) {
                            $this->verPortatil4();
                        }
                        else if (strcmp($cmd->getAccion(),"ATRIL")==0) {
                                $this->verAtril();
                            }
                            else if (strcmp($cmd->getAccion(),"THINK_CLIENT")==0) {
                                    $this->verRedthinkClient();
                                }
                                else if (strcmp($cmd->getAccion(),"CAMARA_DE_DOCUMENTOS")==0) {
                                        $this->verVisorDocumentos();
                                    }
                                    else if (strcmp($cmd->getAccion(),"DVD")==0) {
                                            $this->verDVD();
                                        }
                                        else if (strcmp($cmd->getAccion(),"DVDGRAB")==0) {
                                                $this->verGrabadorDVD();
                                            }
                                            else if (strcmp($cmd->getAccion(),"CAMARA_1")==0) {
                                                    $this->verCamara1();
                                                }
                                                else if (strcmp($cmd->getAccion(),"CAMARA_2")==0) {
                                                        $this->verCamara2();
                                                    }
                                                    else if (strcmp($cmd->getAccion(),"CAMARA_3")==0) {
                                                            $this->verCamara3();
                                                        }
        //if(strcmp($tipoComando, "COMANDO")==0)
//        $comandoFlash=$this->crearComandoFlash();
//        //else if(strcmp($tipoComando, "CAMARADOC")==0)
//        $comandoFlash=$this->crearComandoCamaraDocFlash();
//        return $comandoFlash;

    }
    /**
     *
     *
     * @return
     * @access public
     */
    public function pantallaRedThinkClient( ) {
AccesoGui::$guiDispositivos->seleccionarRedThinkClient();
    } // end of member function pantallaRedThinkClient

    /**
     *
     *
     * @return
     * @access public
     */
    public function verCamara1( ) {
        AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_CAMARA_1,MatrizVideo::$OUTPUT_PL_ASMA);
        AccesoGui::$guiRedThinkClient-> verCamara1EnRedThinkClient();
 } // end of member function verCamara1

    /**
     *
     *
     * @return
     * @access public
     */
    public function verCamara2( ) {
        AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_CAMARA_2,MatrizVideo::$OUTPUT_PL_ASMA);
 AccesoGui::$guiRedThinkClient-> verCamara2EnRedThinkClient();
    } // end of member function verCamara2

    /**
     *
     *
     * @return
     * @access public
     */
    public function verCamara3( ) {
        AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_CAMARA_3,MatrizVideo::$OUTPUT_PL_ASMA);
 AccesoGui::$guiRedThinkClient-> verCamara3EnRedThinkClient();
    } // end of member function verCamara3

    /**
     *
     *
     * @return
     * @access public
     */
    public function verGrabadorDVD( ) {
        AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_DVD_GRABADOR,MatrizVideo::$OUTPUT_PL_ASMA);
 AccesoGui::$guiRedThinkClient-> verDVDGrabEnRedThinkClient();
 AccesoGui::$guiDispositivos->seleccionarDVDGrab();
   } // end of member function verGrabadorDVD

    /**
     *
     *
     * @return
     * @access public
     */
    public function verDVD( ) {
        AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_DVD_REPRODUCTOR,MatrizVideo::$OUTPUT_PL_ASMA);
 AccesoGui::$guiRedThinkClient-> verDVDEnRedThinkClient();
  AccesoGui::$guiDispositivos->seleccionarDVD();
    } // end of member function verDVD

    /**
     *
     *
     * @return
     * @access public
     */
    public function verPCSuelo( ) {
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(1,5);

        try {
            usleep(100000);
        }catch (Exception $e ) {

        }
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(1,1);
         AccesoGui::$guiRedThinkClient-> verPCSueloEnRedThinkClient();
 AccesoGui::$guiDispositivos->seleccionarPCSuelo();
  } // end of member function verPCSala

    /**
     *
     *
     * @return
     * @access public
     */
    public function verPortatil1( ) {
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(2,5);
        try {
            usleep(100000);
        }catch (Exception $e ) {

        }
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(2,1);
         AccesoGui::$guiRedThinkClient-> verPortatil1EnRedThinkClient();
    } // end of member function verPortatil1

    /**
     *
     *
     * @return
     * @access public
     */
    public function verPortatil2( ) {
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(3,5);
        try {
            usleep(100000);
        }catch (Exception $e ) {

        }
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(3,1);
         AccesoGui::$guiRedThinkClient-> verPortatil2EnRedThinkClient();
    } // end of member function verPortatil2

    /**
     *
     *
     * @return
     * @access public
     */
    public function verPortatil3( ) {
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(4,5);
        try {
            usleep(100000);
        }catch (Exception $e ) {

        }
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(4,1);
         AccesoGui::$guiRedThinkClient-> verPortatil3EnRedThinkClient();
    } // end of member function verPortatil3

    /**
     *
     *
     * @return
     * @access public
     */
    public function verPortatil4( ) {
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(9,5);
        try {
            usleep(100000);
        }catch (Exception $e ) {

        }
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(9,1);
         AccesoGui::$guiRedThinkClient-> verPortatil4EnRedThinkClient();
    } // end of member function verPortatil4

    /**
     *
     *
     * @return
     * @access public
     */
    public function verAtril( ) {
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(9,5);
        try {
            usleep(100000);
        }catch (Exception $e ) {

        }
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(9,1);
        AccesoGui::$guiRedThinkClient-> verAtrilEnRedThinkClient();

    } // end of member function verAtril

    /**
     *
     *
     * @return
     * @access public
     */
    public function verRedThinkClient( ) {
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(5,5);
        try {
            usleep(100000);
        }catch (Exception $e ) {

        }
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(5,1);
         AccesoGui::$guiRedThinkClient-> verRedThinkClientEnRedThinkClient();
 AccesoGui::$guiDispositivos->seleccionarRedThinkClient();
 } // end of member function verRedThinkClient

    /**
     *
     *
     * @return
     * @access public
     */
    public function verVisorDocumentos( ) {
        AccesoControladoresDispositivos::$ctrlVisorDocumentos->encender();
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(8,5);
         AccesoGui::$guiRedThinkClient-> verVisorDocumentosEnRedThinkClient();
          AccesoGui::$guiDispositivos->seleccionarCamaraDocumentos();
 } // end of member function verVisorDocumentos





} // end of ControladorRedThinkClient
?>
