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
require_once './dispositivos/Dispositivo.php';
require_once './comunication/php_serial.class.php';


/**
 * class DispositivoSerie
 * @package PHP::dispositivos
 */
abstract class DispositivoSerie extends Dispositivo {



 /**
 *
 *
 * @param string comando

 * @return
 * @access public
 */
    public function enviarComando( $comando ) {
   
  $serial= phpSerial::getInstance();
     $serial->escribirPuerto($comando);
             
    } // end of member function enviarComando


} // end of DispositivoSerie
?>
