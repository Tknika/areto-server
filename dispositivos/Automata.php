
<?php
/**
 * page-level  package
 *
 *  @package PHP::dispositivos
 *
 */
/**
* includes
*
*/
require_once './dispositivos/DispositivoSerie.php';
require_once 'AccesoControladoresDispositivos.php';
require_once './dispositivos/Camara.php';

/**
 * Descripcion clase Automata
 *
 * Clase para controlar las luces del suelo, leds de los microfonos, la pantalla e
 * lectrica, rack, ordenador tactil de la presidencia,....
 *
 *  @package PHP::dispositivos
 *
 */
class Automata extends DispositivoSerie {


    /**
     * Valores por defecto de todos los parametros que forman el comando del automata(iguales que los del archivo estadoDispositivos.properties)
     */

    private $activarRack=array("rack"=>1);
    //pantalla tactil presidencia (valores: 1 o 0)
    private $activarPrestactil=array("presTact"=>1);
    //leds de los microfonos (valores: 1 o 0)
    private $ledMic=array("M12"=>0,"M6"=>0,"M5"=>0,"M4"=>0,"M3"=>0,"M2"=>0,"M1"=>0);
    //parametro para definir la intensidad de las luces del suelo (valores; 0000,03D0,07D0)
    private $intensidadSuelo=array("p1"=>"03D0","p2"=>"03D0","alum1"=>"03D0","alum2"=>"03D0","alum3"=>"03D0","alum4"=>"03D0","alum5"=>"03D0");
    //led de la pizarra (valores: 1 o 0)
    private $pizarra=array("show"=>0);
    //indicadores para sacar las fotos (valores: 1 o 0)
    private $foto=array("vipx2"=>0,"vipx1"=>0);
    //subir o bajar la pantalla electrica 1 o 0
    private $pantalla=array("bpan"=>0,"span"=>0);
    //activar o desactivar redThinkClient 1 o 0
    private $thinkClient=array("f567"=>0,"f34"=>0,"f12"=>0);
    //encender o apagar la luz del techo 1 o 0
    private $activarDispositivosTecho=array("techo"=>1);
    //encender o apagar luces del suelo 1 o 0
    private $activarLuzSuelo=array("l567"=>0,"l34"=>0,"l12"=>0);

    /**
     * Atributos para controlar el estado del automata
     */
    private $mic=array("M12"=>0,"M6"=>0,"M5"=>0,"M4"=>0,"M3"=>0,"M2"=>0,"M1"=>0);
    //estado luz sala
    private $luz=0;
    //estado pantalla electrica
    private $pantallaElectrica=0;
    //estado pizarra
    private $showme = 0;
    //para calcular la posicion del microfono o microfonos que estan encendidos
    private $microfonosActivos=0;
    private $numeroMicrofonosActivos=0;
    //interruptor de la entrada
    private $interruptor=0;
    //valores posibles de la intensidad de la luz del suelo
    public static $intensidades=array("minima"=>"0000","media"=>"03D0","maxima"=>"07D0");

    function  __construct($dispositivo) {

        $this->tipoDispositivo="Automata";
        parent::__construct($dispositivo);
        echo($this->ip."-".$this->modeloIPLT."-".$this->strMarca."-".$this->strModelo."-".$this->id_disp."-".$this->tipoPuerto."-".$this->numeroPuerto."-".$this->baudRate."-".$this->timeOut."-".$this->puerto."-".$this->password);
//        $this->cargarEstado();
    }


    /**
     * Funcion que para encender ($valor=1) o apagar ($valor=0) el led de un determinado microfono ($mic).
     * Despues de realizar el cambio, lo guarda en el archivo estadoDispositivos.properties
     *
     *
     * @access public
     * @param string $mic  M1, M2, M3, M4, M5, M6
     * @param bit $valor 0 o 1
     *
     * @link Properties::guardarEstado()
     */
    public function setLedMicrofono($mic,$valor) {

        $this->ledMic[$mic]=$valor;
        $this->guardarEstado();

    }

    /**
     * Metodo para saber si el led de el microfono $micro esta encendido o apagado
     *
     * @access public
     * @param string $micro
     * @return bit devuelve 1 si el led esta encendido y 0 si esta apagado
     *
     * @link Properties::guardarEstado()
     */
    public function getLedMicrofono($micro) {

        return $this->ledMic[$micro];

    }


    /**
     *  Funcion que para encender ($valor=1) o apagar ($valor=0) un determinado microfono ($mic).
     * Despues de realizar el cambio, lo guarda en el archivo estadoDispositivos.properties
     *
     * @access public
     * @param string $mic
     * @param bit $valor
     *
     * @link Properties::guardarEstado()
     */
    public function setMicrofonoOn($mic,$valor) {

        $this->mic[$mic]=$valor;
        $this->guardarEstado();

    }

