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
require_once 'Properties.php';

/**
 * Clase para controlar las luces del techo
 * @package PHP::dispositivos
 */
class LuzTecho extends DispositivoIP {

/**
 *
 * @var int
 * @static
 * @access private
 */
    private static $UNIDAD_INTENSIDAD = 10;

    /**
     * @var int
     * @static
     * @access private
     */
    private static $INTENSIDAD_MAXIMA = 155;

    /**
     * @var int
     * @static
     * @access private
     */
    private  static $INTENSIDAD_MINIMA = 55;

    /**
     * Atributo que se utiliza como parametro para seleccionar la linea de luces de los alumnos
     *
     * @var string
     * @static
     * @access public
     */
    public static $ALUMNOS="alumnos";
    /**
     * Atributo que se utiliza como parametro para seleccionar la linea de luces del pasillo
     *
     * @var string
     * @static
     * @access public
     */
    public static $PASILLO="pasillo";
    /**
     * Atributo que se utiliza como parametro para seleccionar la linea de luces de la presidencia
     *
     * @var string
     * @static
     * @access public
     */
    public static $PRESIDENCIA="presidencia";
    /**
     * Atributo para guardar los valores de las intensidades de cada linea de luz
     *
     * @var array
     * @access public
     */
    public $levels=array("alumnos"=>array(6=>255),"pasillo"=>array(7=>255,8=>255,9=>255),"presidencia"=>array(10=>255,11=>255,12=>255));
    /**
     * Atributo para guardar los valores de las intensidades de cada grupo
     *
     * @var array
     * @access public
     */
    public $levelGrupos=array("alumnos"=>255,"pasillo"=>255,"presidencia"=>255);
    /**
     * Atributo para poner el estado de las luces en on
     *
     * @var string
     * @static
     * @access public
     */
    public static $ENCENDIDA = "ON";
    /**
     * Atributo para poner el estado de las luces en off
     *
     * @var string
     * @static
     * @access public
     */
    public static $APAGADA = "OFF";
    /**
     * Atributo para poner los valores predefinidos de la clase local
     *
     * @var string
     * @static
     * @access public
     */
    public static $ESCENARIO_CLASE_LOCAL = "clase_local";
    /**
     * Atributo para poner los valores predefinidos del seminario
     *
     * @var string
     * @static
     * @access public
     */
    public static $ESCENARIO_SEMINARIO_CLASE = "seminario_clase";
    /**
     * Atributo para poner los valores predefinidos de la pelicula
     *
     * @var string
     * @static
     * @access public
     */
    public static $ESCENARIO_PELICULA = "pelicula";
    /**
     * Atributo para poner los valores predefinidos para enviar una clase
     *
     * @var string
     * @static
     * @access public
     */
    public static $ESCENARIO_ENVIAR_CLASE = "enviar_clase";
    /**
     * Atributo para poner los valores predefinidos para recibir una clase
     *
     * @var string
     * @static
     * @access public
     */
    public static $ESCENARIO_RECIBIR_CLASE = "recibir_clase";

    /**
     * Atributo para saber si se cambia la intensidad de una linea o se apaga o se enciende
     *
     * @var string
     * @access private
     */
    private $cambiarLinea=false;

    function  __construct($dispositivo) {

        $this->tipoDispositivo="Luces";
        parent::__construct($dispositivo);

        echo($this->ip."-".$this->modeloIPLT."-".$this->strMarca."-".$this->strModelo."-".$this->id_disp."-".$this->tipoPuerto."-".$this->numeroPuerto."-".$this->baudRate."-".$this->timeOut."-".$this->puerto."-".$this->password);
        $this->cargarEstado();

    }

    /**
     * Devuelve el valor minimo que puede tener la intensidad de la luz
     *
     * @return int
     */
    public function getIntensidadMaxima() {

        return self::$INTENSIDAD_MAXIMA;

    }

    /**
     * Devuelve el valor maximo que puede tener la intensidad de la luz
     *
     * @return int
     */
    public function getIntensidadMinima() {

        return self::$INTENSIDAD_MINIMA;

    }

    /**
     *Apagar las luces del grupo indicado como parametro
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     * @param string $idGrupo
     */
    public function apagarGrupo($idGrupo) {

        $this->cambiarLinea=true;
        $this->setLevelGrupo($idGrupo, 0);
        $this->setAllLevels($idGrupo, 0);
        $comando=$this->comandos1[DaoControl::$BAJARLINEA];
        $comando=$this->procesarComando($comando, $idGrupo);
        $this->enviarComando($comando);
        $this->setEstado(self::$ENCENDIDA);
        $this->cambiarLinea=false;
        $this->setEstado(self::$APAGADA);
        $this->guardarEstado();

    } // end of member function apagar

