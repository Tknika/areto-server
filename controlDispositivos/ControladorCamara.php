<?php
/**
 * @package PHP::controladoresDispositivos
 */
/**
 * includes
 */
include_once './dispositivos/Camara.php';

/**
 * Description of ControladorCamara
 *
 * @author amaia
 *
 * @package PHP::controladorDispositivos
 */
class ControladorCamara {

/**
 * Atributo que guardara la instancia de la clase Camara, para la camara de
 * la presidencia
 *
 * @var Camara("CamaraPresidencia")
 * @access private
 * @static
 */
    private static $presidencia;
    /**
     * Atributo que guardara la instancia de la clase Camara, para la camara
     * alumnos 1
     *
     * @var Camara("CamaraAlumnos1")
     * @access private
     * @static
     */
    private static $alumnos1;
    /**
     * Atributo que guardara la instancia de la clase Camara, para la camara
     * alumnos 2
     *
     * @var Camara("CamaraAlumnos2")
     * @access private
     * @static
     */
    private static $alumnos2;
    /**
     * Metodo constructor de la clase, se instancian las Camaras que vaya a
     * controlar la clase
     *
     * @access public
     */
    public function  __construct() {
        self::$presidencia=new Camara("CamaraPresidencia");
        self::$alumnos1=new Camara("CamaraAlumnos1");
        self::$alumnos2=new Camara("CamaraAlumnos2");
    }


    /////////////////////////////////////////////
    //////////////Camara alumnos1////////////////
    /////////////////////////////////////////////

  /**
     * Metodo para mover la camara 1 de los alumnos a la posicion $posicion
   *
     * @access public
     * @param int $posicion
   */
    public function presetCamaraAlumnos1($posicion) {

        self::$alumnos1->preset($posicion);

    }

    //    public function pararCamaraAlumnos1(){
    //         self::$alumnos1->pararCamara($posicion);
    //    }

    /**
     * Metodo para acercar la camara 1
     *
     * @access public
     */
    public function acercarCamaraAlumnos1() {

        self::$alumnos1->acercarZoom();

    }

    /**
     * Metodo para alejar la camara 1
     *
     * @access public
     */
    public function alejarCamaraAlumnos1() {

        self::$alumnos1->alejarZoom();

    }

    /**
     * Metodo para enfocar la camara 1
     *
     * @access public
     */
    public function enfocarCamaraAlumnos1() {

        self::$alumnos1->enfocar();

    }

    /**
     * Metodo para desenfocar la camara 1
     *
     * @access public
     */
    public function desenfocarCamaraAlumnos1() {

        self::$alumnos1->desenfocar();

    }

    /**
     * Metodo para mover la camara 1 hacia arriba
     *
     * @access public
     */
    public function tiltUpCamaraAlumnos1() {

        self::$alumnos1->moverArriba();

    }

    /**
     * Metodo para mover la camara 1 hacia abajo
     *
     * @access public
     */
    public function tiltDownCamaraAlumnos1() {

        self::$alumnos1->moverAbajo();

    }

    /**
     * Metodo para mover la camara 1 a la derecha
     *
     * @access public
     */
    public function panRightCamaraAlumnos1() {

        self::$alumnos1->moverALaDerecha();

    }

    /**
     * Metodo para mover la camara 1 a la izquierda
     *
     * @access public
     */
    public function panLeftCamaraAlumnos1() {

        self::$alumnos1->moverALaIzquierda();

    }

    ////////////////////////////////////////////
    ///////////////Camara Alumnos2//////////////
    ////////////////////////////////////////////

    /**
     * Metodo para mover la camara 2 de los alumnos a la posicion $posicion
     *
     * @access public
     * @param int $posicion
     */
    public function presetCamaraAlumnos2($posicion) {

        self::$alumnos2->preset($posicion);

    }

    //    public function pararCamaraAlumnos2(){
    //         self::$alumnos2->pararCamara($posicion);
    //    }

    /**
     * Metodo para acercar la camara 2
     *
     * @access public
     */
    public function acercarCamaraAlumnos2() {

        self::$alumnos2->acercarZoom();

    }

    /**
     * Metodo para alejar la camara 2
     *
     * @access public
     */
    public function alejarCamaraAlumnos2() {

        self::$alumnos2->alejarZoom();

    }

    /**
     * Metodo para enfocar la camara 2
     *
     * @access public
     */
    public function enfocarCamaraAlumnos2() {

        self::$alumnos2->enfocar();

    }

    /**
     * Metodo para desenfocar la camara 2
     *
     * @access public
     */
    public function desenfocarCamaraAlumnos2() {

        self::$alumnos2->desenfocar();

    }

    /**
     * Metodo para mover la camara 2 hacia arriba
     *
     * @access public
     */
    public function tiltUpCamaraAlumnos2() {

        self::$alumnos2->moverArriba();

    }

    /**
     * Metodo para mover la camara 2 hacia abajo
     *
     * @access public
     */
    public function tiltDownCamaraAlumnos2() {

        self::$alumnos2->moverAbajo();

    }

    /**
     * Metodo para mover la camara 2 a la derecha
     *
     * @access public
     */
    public function panRightCamaraAlumnos2() {

        self::$alumnos2->moverALaDerecha();

    }

    /**
     * Metodo para mover la camara 2 a la izquierda
     *
     * @access public
     */
    public function panLeftCamaraAlumnos2() {

        self::$alumnos2->moverALaIzquierda();
    }


    ///////////////////////////////////////////////
    ///////////////Camara presidencia//////////////
    ///////////////////////////////////////////////

    /**
     * Metodo para mover la camara de la presidencia a la posicion $posicion
     *
     * @access public
     * @param int $posicion
     */
    public function presetCamaraPresidencia($posicion) {

       self::$presidencia->preset($posicion);

    }

    //    public function pararCamaraPresidencia(){
    //         self::$presidencia->pararCamara($posicion);
    //    }

    /**
     * Metodo para acercar la camara de la presidencia
     *
     * @access public
     */
    public function acercarCamaraPresidencia() {

        self::$presidencia->acercarZoom();

    }

    /**
     * Metodo para alejar la camara de la presidencia
     *
     * @access public
     */
    public function alejarCamaraPresidencia() {

        self::$presidencia->alejarZoom();

    }

    /**
     * Metodo para enfocar la camara de la presidencia
     *
     * @access public
     */
    public function enfocarCamaraPresidencia() {

        self::$presidencia->enfocar();

    }

    /**
     * Metodo para desenfocar la camara de la presidencia
     *
     * @access public
     */
    public function desenfocarCamaraPresidencia() {

        self::$presidencia->desenfocar();

    }

    /**
     * Metodo para mover la camara de la presidencia hacia arriba
     *
     * @access public
     */
    public function tiltUpCamaraPresidencia() {

        self::$presidencia->moverArriba();

    }

    /**
     * Metodo para mover la camara de la presidencia hacia abajo
     *
     * @access public
     */
    public function tiltDownCamaraPresidencia() {

        self::$presidencia->moverAbajo();

    }

    /**
     * Metodo para mover la camara de la presidencia a la derecha
     *
     * @access public
     */
    public function panRightCamaraPresidencia() {

        self::$presidencia->moverALaDerecha();

    }

    /**
     * Metodo para mover la camara de la presidencia a la izquierda
     *
     * @access public
     */
    public function panLeftCamaraPresidencia() {

        self::$presidencia->moverALaIzquierda();
    }

}
?>
