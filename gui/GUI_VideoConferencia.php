<?php

/**
 * class GUI_VideoConferencia
 *
 */
class GUI_VideoConferencia {

/** Aggregations: */

/** Compositions: */

   /*** Attributes: ***/
    private $comando = "";
    private $atributo = "";
    private $volumen = 84;
    private $numero_ip = "";
    private $noInterrumpir = "APAGAR";
    private $nuestroSonido = "OFF";

    public function  __construct() {

    }
    /**
     *
     *
     * @param string comando

     * @return
     * @access public
     */
  /*public function setComando( $comando ) {
      $this->comando=$comando;
      $this->atributo="";
      //activar y enviar comando
  } // end of member function setComando

  /**
   * 
   *
   * @return string
   * @access public
   */
    public function getComando( ) {
        return $this->comando;
    } // end of member function getComando

    /**
     *
     *
     * @param string comando

     * @param string atributo

     * @return
     * @access public
     */
    public function setComando( $comando,  $atributo=null ) {
        $this->comando=$comando;
        $this->atributo=$atributo;
        $this->enviarComando();
        $this->activarPantalla();
    //activa y enviar comando
    } // end of member function setComando

    /**
     *
     *
     * @return string
     * @access public
     */
    public function getNoInterrumpir( ) {
        return $this->noInterrumpir;
    } // end of member function getNoInterrumpir

    /**
     *
     *
     * @param string comando

     * @return
     * @access public
     */
    public function setNoInterrumpir( $comando ) {
        $this->noInterrumpir=$comando;
        $this->enviarNoInterrumpir();
        $this->activarPantalla();
    //activar y enviar comando
    } // end of member function setNoInterrumpir

    /**
     *
     *
     * @return string
     * @access public
     */
    public function getNuestroSonido( ) {
        return $this->nuestroSonido;

    } // end of member function getNuestroSonido

    /**
     *
     *
     * @param string comando

     * @return
     * @access public
     */
    public function setNuestroSonido( $comando ) {
        
        $this->nuestroSonido=$comando;
        $this->enviarNuestroSonido();
        $this->activarPantalla();
    //activar y enviar comando
    } // end of member function setNuestroSonido
public function getVolumen(){
    return $this->volumen;

}
    /**
     *
     *
     * @return string
     * @access public
     */
    public function getAtributo( ) {
        return $this->atributo;
    } // end of member function getAtributo

    /**
     *
     *
     * @param int volumen

     * @return
     * @access public
     */
    public function setVolumen( $volumen ) {
        echo "VOLULMEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEENNNNNNNNNNNNNNN".$volumen;
        $this->volumen=$volumen;
        $this->enviarVolumen();
        $this->activarPantalla();
    //activar y enviar volumen
    } // end of member function setVolumen

    /**
     *
     *
     * @param string numero

     * @return
     * @access public
     */
    public function setNumeroIP( $numero ) {
        $this->numero_ip=$numero;
        $this->enviarNumero();
        $this->activarPantalla();
    //activar y enviar numero
    } // end of member function setNumeroIP

    /**
     *
     *
     * @return string
     * @access public
     */
    public function getNumeroIP( ) {
        return $this->numero_ip;
    } // end of member function getNumeroIP

    /**
     *
     *
     * @param string numero

     * @return
     * @access public
     */
    public function addNumeroIP( $numero ) {
        $this->setNumeroIP($this->numero_ip.$numero);
    } // end of member function addNumeroIP

    /**
     *
     *
     * @return
     * @access public
     */
    public function delNumeroIP( ) {
        $longitud=strlen($this->numero_ip);
        $this->setNumeroIP(substr($this->numero_ip, 0,$longitud-1));
    } // end of member function delNumeroIP

    /**
     *
     *
     * @return
     * @access public
     */
    public function delAllNumeroIP( ) {
        $this->setNumeroIP("");
    } // end of member function delAllNumeroIP

    /**
     *
     *
     * @return
     * @access public
     */
    public function subirVolumen( ) {
        $vol = $this->getVolumen();
        if ($vol < 100) {
            $vol = $vol + 8;
        }
        else {
            $vol = 8;
        }
        $this->setVolumen($vol);
    } // end of member function subirVolumen

    /**
     *
     *
     * @return
     * @access public
     */
    public function bajarVolumen( ) {
        $vol = $this->getVolumen();
        if ($vol > 0) {
            $vol = $vol - 8;
        }
        else {
            $vol = 0;
        }
        $this->setVolumen($vol);
    } // end of member function bajarVolumen

