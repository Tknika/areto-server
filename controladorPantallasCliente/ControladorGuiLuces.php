<?php
/**
 * @package PHP::controladoresGuiDispositivos
 */
/**
 * Clases necesarias para el control
 */
require_once './controlDispositivos/ControladorLucesTecho.php';
require_once './AccesoControladoresDispositivos.php';

/**
 * Description of ControladorGuiLuces
 *
 * Clase que se encargara de enviar los comandos necesarios para controlar a las
 * luces, tanto del techo como las del suelo y marcar los botones seleccionados
 * en la pantalla de las luces.
 *
 * @author amaia
 *
 * @package PHP::controladoresGuiDispositivos
 */
class ControladorGuiLuces {

/**
 * Atributo que guardara la instancia de el controlador de luces
 *
 * @var ControladorLuces
 * @access private
 */
    private $luces;

    public function  __construct() {

        $this->luces=new ControladorLuces();

    }

    /**
     *
     *
     * @return
     * @access public
     */
    public function pantallaLuces( ) {
    } // end of member function pantallaLuces

    /**
     *
     *
     * @return
     * @access public
     */
    public  function lucesEncenderSala( ) {
        $this->luces->encenderSala();
        AccesoGui::$guiLuces->luzSalaEncenderTodo();
        //        AccesoControladoresDispositivos::$ctrlLuzTecho->encenderLucesTecho();
        //        AccesoControladoresDispositivos::$ctrlAutomata->encenderLucesSuelo();
    } // end of member function lucesEncenderSala

    /**
     * Metodo para apagar todas las luces de la sala y marcar el boton de apagar
     * todas las luces
     *
     * @access public
     */
    public function lucesApagarSala( ) {

        $this->luces->apagarSala();
        AccesoGui::$guiLuces->luzSalaApagarTodo();

    } // end of member function lucesApagarSala

    //    /**
    //     *
    //     *
    //     * @access public
    //     */
    //    public function lucesSubir($grupo) {
    //       // AccesoControladoresDispositivos::$luzTecho->subirIntensidad($grupo);
    //    } // end of member function lucesSubir
    //
    //    /**
    //     *
    //     *
    //     * @return
    //     * @access public
    //     */
    //    public function lucesBajar($grupo) {
    //        //AccesoControladoresDispositivos::$luzTecho->bajarIntensidad($grupo);
    //    } // end of member function lucesBajar
    //
    //    /**
    //     *
    //     *
    //     * @return
    //     * @access public
    //     */
    //    public function lucesEncender($grupo) {
    //        //AccesoControladoresDispositivos::$luzTecho->encender();
    //
    //    } // end of member function lucesEncender
    //
    //    /**
    //     *
    //     *
    //     * @return
    //     * @access public
    //     */
    //    public function lucesApagar($grupo ) {
    //        //AccesoDispositivos::$luz->apagar();
    //    } // end of member function lucesApagar

    /**
     * Metodo para encender todas las luces del techo y marcar el boton de la
     * pantalla
     *
     * @access public
     */
    public function lucesTechoEncender( ) {

        $this->luces->encenderLucesTecho();
        AccesoGui::$guiLuces->luzTechoEncender();

    } // end of member function lucesTechoEncender

    /**
     * Metodo para apagar todas las luces del techo y marcar el boton de la
     * pantalla
     *
     * @access public
     */
    public function lucesTechoApagar( ) {

        $this->luces->apagarLucesTecho();
        AccesoGui::$guiLuces->luzTechoApagar();

    } // end of member function lucesTechoApagar

    /**
     * Metodo para encender las luces del techo de la presidencia, marcar el
     * boton de la pantalla y actualizar la barra de intensidades
     *
     * @access public
     */
    public function lucesTechoPresidenciaEncender( ) {

        $this->luces->encenderLucesTechoPresidencia();
        AccesoGui::$guiLuces->luzTechoPresidenciaEncender();

    } // end of member function lucesTechoPresidenciaEncender

    /**
     * Metodo para apagar las luces del techo de la presidencia, marcar el
     * boton de la pantalla de apagadas y actualizar la barra de intensidades
     *
     * @access public
     */
    public function lucesTechoPresidenciaApagar( ) {
        $this->luces->apagarLucesTechoPresidencia();
        AccesoGui::$guiLuces->luzTechoPresidenciaApagar();
    } // end of member function lucesTechoPresidenciaApagar

