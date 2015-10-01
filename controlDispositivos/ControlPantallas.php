<?php
/**
 * @package PHP::controladoresDispositivos
 */
/**
 * require_once
 */
require_once './dispositivos/LCD.php';
//require_once './dispositivos/PantallaElectrica.php';


/**
 * Description of ControlPantallas
 *
 * @author amaia
 *
 *@package PHP::controladoresDispositivos
 */

class ControlPantallas {

    /**
     * Atributo que guardara la instancia de la clase Pantalla, para la pantalla de
     * la presidencia
     *
     * @var LCD("PantallaPresidencia")
     * @static
     * @access private
     */
    private static $presidencia;
    /**
     *Atributo que guardara la instancia de la clase Pantalla, para la pantalla de
     * la entrada
     *
     * @var  LCD("PantallaEntrada")
     * @static
     * @access private
     */
    private static $entrada;
    //    /**
    //     * No hace falta
    //     *
    //     * @var  LCD("PantallaElectrica")
    //     * @static
    //     * @access private
    //     */
    //    private static $electrica;

    /**
     * Metodo constructor de la clase, se instancian las pantallas que vaya a
     * controlar la clase
     *
     * @access public
     */
    public function  __construct() {

        self::$presidencia=new LCD("PantallaPresidencia");
        self::$entrada=new LCD("PantallaEntrada");
        //        self::$electrica=new PantallaElectrica("PantallaElectrica");

    }
    ////////////////////////////////////////////////////////////////
    //////////////Metodos de la Pantalla Presidencia////////////////
    ////////////////////////////////////////////////////////////////

    /**
     * Metodo para encender la pantalla de la presidencia
     *
     * @access public
     */
    public function encenderPresidencia() {

        $error=self::$presidencia->getEstado(LCD::$estadoLCD[LCD::$ENCENDIDO]);
        print_r($error);
        if(!empty ($error)) {
            if(strpos($error["estado"], "NG")===false) {
                if(strpos($error["estado"], "00")>=0) {
                    $error=self::$presidencia->encender();
                    if(strpos($error["estado"], "OK")===false) {
                        echo "Error al intentar encender la pantalla de la presidencia\n";
                        return 1;
                    }
                    else return 0;

                }
            }else {
                echo "error al intentar conocer el estado del lcd antes de apagarlo\n";
                return 1;
            }
        }
        else {
            return 1;
        }
    }

    /**
     * Metodo para apagar la pantalla de la presidencia
     *
     * @access public
     */
    public function apagarPresidencia() {

        $error=self::$presidencia->getEstado(LCD::$estadoLCD[LCD::$ENCENDIDO]);
        print_r($error);
        if(!empty ($error)) {
            if(strpos($error["estado"], "NG")===false) {
                if(strpos($error["estado"], "01")>=0) {
                    $error=self::$presidencia->apagar();
                    if(strpos($error["estado"], "OK")===false) {
                        echo "Error al intentar apagar la pantalla de la presidencia\n";
                        return 1;
                    }
                    else return 0;

                }
            }else {
                echo "error al intentar conocer el estado del lcd antes de apagarlo\n";
                return 1;
            }
        }else {
            return 1;
        }
    }

    /**
     * Metodo que devuelve si la pantalla de la presidencia esta encendida o no
     *
     * @access public
     * @return bit
     */
    public function isEncendidaPresidencia() {

        return self::$presidencia->isEncendida();

    }

    /**
     * Metodo para ver la entrada AV1 en la pantalla de la presidencia
     *
     * @access public
     */
    public function verEntradaPresidenciaAV1() {

        $error=self::$presidencia->verEntradaPantallaAV(2);
        if(!empty ($error)) {
            if(strpos($error, "OK")===false) {
                echo "Error al intentar  seleccionar la entrada av1 de la presidencia\n";
            }
        }
    }

    /**
     * Metodo para ver la entrada AV2 en la pantalla de la presidencia
     *
     * @access public
     */
    public function verEntradaPresidenciaAV2() {

        $error=self::$presidencia->verEntradaPantallaAV(3);
        if(!empty ($error)) {
            if(strpos($error, "OK")===false) {
                echo "Error al intentar seleccionar la entrada av2 de encender la pantalla de la presidencia\n";
            }
        }
    }

    //    /**
    //     * Metodo para ver la entrada AV3 en la pantalla de la presidencia
    //     *
    //     * @access public
    //     */
    //    public function verEntradaPresidenciaAV3() {
    //
    //        self::$presidencia->verEntradaPantallaAV(3);
    //
    //    }

    /**
     * Metodo para ver la entrada VGA en la pantalla de la presidencia
     *
     * @access public
     */
    public function verEntradaPresidenciaVGA() {

        $error=self::$presidencia->verEnPantallaVGA();
        if(!empty ($error)) {
            if(strpos($error, "OK")===false) {
                echo "Error al intentar seleccionar la entrada vga de la pantalla de la presidencia\n";
            }
        }
    }