    /**
     *
     *
     * @param string anchoBanda

     * @return
     * @access public
     */
    public function videoconferenciaAnchoBanda( $anchoBanda ) {
        $this->setComando("ANCHO_DE_BANDA");
    } // end of member function videoconferenciaAnchoBanda

    /**
     *
     *
     * @return
     * @access public
     */
    public function videoconferenciaLlamando( ) {
        $this->setComando("LLAMANDO");
    } // end of member function videoconferenciaLlamando

    /**
     *
     *
     * @return
     * @access public
     */
    public function videoconferenciaColgado( ) {
        $this->delAllNumeroIP();
        $this->setComando("COLGADO");
    } // end of member function videoconferenciaColgado

    /**
     *
     *
     * @param string llamada

     * @return
     * @access public
     */
    public function videoconferenciaLlamadaColgado( $llamada ) {
        $this->delAllNumeroIP();
        $this->setComando("COLGADO",$llamada);
    } // end of member function videoconferenciaLlamadaColgado

    /**
     *
     *
     * @return
     * @access public
     */
    public function videoconferenciaHome( ) {
        $this->setComando("HOME");
    } // end of member function videoconferenciaHome

    /**
     *
     *
     * @return
     * @access public
     */
    public function videoconferenciaGraficos( ) {
        $this->setComando("GRAFICOS");
    } // end of member function videoconferenciaGraficos

    /**
     *
     *
     * @param string numero

     * @return
     * @access public
     */
    public function marcarNumero( $numero ) {
        $this->addNumeroIP($numero);
    } // end of member function marcarNumero

    /**
     *
     *
     * @return
     * @access public
     */
    public function marcarPunto( ) {
        $this->addNumeroIP(".");

    } // end of member function marcarPunto

    /**
     *
     *
     * @return
     * @access public
     */
    public function borrarUltimoNumero( ) {
        $this->delNumeroIP();
    } // end of member function borrarUltimoNumero

    /**
     *
     *
     * @return
     * @access public
     */
    public function borrarNumeroEntero( ) {
        $this->delAllNumeroIP();
    } // end of member function borrarNumeroEntero

    /**
     *
     *
     * @param string numero

     * @return
     * @access public
     */
    public function videoconferenciaConectado( $numero ) {
        $this->setNumeroIP($numero);
        $this->setComando("CONECTADO",$numero);
    } // end of member function videoconferenciaConectado

    /**
     *
     *
     * @return
     * @access public
     */
    public function videoconferenciaDesconectado( ) {
        $this->setComando("DESCONECTADO");
    } // end of member function videoconferenciaDesconectado

