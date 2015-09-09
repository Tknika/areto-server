<?php

/**
 * class ControlVideoConferencia
 *
 */
class ControlGuiVideoconferencia {

/** Aggregations: */

/** Compositions: */

   /*** Attributes: ***/
/* @access private
    *
    *
    */

// public function getListaLlamadasEnCurso(){
//            return $this->videoconferencia->getListaLlamadasEnCurso();
//        }
//
//        public function getListaLlamadas(){
//            return $this->videoconferencia->getListaLlamadas();
//        }


//	public function conectar(){
//	}
//
//	public function desconectar() {
//	}

    public function reiniciarVideoconferencia() {
        $this->videoconferencia->reiniciarVideoconferencia();

    }

    public function colgarVideoconferencia() {
        AccesoControladoresDispositivos::$ctrlVideoconferencia->colgarVideoconferencia();
      //  AccesoGui::$guiVideoconferencia->videoconferenciaColgado();
    }

    public function colgarLlamada($llamada) {
        $llamSel=AccesoControladoresDispositivos::$ctrlVideoconferencia->getListaLlamadasEnCurso();

print_r($llamSel);
       $id=$llamSel->buscarLlamada($llamada);
echo "la llamada es: ".$id;
     
        AccesoControladoresDispositivos::$ctrlVideoconferencia->colgarLlamada($id);
     //  AccesoGui::$guiVideoconferencia->videoconferenciaLlamadaColgado($llamada);
    	
          $this->llamadasActivas();
       
    }

    public function contactos() {

        AccesoControladoresDispositivos::$ctrlVideoconferencia->contactos();
        AccesoGui::$guiVideoconferencia->videoconferenciaContactos(AccesoControladoresDispositivos::$ctrlVideoconferencia->getListaDeContactosString());


    //            AccesoGui::$guiVideoconferencia->videoconferenciaContactos("aa");
    }

    public function llamadasActivas() {
    //parametro bezela pantall videoconferencia
        AccesoControladoresDispositivos::$ctrlVideoconferencia->llamadasActivas();
	echo "llamadas activas en control gui videoconf: ".count(AccesoControladoresDispositivos::$ctrlVideoconferencia->getListaLlamadasEnCursoString())."\n";
	//print_r(AccesoControladoresDispositivos::$ctrlVideoconferencia->getListaLlamadasEnCursoString());
	if(count(AccesoControladoresDispositivos::$ctrlVideoconferencia->getListaLlamadasEnCursoString())==0){
	AccesoGui::$guiVideoconferencia->llamadas("");
	echo "no hay llamadas\n";
}
		else
        AccesoGui::$guiVideoconferencia->llamadas(AccesoControladoresDispositivos::$ctrlVideoconferencia->getListaLlamadasEnCursoString());
    }

    public function llamadas($llamada,$tipoLlamada) {
        $respuesta=AccesoControladoresDispositivos::$ctrlVideoconferencia->llamadas($llamada, $tipoLlamada);

    }
    public function llamarVideoconferencia() {
        AccesoControladoresDispositivos::$ctrlVideoconferencia->llamarVideoconferencia();
$this->borrarTodo();
 AccesoGui::$guiSistema->esperarInicioSistema(30);
usleep(3000000);
        $this->llamadasActivas();
AccesoGui::$guiSistema->stopEsperaSistema();

    }

    public function llamarVideoconferenciaIP($numeroIP) {
        AccesoControladoresDispositivos::$ctrlVideoconferencia->llamarVideoconferenciaIP($numeroIP);
$this->llamadasActivas();
    }

    public function llamarVideoconferenciaNombre($nombre) {
        //$this->llamarVideoconferenciaNombre($nombre);
        $this->contactoLlamar($nombre);

    }


//    public function videoconferenciaIP() {
//        $this->videoconferencia->videoconferenciaIP();
//
//    }
//
//    public function videoconferenciaRDSI() {
//        $this->videoconferencia->videoconferenciaRDSI();
//    }
//
//    public function homeVideoconferencia() {
//        AccesoControladoresDispositivos::$ctrlVideoconferencia->homeVideoconferencia();
//
//    }
    public function graficosVideoconferencia() {
        AccesoControladoresDispositivos::$ctrlVideoconferencia->graficosVideoconferencia();
        AccesoGui::$guiVideoconferencia->videoconferenciaGraficos();
    }

