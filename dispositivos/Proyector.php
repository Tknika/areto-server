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
require_once './dispositivos/DispositivoIP.php';


/**
 * class Proyector
 *
 *  @package PHP::dispositivos
 */
class Proyector extends DispositivoIP {

/**
 *
 * @var string
 * @access private
 * @static
 */
    private static $ON = "ON";

    /**
     *
     * @var string
     * @access private
     * @static
     */
    private static $OFF = "OFF";

    /**
     *
     * @var string
     * @access private
     * @static
     */
    private static $MUTE = "OFF";

    /**
     *
     * @var string
     * @access private
     * @static
     */
    //private static $NOMUTE = "IMAGEN NO MUTE";

    /**
     *
     * @var string
     * @access private
     * @static
     */
    private static $VC = "INPUT VC";

    /**
     *
     * @var string
     * @access private
     * @static
     */
    private static $VGA = "INPUT VGA";

    /**
     *
     * @var int
     */
    private $respuestaDispositivo;
    private $last_status;

    function  __construct($dispositivo) {

        $this->tipoDispositivo="Proyector";
        parent::__construct($dispositivo);
        echo($this->ip."-".$this->modeloIPLT."-".$this->strMarca."-".$this->strModelo."-".$this->id_disp."-".$this->tipoPuerto."-".$this->numeroPuerto."-".$this->baudRate."-".$this->timeOut."-".$this->puerto."-".$this->password);

    }

    /**
     * Metodo que enciende el proyector
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function encender( ) {

        $comando=$this->comandos1[DaoControl::$ENCENDER];
        $comando=$this->procesarComando($comando,"");
        $this->enviarComando($comando);
        //$this->setEstado(self::$ON);
        //$this->encendido=true;
        $this->guardarEstado();
	$this->desmutear();
                   
    } // end of member function encender

    /**
     * Metodo que apaga el proyector
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function apagar( ) {

        $comando=$this->comandos1[DaoControl::$APAGAR];
        $comando=$this->procesarComando($comando,"");
        $respuesta=$this->enviarComando($comando);
        //$this->setEstado(self::$OFF);
        //$this->encendido=false;
        $this->guardarEstado();
	return $respuesta;

    } // end of member function apagar

    /**
     * Metodo para ver la entrada VC del proyector
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function entradaVC( ) {

        $comando=$this->comandos1[DaoControl::$VC];
        $comando=$this->procesarComando($comando,"");
        $respuesta=$this->enviarComando($comando);
            $this->setEstado(self::$VC);
            $this->guardarEstado();
	if($respuesta==""){
		$respuesta=0;
	}
    	return $respuesta;

    } // end of member function entradaVC

    /**
     * Metodo para ver la entrada VGA en el proyector
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function entradaVGA( ) {

        $comando=$this->comandos1[DaoControl::$VGA];
        $comando=$this->procesarComando($comando,"");
        $respuesta=$this->enviarComando($comando);
            $this->setEstado(self::$VGA);
            $this->guardarEstado();
	if($respuesta=="" ){
		$respuesta=1;
	}
   	return $respuesta;

    } // end of member function entradaVGA

    /**
     * Metodo para mutear el proyector
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function mutear( ) {

        $comando=$this->comandos1[DaoControl::$MUTEAR];
        $comando=$this->procesarComando($comando,"");
        $respuesta=$this->enviarComando($comando);
	self::$MUTE='ON';
	//$this->setEstado(self::$MUTE);
	$this->guardarEstado();
	return $respuesta;
    } // end of member function mutear

    /**
     * Metodo para desmutear el proyector
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function desmutear( ) {

        $comando=$this->comandos1[DaoControl::$DESMUTEAR];
        $comando=$this->procesarComando($comando,"");
        $respuesta=$this->enviarComando($comando);
	self::$MUTE='OFF';

	//$this->setEstado();
	$this->guardarEstado();
	return $respuesta;
    } // end of member function desmutear

    /**
     * Metodo para ver la temperatura del proyector
     *
     * @access public
     */
    public function temperatura( ) {

        $comando=$this->comandos1[DaoControl::$TEMPERATURA];
        $comando=$this->procesarComando($comando,"");
        $respuesta=$this->enviarComando($comando);
        return $respuesta;
    } // end of member function temperatura

