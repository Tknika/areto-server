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
require_once './dispositivos/Pantallas.php';
require_once './utils/Utils.php';


/**
 * class Plasma
 *
 *
 *  @package PHP::dispositivos
 */
class Plasma extends Pantallas {

/**
 *
 * @var string
 * @access private
 * @static
 */
    private static $STX = "02";

    /**
     *
     * @var string
     * @access private
     * @static
     */
    private static $ETX = "03";

    function  __construct($dispositivo) {
        $this->tipoDispositivo="Plasma";
        parent::__construct($dispositivo);
        echo($this->ip."-".$this->modeloIPLT."-".$this->strMarca."-".$this->strModelo."-".$this->id_disp."-".$this->tipoPuerto."-".$this->numeroPuerto."-".$this->baudRate."-".$this->timeOut."-".$this->puerto."-".$this->password);

    }
        public function apagar(){
	
		$respuesta=parent::apagar();
		return $respuesta;
		
        }
        public function encender(){
		
           		$respuesta=parent::encender();
			return $respuesta;
		
       }

    /**
     * Metodo para ver el estado del plasma
     *
     * @access public
     */
    public function estadoPlasma( ) {
	$this->encenderApagar=true;
        $comando=$this->comandos1[DaoControl::$ESTADO];
        $comando=$this->procesarComando($comando, $this->parametroComando);
        $respuesta=$this->enviarComando($comando);
	return $respuesta;

    } // end of member function estadoPlasma

    /**
     *
     * @param string $comando
     * @param string $parametro
     * @return string
     */
    public function procesarComando($comando,$parametro) {

        $comando=$comando;
        if(!$this->encenderApagar)
		    $comando=Utils::hexToStr(self::$STX).$comando.$this->vcNum.Utils::hexToStr(self::$ETX);
        else
            $comando=Utils::hexToStr(self::$STX).$comando.Utils::hexToStr(self::$ETX);
        return $comando;
    }
} // end of Plasma
?>
