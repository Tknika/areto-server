<?php
/**
 * @package PHP::controladoresGuiDispositivos
 */
/**
 * Clases necesarias para el control
 */
require_once './AccesoControladoresDispositivos.php';

/**
 * Description of ControladorGuiCamaras
 *
 * Clase que se encargara de enviar los comandos necesarios a las camaras y a
 * sus respectivas pantallas
 *
 * @author amaia
 *
 * @package PHP::controladoresGuiDispositivos
 */
class ControladorGuiCamaras {


//    /**
//     *
//     *
//     * @return
//     * @access public
//     */
//    public function pantallaCamara1( ) {
//    } // end of member function pantallaCamara1
//
//    /**
//     *
//     *
//     * @return
//     * @access public
//     */
//    public function pantallaCamara2( ) {
//    } // end of member function pantallaCamara2
//
//    /**
//     *
//     *
//     * @return
//     * @access public
//     */
//    public function pantallaCamara3( ) {
//    } // end of member function pantallaCamara3


    public function acercarCamaraAlumnos1() {

        AccesoControladoresDispositivos::$ctrlCamaras->acercarCamaraAlumnos1();

    } // end of member function acercarCamara
    public function acercarCamaraAlumnos2() {

        AccesoControladoresDispositivos::$ctrlCamaras->acercarCamaraAlumnos2();

    } // end of member function acercarCamara
    public function acercarCamaraPresidencia() {

        AccesoControladoresDispositivos::$ctrlCamaras->acercarCamaraPresidencia();

    } // end of member function acercarCamara
    public function alejarCamaraAlumnos1() {

        AccesoControladoresDispositivos::$ctrlCamaras->alejarCamaraAlumnos1();

    } // end of member function acercarCamara
    public function alejarCamaraAlumnos2() {

        AccesoControladoresDispositivos::$ctrlCamaras->alejarCamaraAlumnos2();

    } // end of member function acercarCamara
    public function alejarCamaraPresidencia() {

        AccesoControladoresDispositivos::$ctrlCamaras->alejarCamaraPresidencia();

    } // end of member function acercarCamara
    public function panRightCamaraAlumnos1() {

        AccesoControladoresDispositivos::$ctrlCamaras->panRightCamaraAlumnos1();

    } // end of member function acercarCamara
    public function panRightCamaraAlumnos2() {

        AccesoControladoresDispositivos::$ctrlCamaras->panRightCamaraAlumnos2();

    } // end of member function acercarCamara
    public function panRightCamaraPresidencia() {

        AccesoControladoresDispositivos::$ctrlCamaras->panRightCamaraPresidencia();

    } // end of member function acercarCamara
    public function panLeftCamaraAlumnos1() {

        AccesoControladoresDispositivos::$ctrlCamaras->panLeftCamaraAlumnos1();

    } // end of member function acercarCamara
    public function panLeftCamaraAlumnos2() {

        AccesoControladoresDispositivos::$ctrlCamaras->panLeftCamaraAlumnos2();

    } // end of member function acercarCamara
    public function panLeftCamaraPresidencia() {

        AccesoControladoresDispositivos::$ctrlCamaras->panLeftCamaraPresidencia();

    } // end of member function acercarCamara
    public function tiltUpCamaraAlumnos1() {

        AccesoControladoresDispositivos::$ctrlCamaras->tiltUpCamaraAlumnos1();

    } // end of member function acercarCamara
    public function tiltUpCamaraAlumnos2() {

        AccesoControladoresDispositivos::$ctrlCamaras->tiltUpCamaraAlumnos2();

    } // end of member function acercarCamara
    public function tiltUpCamaraPresidencia() {

        AccesoControladoresDispositivos::$ctrlCamaras->tiltUpCamaraPresidencia();

    } // end of member function acercarCamara
    public function tiltDownCamaraAlumnos1() {

        AccesoControladoresDispositivos::$ctrlCamaras->tiltUpCamaraAlumnos1();

    } // end of member function acercarCamara
    public function tiltDownCamaraAlumnos2() {

        AccesoControladoresDispositivos::$ctrlCamaras->tiltUpCamaraAlumnos2();

    } // end of member function acercarCamara
    public function tiltDownCamaraPresidencia() {

        AccesoControladoresDispositivos::$ctrlCamaras->tiltUpCamaraPresidencia();

    } // end of member function acercarCamara
    public function presetCamaraAlumnos1($pos) {

        AccesoControladoresDispositivos::$ctrlCamaras->presetCamaraAlumnos1($pos);

    } // end of member function acercarCamara
    public function presetCamaraAlumnos2($pos) {

        AccesoControladoresDispositivos::$ctrlCamaras->presetCamaraAlumnos2($pos);

    } // end of member function acercarCamara
    public function presetCamaraPresidencia($pos) {

        AccesoControladoresDispositivos::$ctrlCamaras->presetCamaraPresidencia($pos);

    } // end of member function acercarCamara