    /**
     * Metodo para poner PIP en la pantalla de la presidencia
     *
     * @access public
     */
    public function ponerPIPPresidencia() {

        $error=self::$presidencia->ponerPIP();
        if(!empty ($error)) {
            if(strpos($error["estado"], "OK")===false)
                echo "Error al enviar el comando ponerPIP a la pantalla de la presidencia\n";
        }
    }

    /**
     * Metodo para quitar PIP en la pantalla de la presidencia
     *
     * @access public
     */
    public function quitarPIPPresidencia() {

        $error=self::$presidencia->quitarPIP();
        if(!empty ($error)) {
            if(strpos($error["estado"],"OK")===false)
                echo "Error al enviar el comando quitarPIP a la pantalla de la presidencia\n";
        }
    }

    /**
     * Metodo para seleccionar la fuente PIP en la pantalla de la presidencia
     *
     * @access public
     */
    public function fuentePIPPresidencia() {

        $error=self::$presidencia->fuentePIP(2);
        if(!empty ($error)) {
            if(strpos($error["estado"], "OK")===false)
                echo "Error al enviar el comando fuentePIP a la pantalla de la presidencia\n";
        }
    }

    /**
     * Metodo para seleccionar la fuente PIP1 en la pantalla de la presidencia
     *
     * @access public
     */
    public function fuentePIP1Presidencia() {

        $error=self::$presidencia->fuentePIP(3); {
            if(strpos($error["estado"], "OK")===false)
                echo "Error al enviar el comando fuentePIP1 a la pantalla de la presidencia\n";
        }
    }

    /**
     * Metodo que de vuelve si la pantalla de la pantalla de presidencia tiene pip
     *
     * @access public
     * @return bit
     */
    public function isPIPPresidencia() {

        return self::$presidencia->isPIP();

    }

    /**
     * Metodo que devuelve el identificador de la pantalla de la presidencia
     *
     * @access public
     * @return int
     */
    public function getIdPresidencia() {

        return self::$presidencia->getIdLCD();
    }

    /**
     * Metodo para hacer pip en la pantalla de la presidencia.
     *
     * En caso de que la pantalla no este encendida, la encendera, activara la
     * entrada VGA y pone la camara 1 en la presidencia.
     *
     * Enruta el audio del pc al canal7 y el video del escalador a la pantalla de
     * la presidencia. Activa la funcion PIP en la presidencia y selecciona la
     * fuente PIP
     *
     * @access public
     */

    public function pipEnPresidencia() {

	$this->verEntradaPresidenciaVGA();
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(1,1);
	AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(1,1);
        AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_CAMARA_3,MatrizVideo::$OUTPUT_LCD_PRESIDENCIA);
	$this->ponerPIPPresidencia();
        $this->fuentePIPPresidencia();



