<?php
/**
 * @package PHP::controladoresDispositivos
 */
/**
 * Clases necesarias para el control
 */
require_once './dispositivos/MesaMezclas.php';

/**
 * Description of ControlMesaMezclas
 *
 * @author amaia
 *
 * @package PHP::controladoresDispositivos
 */
class ControlMesaMezclas {

/**
 *
 * @var MesaMezclas
 * @access private
 * @static
 */
    private static $mesaMezclas;

    public function  __construct() {
        self::$mesaMezclas=new MesaMezclas("MesaMezclas");
    }

    /**
     * Metodo para subir el volumen  del grabador de dvd
     *
     * @access public
     */
    public function subirVolumenDVDGrab() {

        self::$mesaMezclas->subirVolumen(MesaMezclas::$CANAL1,"grabadorL");
        self::$mesaMezclas->subirVolumen(MesaMezclas::$CANAL1,"grabadorR");

    }

    /**
     * Metodo para bajar el volumen  del grabador de dvd
     *
     * @access public
     */
    public function bajarVolumenDVDGrab() {

        self::$mesaMezclas->bajarVolumen(MesaMezclas::$CANAL1,"grabadorL");
        self::$mesaMezclas->bajarVolumen(MesaMezclas::$CANAL1,"grabadorR");

    }

    /**
     * Metodo para activar el sonido del grabador de dvd
     *
     * @access public
     */
    public function activarSonidoDVDGrab() {

        self::$mesaMezclas->encender(MesaMezclas::$CANAL1,"grabadorL");
        self::$mesaMezclas->encender(MesaMezclas::$CANAL1,"grabadorR");

    }

    /**
     * Metodo para activar el sonido del grabador de dvd
     *
     * @access public
     */
    public function desactivarSonidoDVDGrab() {

        self::$mesaMezclas->apagar(MesaMezclas::$CANAL1,"grabadorL");
        self::$mesaMezclas->apagar(MesaMezclas::$CANAL1,"grabadorR");

    }

    /**
     * Metodo que devuelve el volumen del grabador de dvd
     *
     * @access public
     * @return int
     */
    public function getVolumenDVDGrab() {

        $vol=self::$mesaMezclas->getVol("grabadorL");
        return $vol;

    }

     /**
      * Metodo para activar el micro $mic de la presidencia o de los atriles
     *
     * @access public
     * @param string $mic
      */
    public function activarMicPresidencia($mic) {

        self::$mesaMezclas->encender(MesaMezclas::$CANAL1,$mic);

    }

    /**
      * Metodo para desactivar el micro $mic de la presidencia o de los atrilea
     *
     * @access public
     * @param string $mic
      */
    public function desactivarMicPresidencia($mic) {
        self::$mesaMezclas->apagar(MesaMezclas::$CANAL1,$mic);

    }

     /**
      * Metodo para subir el volumen del micro $mic de la presidencia o de los atrilea
     *
     * @access public
     * @param string $mic
      */
    public function subirMicPresidencia($mic) {
        self::$mesaMezclas->subirVolumen(MesaMezclas::$CANAL1,$mic);

    }

    /**
      * Metodo para bajar el volumen del micro $mic de la presidencia o de los atrilea
     *
     * @access public
     * @param string $mic
      */
    public function bajarMicPresidencia($mic) {

   self::$mesaMezclas->bajarVolumen(MesaMezclas::$CANAL1,$mic);

    }

     /**
     * Metodo que devuelve el volumen del micro $mic de la presidencia o de los atriles
     *
     * @access public
     * @param string $mic
     * @return int
     */
    public function getVolumenMicro($mic) {

        $vol=self::$mesaMezclas->getVol($mic);
        return $vol;

    }

    /**
     * Metodo para subir el volumen  del dvd
     *
     * @access public
     */
    public function subirVolumenDVD() {

        self::$mesaMezclas->subirVolumen(MesaMezclas::$CANAL1,"dvdL");

    }

     /**
     * Metodo para bajar el volumen  del dvd
     *
     * @access public
     */
    public function bajarVolumenDVD() {

        self::$mesaMezclas->bajarVolumen(MesaMezclas::$CANAL1,"dvdL");

    }

