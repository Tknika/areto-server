<?php
/**
 * @package PHP::controladoresDispositivos
 */
/**
 * includes
 */
require_once './dispositivos/Automata.php';
require_once './AccesoControladoresDispositivos.php';

/**
 * Description of controladorAutomata
 *
 * @author amaia
 *
 * @package PHP::controladoresDispositivos
 */
class ControladorAutomata {

/**
 * Atributo que guardara la instancia de la clase Automata
 *
 * @var automata
 * @access private
 * @static
 */
    private static $automata;
    /**
     * Informacion que recibe del automata cuando se pulsa el interruptor de la sala
     *
     * @var string
     * @access private
     * @static
     */
    private static $ARGIA = "lu";
    /**
     * Informacion que recibe del automata cuando se pulsa el pulsador del microfono 1
     *
     * @var string
     * @access private
     * @static
     */
    public static $MICPRESI_1 = "m1";
    /**
     * Informacion que recibe del automata cuando se pulsa el pulsador del microfono 2
     *
     * @var string
     * @access private
     * @static
     */
    public static $MICPRESI_2 = "m2";
    /**
     *Informacion que recibe del automata cuando se pulsa el pulsador del microfono 3
     *
     * @var string
     * @access private
     * @static
     */
    public static $MICPRESI_3 = "m3";
    /**
     * Informacion que recibe del automata cuando se pulsa el pulsador del microfono 4
     *
     * @var string
     * @access private
     * @static
     */
    public static $MICPRESI_4 = "m4";
    /**
     * Informacion que recibe del automata cuando se pulsa el pulsador del microfono del atril 1
     *
     * @var string
     * @access private
     * @static
     */
    public static $MICATRIL = "t1";
    /**
     * Informacion que recibe del automata cuando se pulsa el pulsador del microfono del atril 2
     * @var string
     * @access private
     * @static
     */
    public static $MICATRIL2 = "t2";
    /**
     * Informacion que recibe del automata cuando se pulsa el pulsador de la pizarra
     *
     * @var string
     * @access private
     * @static
     */
    public static $SHOWMEPIZARRA = "pi";

    public function  __construct() {

        self::$automata=new Automata("Automata");

    }


    /**
     * Metodo que devuelve el valor hexadecimal de la intensidad $intensidad
     *
     * @access public
     * @param string $intensidad hexadecimal
     * @return string
     */
    public function getDescripcionIntensidad($intensidad) {

        return self::$automata->getDescripcionIntensidad($intensidad);

    }

    /**
     * Metodo que pone la luz de la linea $linea con la intensidad $intensidad
     *
     * @access public
     * @param string $linea
     * @param string $intensidad
     */
    public function setIntensidadLinea($linea,$intensidad) {

        self::$automata->setIntensidadLinea($linea,$intensidad);

    }

    /**
     * Metodo que devuelve la intensidad de la linea $linea
     *
     * @access public
     * @param string $linea
     * @return string intensidad hexadecimal
     */
    public function getIntensidadLinea($linea) {

        return self::$automata->getIntensidadLinea($linea);

    }

    /**
     * Metodo que pone las luces del pasillo con intesidad $intensidad
     *
     * @access public
     * @param string $intensidad
     */
    public function setIntensidadPasillo($intensidad) {

        self::$automata->setIntensidadPasillo($intensidad);

    }

    /**
     * Metodo que devuelve la intensidad de las luces del pasillo
     *
     * @access public
     * @return string intensidad hexadecimal
     */

    public function getIntensidadPasillo() {

        return self::$automata->getIntensidadPasillo();

    }

    /**
     * Metodo que pone las luces de los alumnos con intesidad $intensidad
     *
     * @access public
     * @param string $intensidad
     */
    public function setIntensidadAlumnos($intensidad) {

        self::$automata->setIntensidadAlumnos($intensidad);

    }

    /**
     * Metodo que devuelve la intensidad de las luces de los alumnos
     *
     * @access public
     * @return string intensidad hexadecimal
     */
    public function getIntensidadAlumnos() {

        return self::$automata->getIntensidadAlumnos();

    }

    /**
     * Metodo para subir la intensidad de la linea $linea
     *
     * @access public
     * @param string $linea
     */
    public function subirIntensidadLinea($linea) {

        self::$automata->subirIntensidadLinea($linea);

    }