    /**
     * Metodo para subir las luces del techo de la presidencia, marcar el
     * boton de la pantalla de subir la intensidad y actualizar la barra de
     * intensidades
     *
     * @access public
     */
    public function lucesTechoPresidenciaSubir( ) {
 AccesoGui::$guiLuces->luzTechoPresidenciaNivel();
        $this->luces->subirLucesTechoPresidencia();
       
    } // end of member function lucesTechoPresiSubir

    /**
     * Metodo para bajar las luces del techo de la presidencia, marcar el
     * boton de la pantalla de bajar la intensidad y actualizar la barra de
     * intensidades
     *
     * @access public
     */
    public function lucesTechoPresidenciaBajar( ) {
        $this->luces->bajarLucesTechoPresidencia();
        AccesoGui::$guiLuces->luzTechoPresidenciaNivel();
    } // end of member function lucesTechoPresiBajar

    /**
     * Metodo para encender las luces del techo del pasillo, marcar el  boton de
     * la pantalla y actualizar la barra de intensidades
     *
     * @access public
     */
    public function lucesTechoPasilloEncender( ) {
        $this->luces->encenderLucesTechoPasillo();
        AccesoGui::$guiLuces->luzTechoPasilloEncender();
    } // end of member function lucesTechoPasilloEncender

    /**
     * Metodo para apagar las luces del techo del pasillo, marcar el boton de la
     * pantalla de apagadas y actualizar la barra de intensidades
     *
     * @access public
     */
    public function lucesTechoPasilloApagar( ) {
        $this->luces->apagarLucesTechoPasillo();
        AccesoGui::$guiLuces->luzTechoPasilloApagar();
    } // end of member function lucesTechoPasilloApagar

    /**
     * Metodo para subir las luces del techo del pasillo, marcar el boton de la
     * pantalla de subir la intensidad y actualizar la barra de intensidades
     *
     * @access public
     */
    public function lucesTechoPasilloSubir( ) {
        $this->luces->subirLucesTechoPasillo();
        AccesoGui::$guiLuces->luzTechoPasilloNivel();
    } // end of member function lucesTechoPasilloSubir

    /**
     * Metodo para bajar las luces del techo del pasillo, marcar el boton de la
     * pantalla de subir la intensidad y actualizar la barra de intensidades
     *
     * @access public
     */
    public function lucesTechoPasilloBajar( ) {
        $this->luces->bajarLucesTechoPasillo();
        AccesoGui::$guiLuces->luzTechoPasilloNivel();
    } // end of member function lucesTechoPasilloBajar

    /**
     * Metodo para encender las luces del techo de los alumnos, marcar el  boton
     * de la pantalla y actualizar la barra de intensidades
     *
     * @access public
     */
    public function lucesTechoAlumnosEncender( ) {
        $this->luces->encenderLucesTechoAlumnos();
        AccesoGui::$guiLuces->luzTechoAlumnosEncender();
    } // end of member function lucesTechoAlumnosEncender

    /**
     * Metodo para apagar las luces del techo de los alumnos, marcar el  boton
     * de la pantalla y actualizar la barra de intensidades
     *
     * @access public
     */
    public function lucesTechoAlumnosApagar( ) {
        $this->luces->apagarLucesTechoAlumnos();
        AccesoGui::$guiLuces->luzTechoAlumnosApagar();
    }  // end of member function lucesTechoAlumnosApagar

    /**
     * Metodo para subir las luces del techo de los alumnos, marcar el boton de
     * la pantalla de subir la intensidad y actualizar la barra de intensidades
     *
     * @access public
     */
    public function lucesTechoAlumnosSubir( ) {
        $this->luces->subirLucesTechoAlumnos();
        AccesoGui::$guiLuces->luzTechoAlumnosNivel();
    } // end of member function lucesTechoAlumnosSubir

    /**
     * Metodo para bajar las luces del techo de los alumnos, marcar el boton de
     * la pantalla de subir la intensidad y actualizar la barra de intensidades
     *
     * @access public
     */
    public function lucesTechoAlumnosBajar( ) {
        $this->luces->bajarLucesTechoAlumnos();
        AccesoGui::$guiLuces->luzTechoAlumnosNivel();
    } // end of member function lucesTechoAlumnosBajar


    //////////////////////////////////////////////
    /////////////////LUCES SUELO//////////////////
    //////////////////////////////////////////////

    /**
     * Metodo para encender todas las luces del suelo y marcar el boton de la
     * pantalla
     *
     * @access public
     */
    public function lucesSueloEncender( ) {
        $this->luces->encenderLucesSuelo();
        AccesoGui::$guiLuces->luzSueloEncender();
    } // end of member function lucesSueloEncender

