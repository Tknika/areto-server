<?php

/**
 * @package PHP::controladoresGuiDispositivos
 */

/**
 * Description of ControlGuiEscenarios
 *
 * Clase que se encargara de enviar los comandos necesarios a los dispositivos
 * que se utilizen en cada escenario y a sus respectivas pantallas
 *
 * @author amaia
 *
 * @package PHP::controladoresGuiDispositivos
 */
class ControladorGuiSonido {

    /**
     * Metodo para examinar la accion del comando recivido por la pelicula flash
     * para seleccionar la accion del microfono adecuado
     *
     * @param ComandoFlash $cmd
     */
    public function getComandoMicroFlash($cmd) {
        if (strcmp($cmd->getAccion(),"ACTIVAR")==0) {
            $this->activarMicroPresidencia($cmd->getAtributo());
        } else if (strcmp($cmd->getAccion(),"DESACTIVAR")==0) {
            $this->desactivarMicroPresidencia($cmd->getAtributo());
        } else if (strcmp($cmd->getAccion(),"SUBIR_VOLUMEN")==0) {
            echo "atributo: ".$cmd->getAtributo();
            $this->subirMicPresidencia($cmd->getAtributo());
        } else if (strcmp($cmd->getAccion(),"BAJAR_VOLUMEN")==0) {
            $this->bajarMicPresidencia($cmd->getAtributo());
        }
    }

/**
     * Metodo para examinar la accion del comando recivido por la pelicula flash
     * para seleccionar la accion del sonido adecuada
     *
     * @param ComandoFlash $cmd
     */
    public function getComandoSonidoFlash($cmd) {
        
        if (strcmp($cmd->getAccion(),"SUBIR_VOLUMEN")==0) {
            $this->subirSonidoGeneral();
        } else if (strcmp($cmd->getAccion(),"BAJAR_VOLUMEN")==0) {
            $this->bajarSonidoGeneral();
        } else if (strcmp($cmd->getAccion(),"ACTIVAR")==0) {
            if (strcmp($cmd->getAtributo(),"ENTRANTE")==0) {
                $this->activarSonidoEntrante();
            } else if (strcmp($cmd->getAtributo(),"SALIENTE")==0) {
                $this->activarSonidoSaliente();
            } else if (strcmp($cmd->getAtributo(),"GENERAL")==0) {
                $this->activarSonidoGeneral();
            }
        } else if (strcmp($cmd->getAccion(),"SILENCIAR")==0) {
            if (strcmp($cmd->getAtributo(),"ENTRANTE")==0) {
                $this->desactivarSonidoEntrante();
            } else if (strcmp($cmd->getAtributo(),"SALIENTE")==0) {
                $this->desactivarSonidoSaliente();
            } else if (strcmp($cmd->getAtributo(),"GENERAL")==0) {
                $this->desactivarSonidoGeneral();
            }
        }
    
    }
    
    /////////////////////////////////////////////////
    //////////////FUNCIONES MICROFONOS///////////////
    /////////////////////////////////////////////////
    
    /**
     * Metodo para activar el micro, $mic de la presidencia, marca el boton de 
     * encendido y actualizar el valor de la barra del volumen
     * 
     * @param int $mic 
     */
    public function activarMicroPresidencia($mic) {
    
        echo "\n micro presidencia: ".$mic."\n";
        AccesoControladoresDispositivos::$ctrlMesaMezclas->activarMicPresidencia($mic);
        AccesoControladoresDispositivos::$ctrlAutomata->encenderLedMicrofono($mic);
        AccesoGui::$guiSonido->activarMicroPresidencia($mic);

    }

    /**
     * Metodo para desactivar el micro, $mic de la presidencia, marca el boton de 
     * encendido y actualizar el valor de la barra del volumen
     * 
     * @param int $mic 
     */
    public function desactivarMicroPresidencia($mic) {
    
        AccesoControladoresDispositivos::$ctrlMesaMezclas->desactivarMicPresidencia($mic);
        AccesoControladoresDispositivos::$ctrlAutomata->apagarLedMicrofono($mic);
        AccesoGui::$guiSonido->desactivarMicroPresidencia($mic);
    
}

    /**
     * Metodo para subir el volumen del micro, $mic de la presidencia, marca el boton de 
     * encendido y actualizar el valor de la barra del volumen
     * 
     * @param int $mic 
     */
    public function subirMicPresidencia($mic) {
  
        AccesoControladoresDispositivos::$ctrlMesaMezclas->subirMicPresidencia($mic);
        //    $vol = this.control.mesa.getVolumenFader(micro);
        $vol=AccesoControladoresDispositivos::$ctrlMesaMezclas->getVolumenMicro($mic);
        $vol = (($vol - MesaMezclas::$VOLMIN)*100) / (MesaMezclas::$VOLMAX -  MesaMezclas::$VOLMIN);
        AccesoGui::$guiSonido->setVolumenMicro($mic,$vol);

    }

    /**
     * Metodo para bajar el volumen del micro, $mic de la presidencia, marca el boton de 
     * encendido y actualizar el valor de la barra del volumen
     * 
     * @param int $mic 
     */
    public function bajarMicPresidencia($mic) {
  
        AccesoControladoresDispositivos::$ctrlMesaMezclas->bajarMicPresidencia($mic);
        $vol=AccesoControladoresDispositivos::$ctrlMesaMezclas->getVolumenMicro($mic);
        $vol = (($vol - MesaMezclas::$VOLMIN)*100) / (MesaMezclas::$VOLMAX -  MesaMezclas::$VOLMIN);
        AccesoGui::$guiSonido->setVolumenMicro($mic,$vol);

    }
    //////////////////////////////////////////////////////
    //////////////FUNCIONES SONIDO ENTRANTE///////////////
    //////////////////////////////////////////////////////
    
