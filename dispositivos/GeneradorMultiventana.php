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
 * class GeneradorMultiventana
 *
 * Clase que se encargara de enviar al generador multiventanas las ordenes adecuadas
 * para su manejo
 *
 *  @package PHP::dispositivos
 */
class GeneradorMultiventana extends DispositivoIP {

/**
 * Atributo para diferenciar si se hace un preset o cualquier otra funcion
 *
 * @access private
 * @var boolean
 */
    private $functionPreset=false;

    function  __construct($dispositivo) {

        $this->tipoDispositivo="GeneradorMultiventanas";
        parent::__construct($dispositivo);
        echo($this->ip."-".$this->modeloIPLT."-".$this->strMarca."-".$this->strModelo."-".$this->id_disp."-".$this->tipoPuerto."-".$this->numeroPuerto."-".$this->baudRate."-".$this->timeOut."-".$this->puerto."-".$this->password);

    }


    /**
     * Metodo para poner el input $x en la ventana $y
     *
     * @access public
     * @param int $x
     * @param int $y
     */
    public function inputXVentanaY( $x,  $y ) {

        $comando=$this->comandos1[DaoControl::$INPUT];
        $comando=$this->procesarComando($comando, array("input"=>$x,"ventana"=>$y));
        $respuesta=$this->enviarComando($comando);
if(strpos($respuesta,"Out")!=0){

	echo "el generador multiventanas  a producido el siguiente error: ".$respuesta."\n";
}

    } // end of member function inputXVentanaY

    /**
     * Metodo para poner el preset en la ventanda indicada como parametro
     *
     * @access public
     * @param int $id
     */
    public function preset( $id ) {

        $this->functionPreset=true;
        $comando=$this->comandos1[DaoControl::$PRESET];
        $comando=$this->procesarComando($comando, $id);
        $respuesta=$this->enviarComando($comando);
if(strpos($respuesta,"Rpr")!=0){

	echo "el generador multiventanas  a producido el siguiente error: ".$respuesta."\n";
}

        $this->functionPreset=false;

    } // end of member function eragiketa_berria

    /**
     * Metodo mara general el comando adecuado para que el generador lo entienda
     *
     * @access public
     * @param string $comando Comando recogido de la lista de comandos
     * @param string $parametro Para remplazar en $comando
     * @return string Comando preparado para enviar al generador multiventanas
     */
    public function procesarComando($comando,$parametro) {
      
        if ($this->functionPreset) {
            $comando=str_replace("\$pr$", $parametro, $comando);
        }
        else {
            $comando=str_replace("\$in$", $parametro["input"], $comando);
            $comando=str_replace("\$win$", $parametro["ventana"], $comando);
        }
        return $comando;
    }

} // end of GeneradorMultiventana
?>
