<?php

/**
 * class GUI_Luces
 *
 */
class GUI_Luces {



    private $sala_on = 1;
    private $techo_on = 1;
    private $suelo_on = 1;
    private $techo_presidencia_on = 1;
    private $techo_pasillo_on = 1;
    private $techo_alumnos_on = 1;
    private $suelo_pasillo_on = 1;
    private $suelo_alumnos_on = 1;
    private $nivel_techo_presidencia = 255;
    private $nivel_techo_pasillo = 255;
    private $nivel_techo_alumnos = 255;
    private $nivel_suelo_pasillo = 255;
    private $nivel_suelo_alumnos = 255;
    private $nivel_suelo = 255;



    /**
     *
     *
     * @return
     * @access public
     */
    public function luzSalaEncenderTodo( ) {
        $this->sala_on = 1;
        $this->techo_on = 1;
        $this->suelo_on = 1;
        $this->techo_presidencia_on = 1;
        $this->techo_pasillo_on = 1;
        $this->techo_alumnos_on = 1;
        $this->suelo_pasillo_on = 1;
        $this->suelo_alumnos_on = 1;
        $this->ActualizarNivelesSala();
        //$this->activarPantalla();
        $this->dibujarPantalla();
    } // end of member function luzSalaEncenderTodo

    /**
     *
     *
     * @return
     * @access public
     */
    public function luzSalaApagarTodo( ) {
        $this->sala_on = 0;
        $this->techo_on = 0;
        $this->suelo_on = 0;
        $this->techo_presidencia_on = 0;
        $this->techo_pasillo_on = 0;
        $this->techo_alumnos_on = 0;
        $this->suelo_pasillo_on = 0;
        $this->suelo_alumnos_on = 0;
        $this->ActualizarNivelesSala();
        //$this->activarPantalla();
        $this->dibujarPantalla();
    } // end of member function luzSalaApagarTodo

    /**
     *
     *
     * @param int nivel

     * @return
     * @access public
     */
    public function luzSalaNivel( $nivel ) {
    //funtzio hau exekutatu aurretik luceseko bajar edo subir intensidad exekutatu beharko dira
    //getLuzNivel(luz) luces-etik
    // $nivel=AccesoDispositivos::$luz
    //$this->dibujarPantalla();
    } // end of member function luzSalaNivel

    /**
     *
     *
     * @param int luz

     * @return
     * @access public
     */
    public function luzSalaEncender( $luz ) {
        $this->sala_on = 1;
        $this->dibujarPantalla();
    //$this->activarPantalla();
    } // end of member function luzSalaEncender

    /**
     *
     *
     * @param int luz

     * @return
     * @access public
     */
    public function luzSalaApagar( $luz ) {
        $this->sala_on = 0;
        $this->dibujarPantalla();
    //$this->activarPantalla();
    } // end of member function luzSalaApagar

    /**
     *
     *
     * @return
     * @access public
     */
    public function luzTechoEncender( ) {

        $this->techo_on = 1;
        $this->techo_presidencia_on = 1;
        $this->techo_pasillo_on = 1;
        $this->techo_alumnos_on = 1;
        $this->ActualizarNivelesTecho();
         $this->dibujarTecho();
        //$this->dibujarPantalla();
    } // end of member function luzTechoEncender

    /**
     *
     *
     * @return
     * @access public
     */
    public function luzTechoapagar( ) {

        $this->techo_on = 0;
        $this->techo_presidencia_on = 0;
        $this->techo_pasillo_on = 0;
        $this->techo_alumnos_on = 0;
        $this->ActualizarNivelesTecho();
        $this->dibujarTecho();
        //$this->dibujarPantalla();
    } // end of member function luzTechoapagar

    /**
     *
     *
     * @return
     * @access public
     */
    public function luzTechoPresidenciaNivel( ) {
        $nivel=AccesoControladoresDispositivos::$ctrlLuz->getIntensidadTechoPresidencia();//presidencia

        $this->nivel_techo_presidencia = $this->getNivel($nivel);
        $this->enviarIntensidadTechoPresidencia();
//        $this->dibujarPantalla();
    } // end of member function luzTechoPresidenciaNivel