    /**
     *
     *
     * @param string contactos

     * @return
     * @access public
     */
//    public function videoconferenciaContactos( $contactos ) {
//        echo "\nvideoconferencia contactos\n";
//        $this->enviarContactos();
//
//    } // end of member function videoconferenciaContactos
    public function videoconferenciaContactos( $contactos ) {
        $this->setComando("CONTACTOS:LISTA",$contactos);
    } // end of member function videoconferenciaContactos
    public function enviarContactos(){
       $this->enviarPeticion("VIDEOCONFERENCIA:CONTACTOS:LISTA:DIOCE=0,LOOPBACK
1=0,LOOPBACK 2=0,MIGUEL ALTUNA=1,POLYCOM AUSTIN STEREO=0,POLYCOM AUSTIN
STEREO=0,POLYCOM AUSTIN USA=0,POLYCOM AUSTIN USA IP=0,POLYCOM
AUSTRALIA=0,POLYCOM BRAZIL=0,POLYCOM EUROPE=0,POLYCOM HONG
KONG=0,POLYCOM JAPAN=0,POLYCOM JAPAN=0,POLYCOM MEXICO=0,POLYCOM MILPITAS
LOBBY=0,POLYCOM PERU=0,POLYCOM SOUTHERN EUROPE=0,TELESONIC=0");
    }
    /**
     *
     *
     * @param string contacto

     * @return
     * @access public
     */
    public function contactoSeleccionado( $contacto ) {
        $this->setComando("CONTACTOS:SEL",$contacto);
    } // end of member function contactoSeleccionado

    /**
     *
     *
     * @param string contacto

     * @return
     * @access public
     */
    public function contactoDeseleccionado( $contacto ) {
        $this->setComando("CONTACTOS:DESEL",$contacto);
    } // end of member function contactoDeseleccionado

    /**
     *
     *
     * @param string llamadas

     * @return
     * @access public
     */
    public function llamadas( $llamadas ) {
        $this->setComando("LLAMADAS:LISTA",$llamadas);
    } // end of member function llamadas

    /**
     *
     *
     * @return
     * @access public
     */
    public function llamadasVaciar( ) {
        $this->setComando("LLAMADAS","VACIAR");
    } // end of member function llamadasVaciar

    /**
     *
     *
     * @param string contacto

     * @return
     * @access public
     */
    public function llamadaSeleccionada( $contacto ) {
        $this->setComando("LLAMADAS:SEL",$contacto);
    } // end of member function llamadaSeleccionada

    /**
     *
     *
     * @param string contacto

     * @return
     * @access public
     */
    public function llamadaDeseleccionada( $contacto ) {
        $this->setComando("LLAMADAS:DESEL",$contacto);
    } // end of member function llamadaDeseleccionada

    /**
     *
     *
     * @param string contacto

     * @return
     * @access public
     */
    public function contactoLlamarIP( $contacto ) {
        $this->setComando($contacto);
//        $this->dibujarPantalla();
    //DIBUJAR PANTALLA
    } // end of member function contactoLlamarIP

    /**
     *
     *
     * @param string contacto

     * @return
     * @access public
     */
    public function contactoLlamarNombre( $contacto ) {
        $this->setNumeroIP($contacto);
        $this->dibujarPantalla();
    //DIBUJAR PANTALLA
    } // end of member function contactoLlamarNombre

    /**
     *
     *
     * @return
     * @access public
     */
    public function contactoCancelar( ) {
        $this->setComando("CONTACTOS","CANCELAR");
    } // end of member function contactoCancelar

    /**
     *
     *
     * @return
     * @access public
     */
    public function videoconferenciaNoInterrumpirOFF( ) {
        $this->setNoInterrumpir("ON");
//        $this->setNoInterrumpir("AUTOANSWER");
    } // end of member function videoconferenciaNoInterrumpirOFF

    /**
     *
     *
     * @return
     * @access public
     */
    public function videoconferenciaNoInterrumpir( ) {
        $this->setNoInterrumpir("OFF");
        //$this->setNoInterrumpir("ALLOCATED");
    } // end of member function videoconferenciaNoInterrumpir

    /**
     *
     *
     * @return
     * @access public
     */
    public function videoconferenciaSubirVolumen( ) {
        $this->subirVolumen();
        //$this->setComando("SUBIR_VOLUMEN");
    } // end of member function videoconferenciaSubirVolumen

    /**
     *
     *
     * @return
     * @access public
     */
    public function videoconferenciaBajarVolumen( ) {
        $this->bajarVolumen();
        //$this->setComando("BAJAR_VOLUMEN");
    } // end of member function videoconferenciaBajarVolumen

    /**
     *
     *
     * @param int volumen

     * @return
     * @access public
     */
    public function videoconferenciaVolumen( $volumen ) {
        $this->setVolumen($volumen);
    } // end of member function videoconferenciaVolumen

    /**
     *
     *
     * @param string estado

     * @return
     * @access public
     */
    public function videoconferenciaNuestroSonido( $estado ) {
        
        $this->setNuestroSonido($estado);
    } // end of member function videoconferenciaNuestroSonido

    /**
     *
     *
     * @param string estado

     * @return
     * @access public
     */
    public function videoconferenciaMostrarContraparte( $estado ) {
        $this->setComando("MOSTRAR_CONTRAPARTE",$estado);
    } // end of member function videoconferenciaMostrarContraparte

    /**
     *
     *
     * @return
     * @access public
     */
    public function enviarVolumen( ) {
          $cmd = new ComandoFlash("VIDEOCONFERENCIA:SONIDO_CONTRAPARTE","VOLUMEN",
                              $this->getVolumen());
    $this->enviarPeticion($cmd->getComando());

    } // end of member function enviarVolumen

    /**
     *
     *
     * @return
     * @access public
     */
    public function enviarComando( ) {
         $cmd = new ComandoFlash("VIDEOCONFERENCIA", $this->getComando(),
                             $this->getAtributo());
print_r($cmd);
    $this->enviarPeticion($cmd->getComando());

    } // end of member function enviarComando

    /**
     *
     *
     * @return
     * @access public
     */
    public function enviarNumero( ) {
           $cmd = new ComandoFlash("VIDEOCONFERENCIA", "MARCADO",$this->getNumeroIP());
    $this->enviarPeticion($cmd->getComando());

    } // end of member function enviarNumero

    /**
     *
     *
     * @return
     * @access public
     */
    public function enviarNoInterrumpir( ) {
           $cmd = new ComandoFlash("VIDEOCONFERENCIA", "NO_INTERRUMPIR",
                             $this->getNoInterrumpir());
                         usleep(1000000);
    $this->enviarPeticion($cmd->getComando());

    } // end of member function enviarNoInterrumpir

    /**
     *
     *
     * @return
     * @access public
     */
    public function enviarNuestroSonido( ) {
           $cmd = new ComandoFlash("VIDEOCONFERENCIA","NUESTRO_SONIDO",$this->getNuestroSonido());
    $this->enviarPeticion($cmd->getComando());

    } // end of member function enviarNuestroSonido

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
echo "pantalla activa=4\n";

            $pantallaActual=new Properties();
        $pantallaActual->load(file_get_contents("./pantallaActiva.properties"));
            $pantallaActual->setProperty("Pantalla.activa",4);
        file_put_contents('./pantallaActiva.properties',     $pantallaActual->toString(true));


       // $this->pantalla_activa=$pantalla;
    } // end of member function setPantallaActiva
    /**
     *
     *
     * @return
     * @access public
     */
    public function dibujarPantalla( ) {
        $this->activarPantalla();
echo "1";
         $this->enviarNumero();
echo "2";
	  $this->enviarVolumen();
echo "3";
	  $this->enviarComando();
echo "4";
  $this->enviarNoInterrumpir();
echo "5";
	  $this->enviarNuestroSonido();
echo "6";
	  //this.pnlControl.getModuloControl().control_videoconferencia.llamadasactivas();
    } // end of member function dibujarPantalla


//    public function getComandoFlash($cmd) {
//
//        if (strcmp($cmd->getAccion(),"LLAMAR")==0) {
//            $this->videoconferenciaLlamando();
//        }
//        else if (strcmp($cmd->getAccion(),"CONTACTOS")==0) {
//                if (strcmp($cmd->getAtributo(),"SEL")==0) {
//                    if ($cmd->getAtributo().contains("DESEL")==0) {
//                        $this->contactoDeseleccionado($cmd->getAtributo());
//                    } else
//                        $this->contactoSeleccionado($cmd->getAtributo());
//                } else
//                    if (strcmp($cmd->getAtributo(),"LLAMAR")==0) {
//                        $this->contactoLlamarNombre($cmd->getAtributo());
//                    }
//                    else if (strcmp($cmd->getAtributo(),"CANCELAR")==0) {
//                            $this->contactoCancelar();
//                        }
//                        else if (strcmp($cmd->getAtributo(),"")==0) {
//                            //begiratu
//                                $this->videoconferenciaContactos($cmd->getAtributo());
//                            }
//            }
//            else if (strcmp($cmd->getAccion(),"MARCAR")==0) {
//
//                    if (strcmp($cmd->getAtributo(),".")==0) {
//                        $this->marcarPunto();
//                    }
//                    else {
//                        $this->marcarNumero($cmd->getAtributo());
//                    }
//
//                }
//                else if (strcmp($cmd->getAccion(),"LLAMADAS")==0) {
//                        if (strcmp($cmd->getAtributo(),"SEL")==0) {
//                            if (strcmp($cmd->getAtributo(),"DESEL")==0) {
//                                $this->llamadaDeseleccionada($cmd->getAtributo());
//                            }
//                            else
//                                $this->llamadaSeleccionada($cmd->getAtributo());
//                        }
//                    }
//                    else if (strcmp($cmd->getAccion(),"COLGAR")==0) {
//                            $llamada = $cmd->getAtributo();
//                            $this->videoconferenciaLlamadaColgado($llamada);
//                        }
//                        else if (strcmp($cmd->getAccion(),"BORRAR")==0) {
//                                if (strcmp($cmd->getAtributo(),"ULTIMO")==0) {
//                                    $this->borrarUltimoNumero();
//                                }
//                                else if (strcmp($cmd->getAtributo(),"TODO")==0) {
//                                        $this->borrarNumeroEntero();
//                                    }
//                            }
//                            else if (strcmp($cmd->getAccion(),"NO_INTERRUNPIR")==0) {
//                                    if (strcmp($cmd->getAtributo(),"ACTIVAR")==0) {
//                                        $this->videoconferenciaNoInterrumpir();
//                                    }
//                                    else if (strcmp($cmd->getAtributo(),"APAGAR")==0) {
//                                            $this->videoconferenciaNoInterrumpirOFF();
//
//                                        }
//                                }
//                                else if (strcmp($cmd->getAccion(),"GRAFICOS")==0) {
//                                        $this->videoconferenciaGraficos();
//                                    }
//
//                                    else if (strcmp($cmd->getAccion(),"SONIDO_CONTRAPARTE")==0) {
//                                            if (strcmp($cmd->getAtributo(),"SUBIR_VOLUMEN")==0) {
//                                                $this->videoconferenciaSubirVolumen();
//                                            }
//                                            else if (strcmp($cmd->getAtributo(),"BAJAR_VOLUMEN")==0) {
//                                                    $this->videoconferenciaBajarVolumen();
//                                                }
//                                        }
//                                        else if (strcmp($cmd->getAccion(),"NUESTRO_SONIDO")==0) {
//
//                                                if (strcmp($cmd->getAtributo(),"ENVIAR")==0) {
//                                                    $this->enviarNuestroSonido();
//                                                }
//                                                else if (strcmp($cmd->getAtributo(),"APAGAR")==0) {
//
//                                                        $this->videoconferenciaNuestroSonido("OFF");
//                                                    }
//                                            }
//                                            else if (strcmp($cmd->getAccion(),"MOSTRAR_CONTRAPARTE")==0) {
//                                                    $this->videoconferenciaMostrarContraparte("ON");
//                                                }
//        //if (strcmp($tipoComando, "VOLUMEN")==0)
//        $comandoFlash=$this->crearComandoVolumenFlash();
//        //if (strcmp($tipoComando, "COMANDO")==0)
//        $comandoFlash=$this->crearComandoFlash();
//        //if (strcmp($tipoComando, "NUMERO")==0)
//        $comandoFlash=$this->crearComandoNumeroFlash();
//        //if (strcmp($tipoComando, "NO_INTERRUMPIR")==0)
//        $comandoFlash=$this->crearComandoNoInterrumpirFlash();
//        //if (strcmp($tipoComando, "SONIDO")==0)
//        $comandoFlash=$this->crearComandoSonidoFlash();
//
//
//        return $comandoFlash;
//
//    }
//
//    public function crearComandoFlash() {
//    //$comando="";
//
//
//        $comando=new ComandoFlash("VIDEOCONFERENCIA", $this->getComando(),$this->getAtributo());
//         echo "\n<b>comando:</b>\n";
//        print_r($comando);
//        return $comando;
//
//    }
//    public function crearComandoVolumenFlash() {
//    //$comando="";
//
//
//        $comando=new ComandoFlash("VIDEOCONFERENCIA:SONIDO_CONTRAPARTE","VOLUMEN",$this->getVolumen());
//         echo "\n<b>volumen :</b>\n";
//        print_r($comando);
//        return $comando;
//
//    }
//    public function crearComandoNumeroFlash() {
//    //$comando="";
//
//
//        $comando=new ComandoFlash("VIDEOCONFERENCIA", "MARCADO",$this->getNumeroIP());
//         echo "\n<b>numero:</b>\n";
//        print_r($comando);
//        return $comando;
//
//    }
//    public function crearComandoNoInterrumpirFlash() {
//    //$comando="";
//
//
//        $comando=new ComandoFlash("VIDEOCONFERENCIA", "NO_INTERRUMPIR",$this->getNoInterrumpir());
//        echo "\n<b>no interrumpir:</b>\n";
//        print_r($comando);
//        return $comando;
//
//    }
//    public function crearComandoSonidoFlash() {
//    //$comando="";
//
//
//        $comando=new ComandoFlash("VIDEOCONFERENCIA", "NUESTRO_SONIDO",$this->getNuestroSonido());
//         echo "\n<b>sonido:</b>\n";
//        print_r($comando);
//        return $comando;
//
//    }


} // end of GUI_VideoConferencia
?>
