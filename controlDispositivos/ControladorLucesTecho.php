<?php
/**
 * @package PHP::controladoresDispositivos
 */
 /**
 * includes
 */
require_once './dispositivos/LuzTecho.php';
/**
 * class ControladorLuces
 *
 * Clase que se encargara de enviar las ordenes adecuadas a la clase LuzTecho
 * para el control de las luces del techo
 *
 * @package PHP::controladoresDispositivos
 *
 */
class ControladorLucesTecho {



/**
 * Atributo que guardara la instancia de la clase LucesTecho
 *
 * @var LucesTecho
 * @access private
 * @static
 */
   private static $luz;

    public function  __construct() {

        self::$luz=new LuzTecho("Luces");

    }

    /**
     * Metodo para encender todas las luces del techo
     *
     * @access public
     */
    public function encenderLucesTecho( ) {

        $this->sala_on=true;
        self::$luz->encender();

    } // end of member function lucesTechoEncender

    /**
     * Metodo para apagar todas las luces del techo
     *
     * @access public
     */
    public function apagarLucesTecho( ) {

         $this->sala_on=false;
        self::$luz->apagar();

    } // end of member function lucesTechoApagar

    /**
     * Metodo para encender las luces del techo de la presidencia
     *
     * @access public
     */
    public function lucesTechoPresidenciaEncender( ) {

        self::$luz->encenderGrupo(LuzTecho::$PRESIDENCIA);

    } // end of member function lucesTechoPresidenciaEncender

    /**
     * Metodo para apagar las luces del techo de la presidencia
     *
     * @access public
     */
    public function lucesTechoPresidenciaApagar( ) {

        self::$luz->apagarGrupo(LuzTecho::$PRESIDENCIA);

    } // end of member function lucesTechoPresidenciaApagar

    /**
     * Metodo para subir la intensidad de las luces del techo de la presidencia
     *
     * @access public
     */
    public function lucesTechoPresidenciaSubir( ) {

        self::$luz->subirIntensidad(LuzTecho::$PRESIDENCIA);

    } // end of member function lucesTechoPresiSubir

    /**
     * Metodo para bajar la intensidad de las luces del techo de la presidencia
     *
     * @access public
     */
    public function lucesTechoPresidenciaBajar( ) {

        self::$luz->bajarIntensidad(LuzTecho::$PRESIDENCIA);

    } // end of member function lucesTechoPresiBajar

    /**
     * Metodo que devolvera el valor de la intensidad de las luces del techo de la
     * presidencia
     *
     * @return int
     */
public  function getIntensidadPresidencia() {

   return self::$luz->getLevelGrupo(LuzTecho::$PRESIDENCIA);

}

    /**
     * Metodo para encender las luces del techo del Pasillo
     *
     * @access public
     */
    public function lucesTechoPasilloEncender( ) {

        self::$luz->encenderGrupo(LuzTecho::$PASILLO);

    } // end of member function lucesTechoPasilloEncender

    /**
     * Metodo para apagar las luces del techo del Pasillo
     *
     * @access public
     */
    public function lucesTechoPasilloApagar( ) {

        self::$luz->apagarGrupo(LuzTecho::$PASILLO);

    } // end of member function lucesTechoPasilloApagar

    /**
     * Metodo para subir la intensidad de las luces del techo del pasillo
     *
     * @access public
     */
    public function lucesTechoPasilloSubir( ) {

        self::$luz->subirIntensidad(LuzTecho::$PASILLO);

    } // end of member function lucesTechoPasilloSubir

    /**
     * Metodo para bajar la intensidad de las luces del techo del pasillo
     *
     * @access public
     */
    public function lucesTechoPasilloBajar( ) {

        self::$luz->bajarIntensidad(LuzTecho::$PASILLO);

    } // end of member function lucesTechoPasilloBajar

    /**
     * Metodo que devolvera el valor de la intensidad de las luces del techo de la
     * presidencia
     *
     * @return int
     */
public  function getIntensidadPasillo() {

   return self::$luz->getLevelGrupo(LuzTecho::$PASILLO);

}

    /**
     * Metodo para encender las luces del techo de los alumnos
     *
     * @access public
     */
    public function lucesTechoAlumnosEncender( ) {

        self::$luz->encenderGrupo(LuzTecho::$ALUMNOS);

    } // end of member function lucesTechoAlumnosEncender

    /**
     * Metodo para apagar las luces del techo de los alumnos
     *
     * @access public
     */
    public function lucesTechoAlumnosApagar( ) {

        self::$luz->apagarGrupo(LuzTecho::$ALUMNOS);

    } // end of member function lucesTechoAlumnosApagar

    /**
     * Metodo para subir la intensidad de las luces del techo de los alumnos
     *
     * @access public
     */
    public function lucesTechoAlumnosSubir( ) {

        self::$luz->subirIntensidad(LuzTecho::$ALUMNOS);

    } // end of member function lucesTechoAlumnosSubir

    /**
     * Metodo para bajar la intensidad de las luces del techo de los alumnos
     *
     * @access public
     */
    public function lucesTechoAlumnosBajar( ) {

        self::$luz->bajarIntensidad(LuzTecho::$ALUMNOS);

    } // end of member function lucesTechoAlumnosBajar

    /**
     * Metodo que devolvera el valor de la intensidad de las luces del techo de
     * los alumnos
     *
     * @return int
     */
public  function getIntensidadAlumnos() {

    return self::$luz->getLevelGrupo(LuzTecho::$ALUMNOS);

}

/**
     *  Metodo que encendera las luces del techo con la intensidad predeterminada para
     * cada escenario
 *
     * @param string $escenario
 */
public function setLucesEscenarios($escenario) {

        self::$luz->setLucesEscenarios($escenario);

    }

    /**
     * Metodo que devolvera el valor de la intensidad maxima de las luces del techo
     *
     * @return int
     */
public function getIntensidadMaxima() {

return self::$luz->getIntensidadMaxima();

}

    /**
     * Metodo que devolvera el valor de la intensidad minima de las luces del techo
     *
     * @return int
     */
public function getIntensidadMinima() {

return self::$luz->getIntensidadMinima();

}

} // end of ControladorLuces
?>