    /**
     * Metodo para subir el volumen del sonido entrante, el lque nos llega de la 
     * videoconferencia, y marca el boton
     * 
     * @access public 
     */
    public function subirSonidoEntrante() {

        AccesoControladoresDispositivos::$ctrlMesaMezclas->subirSonidoContraparte();
        AccesoGui::$guiSonido->subirSonidoContraparte();
        $vol=AccesoControladoresDispositivos::$ctrlMesaMezclas->getVolumenVideoconferencia();
        $vol = (($vol - MesaMezclas::$VOLMIN)*100) / (MesaMezclas::$VOLMAX -  MesaMezclas::$VOLMIN);
        AccesoGui::$guiSonido->setSonidoEntrante($vol);
    }

/**
     * Metodo para bajar el volumen del sonido entrante, el lque nos llega de la 
     * videoconferencia, y marca el boton
     * /**

     * @access public 
     */
    public function bajarSonidoEntrante() {
  
        AccesoControladoresDispositivos::$ctrlMesaMezclas->bajarSonidoContraparte();
        AccesoGui::$guiSonido->bajarSonidoContraparte();
        $vol=AccesoControladoresDispositivos::$ctrlMesaMezclas->getVolumenVideoconferencia();
        $vol = (($vol - MesaMezclas::$VOLMIN)*100) / (MesaMezclas::$VOLMAX -  MesaMezclas::$VOLMIN);
        AccesoGui::$guiSonido->setSonidoEntrante($vol);

    }
  
  /**
     * Metodo para activar el sonido entrante, el que nos llega de la 
     * videoconferencia, y marcar el boton de encendido
     * 
     * @access public 
     */
    public function activarSonidoEntrante() {
      
        AccesoControladoresDispositivos::$ctrlMesaMezclas->activarSonidoContraparte();
        AccesoGui::$guiSonido->activarSonidoContraparte();
        $vol=AccesoControladoresDispositivos::$ctrlMesaMezclas->getVolumenVideoconferencia();
        $vol = (($vol - MesaMezclas::$VOLMIN)*100) / (MesaMezclas::$VOLMAX -  MesaMezclas::$VOLMIN);
        AccesoGui::$guiSonido->setVolumenEntrante($vol);

    }
  
  /**
     * Metodo para desactivar el sonido entrante, el que nos llega de la 
     * videoconferencia, y marcar el boton
     * 
     * @access public 
     */
    public function desactivarSonidoEntrante() {      
        
        AccesoControladoresDispositivos::$ctrlMesaMezclas->desactivarSonidoContraparte();
        AccesoGui::$guiSonido->desactivarSonidoContraparte();

    }

    public function activarSonidoSaliente() {
    /**
     * Metodo para activar el fader de nuestro sonido para la videoconferencia
     */
        AccesoControladoresDispositivos::$ctrlMesaMezclas->activarNuestroSonido();
        AccesoGui::$guiSonido->activarSonidoSaliente();


    }

    public function desactivarSonidoSaliente() {
      /**
         * Metodo para desactivar el fader de nuestro sonido para la videoconferencia
         */
        AccesoControladoresDispositivos::$ctrlMesaMezclas->desactivarNuestroSonido();
        AccesoGui::$guiSonido->desactivarSonidoSaliente();

    }
  
  

    public function activarSonidoGeneral() {
    /**
     * Metodo para activar el Sonido General
     */
        AccesoControladoresDispositivos::$ctrlMesaMezclas->activarSonidoGeneral();
        AccesoGui::$guiSonido->activarSonidoGeneral();
    }

    public function desactivarSonidoGeneral() {
    /**
     * Metodo para desactivar el Sonido General
     */
        AccesoControladoresDispositivos::$ctrlMesaMezclas->desactivarSonidoGeneral();
        AccesoGui::$guiSonido->desactivarSonidoGeneral();

    }

    public function subirSonidoGeneral() {
    /**
     * Metodo para subir el volumen  del Sonido General
     */
        AccesoControladoresDispositivos::$ctrlMesaMezclas->subirSonidoGeneral();
        $vol=AccesoControladoresDispositivos::$ctrlMesaMezclas->getVolumenGeneral();
        $vol = (($vol - MesaMezclas::$VOLMIN)*100) / (MesaMezclas::$VOLMAX -  MesaMezclas::$VOLMIN);
        AccesoGui::$guiSonido->setVolumenGeneral($vol);


    }

    public function bajarSonidoGeneral() {
    /**
     * Metodo para bajar el volumen  del Sonido General
     */
        AccesoControladoresDispositivos::$ctrlMesaMezclas->bajarSonidoGeneral();
        $vol=AccesoControladoresDispositivos::$ctrlMesaMezclas->getVolumenGeneral();
        $vol = (($vol - MesaMezclas::$VOLMIN)*100) / (MesaMezclas::$VOLMAX -  MesaMezclas::$VOLMIN);
        AccesoGui::$guiSonido->setVolumenGeneral($vol);
    }
  
}
?>