    /**
     * Metrodo para ver el tiempo de la lampara del proyector
     *
     * @access public
     */
    public function tiempoLampara( ) {

        $comando=$this->comandos1[DaoControl::$LAMPARA];
        $comando=$this->procesarComando($comando,"");
        $respuesta=$this->enviarComando($comando);
       return $respuesta;
        

    } // end of member function temperaturaLampara

    /**
     * Metordo para ver el estado del proyector
     *
     * @access public
     */
    public function estado( ) {
	        
	if(!empty($this->last_status)){
	  $now=time();
	  $last=split(':',$this->last_status);
	  if($now-$last[0]<3){
	    unset($last[0]);
	    return implode(':',$last);
	  }
	}

	$comando=$this->comandos1[DaoControl::$ESTADO];
        $comando=$this->procesarComando($comando,"");
	//CR0,error(08|10|21|81|88),ok(00|04|20|24|28|40|80)

	$estados=array('00'=>'Projector is ON.',
	'04'=>'Lamps are off due to Power Management.',
	'08'=>'Abnormal Temperature results if status 28 doesn’t work',
	'10'=>'Power failure.',
	'20'=>'Projector just shut off and is in 90 second cool down mode.',
	'21'=>'Because of lamp failure, the power is off (cooling down)',
	'24'=>'Processing power save, cooling down',
	'28'=>'Temperature warning and cooling down.',
	'40'=>'Projector just powered up and is currently in 30 sec. countdown',
	'80'=>'Projector is OFF (Standby).',
	'81'=>'Stand By after cooling down because of lamp failure',
	'88'=>'Temperature warning occurred and system has recovered.'
	);

        $respuesta=$this->enviarComando($comando);
	if( ! in_array($respuesta,array_keys($estados))){
	  sleep(2);
	  $respuesta=$this->enviarComando($comando);
	}
	
	$this->cod_estado=$respuesta;
	$this->last_status=time().":".$respuesta;

	$result=$respuesta;
	if($respuesta==0 ){ 
	  $this->encendido=1;
	  $result="ON";
	}else if($respuesta==80 || $respuesta==40||$respuesta==04 ){ 
	  $this->encendido=0;
	  $result="OFF";
	}else{
	  $this->encendido=0;
	  $result="DISABLED";
	}
	if(in_array($respuesta,array_keys($estados))){
	  $st=$result.":".$estados[$respuesta];
	}else{
	  $st=$result;
	}
	$this->last_status=time().":".$st;
	$this->guardarEstado();
	return $st;

        
    } // end of member function estado

    /**
     * Devuelve si el proyector esta encendido o no
     *
     * @return bit
     * @access public
     */
    public function isEncendido( ) {
	//$this->estado( );
        return $this->encendido;

    } // end of member function isEncendido


    public function is_mute() {

      if(self::$MUTE == 'ON')
	return true;
      else
	return false;
    }

    /**
     * Metodo para crear el comando de forma que el proyector lo pueda procesar
     *
     *
     * @access protected
     * @param string $comando
     * @param string $parametro
     * @return string
     */
    public function procesarComando($comando,$parametro) {

        $comando=$comando."\n";
        return $comando;

    }
    

    /**
     * Guarda los valores de los atributos en el archivo estadoDispositivos.properties
     */
    public function guardarEstado() {
	$this->estado();
        $this->estadoDispositivo=new Properties();
        $this->estadoDispositivo->load(file_get_contents("./estadoDispositivos.properties"));
        $this->estadoDispositivo->setProperty($this->disp.".estado",$this->cod_estado);
        $this->estadoDispositivo->setProperty($this->disp.".encendido",$this->encendido);
	$this->estadoDispositivo->setProperty($this->disp.".mute",self::$MUTE);
        file_put_contents('./estadoDispositivos.properties', $this->estadoDispositivo->toString(true));

    }

} // end of Proyector
?>