    public function marcarNumero($numero) {
        AccesoControladoresDispositivos::$ctrlVideoconferencia->marcarNumero($numero);
        AccesoGui::$guiVideoconferencia->marcarNumero($numero);
    } // end of member function marcarNumero

    //marcarNumerokin batera dao
//    public function marcarPunto( ) {
//    } // end of member function marcarPunto

    //	public function Marcar(String direccion) {
    //		/**
    //		 * Metodo para marcar la direccion indicada
    //		 */
    //		String aux = "";
    //		int i = 0;
    //		while (i < direccion.length()) {
    //			aux = aux + direccion.charAt(i) + " ";
    //			i++;
    //		}
    //		String comando = "button " + aux.trim();
    //		this.enviarComando(comando);
    //	}
    public function borrarUltimo( ) {
        AccesoControladoresDispositivos::$ctrlVideoconferencia->borrarUltimo();
        AccesoGui::$guiVideoconferencia->borrarUltimoNumero();
    } // end of member function borrarUltimo
    //	public function BorrarUltimo() {
    //		/**
    //		 * Metodo para borrar el ultimo numero marcado
    //		 */
    //		// String comando = ds.obtenerCadenaComando("borrarultimo");
    //		String comando = "button delete";
    //		this.enviarComando(comando);
    //	}
    public function borrarTodo( ) {
        AccesoControladoresDispositivos::$ctrlVideoconferencia->borrarTodo();
        AccesoGui::$guiVideoconferencia->borrarNumeroEntero();
    } // end of member function borrarTodo

    public function noMolestar( ) {


        AccesoControladoresDispositivos::$ctrlVideoconferencia->noMolestar();
        AccesoGui::$guiVideoconferencia->videoconferenciaNoInterrumpir();

    } // end of member function noMolestar

    public function noMolestarOff( ) {

        AccesoControladoresDispositivos::$ctrlVideoconferencia->noMolestarOff();
       AccesoGui::$guiVideoconferencia->videoconferenciaNoInterrumpirOFF();
    } // end of member function noMolestarOff

    public function contactoLlamar($contacto) {

        $pos=strpos($contacto,":");

        $atrib1=substr($contacto, 0,$pos);
        $lag2=substr($contacto, $pos+1,strlen($contacto)-$pos);//la ip o nombre del contacto
        //	//el nombre viene en maiuscula todo, y tiene que enviarse en el primer caracter maiuscula y todo lo demas en minuscula
        $atributo2 = ucfirst($lag2);
        //	 System.out.println("el contacto"+ atributo2);
        if(is_numeric(substr($atributo2, 0,1))) {//ez da zenbakia, ip bat da
            echo " is numeric Atributo2= ".$atributo2."\n";
            $this->llamadas($atributo2, "ip");
            AccesoControladoresDispositivos::$ctrlVideoconferencia->llamarVideoconferenciaIP($atributo2);

        }
        else {
echo " nombre Atributo2= ".$atributo2."\n";
            $this->llamadas($atributo2, "nombre");
            AccesoControladoresDispositivos::$ctrlVideoconferencia->llamarVideoconferenciaNombre($atributo2);

        }
        echo "llamadasActivas\n";
 $this->llamadasActivas();
    }
    public function contactoCancelar() {
         AccesoGui::$guiVideoconferencia->contactoCancelar();
    //pantailarako
    //     this.control.pantallaControl.pantallaVideoConferencia.ContactoCancelar();
    }
    public function verVideoconferenciaEnPantallaPresidencia() {
    // en la pantalla de la presidencia la videoconferencia
        AccesoControladoresDispositivos::$ctrlPantallas->encenderPresidencia();

        try {
            usleep(3000000);
        }
        catch (Exception $e) {
        }
        AccesoControladoresDispositivos::$ctrlPantallas->quitarPIPPresidencia();
        try {
            usleep(3000000);
        }
        catch (Exception $e) {
        }
        AccesoControladoresDispositivos::$ctrlPantallas->verEntradaPresidenciaAV2();
        AccesoControladoresDispositivos::$ctrlMatrizVideo(MatrizVideo::$INPUT_VIDEOCONFERENCIA,MatrizVideo::$OUTPUT_LCD_PRESIDENCIA);


    }
    public function contactoSeleccionado($nombre) {
        echo "seleccionar contacto:".$nombre;
        $pos = strpos($nombre, ":");
        $atributo1 = substr($nombre,0, $pos);
        $atributo2 =substr($nombre,$pos+1,strlen($nombre)); //el nombre del contacto
        AccesoGui::$guiVideoconferencia->contactoSeleccionado($atributo2);
    //pantailarako funtzioa
    }