    /**
     *
     *
     * @return
     * @access public
     */
    public function luzTechoPresidenciaApagar( ) {
        $this->techo_presidencia_on = 0;
        $this->ActualizarNivelesTecho();
$this->enviarIntensidadTechoPresidencia();
        $this->enviarEstadoTechoPresidencia();
//        $this->dibujarPantalla();
    } // end of member function luzTechoPresidenciaApagar

    /**
     *
     *
     * @return
     * @access public
     */
    public function luzTechoPresidenciaEncender( ) {
        $this->techo_presidencia_on = 1;
        $this->ActualizarNivelesTecho();
$this->enviarIntensidadTechoPresidencia();
        $this->enviarEstadoTechoPresidencia();
//        $this->dibujarPantalla();
    } // end of member function luzTechoPresidenciaEncender

    /**
     *
     *
     * @return
     * @access public
     */
    public function luzTechoPasilloNivel( ) {
        $nivel=AccesoControladoresDispositivos::$ctrlLuz->getIntensidadTechoPasillo();//pasillo

        $this->nivel_techo_pasillo = $this->getNivel($nivel);
       $this->enviarIntensidadTechoPasillo();
        //$this->dibujarPantalla();
    } // end of member function luzTechoPasilloNivel

    /**
     *
     *
     * @return
     * @access public
     */
    public function luzTechoPasilloEncender( ) {
        $this->techo_pasillo_on = 1;
        $this->actualizarNivelesTecho();
$this->enviarIntensidadTechoPasillo();
         $this->enviarEstadoTechoPasillo();
//        $this->dibujarPantalla();
    } // end of member function luzTechoPasilloEncender

    /**
     *
     *
     * @return
     * @access public
     */
    public function luzTechoPasilloApagar( ) {
        $this->techo_pasillo_on = 0;
        $this->actualizarNivelesTecho();
$this->enviarIntensidadTechoPasillo();
        $this->enviarEstadoTechoPasillo();
//        $this->dibujarPantalla();
    } // end of member function luzTechoPasilloApagar

    /**
     *
     *
     * @return
     * @access public
     */
    public function luzTechoAlumnosNivel( ) {
        $nivel=AccesoControladoresDispositivos::$ctrlLuz->getIntensidadTechoAlumnos();//alumnos
        $this->nivel_techo_alumnos = $this->getNivel($nivel);
       $this->enviarIntensidadTechoAlumnos();
       // $this->dibujarPantalla();
    } // end of member function luzTechoAlumnosNivel

    /**
     *
     *
     * @return
     * @access public
     */
    public function luzTechoAlumnosApagar( ) {
        $this->techo_alumnos_on = 0;
        $this->actualizarNivelesTecho();
$this->enviarIntensidadTechoAlumnos();
        $this->enviarEstadoTechoAlumnos();
//        $this->dibujarPantalla();
    } // end of member function luzTechoAlumnosApagar

    /**
     *
     *
     * @return
     * @access public
     */
    public function luzTechoAlumnosEncender( ) {
        $this->techo_alumnos_on = 1;
        $this->actualizarNivelesTecho();
$this->enviarIntensidadTechoAlumnos();
        $this->enviarEstadoTechoAlumnos();
//        $this->dibujarPantalla();
    } // end of member function luzTechoAlumnosEncender

    /**
     *
     *
     * @return
     * @access public
     */
    public function luzSueloEncender( ) {
        $this->suelo_on = 1;
        $this->suelo_pasillo_on = 1;
        $this->suelo_alumnos_on = 1;
        $this->ActualizarNivelesSuelo();
        $this->dibujarSuelo();
        //$this->dibujarPantalla();
    } // end of member function luzSueloEncender

    /**
     *
     *
     * @return
     * @access public
     */
    public function luzSueloPasilloEncender( ) {
        $this->suelo_pasillo_on = 1;
        $this->ActualizarNivelesSuelo();
$this->enviarIntensidadSueloPasillo();
        $this->enviarEstadoSueloPasillo();
//        $this->dibujarPantalla();
    } // end of member function luzSueloPasilloEncender