    /**
     * Metodo para guardar el estado de la luz como endendido
     *
     * @access public
     *
     * @link Properties::guardarEstado()
     *
     */
    public function encenderLuz() {

        $this->luz=1;
        $this->guardarEstado();

    }

    /**
     * Metodo para guardar el estado de la luz como apagado
     *
     * @access public
     *
     * @link Properties::guardarEstado()
     *
     */
    public function apagarLuz() {

        $this->luz=0;
        $this->guardarEstado();

    }


    /**
     * Metodo que indica si la luz esta apagada o encendida
     *
     * @return bit si la luz esta encendida devolvera un 1 y si esta apagada un 0
     */
    public function isLuz() {

        return $this->luz;

    }

    /**
     * Metodo que indica si la pizarra esta encendida o apagada
     *
     * @access public
     * @return bit si esta encendida devolvera un 1 y si no un 0
     */
    public function isPizarraShow() {

        return $this->showme;

    }

    /**
     *Indica si el microfono pasado como parametro esta encendido o no
     *
     * @param string $micro
     * @return string Si el microfono esta apagado devolvera 0 y si no 1
     */
    public function isMicrofonoOn($micro) {

        return $this->mic[$micro];
    }

    /**
     *
     */
    /**
     * Devuelve el valor de la intesidad pasada como parametro
     *
     * @access public
     * @param string $intensidad
     * @return string Devolvera la intensidad en hexadecimal
     */
    public function getDescripcionIntensidad($intensidad) {

        return self::$intensidades[$intensidad];

    }

    /**
     * Metodo para dar la intensidad a la linea (alumnos o pasillo). Los valores de intensidad
     * aceptados son: minima, media y maxima
     *
     * @access public
     * @param string $linea
     * @param string $intensidad
     */
    public function setIntensidadLinea($linea,$intensidad) {

        $this->intensidadSuelo[$linea]=$intensidad;

    }


/**
 * Devuelve la intesidad de la luz de la linea (alumnos o pasillo) que se pasa como parametro
     *
     * @access public
     * @param string $linea
     * @return string $intendidad
 */
    public function getIntensidadLinea($linea) {

        return $this->intensidadSuelo[$linea];
    }

/**
     * Metodo para poner la intensidad que se pasa como parametro a las luces del pasillo
     *
     * @access public
     * @param string $intensidad
 */
    public function setIntensidadPasillo($intensidad) {

        $this->setIntensidadLinea("p1", $intensidad);
        $this->setIntensidadLinea("p2", $intensidad);

    }

    /**
     * Devuelve la intensidad de la luz del pasillo
     *
     * @access public
     * @return string El valor de la intensidad sera devuelto en hexadecimal
     */
    public function getIntensidadPasillo() {

        $intensidad=$this->getIntensidadLinea("p1").$this->getIntensidadLinea("p2");
        return $intensidad;

    }


   /**
 * Funcion para poner la intensidad que se pasa como parametro a las luces de los alumnos
     *
     * @access public
     * @param string $intensidad
 */
    public function setIntensidadAlumnos($intensidad) {

        $this->setIntensidadLinea("alum1", $intensidad);
        $this->setIntensidadLinea("alum2", $intensidad);
        $this->setIntensidadLinea("alum3", $intensidad);
        $this->setIntensidadLinea("alum4", $intensidad);
        $this->setIntensidadLinea("alum5", $intensidad);

    }


/**
     * Metodo que devuelve la intensidad de la luz de los alumnos
     *
     * @access public
     * @return string El valor de la intensidad en hexadecimal
     */
    public function getIntensidadAlumnos() {

        $intensidad=$this->getIntensidadLinea("alum1").$this->getIntensidadLinea("alum2").$this->getIntensidadLinea("alum3").$this->getIntensidadLinea("alum4").$this->getIntensidadLinea("alum5");
        return $intensidad;

    }

    /**
     * Metodo para subir la intensidad de luz de la linea pasada como parametro
     *
     * @access public
     * @param string $linea
     */
    public function subirIntensidadLinea($linea) {

        $intensidad="";
        if($this->getIntensidadLinea($linea)==self::$intensidades["minima"]) {
            $this->setIntensidadLinea($linea, self::$intensidades["media"]);
        }
        else if($this->getIntensidadLinea($linea)==self::$intensidades["media"]) {
                $this->setIntensidadLinea($linea, self::$intensidades["maxima"]);
            }
    }