    public function contactoDeseleccionado($nombre) {
        echo "deseleccionar contacto:".$nombre;
        $pos = strpos($nombre, ":");
        $atributo1 = substr($nombre,0, $pos);
        $atributo2 =substr($nombre,$pos+1,strlen($nombre)); //el nombre del contacto
        AccesoGui::$guiVideoconferencia->contactoDeseleccionado($atributo2);
    //pantailarako funtzioa
    }
    public function  llamadaSeleccionada($nombre) {
        echo "llamada seleccionada: ".$nombre;
        echo "seleccionar contacto:".$nombre;
        $pos = strpos($nombre, ":");
        $atributo1 = substr($nombre,0, $pos);
        $atributo2 =substr($nombre,$pos+1,strlen($nombre)); //el nombre del contacto
        AccesoGui::$guiVideoconferencia->llamadaSeleccionada($atributo2);
    }

    public function  llamadaDeseleccionada($nombre) {
        echo "llamadaDeseleccionadallamadaDeseleccionada: ".$nombre;
        $pos = strpos($nombre, ":");
        $atributo1 = substr($nombre,0, $pos);
        $atributo2 =substr($nombre,$pos+1,strlen($nombre)); //el nombre del contacto
        AccesoGui::$guiVideoconferencia->llamadaDeseleccionada($atributo2);
    }

    public function sonidoContraparteSubir() {
        AccesoControladoresDispositivos::$ctrlMesaMezclas->subirSonidoContraparte();
        AccesoGui::$guiVideoconferencia->videoconferenciaSubirVolumen();

    }

    public function sonidoContraparteBajar() {
        AccesoControladoresDispositivos::$ctrlMesaMezclas->bajarSonidoContraparte();
        AccesoGui::$guiVideoconferencia->videoconferenciaBajarVolumen();
    }

    public function sonidoContraparteON() {
        AccesoControladoresDispositivos::$ctrlMesaMezclas->activarSonidoContraparte();
        AccesoGui::$guiVideoconferencia->videoconferenciaMostrarContraparte("0N");
    }

    public function sonidoContraparteOFF() {
        AccesoControladoresDispositivos::$ctrlMesaMezclas->desactivarSonidoContraparte();
        AccesoGui::$guiVideoconferencia->videoconferenciaMostrarContraparte("0FF");
    }

    public function nuestroSonidoEnviar() {
        AccesoControladoresDispositivos::$ctrlMesaMezclas->activarNuestroSonido();
        AccesoGui::$guiVideoconferencia->videoconferenciaNuestroSonido("0N");
    }

