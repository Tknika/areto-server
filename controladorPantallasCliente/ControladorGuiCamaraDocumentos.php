<?php
/**
 * @package PHP::controladoresGuiDispositivos
 */
/**
 * Clases necesarias para el control
 */
require_once './AccesoControladoresDispositivos.php';
require_once './AccesoGui.php';
/**
 * Description of ControlGuiCamaradocumentos
 *
 * Clase que se encargara de enviar los comandos necesarios a la camara de
 * documentos  y a su pantalla
 *
 * @author amaia
 *
 * @package PHP::controladoresGuiDispositivos
 */
class ControladorGuiCamaraDocumentos {

/**
 * Metodo para desenfocar la camara de documentos y marcar el botton focus -
 *
 *
 * @access public
 */
    public function camaraDocumentosSubirFoco( ) {
        $error=AccesoControladoresDispositivos::$ctrlVisorDocumentos->subirFocoCamaraDocumentos( );
        if($error!=1)
            AccesoGui::$guicamaraDocumentos->camaraDocumentosSubirFoco();
    } // end of member function camaraDocumentosSubirFoco

    /**
     * Metodo para enfocar la camara de documentos y marcar el botton focus +
     *
     *
     * @access public
     */
    public function camaraDocumentosBajarFoco( ) {
        $error=AccesoControladoresDispositivos::$ctrlVisorDocumentos->bajarFocoCamaraDocumentos( );
        if($error!=1)
            AccesoGui::$guicamaraDocumentos->camaraDocumentosBajarFoco();
    } // end of member function camaraDocumentosBajarFoco

    /**
     * Metodo para acercar el zoom de la camara de documentos y marcar el botton
     * Zoom +
     *
     * @access public
     */
    public function camaraDocumentosAcercarZoom( ) {
        $error=AccesoControladoresDispositivos::$ctrlVisorDocumentos->acercarCamaraDocumentos( );
        if($error!=1)
            AccesoGui::$guicamaraDocumentos->camaraDocumentosAcercarZoom();
    } // end of member function camaraDocumentosAcercarZoom

    /**
     * Metodo para alejar el zoom de la camara de documentos y marcar el botton
     * Zoom -
     *
     * @access public
     */
    public function camaraDocumentosAlejarZoom( ) {
        $error=AccesoControladoresDispositivos::$ctrlVisorDocumentos->alejarCamaraDocumentos( );
        if($error!=1)
            AccesoGui::$guicamaraDocumentos->camaraDocumentosAlejarZoom();
    } // end of member function camaraDocumentosAlejarZoom

    /**
     * Metodo para preparar camara de documentos para enfocar una pagina a3
     *  y marcar el botton  A3
     *
     * @access public
     */
    public function camaraDocumentosA3() {
        $error=AccesoControladoresDispositivos::$ctrlVisorDocumentos->dina3CamaraDocumentos( );
        if($error!=1)
            AccesoGui::$guicamaraDocumentos->camaraDocumentosA3();
    } // end of member function camaraDocumentosA3

    /**
     * Metodo para preparar camara de documentos para enfocar una pagina a4
     *  y marcar el botton  A4
     *
     * @access public
     */
    public function camaraDocumentosA4( ) {
        $error=AccesoControladoresDispositivos::$ctrlVisorDocumentos->dina4CamaraDocumentos( );
        if($error!=1)
            AccesoGui::$guicamaraDocumentos->camaraDocumentosA4();
    } // end of member function camaraDocumentosA4

    //    /**
    //     * Metodo para encender la lampara de la camara de documentos
    //     *
    //     * @access public
    //     */
    //    public function camaraDocumentosEncenderLampara( ) {
    //        AccesoControladoresDispositivos::$ctrlVisorDocumentos->encenderLamparaCamaraDocumentos( );
    //        AccesoGui::$guicamaraDocumentos->camaraDocumentosEncenderLampara();
    //    } // end of member function camaraDocumentosEncenderLampara
    //
    //    /**
    //     * Metodo para apagar la lampara de la camara de documentos
    //     *
    //     * @access public
    //     */
    //    public function camaraDocumentosApagarLampara( ) {
    //        AccesoControladoresDispositivos::$ctrlVisorDocumentos->apagarLamparaCamaraDocumentos( );
    //        AccesoGui::$guicamaraDocumentos->ccamaraDocumentosapagarLampara();
    //    } // end of member function camaraDocumentosApagarLampara

    /**
     * Metodo para encender la camara de documentos
     *
     * @access public
     */
    public function camaraDocumentosEncender( ) {
        $error=AccesoControladoresDispositivos::$ctrlVisorDocumentos->encender( );
        if($error!=1)
            AccesoGui::$guicamaraDocumentos->camaraDocumentosEncender();
    } // end of member function camaraDocumentosEncender

    /**
     * Metodo para apagar la camara de documentos
     *
     * @access public
     */
    public function camaraDocumentosApagar( ) {
        $error=AccesoControladoresDispositivos::$ctrlVisorDocumentos->apagarCamaraDocumentos( );
        if($error!=1)
            AccesoGui::$guicamaraDocumentos->camaraDocumentosApagar();
    } // end of member function camaraDocumentosApagar

    /**
     * Metodo para examinar la accion del comando recivido por la pelicula flash para
     * seleccionar la funcion de la camara de documentos
     *
     * @param ComandoFlash $cmd
     */
    public function getComandoFlash($cmd) {
        if (strcmp($cmd->getAccion(),"SUBIR_FOCO")==0) {
            $this->camaraDocumentosSubirFoco();
        }
        else if (strcmp($cmd->getAccion(),"BAJAR_FOCO")==0) {
                $this->camaraDocumentosBajarFoco();
            }
            else if (strcmp($cmd->getAccion(),"ACERCAR")==0) {
                    $this->camaraDocumentosAcercarZoom();
                }
                else if (strcmp($cmd->getAccion(),"ALEJAR")==0) {
                        $this->camaraDocumentosAlejarZoom();
                    }
                    else if (strcmp($cmd->getAccion(),"DINA_A3")==0) {
                            $this->camaraDocumentosA3();
                        }
                        else if (strcmp($cmd->getAccion(),"DINA_A4")==0) {
                                $this->camaraDocumentosA4();
                            }
                            else if (strcmp($cmd->getAccion(),"ENCEDER_LAMPARA")==0) {
                                    $this->camaraDocumentosEncenderLampara();
                                }
                                else if (strcmp($cmd->getAccion(),"APAGAR")==0) {
                                        $this->camaraDocumentosApagar();
                                    }
                                    else if (strcmp($cmd->getAccion(),"ENCENDER")==0) {
                                            $this->camaraDocumentosEncender();

                                        }
    }
}
?>