 /**
     * Metodo para bajar la intensidad de luz de la linea pasada como parametro
     *
     * @access public
     * @param string $linea
     */
    public function bajarIntensidadLinea($linea) {

        $intensidad="";
        if($this->getIntensidadLinea($linea)==self::$intensidades["maxima"]) {
            $this->setIntensidadLinea($linea, self::$intensidades["media"]);
        }
        else if($this->getIntensidadLinea($linea)==self::$intensidades["media"]) {
                $this->setIntensidadLinea($linea, self::$intensidades["minima"]);
            }
    }

    /**
     * Metodo para poner el interruptor de la sala en 1. Despues de realizar
     * el cambio, lo guardara en el archivo estadoDispositivos.properties
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function bloquearLuces() {

        $this->interruptor=1;
        $this->guardarEstado();

    }

    /**
     * Metodo para poner el interruptor de la sala en 0. Despues de realizar
     * el cambio, lo guardara en el archivo estadoDispositivos.properties
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function desbloquearLuces() {

        $this->interruptor=0;
        $this->guardarEstado();

    }


    /**
     * Metodo que nos indicara si el interruptor de la sala esta bloqueado o no
     *
     * @access public
     * @return bit Si el interruptor esta bloqueado nos devolvera un 1 y si no un 0
     */
    public function isLucesBloqueadas() {

        //$this->cargarEstado();
        return $this->interruptor;

    }

    /**
     * Metodo para encender las luces del pasillo y los alumnos con el nivel de
     * luz indicado en el parametro y envia el comando al automata
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     * @param string $nivel
     */
    public function encenderLuzSala($nivel) {

        $this->luz=1;
        $this->activarLuzSuelo["l567"]=1;
        $this->activarLuzSuelo["l34"]=1;
        $this->activarLuzSuelo["l12"]=1;
        $this->setIntensidadPasillo($nivel);
        $this->setIntensidadAlumnos($nivel);
        $comando=$this->procesarComando("", "");
        $this->enviarComando($comando);
        $this->guardarEstado();

    }

     /**
     * Metodo para apagar las luces del pasillo y los alumnos, apagar los
     * redThinkClient y enviar el comando al automata
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function apagarLuzSala() {

        $this->luz=0;
        $this->activarLuzSuelo["l567"]=0;
        $this->activarLuzSuelo["l34"]=0;
        $this->activarLuzSuelo["l12"]=0;
        $this->thinkClient["f567"]=0;
        $this->thinkClient["f34"]=0;
        $this->thinkClient["f12"]=0;
        $comando=$this->procesarComando("", "");
        $this->enviarComando($comando);
        $this->guardarEstado();

    }
     /**
     * Metodo para enciender las luces del pasillo y los alumnos con intensidad de luz media,
     * (03D0), enciender los redThikClient y enviar el comando al automata. Este es el estado
     * en el que se queda la sala al iniciar el sistema
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */

    public function iniciar() {

        $this->luz=1;
        $this->activarLuzSuelo["l567"]=1;
        $this->activarLuzSuelo["l34"]=1;
        $this->activarLuzSuelo["l12"]=1;
        $this->thinkClient["f567"]=1;
        $this->thinkClient["f34"]=1;
        $this->thinkClient["f12"]=1;
        $this->setIntensidadPasillo(self::$intensidades["media"]);
        $this->setIntensidadAlumnos(self::$intensidades["media"]);
        $comando=$this->procesarComando("", "");
        $this->enviarComando($comando);
        $this->guardarEstado();

    }
     /**
     * Metodo para apagar las luces (del suelo), subir la pantalla electrica,
     * poner la intensidad media en el suelo y enviar el comando al automata. Este
     * es el estado en el que se queda la sala al salir del sistema
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     * @access public
     * @link Properties::guardarEstado()
     */
    public function principio() {

        $this->luz=1;
        $this->activarLuzSuelo["l567"]=0;
        $this->activarLuzSuelo["l34"]=0;
        $this->activarLuzSuelo["l12"]=0;
        $this->thinkClient["f567"]=0;
        $this->thinkClient["f34"]=0;
        $this->thinkClient["f12"]=0;
        $this->pantalla["span"]=1;
        $this->pantalla["bpan"]=0;
        $this->setIntensidadPasillo(self::$intensidades["media"]);
        $this->setIntensidadAlumnos(self::$intensidades["media"]);
        $this->pantallaElectrica=0;
        $comando=$this->procesarComando("", "");
        $this->enviarComando($comando);
        $this->guardarEstado();

    }

