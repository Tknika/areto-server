<?php
/**
 * @package PHP::controladoresGuiDispositivos
 */
/**
 * Clases necesarias para el control
 */

/**
 * Description of ControlGuiEscenarios
 *
 * Clase que se encargara de enviar los comandos necesarios a los dispositivos
 * que se utilizen cuando los alumnos hacen preguntas,....
 *
 * @author amaia
 *
 * @package PHP::controladoresGuiDispositivos
 */
class ControladorGuiAlumno {

/**
 * Metodo para sacar una foto al alumno que pide la palabra
 *
 * @param int $alumno
 */
    public function alumnoPidePalabra( $alumno ) {


        AccesoControladoresDispositivos::$ctrlCamaras->presetCamaraAlumnos1($alumno);
        AccesoControladoresDispositivos::$ctrlCamaras->presetCamaraAlumnos2($alumno);
        try {
            usleep(3000000);
        } catch (Exception $e) {
        }
        Utils::sacarFoto($alumno);
        AccesoGui::$guiAlumno->alumnoPidePalabra($alumno);


    } // end of member function alumnoPidePalabra

    /**
     * Metodo para enfocar al alumno que hace una pregunta con el foco
     * (generador multiventanas????)
     *
     * @param int alumno
     * @access public
     */
    public function alumnoTienePalabra( $alumno ) {
        AccesoControladoresDispositivos::$ctrlGeneradorMultiventanas->preset(2);
        AccesoControladoresDispositivos::$ctrlFoco->posicion($alumno);
        AccesoGui::$guiAlumno->alumnoTienePalabra($alumno);
        AccesoGui::$guiAlumno->dibujarPantalla();
    } // end of member function alumnoTienePalabra

    /**
     * Metodo para que el foco deje de apuntar al alumno
     *
     * @param int alumno
     * @access public
     */
    public function alumnoNoTienePalabra( $alumno ) {
        AccesoControladoresDispositivos::$ctrlGeneradorMultiventanas->preset(2);
        AccesoControladoresDispositivos::$ctrlFoco->quitarPreset();
        AccesoGui::$guiAlumno->alumnoNoTienePalabra($alumno);
        AccesoGui::$guiAlumno->dibujarPantalla();
    } // end of member function alumnoNoTienePalabra

    /**
     * Metodo para examinar la accion del comando recivido por la pelicula flash para
     * seleccionar la funcion del alumno adecuada
     *
     * @param ComandoFlash $cmd
     */
    public function getComandoFlash($cmd) {

        if (strcmp($cmd->getAccion(),"PIDE_PALABRA")==0) {
            $lag = $cmd->getAtributo();
            $alumno = substr($lag,2);
            $this->alumnoPidePalabra($alumno);
        }
        else if (strcmp($cmd->getAccion(),"TIENE_PALABRA")==0) {
                $lag1 = $cmd->getAtributo();
                $alumno1 = substr($lag1, 2);
                $this->alumnoTienePalabra($alumno1);
            }
            else if (strcmp($cmd->getAccion(),"NOTIENE_PALABRA")==0) {
                    $lag2 = $cmd->getAtributo();
                    $alumno2 = substr($lag2,2);
                    $this->alumnoNoTienePalabra($alumno2);
                }
    }
}
?>
