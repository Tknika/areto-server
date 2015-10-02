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

    public function estadoPlasma_ona( ) {
	$this->encenderApagar=true;
        $comando=$this->comandos1[DaoControl::$ESTADO];
        $comando=$this->procesarComando($comando, $this->parametroComando);
        $respuesta=$this->enviarComando($comando);
	if(strcmp($respuesta,"ER401")==0)
		return 1;
	else return $respuesta;

    } // end of member function estadoPlasma

    public function estadoPlasma() {
      $this->loadEstado();
	$this->encenderApagar=true;
        $comando=$this->comandos1[DaoControl::$ESTADO];
        $comando=$this->procesarComando($comando, $this->parametroComando);
        $respuesta=trim($this->enviarComando($comando));
	if(strpos($respuesta,"ER401")!==false) {
	    echo "error al preguntar por el estado del plasma\n";
	    
	    return 1;
	}else if(empty($respuesta) || strpos(trim($respuesta),"QPW:0")!==false) { //apagado
	    $this->encendido='OFF';
	}else {
	    $this->encendido='ON';
	}
	$this->estado=$respuesta;
	$this->guardarEstado();
	return $this->encendido;

    } // end of member function estadoPlasma

    /**
     *
     * @param string $comando
     * @param string $parametro
     * @return string
     */
    public function procesarComando($comando,$parametro) {

        $comando=$comando;
        if(!$this->encenderApagar){
	  $comando=Utils::hexToStr(self::$STX).$comando.$this->vcNum.Utils::hexToStr(self::$ETX);
        }else{
          $comando=Utils::hexToStr(self::$STX).$comando.Utils::hexToStr(self::$ETX);
	}
        return $comando;
    }


    /**
     * Guarda los valores de los atributos en el archivo estadoDispositivos.properties
     */
    public function guardarEstado() {
	//$this->estado();
        //$this->loadEstado();
	$this->estadoDispositivo=new Properties();
        $this->estadoDispositivo->load(file_get_contents("./estadoDispositivos.properties"));
	$this->estadoDispositivo->setProperty("Plasma.estado",$this->estado);
	$this->estadoDispositivo->setProperty("Plasma.encendido",$this->encendido);
        file_put_contents('./estadoDispositivos.properties', $this->estadoDispositivo->toString(true));
	

    }

     /*
     * Cargar ultimo estado desde el archivo estadoDispositivos.properties
     */
    public function loadEstado() {
	//$this->estado();
        $this->estadoDispositivo=new Properties();
        $this->estadoDispositivo->load(file_get_contents("./estadoDispositivos.properties"));
        $this->estado=$this->estadoDispositivo->getProperty("Plasma.estado");
	$this->encendido=$this->estadoDispositivo->getProperty("Plasma.encendido");

    }






} // end of Plasma
?>