    /**
     * Metodo para encender todas las luces del suelo del pasillo y marcar el
     * boton de la pantalla
     *
     * @access public
     */
    public function lucesSueloPasilloEncender( ) {
        $this->luces->encenderLucesSueloPasillo();
        AccesoGui::$guiLuces->luzSueloPasilloEncender();
    } // end of member function lucesSueloPasilloEncender

    /**
     * Metodo para encender todas las luces del suelo de los alumnos y marcar el
     * boton de la pantalla
     *
     * @access public
     */
    public function lucesSueloAlumnosEncender( ) {
        $this->luces->encenderLucesSueloAlumnos();
        AccesoGui::$guiLuces->luzSueloAlumnosEncender();
    } // end of member function lucesSueloAlumnosEncender

    /**
     * Metodo para apagar todas las luces del suelo y marcar el boton de la
     * pantalla
     *
     * @access public
     */
    public function lucesSueloApagar( ) {
        $this->luces->apagarLucesSuelo();
        AccesoGui::$guiLuces->luzSueloApagar();
    } // end of member function lucesSueloApagar

    /**
     * Metodo para apagar todas las luces del suelo del pasillo y marcar el
     * boton de la pantalla
     *
     * @access public
     */
    public function lucesSueloPasilloApagar( ) {
        $this->luces->apagarLucesSueloPasillo();
        AccesoGui::$guiLuces->luzSueloPasilloApagar();
    } // end of member function lucesSueloPasilloApagar

    /**
     * Metodo para encender todas las luces del suelo de los alumnos y marcar el
     * boton de la pantalla
     *
     * @access public
     */
    public function lucesSueloAlumnosApagar( ) {
        $this->luces->apagarLucesSueloAlumnos();
        AccesoGui::$guiLuces->luzSueloAlumnosApagar();
    } // end of member function lucesSueloAlumnosApagar

    /**
     * Metodo para subir la intensidad todas las luces del suelo de los alumnos,
     * marcar el boton y actualizar la barra de la intensidad  de la pantalla
     *
     * @access public
     */
    public function lucesSueloAlumnosSubir( ) {
        $this->luces->subirLucesSueloAlumnos();
        AccesoGui::$guiLuces->luzSueloAlumnosNivel();
    } // end of member function lucesSueloAlumnosSubir

    /**
     * Metodo para bajar la intensidad todas las luces del suelo de los alumnos,
     * marcar el boton y actualizar la barra de la intensidad  de la pantalla
     *
     * @access public
     */
    public function lucesSueloAlumnosBajar( ) {
        $this->luces->bajarLucesSueloAlumnos();
        AccesoGui::$guiLuces->luzSueloAlumnosNivel();
    } // end of member function lucesSueloAlumnosBajar

    /**
     * Metodo para subir la intensidad todas las luces del suelo del pasillo,
     * marcar el boton y actualizar la barra de la intensidad  de la pantalla
     *
     * @access public
     */
    public function lucesSueloPasilloSubir( ) {
        $this->luces->subirLucesSueloPasillo();
        AccesoGui::$guiLuces->luzSueloPasilloNivel();
    } // end of member function lucesSueloPasilloSubir

    /**
     * Metodo para bajar la intensidad todas las luces del suelo del pasillo,
     * marcar el boton y actualizar la barra de la intensidad  de la pantalla
     *
     * @access public
     */
    public function lucesSueloPasilloBajar( ) {
        $this->luces->bajarLucesSueloPasillo();
        AccesoGui::$guiLuces->luzSueloPasilloNivel();
    } // end of member function lucesSueloPasilloBajar

