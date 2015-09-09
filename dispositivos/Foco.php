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
* class Foco
*
* Clase que se encargara de enviar al foco las ordenes adecuadas
* para su manejo
* @package PHP::dispositivos
*/
class Foco extends DispositivoIP {

/**
* Atributo para crear los comandos del Foco 1
*
* @var int
* @access private
* @static
*/
public static $FOCO_1=200;
/**
* Atributo para crear los comandos del Foco 2
*
* @var int
* @access private
* @static
*/
public static $FOCO_2=100;
/**
*
* @var <type>
*/
private static $ON="ON";
/**
*
* @var <type>
*/
private static $OFF="OFF";

function  __construct($dispositivo) {

$this->tipoDispositivo="FocoMovil";
parent::__construct($dispositivo);
echo($this->ip."-".$this->modeloIPLT."-".$this->strMarca."-".$this->strModelo."-".$this->id_disp."-".$this->tipoPuerto."-".$this->numeroPuerto."-".$this->baudRate."-".$this->timeOut."-".$this->puerto."-".$this->password);
$estado=self::$OFF;

}

/**
* Metodo que crea el comando para enciender los focos, los pone en la
* posicion inicial y envia el comando a los focos
*
* @access public
*/
public function encender() {
//encender
$comandoFocos1="S".(self::$FOCO_1+23)."V88";
$comandoFocos2="S".(self::$FOCO_2+23)."V88";
$this->enviarComando($comandoFocos1."\r\n".$comandoFocos2);
try {
usleep(10000000);
}
catch (Exception $e ){}

$comando=$this->comandos1["puestoInicio"];
$comando=$this->procesarComando($comando, "");
$this->enviarComando($comando);
$this->setEstado(self::$ON);

}

/**
* Metodo que crea el comando para apagar los focos, los pone en la
* posicion final y envia el comando a los focos
*
* @access public
*/
public function apagar() {

if(strcmp($this->getEstado(), self::$ON)) {
$comandoFoco1="S".(self::$FOCO_1+19)."V0\r\nS".(self::$FOCO_1+20)."V0\r\nS".(self::$FOCO_1+23)."V98";
$comandoFoco2="S".(self::$FOCO_2+19)."V0\r\nS".(self::$FOCO_2+20)."V0\r\nS".(self::$FOCO_2+23)."V98";
}
$this->enviarComando($comandoFoco1."\n".$comandoFoco2);
try {
usleep(5000000);
}
catch (Exception $e ){

}
$comando=$this->comandos1["puestoFin"];
$comando=$this->procesarComando($comando, "");
$this->enviarComando($comando);
$this->setEstado(self::$OFF);


}

/**
* Metodo que crea el comando para mover el foco a la posicion inicial y dejar
* de emitir luz. Envia el comando a los focos
*
* @access public
*/
public function posicionInicial() {

if(strcmp($this->getEstado(), self::$ON)) {
$comando=$this->comandos1["puestoInicio"];
$comando=$this->procesarComando($comando, "");
$this->enviarComando($comando);

}

}

/**
* Metodo que pone el foco en la posicion indicada por el parametro ($pos).
*
* @param int $pos
* @access public
*/
public function posicion($pos) {

//  if(strcmp($this->getEstado(), self::$ON)) {
$cmd="puesto".$pos;
$comando=$this->comandos1[$cmd];
$comando=$this->procesarComando($comando, "");
$this->enviarComando($comando);
$comando2="";
//            $aux=-1;
//            $aux=strpos($comando,"\r\nS119V255");
//            if($aux<0)
//                $aux=strpos($comando,"\r\nS219V255");
//            if($pos>=0) {
//                $comando2=substr($comando, $aux);
//                $comando=substr(0, $aux);
//            }
//            $this->enviarComando($comando);
//            if(strcmp($comando2, "")!=0) {
//                try {
//                    usleep(500);
//                }
//                catch (Exception $e ){
//
//                }
//                  $this->enviarComando($comando."\r\nS120V255\r\nS220V255");
//            }

//  }

}

/**
* Metodo que mueve el foco a la izquierda o derecha segun los parametros
*
* @access public
* @param int $canalFoco
* @param int $pos
*/
public function pan($canalFoco,$pos) {

$this->enviarComando("S".($canalFoco+2)."V".$pos);
}

/**
* Metodo que mueve el foco arriba o abajo segun los parametros
*
* @access public
* @param int $canalFoco
* @param int $pos
*/
public function tilt($canalFoco,$pos) {

$this->enviarComando("S".$canalFoco."V".$pos);

}

/**
* Metodo que crea el comando que enfoca la posicion indicada como parametro
*
* @access public
* @param int $canalFoco
* @param int $pos
*/
public function focus($canalFoco,$pos) {

$this->enviarComando("S".($canalFoco+17)."V".$pos);

}

/**
* Metodo que crea el comando para encender el foco $canalFoco. Enciende la
* lampara
*
* @access public
* @param int $canalFoco
*/
public function switchOn($canalFoco) {

$this->enviarComando("S".($canalFoco+23)."V88");

}

/**
* Metodo crea el comando para apagar el foco $canalFoco. Cierra el obturador(19),
* oscurece la luz(20) y apaga la lampara (23)
*
* @access public
* @param int $canalFoco
*/
public function switchOff($canalFoco) {

$this->enviarComando("S".($canalFoco + 19)."V0\nS".($canalFoco + 20)."V0\nS".($canalFoco + 23)."V98");

}

/**
* Metodo que crea el comando para encender la luz del foco $canalFoco. Abre
* el obturador
*
* @access public
* @param int $canalFoco identificador del foco
*/
public function showLight($canalFoco) {

$this->enviarComando("S".($canalFoco+19)."V255");

}

/**
* Metodo que crea el comando para apagar la luz del foco $canalFoco. Cierra
* el obturador(19)  y oscurece la luz(20)
*
* @access public
* @param int $canalFoco identificador del foco
*/
public function hideLight($canalFoco) {

$this->enviarComando("S".($canalFoco+19)."V0\r\nS".($canalFoco+20)."V0");

}

/**
*Metodo para que el foco deje de apuntar al alumno
*
* @access public
*/
public function dejaDeApuntar() {

$this->hideLight(self::$FOCO_1);
$this->hideLight(self::$FOCO_2);

}

/**
* Metodo mara generar el comando adecuado para que el foco lo entienda
*
* @access protected
* @param string $comando Comando recogido de la lista de comandos
* @param string $parametro Para remplazar en $comando
* @return string Comando preparado para enviar al generador multiventanas
*/
public function procesarComando($comando,$parametro) {

echo "\nFoco:\n";
$comando=str_replace("\$id\$", "\r\n", $comando);
return $comando;

}

} // end of Foco
?>