 /**
     * Metodo para encender con el nivel de luz medio las luces de los alumnos y minimo las del pasillo,
  * activa los redThinkClient, baja la pantalla electrica y envia el comando al automata
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php

     *  * @access public
     * @link Properties::guardarEstado()
     */
    public function escenarioEnviarClase() {

        $this->luz=1;
        $this->activarLuzSuelo["l567"]=1;
        $this->activarLuzSuelo["l34"]=1;
        $this->activarLuzSuelo["l12"]=1;
        $this->thinkClient["f567"]=1;
        $this->thinkClient["f34"]=1;
        $this->thinkClient["f12"]=1;
        $this->setIntensidadPasillo(self::$intensidades["minima"]);
        $this->setIntensidadAlumnos(self::$intensidades["media"]);
        $this->pantalla["span"]=0;
        $this->pantalla["bpan"]=1;
        $this->pantallaElectrica=1;
        $comando=$this->procesarComando("", "");
        $this->enviarComando($comando);
        $this->guardarEstado();

    }
    /**
     * Activa los redThinkClient y envia el comando al automata.
     *
     * Una vez hechos todos los cambios, los guarda en el archivo estadoDispositivos.php
     * @access public
     * @link Properties::guardarEstado()
     */
    public function iniciarThinkClient() {

        $this->thinkClient["f567"]=1;
        $this->thinkClient["f34"]=1;
        $this->thinkClient["f12"]=1;
        $comando=$this->procesarComando("", "");
        $this->enviarComando($comando);
        $this->guardarEstado();

    }

    /**
     * Metodo para bajar la pantalla electrica y enviar el comando al automata
     *
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function bajarPantalla() {

        $this->pantalla["span"]=0;
        $this->pantalla["bpan"]=1;
        $this->pantallaElectrica=1;
        $comando=$this->procesarComando("", "");
        $this->enviarComando($comando);
        $this->guardarEstado();

    }

    /**
     * Sube la pantalla electrica y
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function subirPantalla() {

        $this->pantalla["span"]=1;
        $this->pantalla["bpan"]=0;
        $this->pantallaElectrica=0;
        $comando=$this->procesarComando("", "");
        $this->enviarComando($comando);
        $this->guardarEstado();

    }

    /**
     * Activa y enciende las luces del suelo con intensidad de luz maxima y envia el comando al automata
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function encenderLucesSuelo() {

        $this->activarLuzSuelo["l567"]=1;
        $this->activarLuzSuelo["l34"]=1;
        $this->activarLuzSuelo["l12"]=1;
        $this->setIntensidadPasillo(self::$intensidades["maxima"]);
        $this->setIntensidadAlumnos(self::$intensidades["maxima"]);
        $comando=$this->procesarComando("", "");
        $this->enviarComando($comando);
        $this->guardarEstado();

    }

/**
 * Activa y enciede la luz del pasillo con intensidad maxima y envia el comando al automata
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
 */
    public function encenderLucesSueloPasillo() {

        $this->activarLuzSuelo["l12"]=1;
        $this->setIntensidadPasillo(self::$intensidades["maxima"]);
        $comando=$this->procesarComando("", "");
        $this->enviarComando($comando);
        $this->guardarEstado();
    }

/**
 * Activa y enciede la luz de los alumnos con intensidad maxima y envia el comando al automata
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
 */
    public function encenderLucesSueloAlumnos() {

        $this->activarLuzSuelo["l567"]=1;
        $this->activarLuzSuelo["l34"]=1;
        $this->setIntensidadAlumnos(self::$intensidades["maxima"]);
        $comando=$this->procesarComando("", "");
        $this->enviarComando($comando);
        $this->guardarEstado();

    }
/**
 * Desactiva y apaga la luz del suelo, poniendo la intensidad de la luz al minimo y envia el comando al automata
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
 */
    public function apagarLucesSuelo() {

        $this->activarLuzSuelo["l567"]=0;
        $this->activarLuzSuelo["l34"]=0;
        $this->activarLuzSuelo["l12"]=0;
        $this->setIntensidadPasillo(self::$intensidades["minima"]);
        $this->setIntensidadAlumnos(self::$intensidades["minima"]);
        $comando=$this->procesarComando("", "");
        $this->enviarComando($comando);
        $this->guardarEstado();

    }

/**
 * Desactiva y apaga la luz del pasillo, poniendo la intensidad de la luz al minimo y envia el comando al automata
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
 */
    public function apagarLucesSueloPasillo() {

        $this->activarLuzSuelo["l12"]=0;
        $this->setIntensidadPasillo(self::$intensidades["minima"]);
        $comando=$this->procesarComando("", "");
        $this->enviarComando($comando);
        $this->guardarEstado();

    }

/**
 * Desactiva y apaga la luz de los alumnos, poniendo la intensidad de la luz al minimo y envia el comando al automata
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
 */
    public function apagarLucesSueloAlumnos() {

        $this->activarLuzSuelo["l567"]=0;
        $this->activarLuzSuelo["l34"]=0;
        $this->setIntensidadAlumnos(self::$intensidades["minima"]);
        $comando=$this->procesarComando("", "");
        $this->enviarComando($comando);
        $this->guardarEstado();

    }

/**
 * Sube la intensidad de la luz del pasillo y envia el comando al automata
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
 */
    public function subirIntensidadLucesSueloPasillo() {

        $this->subirIntensidadLinea("p1");
        $this->subirIntensidadLinea("p2");
        $comando=$this->procesarComando("", "");
        $this->enviarComando($comando);

    }
/**
 * Sube la intensidad de la luz de los alumnos y envia el comando al automata
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
 */
    public function subirIntensidadLucesSueloAlumnos() {

        $this->subirIntensidadLinea("alum1");
        $this->subirIntensidadLinea("alum2");
        $this->subirIntensidadLinea("alum3");
        $this->subirIntensidadLinea("alum4");
        $this->subirIntensidadLinea("alum5");
        $comando=$this->procesarComando("", "");
        $this->enviarComando($comando);
    }
/**
 * Baja la intensidad de la luz del pasillo y envia el comando al automata
 */
    public function bajarIntensidadLucesSueloPasillo() {

        $this->bajarIntensidadLinea("p1");
        $this->bajarIntensidadLinea("p2");
        $comando=$this->procesarComando("", "");
        $this->enviarComando($comando);
    }
/**
 * Baja la intensidad de la luz de los alumnos y envia el comando al automata
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
 */
    public function bajarIntensidadLucesSueloAlumnos() {

        $this->bajarIntensidadLinea("alum1");
        $this->bajarIntensidadLinea("alum2");
        $this->bajarIntensidadLinea("alum3");
        $this->bajarIntensidadLinea("alum4");
        $this->bajarIntensidadLinea("alum5");
        $comando=$this->procesarComando("", "");
        $this->enviarComando($comando);

    }
/**
 * Activa el microfono pasado como parametro y coloca la camara en la posicion indicada. La posicion de la camara
 * depende del numero del microfono activado, si solo hay un microfono activo la camara se colocara en la posicion
 * ese microfono, si hay mas de un microfono la posicion cogera un plano general de la presidencia
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     *
     * @param string $micro
 */
    public function activarMicrofono($micro) {

        $this->numeroMicrofonosActivos++;
        $desplazamiento=1<<(substr($micro,-1)-1);
        $this->microfonosActivos = $this->microfonosActivos + $desplazamiento;
        if ($this->numeroMicrofonosActivos==1)
            AccesoControladoresDispositivos::$ctrlCamaras->presetCamaraPresidencia(substr($micro,-1));
        else {
            AccesoControladoresDispositivos::$ctrlCamaras->presetCamaraPresidencia(10);}
        $this->guardarEstado();

    }

