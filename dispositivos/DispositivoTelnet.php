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


/**
 * class DispositivoTelnet
 * @package PHP::dispositivos
 */
abstract class DispositivoTelnet extends Dispositivo {



    protected  $disp;
    protected $conexion;
    function  __construct($dispositivo) {
        $this->mesa=new Properties();
        $this->mesa->load(file_get_contents("./sinta.properties"));
        $this->status=$this->mesa->getProperty($dispositivo.".status");
        $this->disp=$dispositivo;
        parent::__construct($dispositivo);
        $this->conexion= new PHPTelnet();
    }
    public function connect() {
       if($this->status=="" ||  $this->status==0) 
        $this->conexion->Connect($this->ip,"Admin",$this->password);
    }
    /**
     *
     *
     * @param string comando

     * @return
     * @access public
     */
    public function enviarComando( $comando) {

        if($this->status=="" ||  $this->status==0) {
            $this->conexion->DoCommand($comando, $r);
            return $r;
        }else {
            return "";
        }
    } // end of member function enviarComando

    public function disconnect() {
        if($this->status=="" ||  $this->status==0) {
            $this->conexion->Disconnect();

        }
    }



} // end of DispositivoTelnet
?>