    /**
     * Metodo para examinar la accion del comando recivido por la pelicula flash
     * para elegir la accion de las luces que se quiere
     *
     * @param ComandoFlash $cmd
     */
    public function getComandoFlash($cmd) {
        if (strcmp($cmd->getAccion(),"ENCENDER_SALA")==0) {
            $this->lucesEncenderSala();
        }
        else if (strcmp($cmd->getAccion(),"APAGAR_SALA")==0) {
            $this->lucesApagarSala();
        }
        else if (strcmp($cmd->getAccion(),"SUBIR")==0) {
            //denak batera igotzeko, ez da erabiltzen
            $this->luzSalaNivel($cmd->getAtributo());
        }
        else if (strcmp($cmd->getAccion(),"BAJAR")==0) {
            //denak batera jeisteko, ez da erabiltzen
            $this->luzSalaNivel($cmd->getAtributo());

        }
        else if (strcmp($cmd->getAccion(),"ENCENDER")==0) {
            $this->luzSalaEncenderTodo($cmd->getAtributo());
        }
        else if (strcmp($cmd->getAccion(),"APAGAR")==0) {
            $this->luzSalaApagarTodo($cmd->getAtributo());
        }
        else if (strcmp($cmd->getAccion(),"SUELO")==0) {
            $this->getComandoLucesSueloFlash($cmd);
        }
        else if (strcmp($cmd->getAccion(),"TECHO")==0) {
            $this->getComandoLucesTechoFlash($cmd);
        }
    }
    public function getComandoLucesTechoFlash($cmd) {
        if (strcmp($cmd->getAtributo(),"ENCENDER")==0) {
            $this->lucesTechoEncender();
        }
        else if (strcmp($cmd->getAtributo(),"APAGAR")==0) {
            $this->lucesTechoApagar();
        }
        else if (strcmp($cmd->getAtributo(),"PRESI_ENCENDER")==0) {
            $this->lucesTechoPresidenciaEncender();
        }
        else if (strcmp($cmd->getAtributo(),"PRESI_APAGAR")==0) {
            $this->lucesTechoPresidenciaApagar();
        }
        else if (strcmp($cmd->getAtributo(),"PRESI_SUBIR")==0) {
            $this->lucesTechoPresidenciaSubir();
        }
        else if (strcmp($cmd->getAtributo(),"PRESI_BAJAR")==0) {
            $this->lucesTechoPresidenciaBajar();
        }
        else if (strcmp($cmd->getAtributo(),"PASILLO_ENCENDER")==0) {
            $this->lucesTechoPasilloEncender();
        }
        else if (strcmp($cmd->getAtributo(),"PASILLO_APAGAR")==0) {
            $this->lucesTechoPasilloApagar();
        }
        else if (strcmp($cmd->getAtributo(),"PASILLO_SUBIR")==0) {
            $this->lucesTechoPasilloSubir();
        }
        else if (strcmp($cmd->getAtributo(),"PASILLO_BAJAR")==0) {
            $this->lucesTechoPasilloBajar();
        }
        else if (strcmp($cmd->getAtributo(),"ALUMNOS_ENCENDER")==0) {
            $this->lucesTechoAlumnosEncender();
        }
        else if (strcmp($cmd->getAtributo(),"ALUMNOS_APAGAR")==0) {
            $this->lucesTechoAlumnosApagar();
        }
        else if (strcmp($cmd->getAtributo(),"ALUMNOS_SUBIR")==0) {
            $this->lucesTechoAlumnosSubir();
        }
        else if (strcmp($cmd->getAtributo(),"ALUMNOS_BAJAR")==0) {
            $this->lucesTechoAlumnosBajar();
        }
    }
    public function getComandoLucesSueloFlash($cmd) {
        if (strcmp($cmd->getAtributo(),"ENCENDER")==0) {
            $this->lucesSueloEncender();
        }
        else if (strcmp($cmd->getAtributo(),"APAGAR")==0) {
            $this->lucesSueloApagar();
        }
        else if (strcmp($cmd->getAtributo(),"PASILLO_ENCENDER")==0) {
            $this->lucesSueloPasilloEncender();
        }
        else if (strcmp($cmd->getAtributo(),"PASILLO_APAGAR")==0) {
            $this->lucesSueloPasilloApagar();
        }
        else if (strcmp($cmd->getAtributo(),"PASILLO_SUBIR")==0) {
            $this->lucesSueloPasilloSubir();
        }
        else if (strcmp($cmd->getAtributo(),"PASILLO_BAJAR")==0) {
            $this->lucesSueloPasilloBajar();
        }
        else if (strcmp($cmd->getAtributo(),"ALUMNOS_ENCENDER")==0) {
            $this->lucesSueloAlumnosEncender();
        }
        else if (strcmp($cmd->getAtributo(),"ALUMNOS_APAGAR")==0) {
            $this->lucesSueloAlumnosApagar();
        }
        else if (strcmp($cmd->getAtributo(),"ALUMNOS_SUBIR")==0) {
            $this->lucesSueloAlumnosSubir();
        }
        else if (strcmp($cmd->getAtributo(),"ALUMNOS_BAJAR")==0) {
            $this->lucesSueloAlumnosBajar();
        }

    }

} // end of ControladorLuces
?>