     /**
     * Metodo para activar el sonido  del dvd
     *
     * @access public
     */
    public function activarSonidoDVD() {

        self::$mesaMezclas->encender(MesaMezclas::$CANAL1,"dvdL");

    }

     /**
     * Metodo para desactivar el sonido  del dvd
     *
     * @access public
     */
    public function desactivarSonidoDVD() {

        self::$mesaMezclas->apagar(MesaMezclas::$CANAL1,"dvdL");

    }

     /**
     * Metodo que devuelve el volumen del dvd
     *
     * @access public
     * @return int
     */
    public function getVolumenDVD() {
        $vol=self::$mesaMezclas->getVol("dvdL");
        return $vol;
    }

    /**
     * Metodo para subir el volumen  que nos llega por videoconferencia
     *
     * @access public
     */
    public function subirSonidoContraparte() {

        self::$mesaMezclas->subirVolumen(MesaMezclas::$CANAL1,"videoconferencia");

    }

    /**
     * Metodo para bajar el volumen  que nos llega por videoconferencia
     *
     * @access public
     */
    public function bajarSonidoContraparte() {

        self::$mesaMezclas->bajarVolumen(MesaMezclas::$CANAL1,"videoconferencia");

    }

     /**
     * Metodo para activar el Sonido que nos llega por videoconferencia
     *
     * @access public
     */
    public function activarSonidoContraparte() {

        self::$mesaMezclas->encender(MesaMezclas::$CANAL1,"videoconferencia");

    }

    /**
     * Metodo para desactivar el Sonido que nos llega por videoconferencia
     *
     * @access public
     */
    public function desactivarSonidoContraparte() {

        self::$mesaMezclas->apagar(MesaMezclas::$CANAL1,"videoconferencia");

    }

    /**
     * Metodo que nos devuelve el volumen del sonido que nos llega por videoconferencia
     *
     * @access public
     * @return int
     */
    public function getVolumenVideoconferencia() {

        $vol=self::$mesaMezclas->getVol("videoconferencia");
        return $vol;

    }

    /**
     * Metodo para activar el sonido que sale de la sala (para la videoconferencia)
     *
     * @access public
     */
    public function activarNuestroSonido() {

        self::$mesaMezclas->encender(MesaMezclas::$CANAL2,"aux2");

    }

    /**
     * Metodo para desactivar el sonido que sale de la sala (para la videoconferencia)
     *
     * @access public
     */
    public function desactivarNuestroSonido() {

        self::$mesaMezclas->apagar(MesaMezclas::$CANAL2,"aux2");

    }

    /**
     * Metodo para activar el sonido general
     *
     * @access public
     */
    public function activarSonidoGeneral() {

        self::$mesaMezclas->encender(MesaMezclas::$CANAL2,"master");

    }

    /**
     * Metodo para activar el sonido general
     *
     * @access public
     */
    public function desactivarSonidoGeneral() {

        self::$mesaMezclas->apagar(MesaMezclas::$CANAL2,"master");

    }

    /**
     * Metodo para subir el volumen general
     *
     * @access public
     */
    public function subirSonidoGeneral() {

        self::$mesaMezclas->subirVolumen(MesaMezclas::$CANAL2,"master");

    }

    /**
     * Metodo para bajar el volumen general
     *
     * @access public
     */
    public function bajarSonidoGeneral() {

        self::$mesaMezclas->bajarVolumen(MesaMezclas::$CANAL2,"master");

    }
    /**
     * Metodo que devuelve el volumen general
     *
     * @access public
     * @return int $vol
     */
    public function getVolumenGeneral() {

        $vol=self::$mesaMezclas->getVol("master");
        return $vol;

    }

  /**
   * Metodo que recarga la escena 90 de la mesa de mezclas
     *
     * @access public
   */
    public function preset90() {
        
        self::$mesaMezclas->preset(90);

    }

    /**
     * Metodo para reiniciar los valores de la mesa, cargando el archivo
     * estadoDispositivo.properties. hay que mirar si realmente hace falta
     *
     *
     */
    public static function reiniciarValores() {
        self::$mesaMezclas->reiniciarValores();

    }
    

}
?>