    /**
     *Enciende las luces del grupo indicado como parametro
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     * @param string $idGrupo
     */
    public function encenderGrupo($idGrupo) {

        $this->cambiarLinea=true;
        $this->setLevelGrupo($idGrupo, 255);
        $this->setAllLevels($idGrupo, 255);
        $comando=$this->comandos1[DaoControl::$SUBIRLINEA];
        $comando=$this->procesarComando($comando, $idGrupo);
        $this->enviarComando($comando);
        $this->setEstado(self::$ENCENDIDA);
        $this->cambiarLinea=false;
        $this->guardarEstado();


    } // end of member function encender
    /**
     *Apagar todas las luces
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function apagar() {

        $this->cambiarLinea=false;
        $comando=$this->comandos1[DaoControl::$APAGARLUCES];
        foreach ($this->levelGrupos as $num=>$value) {
            $this->levelGrupos[$num]=self::$INTENSIDAD_MINIMA;
        }
        foreach ($this->levels as $grupoActual=>$levelsGrupo) {
            foreach ($this->levels[$grupoActual] as $chanel=>$value) {
                $this->levels[$grupoActual][$chanel]=self::$INTENSIDAD_MINIMA;
            }
        }
        $comando=$this->procesarComando($comando, "");
        $this->enviarComando($comando);
        $this->setEstado(self::$APAGADA);
        $this->guardarEstado();

    } // end of member function apagar

    /**
     *Enciende todas las luces
     * 
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     */
    public function encender() {

        $this->cambiarLinea=false;
        $comando=$this->comandos1[DaoControl::$ENCENDERLUCES];
        foreach ($this->levelGrupos as $num=>$value)
            $this->levelGrupos[$num]=self::$INTENSIDAD_MAXIMA;
        foreach ($this->levels as $grupoActual=>$levelsGrupo) {
            foreach ($this->levels[$grupoActual] as $chanel=>$value) {
                $this->levels[$grupoActual][$chanel]=self::$INTENSIDAD_MAXIMA;
            }
        }
        $comando=$this->procesarComando($comando, "");
        $this->enviarComando($comando);
        $this->setEstado(self::$ENCENDIDA);
        $this->guardarEstado();

    } // end of member function encender

    /**
     *Sube la intensidad de las luces del grupo indicado como parametro
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     * @param string $grupo
     */
    public function subirIntensidad( $grupo ) {

        $this->cambiarLinea=true;
        $level=$this->getLevelGrupo($grupo)+self::$UNIDAD_INTENSIDAD;
        if ($level >= self::$INTENSIDAD_MAXIMA) {
            $level = self::$INTENSIDAD_MAXIMA;
        }
        else  if ($level <= self::$INTENSIDAD_MINIMA) {
                $level = self::$INTENSIDAD_MINIMA;
            }
        $this->setLevelGrupo($grupo, $level);
        $this->setAllLevels($grupo, $level);
        $comando=$this->comandos1[DaoControl::$SUBIRLINEA];
        $comando=$this->procesarComando($comando, $grupo);
        $this->enviarComando($comando);
        $this->setEstado(self::$ENCENDIDA);
        $this->cambiarLinea=false;
        $this->guardarEstado();

    } // end of member function subirIntensidad

    /**
     *Baja la intensidad de las luces del grupo indicado como parametro
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     * @param string $grupo
     */
    public function bajarIntensidad($grupo) {

        $this->cambiarLinea=true;
        $level=$this->getLevelGrupo($grupo)-self::$UNIDAD_INTENSIDAD;
        if ($level > self::$INTENSIDAD_MAXIMA) {
            $level = self::$INTENSIDAD_MAXIMA;
        }
        else  if ($level < self::$INTENSIDAD_MINIMA) {
                $level = self::$INTENSIDAD_MINIMA;
            }
        $this->setLevelGrupo($grupo, $level);
        $this->setAllLevels($grupo, $level);
        $comando=$this->comandos1[DaoControl::$BAJARLINEA];
        $comando=$this->procesarComando($comando, $grupo);
        $this->enviarComando($comando);
        $this->setEstado(self::$ENCENDIDA);
        $this->cambiarLinea=false;
        $this->guardarEstado();

    } // end of member function bajarIntensidad