    /**
     *
     *
     * @return
     * @access public
     */
    public function luzSueloAlumnosEncender( ) {
        $this->suelo_alumnos_on = 1;
        $this->ActualizarNivelesSuelo();
$this->enviarIntensidadSueloAlumnos();
        $this->enviarEstadoSueloAlumnos();
        //$this->dibujarPantalla();

    } // end of member function luzSueloAlumnosEncender

    /**
     *
     *
     * @return
     * @access public
     */
    public function luzSueloPasilloApagar( ) {
        $this->suelo_pasillo_on = 0;
        $this->ActualizarNivelesSuelo();
$this->enviarIntensidadSueloPasillo();
        $this->enviarEstadoSueloPasillo();
//        $this->dibujarPantalla();
    } // end of member function luzSueloPasilloApagar

    /**
     *
     *
     * @return
     * @access public
     */
    public function luzSueloApagar( ) {

        $this->suelo_on = 0;
        $this->suelo_pasillo_on = 0;
        $this->suelo_alumnos_on = 0;
        $this->ActualizarNivelesSuelo();
        $this->dibujarSuelo();
        //$this->dibujarPantalla();
    } // end of member function luzSueloApagar

    /**
     *
     *
     * @return
     * @access public
     */
    public function luzSueloAlumnosApagar( ) {
        $this->suelo_alumnos_on = 0;

        $this->ActualizarNivelesSuelo();
$this->enviarIntensidadSueloAlumnos();
        $this->enviarEstadoSueloAlumnos();
        //$this->dibujarPantalla();

    } // end of member function luzSueloAlumnosApagar

    /**
     *
     *
     * @return
     * @access public
     */
    public function luzSueloPasilloNivel( ) {
        $nivel=AccesoControladoresDispositivos::$ctrlLuz->getIntensidadSueloPasillo();
        $this->nivel_suelo_pasillo = $this->calcularNivelParaPantalla($nivel) * 50;
        $this->enviarIntensidadSueloPasillo();
      //  $this->dibujarPantalla();
    } // end of member function luzSueloPasilloNivel

    /**
     *
     *
     * @return
     * @access public
     */
    public function luzSueloAlumnosNivel( ) {
    //automatan intentsitatea igo/jeitsi, balioa jaso
        $nivel=AccesoControladoresDispositivos::$ctrlLuz->getIntensidadSueloAlumnos();
        $this->nivel_suelo_alumnos = $this->calcularNivelParaPantalla($nivel) * 50;
        $this->enviarIntensidadSueloAlumnos();
       // $this->dibujarPantalla();
    } // end of member function luzSueloAlumnosNivel

    /**
     *
     *
     * @param string comando

     * @return
     * @access public
     */
    public function enviarPeticion( $comando ) {

        SocketClass::client_reply($comando->getComando());
    } // end of member function enviarPeticion