    /**
     * Desactiva el microfono pasado como parametro, si una vez desactivado este
     * hay mas de un microfono activo o no hay ninguno, mantendra el plano
     * general, si solo queda uno, calculara la posicion de este microfono y
     * movera la camara hasta esa posicion.
     *
     * Para calcular la posicion del microfono se utiliza la variable microfonosActivos, q indicara el bit (o bits) que
     * estan activos
     *
     *                     M6 M5 M4 M3 M2 M1
     * microfonosActivos   32 16  8  4  2  1
     *
     * Una vez hechos todos los cambios, los guardara en el archivo
     * estadoDispositivos.php
     *
     * @param string $micro
     * @access public
     * @link Properties::guardarEstado()
     */
    public function desactivarMicrofono($micro) {

        $this->numeroMicrofonosActivos--;
        $desplazamiento=1<<(substr($micro,-1)-1);
        $this->microfonosActivos = $this->microfonosActivos - $desplazamiento;
        if ($this->numeroMicrofonosActivos!=1) {

            AccesoControladoresDispositivos::$ctrlCamaras->presetCamaraPresidencia(10);}
        else {
            $preset=(log10($this->microfonosActivos)/log10(2))+1;
            AccesoControladoresDispositivos::$ctrlCamaras->presetCamaraPresidencia($preset);}
        $this->guardarEstado();

    }

    //    public function  calcularPresetCamara() {
    //    /**
    //     * Metodo para calcular el numero de preset a el que la camara se tiene que mover
    //     */
    //        if ($this->microfonosActivos != 1) {
    //            AccesoControladoresDispositivos::$ctrlCamaras->presetCamaraPresidencia("a");
    //
    //        } else {
    //            $i = 1;
    //            $mic = 1;
    //            while ($i < $this->numeroMicrofonosActivos) {
    //                $i = $i << 1;
    //                $mic++;
    //            }
    //            AccesoControladoresDispositivos::$ctrlCamaras->presetCamaraPresidencia($mic);
    //        }
    //    }