        /*$this->verEntradaPresidenciaVGA();
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(1,1);
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(1,1);
        AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_ESCALADOR,MatrizVideo::$OUTPUT_LCD_PRESIDENCIA);

        $this->ponerPIPPresidencia();
        $this->fuentePIPPresidencia();*/

    }

    ///////////////////////////////////////////////////////////
    //////////////Metodos de la Pantalla Entrada////////////////
    ////////////////////////////////////////////////////////////

    /**
     * Metodo para encender la pantalla de la entrada
     *
     * @access public
     */
    public function encenderEntrada() {

        $error=self::$entrada->getEstado(LCD::$estadoLCD[LCD::$ENCENDIDO]);
        print_r($error);
        if(!empty ($error)) {
            if(strpos($error["estado"], "NG")===false) {
                if(strpos($error["estado"], "00")>=0) {
                    $error=self::$entrada->encender();
                    if(strpos($error["estado"], "OK")===false) {
                        echo "Error al intentar encender la pantalla del pasillo\n";
                        return 1;
                    }
                    else return 0;

                }
            }else {
                echo "error al intentar conocer el estado del lcd antes de apagarlo\n";
                return 1;
            }
        }

    }

    /**
     * Metodo para apagar la pantalla de la entrada
     *
     * @access public
     */
    public function apagarEntrada() {
        $error=self::$entrada->getEstado(LCD::$estadoLCD[LCD::$ENCENDIDO]);
        print_r($error); {
            if(strpos($error["estado"], "NG")===false) {
                if(strpos($error["estado"], "01")>=0) {
                    $error=self::$entrada->apagar();
                    if(strpos($error["estado"], "OK")===false) {
                        echo "Error al intentar apagar la pantalla del pasillo\n";
                        return 1;
                    }
                    else return 0;
                }
            }else {
                echo "error al intentar conocer el estado del lcd antes de apagarlo\n";
                return 1;
            }

        }
    }


    /**
     * Metodo que devuelve si la pantalla de la entrada esta encendida o no
     *
     * @access public
     * @return bit
     */
    public function isEncendidaEntrada() {

        return self::$entrada->isEncendida();

    }

    /**
     * Metodo para ver la entrada AV1 en la pantalla de la entrada
     *
     * @access public
     */
    public function verEntradaEntradaAV1() {

        $error=self::$entrada->verEntradaPantallaAV(1);
        $error=self::$entrada->procesarRespuesta($error);
        if(!empty ($error)) {
            if(strpos($error["estado"], "OK")===false) {
                echo "Error al intentar seleccionar la entrada av1 de la pantalla del pasillo\n";
            }
        }

    }

    /**
     * Metodo para ver la entrada AV2 en la pantalla de la entrada
     *
     * @access public
     */
    public function verEntradaEntradaAV2() {

        $error=self::$entrada->verEntradaPantallaAV(2);
        $error=self::$entrada->procesarRespuesta($error);
        if(!empty ($error)) {
            if(strpos($error["estado"], "OK")===false) {
                echo "Error al intentar seleccionar la entrada av2 de la pantalla del pasillo\n";
            }
        }

    }

    //    /**
    //     * Metodo para ver la entrada AV3 en la pantalla de la entrada
    //     *
    //     * @access public
    //     */
    //    public function verEntradaEntradaAV3() {
    //
    //        $error=self::$entrada->verEntradaPantallaAV(3);
    // if($error==1){
    //           echo "Error al intentar seleccionar la entrada vga de la pantalla de la presidencia\n";
    //       }
    //    }

    /**
     * Metodo para ver la entrada VGA en la pantalla de la entrada
     *
     * @access public
     */
    public function verEntradaEntradaVGA() {

        $error=self::$entrada->verEnPantallaVGA();
        if(!empty ($error)) {
            if(!isset($error["estado"]) || strpos($error["estado"], "OK")===false) {
                echo "Error al intentar seleccionar la entrada av2 de la pantalla del pasillo\n";
            }
        }

    }

    /**
     * Metodo para poner PIP en la pantalla de la entrada
     *
     * @access public
     */
    public function ponerPIPEntrada() {

        $error=self::$entrada->ponerPIP();
        if(!empty ($error)) {
            if(strpos($error["estado"], "OK")===false) {
                echo "Error al intentar enviar el comando ponerPIP a la pantalla del pasillo\n";
            }
        }
    }

    /**
     * Metodo para quitar PIP en la pantalla de la entrada
     *
     * @access public
     */
    public function quitarPIPEntrada() {

        $error=self::$entrada->quitarPIP();
        if(!empty ($error)) {
            if(strpos($error["estado"], "OK")===false) {
                echo "Error al intentar enviar el comando quitarPIP a la pantalla del pasillo\n";
            }
        }

    }

    /**
     * Metodo para seleccionar la fuente PIP en la pantalla de la entrada
     *
     * @access public
     */
    public function fuentePIPEntrada() {

        $error=self::$entrada->fuentePIP(2);
        if(!empty ($error)) {
            if(strpos($error["estado"], "OK")===false) {
                echo "Error al intentar enviar el comando fuentePIP a la pantalla del pasillo\n";
            }
        }

    }

    /**
     * Metodo para seleccionar la fuente PIP1 en la pantalla de la entrada
     *
     * @access public
     */
    public function fuentePIP1Entrada() {

        $error=self::$entrada->fuentePIP(3);
        if(!empty ($error)) {
            if(strpos($error["estado"], "OK")===false) {
                echo "Error al intentar enviar el comando fuentePIP1 a la pantalla del pasillo\n";
            }
        }

    }

    /**
     * Metodo que de vuelve si la pantalla de la pantalla de pentrada tiene pip
     *
     * @access public
     * @return bit
     */
    public function isPIPEntrada() {

        return self::$entrada->isPIP();

    }

    /**
     * Metodo que devuelve el identificador de la pantalla de la entrada
     *
     * @access public
     * @return int
     */
    public function getIdEntrada() {

        return self::$entrada->getIdLCD();

    }

    /**
     * Metodo para hacer pip en la pantalla de la entrada
     *
     * Enciende la pantalla de la entrada, activa la entrada VGA y asigna el
     * video del pc (VGA) y de la camara3(video) a la pantalla de la entrada,
     * activa la funcion PIP en la pantalla de la entrada y selecciona la fuente
     * PIP
     *
     * @access public
     */
    public function pipEnEntrada() {


        $this->verEntradaEntradaVGA();
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(1,6);
        AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_CAMARA_3,MatrizVideo::$OUTPUT_MONITOR_PASILLO);
        $this->ponerPIPEntrada();
        $this->fuentePIPEntrada();

    }

}
?>