    /**
     *
     *
     * @return
     * @access public
     */
    public function activarPantalla() {


        $pantallaActual=new Properties();
        $pantallaActual->load(file_get_contents("./pantallaActiva.properties"));
        $pantallaActual->setProperty("Pantalla.activa",6);
        file_put_contents('./pantallaActiva.properties',     $pantallaActual->toString(true));


    // $this->pantalla_activa=$pantalla;
    } // end of member function setPantallaActiva
    /**
     *
     *
     * @return
     * @access public
     */
    public function estadoPantalla( ) {

    //zertarako sortu bidaltzen ez bada?????
        if ($this->sala_on) {


            $cmd = new ComandoFlash("LUZ", "ENCENDER_TODAS", "");
        }
        else {
            print_r($cmd);

            $cmd = new ComandoFlash("LUZ", "APAGAR_TODAS", "");
        }

        $this->enviarPeticion($cmd);
        $cmd = new ComandoFlash("LUZ", "TECHO", $this->getValorOnOff($this->techo_on));

        $this->enviarPeticion($cmd);
        $cmd = new ComandoFlash("LUZ", "SUELO", $this->getValorOnOff($this->suelo_on));

        $this->enviarPeticion($cmd);
        $cmd = new ComandoFlash("LUZ", "TECHO:PRESI",$this->getValorOnOff($this->techo_presidencia_on));

        $this->enviarPeticion($cmd);
        $cmd = new ComandoFlash("LUZ", "TECHO:PASILLO", $this->getValorOnOff($this->techo_pasillo_on));

        $this->enviarPeticion($cmd);
        $cmd = new ComandoFlash("LUZ", "TECHO:ALUMNOS", $this->getValorOnOff($this->techo_alumnos_on));

        $this->enviarPeticion($cmd);
        $cmd = new ComandoFlash("LUZ", "SUELO:PASILLO", $this->getValorOnOff($this->suelo_pasillo_on));

        $this->enviarPeticion($cmd);

        $cmd = new ComandoFlash("LUZ", "SUELO:ALUMNOS", $this->getValorOnOff($this->suelo_alumnos_on));

        $this->enviarPeticion($cmd);

        $cmd = new ComandoFlash("LUZ", "TECHO:PRESI",$this->nivel_techo_presidencia);

        $this->enviarPeticion($cmd);

        $cmd = new ComandoFlash("LUZ", "TECHO:PASILLO",$this->nivel_techo_pasillo);

        $this->enviarPeticion($cmd);

        $cmd = new ComandoFlash("LUZ", "TECHO:ALUMNOS",$this->nivel_techo_alumnos);

        $this->enviarPeticion($cmd);

        $cmd = new ComandoFlash("LUZ", "SUELO:PASILLO", $this->nivel_suelo_pasillo);

        $this->enviarPeticion($cmd);

        $cmd = new ComandoFlash("LUZ", "SUELO:ALUMNOS", $this->nivel_suelo_alumnos);
        print_r($cmd);

        $this->enviarPeticion($cmd);

    } // end of member function estadoPantalla
    private function enviarEstadoTodo() {
        if ($this->sala_on) {
            $cmd = new ComandoFlash("LUZ", "ENCENDER_TODAS", "");
        }
        else {
            print_r($cmd);
            $cmd = new ComandoFlash("LUZ", "APAGAR_TODAS", "");
        }
        $this->enviarPeticion($cmd);
    }

    private function enviarEstadoTecho() {

        $cmd = new ComandoFlash("LUZ", "TECHO", $this->getValorOnOff($this->techo_on));
        $this->enviarPeticion($cmd);

    }
    private function enviarEstadoSuelo() {
        $cmd = new ComandoFlash("LUZ", "SUELO", $this->getValorOnOff($this->suelo_on));
        $this->enviarPeticion($cmd);
    }
    private function enviarEstadoTechoPresidencia() {
        $cmd = new ComandoFlash("LUZ", "TECHO:PRESI",$this->getValorOnOff($this->techo_presidencia_on));
        $this->enviarPeticion($cmd);
    }
    private function enviarEstadoTechoPasillo() {
        $cmd = new ComandoFlash("LUZ", "TECHO:PASILLO", $this->getValorOnOff($this->techo_pasillo_on));
        $this->enviarPeticion($cmd);
    }
    private function enviarEstadoTechoAlumnos() {
        $cmd = new ComandoFlash("LUZ", "TECHO:ALUMNOS", $this->getValorOnOff($this->techo_alumnos_on));
        $this->enviarPeticion($cmd);

    }
    private function enviarEstadoSueloPasillo() {
        $cmd = new ComandoFlash("LUZ", "SUELO:PASILLO", $this->getValorOnOff($this->suelo_pasillo_on));
        $this->enviarPeticion($cmd);

    }
    private function enviarEstadoSueloAlumnos() {
        $cmd = new ComandoFlash("LUZ", "SUELO:ALUMNOS", $this->getValorOnOff($this->suelo_alumnos_on));
        $this->enviarPeticion($cmd);

    }
    private function enviarIntensidadTechoPresidencia() {
        $cmd = new ComandoFlash("LUZ", "TECHO:PRESI",$this->nivel_techo_presidencia);
        $this->enviarPeticion($cmd);

    }
    private function enviarIntensidadTechoPasillo() {
        $cmd = new ComandoFlash("LUZ", "TECHO:PASILLO",$this->nivel_techo_pasillo);
        $this->enviarPeticion($cmd);

    }
    private function enviarIntensidadTechoAlumnos() {
        $cmd = new ComandoFlash("LUZ", "TECHO:ALUMNOS",$this->nivel_techo_alumnos);
        $this->enviarPeticion($cmd);

    }
    private function enviarIntensidadSueloPasillo() {

        $cmd = new ComandoFlash("LUZ", "SUELO:PASILLO", $this->nivel_suelo_pasillo);
        $this->enviarPeticion($cmd);

    }
    private function enviarIntensidadSueloAlumnos() {
        $cmd = new ComandoFlash("LUZ", "SUELO:ALUMNOS", $this->nivel_suelo_alumnos);
        $this->enviarPeticion($cmd);
    }
    /**
     *
     *
     * @param bool on

     * @return
     * @access public
     */
    public function getValorOnOff( $on ) {
        if ($on==1) {
            return "ON";
        }
        else {
            return "OFF";
        }
    } // end of member function getValorOnOff