    /**
     * Enciende y activa el led del microfono que se le pasa como parametro y
     * envia el comando al automata
     *
     * Una vez hechos todos los cambios, los guardara en el archivo
     * estadoDispositivos.php
     *
     * @param string $micro
     * @access public
     * @link Properties::guardarEstado()
     */
    public function encenderLedMicrofono($micro) {

        $this->luz=1;
        $this->setMicrofonoOn($micro, 1);
        $this->setLedMicrofono($micro, 1);
        $comando=$this->procesarComando("", "");
        $this->enviarComando($comando);
        $this->activarMicrofono($micro);
        $this->guardarEstado();

    }

    /**
     * Apaga y desactiva el led del microfono que se le pasa como parametro y
     * envia el comando al automata
     *
     * Una vez hechos todos los cambios, los guardara en el archivo e
     * stadoDispositivos.php
     *
     * @param string $micro
     * @access public
     * @link Properties::guardarEstado()
     */
    public function apagarLedMicrofono($micro) {
        $this->luz=1;
        $this->setMicrofonoOn($micro, 0);
        $this->setLedMicrofono($micro, 0);
        $comando=$this->procesarComando("", "");
        $this->enviarComando($comando);
         $this->desactivarMicrofono($micro);
        $this->guardarEstado();

    }
/**
     * Activa el vipx1 para que saque una foto y envia el comando al automata,
     * despues de sacar la foto lo
 * desactiva y vuelve a mandar el comando
     *
     * @access public
 */
    public function activarVipx1() {

        $this->foto["vipx1"]=1;
        $this->foto["vipx2"]=0;
        $comando=$this->procesarComando("", "");
        $this->enviarComando($comando);
        try {
            usleep(1000000);
        }
        catch (Exception $e ) {

        }
        $this->foto["vipx1"]=0;
        $this->foto["vipx2"]=0;
        $comando=$this->procesarComando("", "");
        $this->enviarComando($comando);

    }

/**
     * Activa el vipx2 para que saque una foto y envia el comando al automata,
     * despues de sacar la foto lo
 * desactiva y vuelve a mandar el comando
     *
     * @access public
 */
    public function activarVipx2() {

        $this->foto["vipx1"]=0;
        $this->foto["vipx2"]=1;
        $comando=$this->procesarComando("", "");
        $this->enviarComando($comando);
        try {
            usleep(1000000);
        }
        catch (Exception $e ) {

        }
        $this->foto["vipx1"]=0;
        $this->foto["vipx2"]=0;
        $comando=$this->procesarComando("", "");
        $this->enviarComando($comando);

    }
/**
     * Activa y enciende la pizarra, pone la camara en la posicion de la pizarra
     * y envia el comando al automata
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
 */
    public function showPizarra() {

        $this->pizarra["show"]=1;
        $this->showme=1;
        AccesoControladoresDispositivos::$ctrlCamaras->presetCamaraPresidencia(7);
        $comando=$this->procesarComando("", "");
        $this->enviarComando($comando);
        $this->guardarEstado();

    }
 /**
     * Desactiva y apaga la pizarra, pone la camara en la posicion de plano general
     * y envia el comando al automata
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
 */
    public function showPizarraApagar() {

        $this->pizarra["show"]=0;
        $this->showme=0;
        AccesoControladoresDispositivos::$ctrlCamaras->presetCamaraPresidencia(10);
        $comando=$this->procesarComando("", "");
        $this->enviarComando($comando);
        $this->guardarEstado();

    }

