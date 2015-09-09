<?php
/**
 * @package PHP::controladoresDispositivos
  */
  /**
 * includes
 */
require_once './dispositivos/MatrizVideo.php';


/**
 * Description of controladorMatrizVideo
 *
 * @author amaia
 *
 * @package PHP::controladoresDispositivos
 */
class controladorMatrizVideo {

/**
 * Atributo que guardara la instancia de la clase MatrizVideo
 *
 * @var MatrizVideo
 * @access private
 * @static
 */
    private static $matrizVideo;

    public function  __construct() {

        self::$matrizVideo=new MatrizVideo("MatrizVideo");

    }

    /**
     * Metodo que enruta el video de la entrada $in a la salida $out
     *
     *@access public
     * @param int $in
     * @param int $out
     */
    public function asignarVideo( $in,  $out ) {

        self::$matrizVideo->asignarVideo($in,$out);

    } // end of member function asignarVideo
}
?>