    /**
     *
     *
     * @param int nivel

     * @return int
     * @access public
     */
    public function getNivel($nivel) {
        $aux;
        if ($nivel == 255) {
            $aux = 100;
        }else {
            $aux = (100 * ($nivel-AccesoControladoresDispositivos::$ctrlLuz->getIntensidadMinimaTecho())) / (AccesoControladoresDispositivos::$ctrlLuz->getIntensidadMaximaTecho() - AccesoControladoresDispositivos::$ctrlLuz->getIntensidadMinimaTecho());
        }
        return $aux;
    }// end of member function getNivel
    /**
     *
     *
     * @return
     * @access public
     */
    public function actualizarNivelesTecho( ) {
        $nivel=AccesoControladoresDispositivos::$ctrlLuz->getIntensidadTechoAlumnos();//alumnos

        $this->nivel_techo_alumnos=$this->getNivel($nivel);
        $nivel=AccesoControladoresDispositivos::$ctrlLuz->getIntensidadTechoPresidencia();//presidencia

        $this->nivel_techo_presidencia=$this->getNivel($nivel);
        $nivel=AccesoControladoresDispositivos::$ctrlLuz->getIntensidadTechoPasillo();//pasillo

        $this->nivel_techo_pasillo=$this->getNivel($nivel);


    } // end of member function activarNivelesTecho

    /**
     *
     *
     * @return
     * @access public
     */
    public function actualizarNivelesSuelo( ) {


        $nivel=AccesoControladoresDispositivos::$ctrlLuz->getIntensidadSueloAlumnos();

        $this->nivel_suelo_alumnos=$this->calcularNivelParaPantalla($nivel) *50;
        $nivel=AccesoControladoresDispositivos::$ctrlLuz->getIntensidadSueloPasillo();

        $this->nivel_suelo_pasillo=$this->calcularNivelParaPantalla($nivel) * 50;

    } // end of member function activarNivelesSuelo

    /**
     *
     *
     * @return
     * @access public
     */
    public function actualizarNivelesSala( ) {
        $this->actualizarNivelesSuelo();
        $this->actualizarNivelesTecho();
    } // end of member function activarNivelesSala

    /**
     *
     *
     * @return
     * @access public
     */
    public function dibujarPantalla( ) {
        $this->activarPantalla();
        $this->actualizarNivelesSala();
        $this->dibujarSuelo();
        $this->dibujarTecho();
//        $this->estadoPantalla();
    } // end of member function dibujarPantalla
    public function dibujarTecho(){
        $this->enviarEstadoTecho();
        $this->enviarEstadoTechoAlumnos();
        $this->enviarEstadoTechoPasillo();
        $this->enviarEstadoTechoPresidencia();
        $this->enviarIntensidadTechoAlumnos();
        $this->enviarIntensidadTechoPasillo();
        $this->enviarIntensidadTechoPresidencia();
    }
    public function dibujarSuelo(){
        $this->enviarEstadoSuelo();
        $this->enviarEstadoSueloAlumnos();
        $this->enviarEstadoSueloPasillo();
        $this->enviarIntensidadSueloAlumnos();
        $this->enviarIntensidadSueloPasillo();

    }

    public function calcularNivelParaPantalla($nivel) {
        if($nivel==7)
            return 2;
        else if ($nivel==3)
                return 1;
            else if ($nivel==0)
                    return 0;
    }


} // end of GUI_Luces
?>