    /**
     * Metodo para examinar el entorno y la accion del comando recivido por la pelicula flash para
     * seleccionar la camara y la funcion adecuada
     *
     * @param ComandoFlash $cmd
     */
    public function getComandoFlash($cmd) {
        if (strcmp($cmd->getAccion(),"ACERCAR")==0) {
            if(strcmp($cmd->getEntorno(),"CAMARA_1")==0)
                $this->acercarCamaraAlumnos1();
            else if(strcmp($cmd->getEntorno(),"CAMARA_2")==0)
                    $this->acercarCamaraAlumnos2();
            if(strcmp($cmd->getEntorno(),"CAMARA_3")==0)
                $this->acercarCamaraPresidencia();
        }
        else if (strcmp($cmd->getAccion(),"ALEJAR")==0) {
                if(strcmp($cmd->getEntorno(),"CAMARA_1")==0)
                    $this->alejarCamaraAlumnos1();
                else if(strcmp($cmd->getEntorno(),"CAMARA_2")==0)
                        $this->alejarCamaraAlumnos2();
                if(strcmp($cmd->getEntorno(),"CAMARA_3")==0)
                    $this->alejarCamaraPresidencia();
            }
            else if (strcmp($cmd->getAccion(),"PANR")==0) {
                    if(strcmp($cmd->getEntorno(),"CAMARA_1")==0)
                        $this->panRightCamaraAlumnos1();
                    else if(strcmp($cmd->getEntorno(),"CAMARA_2")==0)
                            $this->panRightCamaraAlumnos2();
                    if(strcmp($cmd->getEntorno(),"CAMARA_3")==0)
                        $this->panRightCamaraPresidencia();
                }
                else if (strcmp($cmd->getAccion(),"PANL")==0) {
                        if(strcmp($cmd->getEntorno(),"CAMARA_1")==0)
                            $this->panLeftCamaraAlumnos1();
                        else if(strcmp($cmd->getEntorno(),"CAMARA_2")==0)
                                $this->panLeftCamaraAlumnos2();
                        if(strcmp($cmd->getEntorno(),"CAMARA_3")==0)
                            $this->panLeftCamaraPresidencia();
                    }
                    else if (strcmp($cmd->getAccion(),"TILTUP")==0) {

                            if(strcmp($cmd->getEntorno(),"CAMARA_1")==0)
                                $this->tiltUpCamaraAlumnos1();
                            else if(strcmp($cmd->getEntorno(),"CAMARA_2")==0)
                                    $this->tiltUpCamaraAlumnos2();
                            if(strcmp($cmd->getEntorno(),"CAMARA_3")==0)
                                $this->tiltUpCamaraPresidencia();
                        }
                        else if (strcmp($cmd->getAccion(),"TILTDOWN")==0) {
                                if(strcmp($cmd->getEntorno(),"CAMARA_1")==0)
                                    $this->tiltDownCamaraAlumnos1();
                                else if(strcmp($cmd->getEntorno(),"CAMARA_2")==0)
                                        $this->tiltDownCamaraAlumnos2();
                                if(strcmp($cmd->getEntorno(),"CAMARA_3")==0)
                                    $this->tiltDownCamaraPresidencia();
                            }

                            //                            else if (strcmp($cmd->getAccion(),"PARAR")==0) {
                            //                                    if(strcmp($cmd->getEntorno(),"CAMARA_1"))
                            //                                        $this->pararCamaraAlumnos1();
                            //                                    else if(strcmp($cmd->getEntorno(),"CAMARA_2"))
                            //                                            $this->pararCamaraAlumnos1();
                            //                                    if(strcmp($cmd->getEntorno(),"CAMARA_3"))
                            //                                        $this->pararCamaraPresidencia();
                            //                                }
                            else if (strcmp($cmd->getAccion(),"POSICION")==0) {
                                    if(strcmp($cmd->getEntorno(),"CAMARA_1")==0)
                                        $this->presetCamaraAlumnos1($cmd->getAtributo());
                                    else if(strcmp($cmd->getEntorno(),"CAMARA_2")==0)
                                            $this->presetCamaraAlumnos2($cmd->getAtributo());
                                    if(strcmp($cmd->getEntorno(),"CAMARA_3")==0)
                                        $this->presetCamaraPresidencia($cmd->getAtributo());
                                }
    // if(strcmp($tipoComando, "COMANDO")==0)
    //        $comandoFlash=$this->crearComandoFlash($cmd->getEntorno());
    //        //else if(strcmp($tipoComando, "POSICION")==0)
    //        $comandoFlash=$this->crearComandoPosicionFlash($cmd->getEntorno());
    //        return $comandoFlash;

    }



} // end of ControladorCamaras
?>