    public function nuestroSonidoApagar() {
        AccesoControladoresDispositivos::$ctrlMesaMezclas->desactivarNuestroSonido();
         AccesoGui::$guiVideoconferencia->videoconferenciaNuestroSonido("0FF");
    }
    /////////////funtzioaren aukera////////
    public function getComandoFlash($cmd) {

        if (strcmp($cmd->getAccion(),"LLAMAR")==0) {
            $this->LlamarVideoconferencia();
        }
        else if (strcmp($cmd->getAccion(),"CONTACTOS")==0) {
                if (strcmp($cmd->getAtributo(),"")==0) {
                //begiratu
                    echo "CONTACTOS\n";
                    $this->contactos($cmd->getAtributo());
                }else
                    if (strcmp(substr($cmd->getAtributo(),0,3),"SEL")==0) {
                        echo "\nCONTACTO SELECCIONADO ".$cmd->getAtributo()."\n";
                        $this->contactoSeleccionado($cmd->getAtributo());

                    }
                    else if (strcmp(substr($cmd->getAtributo(),0,5),"DESEL")==0) {

                            $this->contactoDeseleccionado($cmd->getAtributo());

                        }


                        else if (strcmp(substr($cmd->getAtributo(),0,6),"LLAMAR")==0) {
                            echo "atributo para analizar: ".$cmd->getAtributo()."\n";
                                $this->contactoLlamar($cmd->getAtributo());
                            }
                            else if (strcmp($cmd->getAtributo(),"CANCELAR")==0) {
                                    $this->contactoCancelar();
                                }

            }
            else if (strcmp($cmd->getAccion(),"MARCAR")==0) {

                    if (strcmp($cmd->getAtributo(),".")==0) {
                        $this->marcarNumero($cmd->getAtributo());
                    }
                    else {
                        $this->marcarNumero($cmd->getAtributo());
                    }

                }
                else if (strcmp($cmd->getAccion(),"LLAMADAS")==0) {
                        if (strcmp(substr($cmd->getAtributo(),0,3),"SEL")==0)
                            $this->llamadaSeleccionada($cmd->getAtributo());
                        else
                            $this->llamadaDeseleccionada($cmd->getAtributo());

                    }
                    else if (strcmp($cmd->getAccion(),"COLGAR")==0) {
                        //$this->llamadasActivas();
                            $this->colgarLlamada($cmd->getAtributo());
                        }
                        else if (strcmp($cmd->getAccion(),"BORRAR")==0) {
                                if (strcmp($cmd->getAtributo(),"ULTIMO")==0) {
                                    $this->borrarUltimo();
                                }
                                else if (strcmp($cmd->getAtributo(),"TODO")==0) {
                                        $this->borrarTodo();
                                    }
                            }
                            else if (strcmp($cmd->getAccion(),"NO_INTERRUNPIR")==0) {
                                    if (strcmp($cmd->getAtributo(),"ACTIVAR")==0) {
                                        $this->noMolestar();
                                    }
                                    else if (strcmp($cmd->getAtributo(),"APAGAR")==0) {
                                            $this->noMolestarOff();

                                        }
                                }
                                else if (strcmp($cmd->getAccion(),"GRAFICOS")==0) {
                                        $this->graficosvideoconferencia();
                                    }

                                    else if (strcmp($cmd->getAccion(),"SONIDO_CONTRAPARTE")==0) {
                                            if (strcmp($cmd->getAtributo(),"SUBIR_VOLUMEN")==0) {
                                                $this->sonidoContraparteSubir();
                                            }
                                            else if (strcmp($cmd->getAtributo(),"BAJAR_VOLUMEN")==0) {
                                                    $this->sonidoContraparteBajar();
                                                }
                                        }
                                        else if (strcmp($cmd->getAccion(),"NUESTRO_SONIDO")==0) {

                                                if (strcmp($cmd->getAtributo(),"ENVIAR")==0) {
                                                    $this->nuestroSonidoEnviar();
                                                }
                                                else if (strcmp($cmd->getAtributo(),"APAGAR")==0) {

                                                        $this->nuestroSonidoApagar();
                                                    }
                                            }
                                            else if (strcmp($cmd->getAccion(),"MOSTRAR_CONTRAPARTE")==0) {
                                                    $this->videoconferenciaMostrarContraparte("ON");
                                                }

   
    }




} // end of ControlVideoConferencia
?>
