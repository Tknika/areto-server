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
require_once './comunication/ConexionIP.php';

/**
 * class DispositivoIP
 * @package PHP::dispositivos
 */
abstract class DispositivoIP extends Dispositivo {

    protected  $disp;
    function  __construct($dispositivo) {
        $this->disp=$dispositivo;
        $this->dispositivos=new Properties();
        $this->dispositivos->load(file_get_contents("./sinta.properties"));
        $this->status=$this->dispositivos->getProperty($this->disp.".status");
        parent::__construct($dispositivo);
    }
    /**
     *
     *
     * @param string comando

     * @return
     * @access public
     */
    public function enviarComando( $comando, $param1=null,$param2=null ) {
        
        if($this->status=="" ||  $this->status==0) {

            $conexion= new ConexionIP($this->ip, $this->puerto, $this->modeloIPLT, $this->numeroPuerto, $this->tipoPuerto);

            $conexion->conect1();
            echo $this->disp.": ";
            $res=$conexion->write1($comando);

            $conexion->close1();
            return $res;

        }
        else {

            return "";

        }

    } // end of member function enviarComando



} // end of DispositivoIP
?>