    /**
     * Metodo para bajar la intensidad de la linea $linea
     *
     * @access public
     * @param string $linea
     */
    public function bajarIntensidadLinea($linea) {

        self::$automata->bajarIntensidadLinea($linea);

    }

    /**
     * Metodo para bloquear el interruptor de las luces de sala
     *
     * @access public
     */
    public function bloquearLuces() {

        self::$automata->bloquearLuces();

    }

    /**
     * Metodo para desbloquear el interruptor de las luces de sala
     *
     * @access public
     */
    public function desbloquearLuces() {

        self::$automata->desbloquearLuces();

    }

    /**
     * Metodo que devuelve si el interruptor de las luces de la sala esta bloqueado
     *
     * @access public
     * @return bit
     */
    public function isLucesBloqueadas() {

        return  self::$automata->isLucesBloqueadas();

    }

    /**
     * Metodo para enciender las luces del suelo al con la intensidad $nivel
     *
     * @access public
     * @param string $nivel
     */
    public function encenderLuzSala($nivel) {

        self::$automata->encenderLuzSala($nivel);

    }

    /**
     * Metodo para apagar las luces del suelo
     *
     * @access public
     */
    public function apagarLuzSala() {

        self::$automata->apagarLuzSala();

    }

    /**
     * Metodo para poner el estado de la luz en encendido (1)
     *
     * @access public
     */
    public function encender() {

        self::$automata->encenderLuz();

    }

    /**
     * Metodo para poner el estado de la luz en apagado (0)
     *
     * @access public
     */
    public function apagar() {

        self::$automata->apagarLuz();

    }

    /**
     * Metodo para iniciar el automata
     *
     * @access public
     */
    public function iniciar() {

        self::$automata->iniciar();

    }

    /**
     * Metodo para dejar el automata con los valores del principio
     *
     * @access public
     */
    public function principio() {

        self::$automata->principio();

    }

    /**
     * Metodo para dejar el automata listo para enviar una clase
     *
     * @access public
     */
    public function escenarioEnviarClase() {

        self::$automata->escenarioEnviarClase();


    }

    /**
     * Metodo para activar los redThinkClient
     *
     * @access public
     */
    public function iniciarThinkClient() {

        self::$automata->iniciarThinkClient();

    }


    /**
     * Metodo para encender las luces del suelo
     *
     * @access public
     */
    public function encenderLucesSuelo() {

        self::$automata->encenderLucesSuelo();

    }

    /**
     * Metodo para encender las luces del suelo del pasillo
     *
     * @access public
     */
    public function encenderLucesSueloPasillo() {

        self::$automata->encenderLucesSueloPasillo();

    }

    /**
     * Metodo para encender las luces del suelo de los alumnos
     *
     * @access public
     */
    public function encenderLucesSueloAlumnos() {

        self::$automata->encenderLucesSueloAlumnos();

    }

    /**
     * Metodo para apagar las luces del suelo
     *
     * @access public
     */
    public function apagarLucesSuelo() {

        self::$automata->apagarLucesSuelo();

    }

    /**
     * Metodo para apagar las luces del suelo del pasillo
     *
     * @access public
     */
    public function apagarLucesSueloPasillo() {

        self::$automata->apagarLucesSueloPasillo();

    }

    /**
     * Metodo para apagar las luces del suelo de los alumnos
     *
     * @access public
     */
    public function apagarLucesSueloAlumnos() {

        self::$automata->apagarLucesSueloAlumnos();

    }

    /**
     * Metodo para subir la intensidad de las luces del suelo del pasillo
     *
     * @access public
     */
    public function subirIntensidadLucesSueloPasillo() {

        self::$automata-> subirIntensidadLucesSueloPasillo();

    }

    /**
     * Metodo para subir la intensidad de las luces del suelo de los alumnos
     *
     * @access public
     */
    public function subirIntensidadLucesSueloAlumnos() {

        self::$automata-> subirIntensidadLucesSueloAlumnos();

    }

    /**
     * Metodo para bajar la intensidad de las luces del suelo del pasillo
     *
     * @access public
     */
    public function bajarIntensidadLucesSueloPasillo() {

        self::$automata-> bajarIntensidadLucesSueloPasillo();

    }

    /**
     * Metodo para bajar la intensidad de las luces del suelo de los alumnos
     *
     * @access public
     */
    public function bajarIntensidadLucesSueloAlumnos() {

        self::$automata-> bajarIntensidadLucesSueloAlumnos();

    }