    /**
     *Pone las luces con los valores predefinidos del escenario que se le pasa como parametro
     *
     * Una vez hechos todos los cambios, los guardara en el archivo estadoDispositivos.php
     *
     * @access public
     * @link Properties::guardarEstado()
     * @param string $escenario
     */
    public function setLucesEscenarios($escenario) {

        $this->cambiarLinea=false;
        $comando=$this->comandos1[$escenario];
        $valoresIntensidad=split("W", $comando);
	$i=1;
        foreach ($this->levels as $grupoactual=>$intensidades)
            foreach ($this->levels[$grupoactual] as $num=>$intensidad) {
             //   $this->levels[$grupoactual][$num]=self::$INTENSIDAD_MAXIMA;
		$this->levels[$grupoactual][$num]=$valoresIntensidad[$i];
		$i++;
            }
	if(strcmp($escenario,self::$ESCENARIO_PELICULA)==0){
 		foreach ($this->levelGrupos as $grupo=>$intensidad)
            		$this->levelGrupos[$grupo]=self::$INTENSIDAD_MINIMA;
	}
	else{
        	foreach ($this->levelGrupos as $grupo=>$intensidad)
           		$this->levelGrupos[$grupo]=self::$INTENSIDAD_MAXIMA;
}
        $comando=$this->procesarComando($comando, $escenario);
        $this->enviarComando($comando);
        $this->guardarEstado();

    }

    /**
     * Devuelve la intensidad del grupon pasado como parametro
     *
     * @param string $grupo
     * @return int
     */
    public function getLevelGrupo($grupo) {

        return $this->levelGrupos[$grupo];

    }

    /**
     * Pone los niveles de todos los grupos con el valor de la intensidad pasada como parametro
     *
     * @param int $level
     */
    public function setAllLevels($grupo,$level) {

        foreach ($this->levels[$grupo] as $num=>$value) {
            $this->levels[$grupo][$num]=$level;
        }

    }

    /**
     * Pone el nivel del grupo indicado con el valor de la intensidad pasada como parametro
     *
     * @param int $level
     */
    public function setLevelGrupo($grupo,$level) {

        $this->levelGrupos[$grupo]=$level;

    }

    /**
     * Devuelve el comando que se le mandara a la luz del techo,  tratandolos para formar
     * el comando necesario para que el la luz del techo responda responda
     *
     * @param string $comando
     * @param string $parametro
     * @return string $comandoCadena
     */
    public function procesarComando($comando,$parametro) {

        if($this->cambiarLinea) {//bolumena aldatu nahi denean
            $comandoCadena="";
            $comandoBerria="";
            foreach ($this->levels[$parametro] as $chanel=>$intensidad) {
                $comandoBerria=str_replace("\$ch$", $chanel, $comando);
                $comandoBerria=str_replace("\$id$", $intensidad, $comandoBerria);
                $comandoCadena=$comandoCadena.$comandoBerria."\n";
            }
        }
        else {//argiak piztu eta itzaltzeko
            $comandoCadena=$comando."\n";
        }
        return $comandoCadena;

    }

    /**
     * Carga en los atributos los valores que se encuentran en el archivo estadoDispositivos.properties
     */
    public function cargarEstado() {
        $this->estadoDispositivo=new Properties();
        $this->estadoDispositivo->load(file_get_contents("./estadoDispositivos.properties"));
        $this->levelGrupos["alumnos"]=$this->estadoDispositivo->getProperty('Luces.alumnos');
        $this->levelGrupos["presidencia"]=$this->estadoDispositivo->getProperty('Luces.presidencia');
        $this->levelGrupos["pasillo"]=$this->estadoDispositivo->getProperty('Luces.pasillo');
        $this->levels["alumnos"][6]=$this->estadoDispositivo->getProperty('Luces.6');
        $this->levels["pasillo"][7]=$this->estadoDispositivo->getProperty('Luces.7');
        $this->levels["pasillo"][8]=$this->estadoDispositivo->getProperty('Luces.8');
        $this->levels["pasillo"][9]=$this->estadoDispositivo->getProperty('Luces.9');
        $this->levels["presidencia"][10]=$this->estadoDispositivo->getProperty('Luces.10');
        $this->levels["presidencia"][11]=$this->estadoDispositivo->getProperty('Luces.11');
        $this->levels["presidencia"][12]=$this->estadoDispositivo->getProperty('Luces.12');

    }

    /**
     * Guarda los valores de los atributos en el archivo estadoDispositivos.properties
     */
    public function guardarEstado() {

        $this->estadoDispositivo=new Properties();
        $this->estadoDispositivo->load(file_get_contents("./estadoDispositivos.properties"));
        //guardando niveles de grupos y lineas
        foreach ($this->levels as $grupoActual=>$levelsGrupo) {
            $this->estadoDispositivo->setProperty('Luces.'.$grupoActual,$this->levelGrupos[$grupoActual]);
            foreach ($this->levels[$grupoActual] as $index=>$value) {
                $this->estadoDispositivo->setProperty('Luces.'.$index,$value);
            }

            file_put_contents('./estadoDispositivos.properties', $this->estadoDispositivo->toString(true));
        }
        
    }

} // end of Luz
?>
