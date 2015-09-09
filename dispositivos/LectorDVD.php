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
require_once './dispositivos/DVD.php';



/**
 * class LectorDVD
 *
 * Clase que se encargara de enviar al dvd las ordenes adecuadas
 * para su manejo
 *
 *  @package PHP::dispositivos
 */
class LectorDVD extends DVD {

    function  __construct($dispositivo) {

        $this->tipoDispositivo="Dvd";
        parent::__construct($dispositivo);
        echo($this->ip."-".$this->modeloIPLT."-".$this->strMarca."-".$this->strModelo."-".$this->id_disp."-".$this->tipoPuerto."-".$this->numeroPuerto."-".$this->baudRate."-".$this->timeOut."-".$this->puerto."-".$this->password);

    }

    /**
     * Metodo para encender y apagar el lector de dvd, si esta encendido lo apaga,
     * y si esta apagado lo enciende
     *
     * @access public
     */
    public function onOff() {

        if(strcmp($this->getEstado(),$this->OFF)==0) {
        //hay que mandar cualquier comando para que se encienda, para que se apague y se encienda seguido
            $this->menu();
            $comando=$this->comandos1[DaoControl::$ENCENDER];
            $this->setEstado(self::$ON);
            $this->enviarComando($comando);
        }
        else {
        //hay que mandar cualquier comando para que se apague, para que se apague y se encienda seguido
            $this->menu();
            $comando=$this->comandos1[DaoControl::$APAGAR];
            $this->setEstado(self::$OFF);
            $this->enviarComando($comando);
        }
        $this->guardarEstado();

    }

    /**
     * Metodo para ir al capitulo anterior del dvd
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function rStep( ) {
$this->pause();
        $comando=$this->comandos1[DaoControl::$RSTEP];
       
        $this->enviarComando($comando);
        $this->setEstado(self::$PREV);
        $this->guardarEstado();

    } // end of member function rStep

    /**
     * Metodo para ir al siguiente capitulo del dvd
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function fStep( ) {
$this->pause();
        $comando=$this->comandos1[DaoControl::$FSTEP];
      
        $this->enviarComando($comando);
        $this->setEstado(self::$NEXT );
        $this->guardarEstado();

    } // end of member function fStep

    /**
     * Metodo para ir al menu del dvd
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function menu( ) {

        $comando=$this->comandos1[DaoControl::$MENU];
        $this->enviarComando($comando);
        $this->setEstado(self::$RIGHT);
        $this->guardarEstado();

    } // end of member function menu

    /**
     * Metodo para tratar el comando antes de enviarlo al dvd, en este caso no hace falta
     * @param string $comando
     * @param string $parametro
     */
    public function procesarComando($comando,$parametro) {
    }

//    /**
//     * Carga en los atributos los valores que se encuentran en el archivo estadoDispositivos.properties
//     */
//    public function cargarEstado() {
//
//        $this->estadoDispositivo=new Properties();
//        $this->estadoDispositivo->load(file_get_contents("./estadoDispositivos.properties"));
//        $this->estado=$this->estadoDispositivo->getProperty("Dvd.estado");
//
//    }
//
//    /**
//     * Guarda los valores de los atributos en el archivo estadoDispositivos.properties
//     */
//    public function guardarEstado() {
//
//        $this->estadoDispositivo=new Properties();
//        $this->estadoDispositivo->setProperty("Dvd.estado",$this->estado);
//        file_put_contents('./estadoDispositivos.properties', $this->estadoDispositivo->toString(true));
//
//    }

} // end of LectorDVD
?>