    /**
     * Metodo que devuelve el valor de la intensidad del suelo de los alumnos
     *
     * @access public
     * @return string
     */
    public function getIntesidadLucesSueloAlumnmos() {

        return self::$automata->getIntensidadAlumnos();

    }

    /////////////////////////////////////////////////////
    ////////////Funciones de los mirofonos///////////////
    /////////////////////////////////////////////////////

    /**
     * Metodo para encender o apagar de led del microfono $micro de la presidencia o de los atriles
     * @param <type> $micro
     * @param <type> $valor
     */
    public function setLedMicrofono($micro,$valor) {
        self::$automata->setLedMicrofono($micro,$valor);

    }

    /**
     * Metodo que devuelve si el led del microfono $micro de la presidencia o de los atriles esta encendido o no
     * @param <type> $micro
     * @return <type>
     */
    public function getLedMicrofono($micro) {

        return self::$automata->getLedMicrofono($micro);

    }

    /**
     * Metodo para encender o apagar el microfono $micro de la presidencia o de los atriles
     * @param <type> $micro
     * @param <type> $valor
     */
    public function setMicrofonoOn($micro,$valor) {

        self::$automata->setMicrofonoOn($micro,$valor);

    }

    /**
     * Metodo que devuelve si el microfono $micro de la presidencia o de los atriles esta encendido o no
     * @param <type> $micro
     * @return <type>
     */
    public function isMicrofonoOn($micro) {

        return self::$automata->isMicrofonoOn($micro);

    }

    /**
     * Metodo que mueve la camara a la posicion del microfono que se enciende, controlando
     * la cantidad de microfonos encendidos y sus posiciones. Incrementa la cantidad de
     * microfonos activos
     *
     * @access public
     * @param string $micro
     */
    public function activarMicrofono($micro) {

        self::$automata-> activarMicrofono($micro);

    }

    /**
     * Metodo que mueve la camara a la posicion del microfono que se enciende, controlando
     * la cantidad de microfonos encendidos y sus posiciones. Decrementa la cantidad de
     * microfonos activos
     * @param <type> $micro
     */
    public function desactivarMicrofono($micro) {

        self::$automata-> desactivarMicrofono($micro);

    }

    /**
     * Metodo para encender el led del microfono $micro
     *
     * @access public
     * @param string $micro
     */
    public function encenderLedMicrofono($micro) {

        self::$automata->encenderLedMicrofono($micro);

    }

    /**
     * Metodo para apagar el led del microfono $micro
     *
     * @access public
     * @param string $micro
     */
    public function apagarLedMicrofono($micro) {

        self::$automata->apagarLedMicrofono($micro);

    }
    ///////////////////////////////////////////
    ////////////Funciones pizarra//////////////
    ///////////////////////////////////////////

    /**
     * Metodo para encender la pizarra
     */
    public function showPizarra() {

        self::$automata->showPizarra();

    }
    /**
     * Metodo para apagar la pizarra
     */
    public function showPizarraApagar() {

        self::$automata->showPizarraApagar();

    }

    /**
     * Metodo que nos devueve si la pizarra esta apagada o encendida
     * @return <type>
     */
    public function isPizarraShow() {

        return self::$automata->isPizarraShow();
    }

    //////////////////////////////////
    /////////Funciones Vipx///////////
    //////////////////////////////////

    //    /**
    //     * Metodo para sacar una foto con la camara 1 o solo activar
    //     */
    //    public function activarVipx1() {
    //
    //        self::$automata->activarVipx1();
    //
    //    }
    //
    //    /**
    //     * Metodo para sacar una foto con la camara 2 o solo activar
    //     */
    //    public function activarVipx2() {
    //
    //        self::$automata->activarVipx2();
    //
    //    }



    ////////////////////////////////////////////////
    /////////Funciones pantalla electrica///////////
    ////////////////////////////////////////////////

    /**
     * Metodo para bajar la pantalla electrica
     */
    public function bajarPantalla() {

        self::$automata->bajarPantalla();

    }

    /**
     * Metodo para subir la pantalla electrica
     */
    public function subirPantalla() {

        self::$automata->subirPantalla();

    }

