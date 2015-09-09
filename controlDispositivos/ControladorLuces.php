<?php
/**
 * @package PHP::controladoresDispositivos
 */

/**
 * Description of ControladorTechoAutomata
 *
 * Clase que se encargara de enviar las ordenes adecuadas a las clases
 * Automata y luces techo para el control de las luces.
 *
 * @author amaia
 *
 * @package PHP::controladoresDispositivos
 */
class ControladorLuces {
/**
 * Atributo que guardara la instancia de la clase ControladorLucesTecho
 *
 * @var ControladorLucesTecho
 * @access private
 * @static
 */
    private static $lucesTecho;
    /**
     * Atributo que guardara la instancia de la clase ControladorAutomata
     *
     * @var ControladorAutomata
     * @access private
     * @static
     */
    private static $lucesSuelo;

    public function  __construct() {
    //new beharren accesotik hartu
        self::$lucesSuelo=new ControladorAutomata();
        self::$lucesTecho=new ControladorLucesTecho();

    }

    /**
     * Metodo para encender todas las luces de la sala
     *
     * @access public
     */
    public function encenderSala() {

        self::$lucesSuelo->encenderLucesSuelo();
        self::$lucesTecho->encenderLucesTecho();

    }

    /**
     * Metodo para apagar todas las luces de la sala
     *
     * @access public
     */
    public function apagarSala() {

        self::$lucesSuelo->apagarLucesSuelo();
        self::$lucesTecho->apagarLucesTecho();

    }

    ////////////////////////////////////////////////
    ////////////////////Luces Techo/////////////////
    ////////////////////////////////////////////////


    /**
     * Metodo para encender todas las luces del techo
     *
     * @access public
     */
    public function encenderLucesTecho() {

        self::$lucesTecho->encenderLucesTecho();

    }

    /**
     * Metodo para apagar todas las luces del techo
     *
     * @access public
     */
    public function apagarLucesTecho() {

        self::$lucesTecho->apagarLucesTecho();

    }

    /**
     * Metodo para encender las luces del techo de la presidencia
     *
     * @access public
     */
    public function encenderLucesTechoPresidencia() {

        self::$lucesTecho->lucesTechoPresidenciaEncender();

    }

    /**
     * Metodo para apagar las luces del techo de la presidencia
     *
     * @access public
     */
    public function apagarLucesTechoPresidencia() {

        self::$lucesTecho->lucesTechoPresidenciaApagar();

    }

    /**
     * Metodo para subir la intensidad de las luces del techo de la presidencia
     *
     * @access public
     */
    public function subirLucesTechoPresidencia() {

        self::$lucesTecho->lucesTechoPresidenciaSubir();

    }

    /**
     * Metodo para bajar la intensidad de las luces del techo de la presidencia
     *
     * @access public
     */
    public function bajarLucesTechoPresidencia() {

        self::$lucesTecho->lucesTechoPresidenciaBajar();

    }

    /**
     * Metodo que devolvera el valor de la intensidad de las luces del techo de la
     * presidencia
     *
     * @return int
     */
    public function getIntensidadTechoPresidencia() {

        return self::$lucesTecho->getIntensidadPresidencia();

    }

    /**
     * Metodo para encender las luces del techo del Pasillo
     *
     * @access public
     */
    public function encenderLucesTechoPasillo() {

        self::$lucesTecho->lucesTechoPasilloEncender();

    }

    /**
     * Metodo para apagar las luces del techo del Pasillo
     *
     * @access public
     */
    public function apagarLucesTechoPasillo() {

        self::$lucesTecho->lucesTechoPasilloApagar();

    }

    /**
     * Metodo para subir la intensidad de las luces del techo del pasillo
     *
     * @access public
     */
    public function subirLucesTechoPasillo() {

        self::$lucesTecho->lucesTechoPasilloSubir();

    }

    /**
     * Metodo para bajar la intensidad de las luces del techo del pasillo
     *
     * @access public
     */
    public function bajarLucesTechoPasillo() {

        self::$lucesTecho->lucesTechoPasilloBajar();

    }

    /**
     * Metodo que devolvera el valor de la intensidad de las luces del techo de la
     * presidencia
     *
     * @return int
     */
    public function getIntensidadTechoPasillo() {

        return self::$lucesTecho->getIntensidadPasillo();

    }

    /**
     * Metodo para encender las luces del techo de los alumnos
     *
     * @access public
     */
    public function encenderLucesTechoAlumnos() {

        self::$lucesTecho->lucesTechoAlumnosEncender();

    }