   /**
     * Devuelve el comando que se le mandara al automata, utilizando los atributos,
     * tratandolos y uniendolos formando
     * el comando necesario para que el automata respondaç
     *
     * @access public
     * @param string $comando
     * @param string $parametro
    */
    public function procesarComando($comando,$parametro) {

        $pizarra="";
        $foto="";
        $leds="";
        $pantalla="";
        $luces="";
        $rack="";
        $prestact="";
        $redThinkClient="";
        $techo="";
        $intensidades="";
        foreach ($this->pizarra as $element=>$value)
            $pizarra=$pizarra.$value;
        foreach ($this->foto as $element=>$value)
            $foto=$foto.$value;
        foreach ($this->ledMic as $element=>$value)
            $leds=$leds.$value;
        foreach ($this->pantalla as $element=>$value)
            $pantalla=$pantalla.$value;
        foreach ($this->activarLuzSuelo as $element=>$value)
            $luces=$luces.$value;
        foreach ($this->activarRack as $element=>$value)
            $rack=$rack.$value;
        foreach ($this->activarDispositivosTecho as $element=>$value)
            $techo=$techo.$value;
        foreach ($this->thinkClient as $element=>$value)
            $redThinkClient=$redThinkClient.$value;
        foreach ($this->activarPrestactil as $element=>$value)
            $prestact=$prestact.$value;
        foreach ($this->intensidadSuelo as $element=>$value)
            $intensidades=$intensidades.$value;
        $comando=Utils::bitaZenbakira("000000".$pizarra.$foto.$leds."0").Utils::bitaZenbakira($pantalla."0000".$luces.$rack.$techo.$redThinkClient.$prestact."0").$intensidades."ok";
        return $comando;

    }

/**
     * Carga en los atributos los valores que se encuentran en el archivo
     * estadoDispositivos.properties
 */
    public function cargarEstado() {

        $this->estadoDispositivo=new Properties();
        $this->estadoDispositivo->load(file_get_contents("./estadoDispositivos.properties"));
        $this->pizarra["show"]=$this->estadoDispositivo->getProperty("Automata.showPizarra");
        $this->foto["vipx1"]=$this->estadoDispositivo->getProperty("Automata.vipx1");
        $this->foto["vipx2"]=$this->estadoDispositivo->getProperty("Automata.vipx2");
        $this->mic["M5"]=$this->estadoDispositivo->getProperty("Automata.atril1");
        $this->mic["M6"]=$this->estadoDispositivo->getProperty("Automata.atril2");
        $this->mic["M1"]=$this->estadoDispositivo->getProperty("Automata.m1");
        $this->mic["M2"]=$this->estadoDispositivo->getProperty("Automata.m2");
        $this->mic["M3"]=$this->estadoDispositivo->getProperty("Automata.m3");
        $this->mic["M4"]=$this->estadoDispositivo->getProperty("Automata.m4");
        $this->ledMic["M5"]=$this->estadoDispositivo->getProperty("Automata.ledAtril1");
        $this->ledMic["M6"]=$this->estadoDispositivo->getProperty("Automata.ledAtril2");
        $this->ledMic["M1"]=$this->estadoDispositivo->getProperty("Automata.ledM1");
        $this->ledMic["M2"]=$this->estadoDispositivo->getProperty("Automata.ledM2");
        $this->ledMic["M3"]=$this->estadoDispositivo->getProperty("Automata.ledM3");
        $this->ledMic["M4"]=$this->estadoDispositivo->getProperty("Automata.ledM4");
        $this->pantalla["bpan"]=$this->estadoDispositivo->getProperty("Automata.bpan");
        $this->pantalla["span"]=$this->estadoDispositivo->getProperty("Automata.span");
        $this->activarLuzSuelo["l567"]=$this->estadoDispositivo->getProperty('Automata.l567');
        $this->activarLuzSuelo["l34"]=$this->estadoDispositivo->getProperty('Automata.l34');
        $this->activarLuzSuelo["l12"]=$this->estadoDispositivo->getProperty('Automata.l12');
        $this->thinkClient["f567"]=$this->estadoDispositivo->getProperty('Automata.f567');
        $this->thinkClient["f34"]=$this->estadoDispositivo->getProperty('Automata.f34');
        $this->thinkClient["f12"]=$this->estadoDispositivo->getProperty('Automata.f12');
        $this->activarRack["rack"]=$this->estadoDispositivo->getProperty('Automata.rack');
        $this->activarDispositivosTecho["techo"]=$this->estadoDispositivo->getProperty("Automata.techo");
        $this->activarPrestactil["presTact"]=$this->estadoDispositivo->getProperty("Automata.presTact");
        $this->intensidadSuelo["p1"]=$this->estadoDispositivo->getProperty("Automata.p1");
        $this->intensidadSuelo["p2"]=$this->estadoDispositivo->getProperty("Automata.p2");
        $this->intensidadSuelo["alum1"]=$this->estadoDispositivo->getProperty("Automata.alum1");
        $this->intensidadSuelo["alum2"]=$this->estadoDispositivo->getProperty("Automata.alum2");
        $this->intensidadSuelo["alum3"]=$this->estadoDispositivo->getProperty("Automata.alum3");
        $this->intensidadSuelo["alum4"]=$this->estadoDispositivo->getProperty("Automata.alum4");
        $this->intensidadSuelo["alum5"]=$this->estadoDispositivo->getProperty("Automata.alum5");
        $this->luz=$this->estadoDispositivo->getProperty("Automata.luz");
        $this->pantallaElectrica=$this->estadoDispositivo->getProperty("Automata.pantallaElectrica");
        $this->showme=$this->estadoDispositivo->getProperty("Automata.showme");
        $this->interruptor=$this->estadoDispositivo->getProperty("Automata.interruptor");
        $this->microfonosActivos=$this->estadoDispositivo->getProperty("Automata.microsActivos");
        $this->numeroMicrofonosActivos=$this->estadoDispositivo->getProperty("Automata.numeroMicrofonosActivos");
    }

/**
 * Guarda los valores de los atributos en el archivo estadoDispositivos.properties
 */
    public function guardarEstado() {

        $this->estadoDispositivo=new Properties();
        $this->estadoDispositivo->load(file_get_contents("./estadoDispositivos.properties"));
        $this->estadoDispositivo->setProperty("Automata.showPizarra",$this->pizarra["show"]);
        $this->estadoDispositivo->setProperty("Automata.vipx1",$this->foto["vipx1"]);
        $this->estadoDispositivo->setProperty("Automata.vipx2", $this->foto["vipx2"]);
        $this->estadoDispositivo->setProperty("Automata.atril1",$this->mic["M5"]);
        $this->estadoDispositivo->setProperty("Automata.atril2",$this->mic["M6"]);
        $this->estadoDispositivo->setProperty("Automata.m1",$this->mic["M1"]);
        $this->estadoDispositivo->setProperty("Automata.m2",$this->mic["M2"]);
        $this->estadoDispositivo->setProperty("Automata.m3",$this->mic["M3"]);
        $this->estadoDispositivo->setProperty("Automata.m4",$this->mic["M4"]);
        $this->estadoDispositivo->setProperty("Automata.ledAtril1",$this->ledMic["M5"]);
        $this->estadoDispositivo->setProperty("Automata.ledAtril2",$this->ledMic["M6"]);
        $this->estadoDispositivo->setProperty("Automata.ledM1",$this->ledMic["M1"]);
        $this->estadoDispositivo->setProperty("Automata.ledM2",$this->ledMic["M2"]);
        $this->estadoDispositivo->setProperty("Automata.ledM3",$this->ledMic["M3"]);
        $this->estadoDispositivo->setProperty("Automata.ledM4",$this->ledMic["M4"]);
        $this->estadoDispositivo->setProperty("Automata.bpan",$this->pantalla["bpan"]);
        $this->estadoDispositivo->setProperty("Automata.span",$this->pantalla["span"]);
        $this->estadoDispositivo->setProperty('Automata.l567',$this->activarLuzSuelo["l567"]);
        $this->estadoDispositivo->setProperty('Automata.l34',$this->activarLuzSuelo["l34"]);
        $this->estadoDispositivo->setProperty('Automata.l12',$this->activarLuzSuelo["l12"]);
        $this->estadoDispositivo->setProperty('Automata.f567',$this->thinkClient["f567"]);
        $this->estadoDispositivo->setProperty('Automata.f34',$this->thinkClient["f34"]);
        $this->estadoDispositivo->setProperty('Automata.f12',$this->thinkClient["f12"]);
        $this->estadoDispositivo->setProperty('Automata.rack',$this->activarRack["rack"]);
        $this->estadoDispositivo->setProperty("Automata.techo",$this->activarDispositivosTecho["techo"]);
        $this->estadoDispositivo->setProperty("Automata.presTact",$this->activarPrestactil["presTact"]);
        $this->estadoDispositivo->setProperty("Automata.p1",$this->intensidadSuelo["p1"]);
        $this->estadoDispositivo->setProperty("Automata.p2",$this->intensidadSuelo["p2"]);
        $this->estadoDispositivo->setProperty("Automata.alum1",$this->intensidadSuelo["alum1"]);
        $this->estadoDispositivo->setProperty("Automata.alum2",$this->intensidadSuelo["alum2"]);
        $this->estadoDispositivo->setProperty("Automata.alum3",$this->intensidadSuelo["alum3"]);
        $this->estadoDispositivo->setProperty("Automata.alum4",$this->intensidadSuelo["alum4"]);
        $this->estadoDispositivo->setProperty("Automata.alum5",$this->intensidadSuelo["alum5"]);
        $this->estadoDispositivo->setProperty("Automata.luz",$this->luz);
        $this->estadoDispositivo->setProperty("Automata.pantallaElectrica",$this->pantallaElectrica);
        $this->estadoDispositivo->setProperty("Automata.showme",$this->showme);
        $this->estadoDispositivo->setProperty("Automata.interruptor",$this->interruptor);
        $this->estadoDispositivo->setProperty("Automata.microsActivos", $this->microfonosActivos);
        $this->estadoDispositivo->setProperty("Automata.numeroMicrofonosActivos",$this->numeroMicrofonosActivos);
        file_put_contents('./estadoDispositivos.properties', $this->estadoDispositivo->toString(true));

    }

} // end of Automata
?>
