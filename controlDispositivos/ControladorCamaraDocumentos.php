<?php
/**
 * @package PHP::controladoresDispositivos
 */
/**
 * includes
 */
require_once './dispositivos/VisorOpacos.php';

/**
 * class ControladorCamaraDocumentos
 *
 * Clase que se encargara de enviar las ordenes adecuadas a la clase
 * VisorOpacos.
 *
 * @package PHP::controladoresDispositivos
 */
class ControladorCamaraDocumentos {



    /**
     *Atributo que guardara la instancia de la clase VisorOpacos
     *
     * @var VisorOpacos
     * @access private
     * @static
     */
    private static $visorDocumentos;

    public function  __construct() {
        self::$visorDocumentos=new VisorOpacos("VisorOpacos");
    }



    /**
     * Metodo para desenfocar la camara de documentos
     *
     * @access public
     */
    public function subirFocoCamaraDocumentos( ) {
        $respuesta=self::$visorDocumentos->desenfocar();
        return $this->devolverRespuesta($respuesta,"desenfocar");
    } // end of member function subirFocoCamaraDocumentos

    /**
     * Metodo para enfocar la camara de documentos
     *
     *
     * @return
     * @access public
     */
    public function bajarFocoCamaraDocumentos( ) {
        $respuesta=self::$visorDocumentos->enfocar();
        return $this->devolverRespuesta($respuesta,"enfocar");
    } // end of member function bajarFocoCamaraDocumentos

    /**
     * Metodo para acercar la camara de documentos
     *
     * @access public
     */
    public function acercarCamaraDocumentos( ) {

        $respuesta=self::$visorDocumentos->acercarZoom();
        return $this->devolverRespuesta($respuesta,"acercar el zoom de");
    } // end of member function acercarCamaraDocumentos

    /**
     * Metodo para alejar la camara de documentos
     *
     * @access public
     */
    public function alejarCamaraDocumentos( ) {

        $respuesta=self::$visorDocumentos->alejarZoom();
        return $this->devolverRespuesta($respuesta,"alejar el zoom de");
    } // end of member function alejarCamaraDocumentos

    /**
     * Metodo para seleccionar el area de una A3
     *
     * @access public
     */
    public function dina3CamaraDocumentos( ) {

        $respuesta=self::$visorDocumentos->preset(1);
        return $this->devolverRespuesta($respuesta,"poner en posicion de capturar una dinA3 con");
    } // end of member function dina3CamaraDocumentos

    /**
     * Metodo para seleccionar el area de una A4
     *
     * @access public
     */
    public function dina4CamaraDocumentos( ) {

        $respuesta=self::$visorDocumentos->preset(2);
        return $this->devolverRespuesta($respuesta,"poner en posicion de capturar una dinA4 con");
    } // end of member function dina4CamaraDocumentos

    /**
     * Metodo para encender la lampara de la camara de documentos
     *
     * @access public
     */
    public function encenderLamparaCamaraDocumentos( ) {

        $respuesta=self::$visorDocumentos->encenderLampara();
        return $this->devolverRespuesta($respuesta,"encender la lampara de");
    } // end of member function encenderLamparaCamaraDocumentos

    /**
     * Metodo para apagar la lampara de la camara de documentos
     *
     * @access public
     */
    public function apagarLamparaCamaraDocumentos( ) {

        $respuesta=self::$visorDocumentos->apagarLampara();
        return $this->devolverRespuesta($respuesta,"apagar la lampara de");

    } // end of member function apagarLamparaCamaraDocumentos

    /**
     * Metodo para apagar la camara de documentos
     *
     * @access public
     */
    public function apagarCamaraDocumentos( ) {
        $respuesta=self::$visorDocumentos->getEstadoOnOff();
           if(!empty ($respuesta)) {
        if(strcmp($respuesta,"Error")!=0) {
            usleep(500000);
            echo "\nestado: ".$respuesta."\n";
            if(strpos($respuesta,"1")!==false)
                self::$visorDocumentos->apagar();
            return 0;
        }
        else {
            return 1;
            echo "Error al interntar apagar la camara de documentos\n";
        }
           }else{
               return 1;

           }

    } // end of member function apagarCamaraDocumentos

    /**
     * Metodo para encender la camara de documentos
     *
     * @access public
     */
    public function encender( ) {
        $respuesta=self::$visorDocumentos->getEstadoOnOff();
        if(!empty ($respuesta)) {
            if(strcmp($respuesta,"Error")!=0) {
                usleep(500000);
                echo "\nestado:".$respuesta."\n";
                if(strpos($respuesta,"0")!==false) {
                    self::$visorDocumentos->encender();
                }
                return 0;
            }
            else {
                return 1;
                echo "Error al interntar encender la camara de documentos\n";
            }
        }

        else return 1;
    } // end of member function encenderCamaraDocumentos

    private function devolverRespuesta($res,$mensaje) {
        if(!empty ($res)) {
            if(strcmp($res,"Error")!=0)
                return 0;
            else {
                return 1;
                echo "Error al interntar ".$mensaje." la camara de documentos\n";
            }
        }else return 1;
    }

    /**
     * Metodo para procesar la accion del comando enviado por el cliente
     *
     * @access public
     * @param string $cmd
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

} // end of ControladorCamaraDocumentos
?>