    /**
     * Metodo para tratar la informacion que se recibe del automata y enviarle al automata una respuesta.
     *
     * LUCES
     *
     * Si se pulsa el interruptor de la entrada, si la luz esta apagada y las luces no estan bloqueadas (interruptor=0),
     * las luces se encenderan, en caso contrario, si estan bloqueadas (interruptor=1), es q ya se a pulsado interruptor
     * antes para encender las luces
     *
     * Si se pulsa el interruptor de la entrada, si la luz esta encendida y las luces no estan bloqueadas (interruptro=0),
     * las luces se apagaran, en caso contrario, si estan bloqueadas (interruptor=1), es q ya se a pulsado el interruptor
     * antes y que en la sala hay un acto
     *
     * MICROFONOS
     *
     * Si al pulsar el interruptor de algun microfono este esta apagado, se encendera el led del interruptor, se activara
     * el microfono y se marcara el boton de la pantalla que indica que el microfono esta encendido. Si el microfono ya
     * estaba encendido, se apagara el led, se desactivara el microfono y se marcara en la pantalla que el microfono esta apagado
     *
     * PIZARRA
     *
     * Si al pulsar el interruptor de la pizarra, la pizarra esta encendida, se apagara. Y en caso contrario se encendera
     *
     * @access public
     */
    public function procesarComandoSala($comando) {

    //self::$automata->cargarEstado();
        /*
         * Pulsan el interruptor de la entrada de la sala
         */
    //Si la luz de la sala esta apagada y pulsan el interruptor
        if((strcmp($comando,self::$ARGIA)==0)&&(self::$automata->isLuz()==0)) {
        //Si las luces no estan bloqueadas (interruptor=0)
            if ($this->isLucesBloqueadas() ==0) {
            //encender la luz del suelo
                $this->encender();
                //encender la luz del techo
                AccesoControladoresDispositivos::$ctrlLuzTecho->encenderLucesTecho();
                echo "\nSe a pulsado el interruptor de la sala, las luces estan encendidas\n";
            } else {//Si las luces estan bloqueadas (interruptor=1)
                echo "La luz de sala ya esta encendida";
            }
        //Si la luz de la sala esta encendida y pulsan el interruptor
        } else  if((strcmp($comando,self::$ARGIA)==0)&&(self::$automata->isLuz()==1)) {
            //Si las luces no estan bloqueadas (interruptor=0)
                if ($this->isLucesBloqueadas() ==0) {
                //apagar la luz del suelo
                    $this->apagarLuzSala();
                    //apagar la luz del techo
                    AccesoControladoresDispositivos::$ctrlLuzTecho->apagarLucesTecho();
                    echo "\nSe a pulsado el interruptor de la sala, las luces estan apagadas";
                } else {//Si las luces estan bloqueadas (interruptor=1)
                    echo "No se puede apagar la luz: En la sala hay un acto";
                }
            }
        /*
         * Pulsan el interruptor del microfono 1 de la presidencia.
         */
            else if(strcmp(self::$MICPRESI_1, $comando)==0) {

                    if ($this->isMicrofonoOn("M1") ==0) {
                        AccesoControladoresDispositivos::$ctrlMesaMezclas->activarMicPresidencia("M1");
                        AccesoControladoresDispositivos::$ctrlAutomata->encenderLedMicrofono("M1");
                        AccesoGui::$guiSonido->activarMicroPresidencia("M1");

                    } else if ($this->isMicrofonoOn("M1") == 1) {
                            AccesoControladoresDispositivos::$ctrlMesaMezclas->desactivarMicPresidencia("M1");
                            AccesoControladoresDispositivos::$ctrlAutomata->apagarLedMicrofono("M1");
                            AccesoGui::$guiSonido->desactivarMicroPresidencia("M1");

                        }
                }
                /*
                 * Pulsan el interruptor del microfono 2 de la presidencia
                 */
                else if(strcmp(self::$MICPRESI_2, $comando)==0) {
                        if ($this->isMicrofonoOn("M2") == 0) {
                            AccesoControladoresDispositivos::$ctrlMesaMezclas->activarMicPresidencia("M2");
                            AccesoControladoresDispositivos::$ctrlAutomata->encenderLedMicrofono("M2");
                            AccesoGui::$guiSonido->activarMicroPresidencia("M2");

                        } else if ($this->isMicrofonoOn("M2") == 1) {
                                AccesoControladoresDispositivos::$ctrlMesaMezclas->desactivarMicPresidencia("M2");
                                AccesoControladoresDispositivos::$ctrlAutomata->apagarLedMicrofono("M2");
                                AccesoGui::$guiSonido->desactivarMicroPresidencia("M2");

                            }
                    }
                    /*
                     * Pulsan el interruptor del microfono 3 de la presidencia
                     */
                    else if(strcmp(self::$MICPRESI_3, $comando)==0) {
                            if ($this->isMicrofonoOn("M3") == 0) {
                                AccesoControladoresDispositivos::$ctrlMesaMezclas->activarMicPresidencia("M3");
                                AccesoControladoresDispositivos::$ctrlAutomata->encenderLedMicrofono("M3");
                                AccesoGui::$guiSonido->activarMicroPresidencia("M3");

                            } else if ($this->isMicrofonoOn("M3") == 1) {
                                    AccesoControladoresDispositivos::$ctrlMesaMezclas->desactivarMicPresidencia("M3");
                                    AccesoControladoresDispositivos::$ctrlAutomata->apagarLedMicrofono("M3");
                                    AccesoGui::$guiSonido->desactivarMicroPresidencia("M3");

                                }
                        }
                        /*
                         * Pulsan el interruptor del microfono 4 de la presidencia
                         */
                        else if(strcmp(self::$MICPRESI_4, $comando)==0) {
                                if ($this->isMicrofonoOn("M4") == 0) {

                                    AccesoControladoresDispositivos::$ctrlMesaMezclas->activarMicPresidencia("M4");
                                    AccesoControladoresDispositivos::$ctrlAutomata->encenderLedMicrofono("M4");
                                    AccesoGui::$guiSonido->activarMicroPresidencia("M4");
                                } else if ($this->isMicrofonoOn("M4") == 1) {
                               
                                        AccesoControladoresDispositivos::$ctrlMesaMezclas->desactivarMicPresidencia("M4");
                                        AccesoControladoresDispositivos::$ctrlAutomata->apagarLedMicrofono("M4");
                                        AccesoGui::$guiSonido->desactivarMicroPresidencia("M4");
                                    }
                            }
                            /*
                             * Pulsan el interruptor del microfono del atril1
                             */

                            else if(strcmp(self::$MICATRIL, $comando)==0) {
                                    if ($this->isMicrofonoOn("M5") == 0) {
                                        AccesoControladoresDispositivos::$ctrlMesaMezclas->activarMicPresidencia("M5");
                                        AccesoControladoresDispositivos::$ctrlAutomata->encenderLedMicrofono("M5");
                                        AccesoGui::$guiSonido->activarMicroPresidencia("M5");
                                    } else if ($this->isMicrofonoOn("M5") == 1) {
                                            AccesoControladoresDispositivos::$ctrlMesaMezclas->desactivarMicPresidencia("M5");
                                            AccesoControladoresDispositivos::$ctrlAutomata->apagarLedMicrofono("M5");
                                            AccesoGui::$guiSonido->desactivarMicroPresidencia("M5");
                                        }
                                }
                                          /*
         * Pulsan el interruptor del microfono del atril2
         */


                                else if(strcmp(self::$MICATRIL2, $comando)==0) {
                                        if ($this->isMicrofonoOn("M6") == 0) {
                                            AccesoControladoresDispositivos::$ctrlMesaMezclas->activarMicPresidencia("M6");
                                            AccesoControladoresDispositivos::$ctrlAutomata->encenderLedMicrofono("M6");
                                            AccesoGui::$guiSonido->activarMicroPresidencia("M6");
                                        } else if ($this->isMicrofonoOn("M6") == 1) {
                                                AccesoControladoresDispositivos::$ctrlMesaMezclas->desactivarMicPresidencia("M6");
                                                AccesoControladoresDispositivos::$ctrlAutomata->apagarLedMicrofono("M6");
                                                AccesoGui::$guiSonido->desactivarMicroPresidencia("M6");
                                            }
                                    }

                                                /*
         * Pulsan el interruptor de la pizarra
         */

                                    else if(strcmp($comando,self::$SHOWMEPIZARRA)==0) {
                                            if ($this->isPizarraShow() == 0) {
                                                echo "\npizarra show\n";
                                                $this->showPizarra();
                                            } else if ($this->isPizarraShow() == 1) {
                                                    echo "\npizarra apagar\n";
                                                    $this->showPizarraApagar();

                                                }
                                        }
    }
}


?>