    /**
     * Metodo para apagar las luces del techo de los alumnos
     *
     * @access public
     */
    public function apagarLucesTechoAlumnos() {

        self::$lucesTecho->lucesTechoAlumnosApagar();

    }

    /**
     * Metodo para subir la intensidad de las luces del techo de los alumnos
     *
     * @access public
     */
    public function subirLucesTechoAlumnos() {

        self::$lucesTecho->lucesTechoAlumnosSubir();

    }

    /**
     * Metodo para bajar la intensidad de las luces del techo de los alumnos
     *
     * @access public
     */
    public function bajarLucesTechoAlumnos() {

        self::$lucesTecho->lucesTechoAlumnosBajar();

    }

    /**
     * Metodo que devolvera el valor de la intensidad de las luces del techo de
     * los alumnos
     *
     * @return int
     */
    public function getIntensidadTechoAlumnos() {

        return self::$lucesTecho->getIntensidadAlumnos();

    }

    ///////////////////////Luces suelo/////////////////////////////

    /**
     *
     * Metodo para encender todas las luces del suelo
     *
     * @access public
     */
    public function encenderLucesSuelo() {

        echo "\n encendiendo luces suelo2 \n";
        self::$lucesSuelo->encenderLucesSuelo();

    }

    /**
     *
     * Metodo para apagar todas las luces del suelo
     *
     * @access public
     */
    public function apagarLucesSuelo() {

        self::$lucesSuelo->apagarLucesSuelo();

    }

    /**
     * Metodo para encender las luces del suelo del Pasillo
     *
     * @access public
     */
    public function encenderLucesSueloPasillo() {

        self::$lucesSuelo->encenderLucesSueloPasillo();

    }

    /**
     * Metodo para apagar las luces del suelo del Pasillo
     *
     * @access public
     */
    public function apagarLucesSueloPasillo() {

        self::$lucesSuelo->apagarLucesSueloPasillo();

    }

    /**
     * Metodo para subir la intensidad de las luces del suelo del pasillo
     *
     * @access public
     */
    public function subirLucesSueloPasillo() {

        self::$lucesSuelo->subirIntensidadLucesSueloPasillo();

    }

    /**
     * Metodo para bajar la intensidad de las luces del suelo del pasillo
     *
     * @access public
     */
    public function bajarLucesSueloPasillo() {

        self::$lucesSuelo->bajarIntensidadLucesSueloPasillo();

    }

    /**
     * Metodo que devolvera el valor de la intensidad de las luces del suelo del
     * pasillo
     *
     * @return string hexadecimal
     */
    public function getIntensidadSueloPasillo() {

        return   self::$lucesSuelo->getIntensidadPasillo();

    }

    /**
     * Metodo para encender las luces del techo de los alumnos
     *
     * @access public
     */
    public function encenderLucesSueloAlumnos() {

        self::$lucesSuelo->encenderLucesSueloAlumnos();

    }

    /**
     * Metodo para apagar las luces del suelo de los alumnos
     *
     * @access public
     */
    public function apagarLucesSueloAlumnos() {

        self::$lucesSuelo->apagarLucesSueloAlumnos();

    }

    /**
     * Metodo para subir la intensidad de las luces del suelo de los alumnos
     *
     * @access public
     */
    public function subirLucesSueloAlumnos() {

        self::$lucesSuelo->subirIntensidadLucesSueloAlumnos();

    }

    /**
     * Metodo para bajar la intensidad de las luces del suelo de los alumnos
     *
     * @access public
     */
    public function bajarLucesSueloAlumnos() {

        self::$lucesSuelo->bajarIntensidadLucesSueloAlumnos();

    }
    /**
     * Metodo que devolvera el valor de la intensidad de las luces del suelo de
     * los alumnos
     *
     * @return string hexadecimal
     */
    public function getIntensidadSueloAlumnos() {

        return self::$lucesSuelo->getIntensidadAlumnos();

    }

    /**
     * Metodo que devolvera el valor de la intensidad maxima de las luces del techo
     *
     * @return int
     */
    public function getIntensidadMaximaTecho() {

        return self::$lucesTecho->getIntensidadMaxima();

    }

    /**
     * Metodo que devolvera el valor de la intensidad minima de las luces del techo
     *
     * @return int
     */
    public function getIntensidadMinimaTecho() {

        return self::$lucesTecho->getIntensidadMinima();

    }

    /**
     *  Metodo que encendera las luces del techo con la intensidad predeterminada para
     * cada escenario
     *
     * @param string $escenario
     */
    public function setLucesEscenarios($escenario) {

        self::$lucesTecho->setLucesEscenarios($escenario);

    }

}
?>
