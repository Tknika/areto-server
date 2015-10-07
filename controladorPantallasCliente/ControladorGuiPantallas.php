<?php
/**
 * @package PHP::controladoresGuiDispositivos
 */
/**
 * Clases necesarias para el control
 */
require_once './AccesoControladoresDispositivos.php';
/**
 * Description of ControladorGuiPantallas
 *
 * Clase que se encargara de enviar a las pantallas(electrica, entrada y presidencia)
 * y a la pantalla del cliente los comandos necesarios para controlar los dispositivos
 * y que estas acciones queden marcadas en la pantalla de cada uno
 *
 * @author amaia
 *
 * @package PHP::controladoresGuiDispositivos
 */
class ControladorGuiPantallas {

///////////////////////////////////////////////
////////FUNCIONES PANTALLA ELECTRICA///////////
///////////////////////////////////////////////

/**
 * Metodo para bajar la pantalla electrica y marcar en su pantalla que esta
 * bajada
 *
 * @access public
 */
    public function bajarPantallaElectrica( ) {

        AccesoControladoresDispositivos::$ctrlAutomata->bajarPantalla();
        AccesoGui::$guiPantallas->bajarPantallaElectrica();

    } // end of member function bajarPantallaElectrica

    /**
     * Metodo para subir la pantalla electrica y marcar en su pantalla que esta
     * subida
     *
     * @access public
     */
    public function subirPantallaElectrica( ) {

        AccesoControladoresDispositivos::$ctrlAutomata->subirPantalla();
        AccesoGui::$guiPantallas->subirPantallaElectrica();

    } // end of member function subirPantallaElectrica

    ///////////////////////////////////////////////
    ////////FUNCIONES PANTALLA PRESIDENCIA/////////
    ///////////////////////////////////////////////

    /**
     * Metodo para encender la pantalla de la presidencia y marcar en su pantalla
     *  que esta encendida
     *
     * @access public
     */
    public function presidenciaEncender() {


         if(!AccesoControladoresDispositivos::$ctrlPantallas->isEncendidaPresidencia()) {
          AccesoControladoresDispositivos::$ctrlPantallas->encenderPresidencia();
          AccesoGui::$guiPantallas->pantallaPresidenciaEncender();

        }
        AccesoControladoresDispositivos::$ctrlPantallas->pipEnPresidencia();
        

    }

    /**
     * Metodo para apagar la pantalla de la presidencia y marcar en su pantalla
     *  que esta apagada
     *
     * @access public
     */
    public function presidenciaApagar() {
        AccesoControladoresDispositivos::$ctrlPantallas->apagarPresidencia();
        AccesoGui::$guiPantallas->pantallaPresidenciaApagar();
    }

    /**
     * Metodo para mostran en la pantalla de la presidencia el dispositivo que se
     * esta utilizando en ese momento y marcar los botones en las pantallas, tanto
     * de la pantalla como del dispositivo
     *
     * @access public
     */
    public function presidenciaContraparte() {

	AccesoControladoresDispositivos::$ctrlPantallas->quitarPIPPresidencia();
	AccesoControladoresDispositivos::$ctrlPantallas->pipEnPresidencia();

	AccesoControladoresDispositivos::$ctrlPantallas->verEntradaPresidenciaAV2();
        AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_VIDEOCONFERENCIA,            MatrizVideo::$OUTPUT_LCD_PRESIDENCIA);


	/*

        if (AccesoControladoresDispositivos::$ctrlPantallas->isPIPPresidencia()) {
            AccesoControladoresDispositivos::$ctrlPantallas->quitarPIPPresidencia();
            try {
                usleep(3000000);
            } catch (Exception $e) {
            }
        }
//        AccesoControladoresDispositivos::$ctrlPantallas->verEntradaPresidenciaAV2();
        AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_VIDEOCONFERENCIA,
            MatrizVideo::$OUTPUT_LCD_PRESIDENCIA);
     
        AccesoGui::$guiPantallas->pantallaPresidenciaContra();
	*/
	

    }

    /**
     * Metodo para mostran en la pantalla de la presidencia la camara de la
     * presidencia y marcar los botones en la pantalla
     *
     * @access public
     */
    public function presidenciaNuestra() {

        AccesoControladoresDispositivos::$ctrlPantallas->quitarPIPPresidencia();
        try {
            usleep(3000000);
        } catch (Exception $e) {
        }
        AccesoControladoresDispositivos::$ctrlPantallas->verEntradaPresidenciaAV1();
        AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_CAMARA_3,MatrizVideo::$OUTPUT_LCD_PRESIDENCIA);
        AccesoGui::$guiPantallas->pantallaPresidenciaNuestra();
        
    }



    /**
     * Metodo para dividir la pantalla de la presidencia en dos, a un lado mostrara
     * el pc y al otro la camara de la presidencia
     *
     * Si la pantalla esta apagada, la encendera, activara la entrada VGA (para el
     * pc) y enrutara el audio y video del pc a la pantalla. Por ultimo enrutara
     * el escalador a la pantalla (???????), dividira la pantalla en 2 y elegira
     * la fuente pip 1 de la pantalla
     *
     * @access public
     */
    public function pipEnPantallaPresi() {
        if (! AccesoControladoresDispositivos::$ctrlPantallas->isEncendidaPresidencia()) {
            AccesoControladoresDispositivos::$ctrlPantallas->encenderPresidencia();
        }
        AccesoControladoresDispositivos::$ctrlPantallas->ponerPIPPresidencia();
	AccesoControladoresDispositivos::$ctrlPantallas->fuentePIPPresidencia();
    }


    public function KenduPipEnPantallaPresidencia() {
	AccesoControladoresDispositivos::$ctrlPantallas->encenderPresidencia();
	AccesoControladoresDispositivos::$ctrlPantallas->quitarPIPPresidencia();
    }



    
    public function presidenciaCamara() {
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(1, 1);
        try {
            usleep(100000);
        } catch (Exception $e) {
        }
        //AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(1, 1);
        if (! AccesoControladoresDispositivos::$ctrlPantallas->isPIPPresidencia()) {
            AccesoControladoresDispositivos::$ctrlPantallas->verEntradaPresidenciaVGA();
        }
	//AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_CAMARA_3, 1);
	AccesoControladoresDispositivos::$ctrlPantallas->verEntradaPresidenciaAV1();
        AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_CAMARA_3,MatrizVideo::$OUTPUT_LCD_PRESIDENCIA);
        //AccesoGui::$guiPantallas->pantallaPresidenciaNuestra();
    }


    /**
     * Metodo para mostrar en la pantalla de la presidencia el pc de la sala, para
     * ello enrutara el video y el audio del pc a la pantalla de la presidencia, si
     * la pantalla no esta dividida activaremos la entrada vga de la pantalla.
     *
     * @access public
     */
    public function presidenciaPCSuelo() {
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(1, 1);
        try {
            usleep(100000);
        } catch (Exception $e) {
        }
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(1, 1);
        if (! AccesoControladoresDispositivos::$ctrlPantallas->isPIPPresidencia()) {
            AccesoControladoresDispositivos::$ctrlPantallas->verEntradaPresidenciaVGA();
        }
        AccesoGui::$guiPantallas->pantallaPresidenciaPCsuelo();
        AccesoGui::$guiDispositivos->seleccionarPCSuelo();
    }

    /**
     * Metodo para mostrar en la pantalla de la presidencia el reproductor de dvd,
     * para ello enrutara el video del reproductor a la pantalla de la presidencia
     * y si esta no esta dividida activara la entrada AV1.
     *
     * Tambien mostrara la pantalla para poder manejar el reproductor de dvd
     *
     * @access public
     */
    public function presidenciaDVD() {

        AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_DVD_REPRODUCTOR,
            MatrizVideo::$OUTPUT_LCD_PRESIDENCIA);
        if (! AccesoControladoresDispositivos::$ctrlPantallas->isPIPPresidencia()) {
            AccesoControladoresDispositivos::$ctrlPantallas->verEntradaPresidenciaAV1();
        }
        AccesoGui::$guiPantallas->pantallaPresidenciaDVD();
        AccesoGui::$guiDispositivos->seleccionarDVD();

    }

    /**
     * Metodo para mostrar en la pantalla de la presidencia el grabador de dvd,
     * para ello enrutara el video del grabador a la pantalla de la presidencia
     * y si esta no esta dividida activara la entrada AV1.
     *
     * Tambien mostrara la pantalla para poder manejar el grabador de dvd
     *
     * @access public
     */
    public function presidenciaDVDgrab() {

        AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_DVD_GRABADOR,
            MatrizVideo::$OUTPUT_LCD_PRESIDENCIA);
        if (! AccesoControladoresDispositivos::$ctrlPantallas->isPIPPresidencia()) {
            AccesoControladoresDispositivos::$ctrlPantallas->verEntradaPresidenciaAV1();
        }
        AccesoGui::$guiPantallas->pantallaPresidenciaDVDGrab();
        AccesoGui::$guiDispositivos->seleccionarDvdGrab();

    }

    /**
     * Metodo para mostrar en la pantalla de la presidencia el visor de documentos,
     * para ello enrutara el video del visor a la pantalla de la presidencia, si
     * esta no esta dividida activara la entrada VGA.
     *
     * Tambien encendera el visor de documentos, mostrara la pantalla de este y
     * enviara los comandos necesarios para mostrar el estado del visor.
     *
     * @access public
     */
    public function presidenciaVisorDocumentos() {

        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(8, 1);
        if (! AccesoControladoresDispositivos::$ctrlPantallas->isPIPPresidencia()) {
            AccesoControladoresDispositivos::$ctrlPantallas->verEntradaPresidenciaVGA();
        }
        AccesoControladoresDispositivos::$ctrlVisorDocumentos->encender();
        AccesoGui::$guiPantallas->pantallaPresidenciaVisorDocumentos();
        AccesoGui::$guiDispositivos->seleccionarCamaraDocumentos();
    }

    /**
     * Metodo para mostrar en la pantalla de la presidencia el portatil 1,
     * para ello enrutara el video y el audio del portatil1 a la pantalla de la
     * presidencia y si esta no esta dividida activara la entrada VGA.
     *
     * @access public
     */
    public function presidenciaPortatil1() {
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(2, 1);
        try {
            usleep(100000);
        } catch (Exception $e) {
        }
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(2, 1);
        if (! AccesoControladoresDispositivos::$ctrlPantallas->isPIPPresidencia()) {
            AccesoControladoresDispositivos::$ctrlPantallas->verEntradaPresidenciaVGA();
        }
        AccesoGui::$guiPantallas->pantallaPresidenciaPortatil1();

    }

    /**
     * Metodo para mostrar en la pantalla de la presidencia el portatil 2,
     * para ello enrutara el video y el audio del portatil2 a la pantalla de la
     * presidencia y si esta no esta dividida activara la entrada VGA.
     *
     * @access public
     */
    public function presidenciaPortatil2() {

        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(3, 1);
        try {
            usleep(100000);
        } catch (Exception $e) {
        }
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(3, 1);
        if (! AccesoControladoresDispositivos::$ctrlPantallas->isPIPPresidencia()) {
            AccesoControladoresDispositivos::$ctrlPantallas->verEntradaPresidenciaVGA();
        }
        AccesoGui::$guiPantallas->pantallaPresidenciaPortatil2();

    }

    /**
     * Metodo para mostrar en la pantalla de la presidencia el portatil 3,
     * para ello enrutara el video y el audio del portatil3 a la pantalla de la
     * presidencia y si esta no esta dividida activara la entrada VGA.
     *
     * @access public
     */
    public function presidenciaPortatil3() {

        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(4, 1);
        try {
            usleep(100000);
        } catch (Exception $e) {
        }
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(4, 1);
        if (! AccesoControladoresDispositivos::$ctrlPantallas->isPIPPresidencia()) {
            AccesoControladoresDispositivos::$ctrlPantallas->verEntradaPresidenciaVGA();
        }
        AccesoGui::$guiPantallas->pantallaPresidenciaPortatil3();

    }

    /**
     * Metodo para mostrar en la pantalla de la presidencia el atril,
     * para ello enrutara el video y el audio del atril a la pantalla de la
     * presidencia y si esta no esta dividida activara la entrada VGA.
     *
     * @access public
     */
    public function presidenciaAtril() {

        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(9, 1);
        try {
            usleep(100000);
        } catch (Exception $e) {
        }
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(9, 1);
        if (! AccesoControladoresDispositivos::$ctrlPantallas->isPIPPresidencia()) {
            AccesoControladoresDispositivos::$ctrlPantallas->verEntradaPresidenciaVGA();
        }
        AccesoGui::$guiPantallas->pantallaPresidenciaAtril();

    }

    /**
     * Metodo para mostrar en la pantalla de la presidenciael la pantalla del
     * redThinkClient seleccionado, para ello enrutara el video y el audio de este
     * a la pantalla de la presidencia y si esta no esta dividida activara la
     * entrada VGA.
     *
     * @access public
     */
    public function presidenciaRedThinkClient() {
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(5, 1);
        try {
            usleep(100000);
        } catch (Exception $e) {
        }
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(5, 1);
        if (! AccesoControladoresDispositivos::$ctrlPantallas->isPIPPresidencia()) {
            AccesoControladoresDispositivos::$ctrlPantallas->verEntradaPresidenciaVGA();
        }
        AccesoGui::$guiPantallas->pantallaPresidenciaRedThinkClient();
        AccesoGui::$guiDispositivos->seleccionarRedThinkClient( );

    }

    /**
     * Metodo para mostrar la camara de la presidencia y el dispositivo que se
     * esta usando en la pantalla de la presidencia, para ello si la pantalla esta
     * dividida se quitara el pip y se llamara a la funcion pipEnPantallaPresi,
     * que se encargara de enrutar el video y el audio necesarios
     *
     * @access public
     */
    public function presidenciaMezcla() {
        if(AccesoControladoresDispositivos::$ctrlPantallas->isPIPPresidendencia) {
            AccesoControladoresDispositivos::$ctrlPantallas->quitarPIPPresidencia();
            try {
                usleep(3000000);
            } catch (Exception $e) {
            }

        }
        AccesoControladoresDispositivos::$ctrlPantallas->pipEnPresidencia();
        //$this->pipEnPantallaPresi();
   /*
    * komentarioekin dagoena lehen zegoen bezela, printzipioz gaizki zeon
    */
        //        $this->PresidenciaNuestra();
//        AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_VIDEOCONFERENCIA,
//            MatrizVideo::$OUTPUT_LCD_PRESIDENCIA);
//        $videoconferencia=AccesoGui::$guiEscenarios->getEstadoVideoConferencia();
//
//        if(strcmp($videoconferencia, "VIDEOCONFERENCIA:TRUE")==0) {
//        //hau jarrita dockumentu kamara jarriz gero beti bideoconferentzia ikusten da
//            AccesoControladoresDispositivos::$ctrlGeneradorMultiventanas->preset(1);
//            AccesoControladoresDispositivos::$ctrlPantallas->verEntradaPresidenciaAV1();
//            AccesoControladoresDispositivos::$ctrlGeneradorMultiventanas->preset(2);
//            AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(7,8);
//            AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_CAMARA_3, MatrizVideo::$OUTPUT_LCD_PRESIDENCIA);
//        }
        AccesoGui::$guiPantallas->pantallaPresidenciaMezcla();
    }

    /**
     * Metodo para mostrar en la pantalla de la presidencia la videoconferencia,
     * para ello  si esta no esta dividida activara la entrada AV1 y enrutara el
     * video y de la videoconferencia a la pantalla de la presidencia.
     *
     * @access public
     */
    public function presidenciaVideoconferencia() {

        if (! AccesoControladoresDispositivos::$ctrlPantallas->isPIPPresidencia()) {
            AccesoControladoresDispositivos::$ctrlPantallas->verEntradaPresidenciaAV1();
        }

	AccesoControladoresDispositivos::$ctrlPantallas->pipEnPresidencia();
        //AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_VIDEOCONFERENCIA, MatrizVideo::$OUTPUT_LCD_PRESIDENCIA);
    }


    //////////////////////////////////////////
    ////////FUNCIONES PANTALLA ENTRADA////////
    //////////////////////////////////////////


    /**
     * Metodo para dividir la pantalla de la entrada en dos, a un lado mostrara
     * el pc y al otro la camara de la presidencia
     *
     * Encendera la pantalla, activara la entrada VGA (para elpc) y enrutara el
     * audio y video del pc a la pantalla. Por ultimo enrutara la camara de la
     * presidencia a la pantalla, dividira la pantalla en 2 y elegira la fuente
     * pip 1 de la pantalla
     *
     * @access public
     */
    public function pipEnPantallaEntrada() {

        AccesoControladoresDispositivos::$ctrlPantallas->encenderEntrada();
        AccesoGui::$guiPantallas->pantallaEntradaEncender();
        try {
            usleep(1000000);
        } catch (Exception $e) {
        }
        //AccesoControladoresDispositivos::$ctrlPantallas->verEntradaEntradaVGA();
        //AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(1, 6);
        //AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_CAMARA_3,MatrizVideo::$OUTPUT_MONITOR_PASILLO);

        try {
            usleep(1000000);
        } catch (Exception $e) {
        }
        AccesoControladoresDispositivos::$ctrlPantallas->ponerPIPEntrada();
        try {
            usleep(1000000);
        } catch (Exception $e) {
        }
        AccesoControladoresDispositivos::$ctrlPantallas->fuentePIPEntrada();
    }

    public function KenduPipEnPantallaEntrada() {
	AccesoControladoresDispositivos::$ctrlPantallas->encenderEntrada();
        try {
            usleep(1000000);
        } catch (Exception $e) {
        }
	AccesoControladoresDispositivos::$ctrlPantallas->quitarPIPEntrada();
    }

    public function PantallaPantallaEntrada() {
    //		$this->control.pantallaControl.pantallaDispositivos
    //				.seleccionarPantallaEntrada();
    }

    /**
     * Metodo para encender la pantalla de la entrada y marcar en su pantalla
     *  que esta encendida
     *
     * @access public
     */
    public function entradaEncender() {

        $this->pipEnPantallaEntrada();
        AccesoGui::$guiPantallas->pantallaEntradaEncender();

    }

    /**
     * Metodo para apagar la pantalla de la entrada y marcar en su pantalla
     *  que esta apagada
     *
     * @access public
     */
    public function entradaApagar() {

        AccesoControladoresDispositivos::$ctrlPantallas->apagarEntrada();
        AccesoGui::$guiPantallas->pantallaEntradaApagar();

    }

    /**
     * Metodo para mostrar en la pantalla de la entrada el reproductor de dvd,
     * para ello enrutara el video del reproductor a la pantalla de la entrada
     * y si esta no esta dividida activara la entrada AV1.
     *
     * Tambien mostrara la pantalla para poder manejar el reproductor de dvd
     *
     * @access public
     */
    public function entradaDVD() {

        AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_DVD_REPRODUCTOR,
            MatrizVideo::$OUTPUT_MONITOR_PASILLO);
        if (! AccesoControladoresDispositivos::$ctrlPantallas->isPIPEntrada()) {
            AccesoControladoresDispositivos::$ctrlPantallas->verEntradaEntradaAV1();
        }
        AccesoGui::$guiPantallas->pantallaEntradaDVD();
        AccesoGui::$guiDispositivos->seleccionarDVD();
    }

    /**
     * Metodo para mostrar en la pantalla de la entrada el grabador de dvd,
     * para ello enrutara el video del grabador a la pantalla de la entrada
     * y si esta no esta dividida activara la entrada AV1.
     *
     * Tambien mostrara la pantalla para poder manejar el grabador de dvd
     *
     * @access public
     */
    public function entradaDVDGrab() {

        AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_DVD_GRABADOR,
            MatrizVideo::$OUTPUT_MONITOR_PASILLO);
        if (! AccesoControladoresDispositivos::$ctrlPantallas->isPIPEntrada()) {
            AccesoControladoresDispositivos::$ctrlPantallas->verEntradaEntradaAV1();
        }
        AccesoGui::$guiPantallas->pantallaEntradaDVDGrab();
        AccesoGui::$guiDispositivos->seleccionarDVDGrab();

    }
    /**
     * Metodo para mostrar en la pantalla de la entrada el visor de documentos,
     * para ello enrutara el video del visor a la pantalla de la entrada, si
     * esta no esta dividida activara la entrada VGA.
     *
     * Tambien encendera el visor de documentos, mostrara la pantalla de este y
     * enviara los comandos necesarios para mostrar el estado del visor.
     *
     * @access public
     */
    public function entradaVisorDocumentos() {

        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(8, 6);
        if (! AccesoControladoresDispositivos::$ctrlPantallas->isPIPEntrada()) {
            AccesoControladoresDispositivos::$ctrlPantallas->verEntradaEntradaVGA();
        }
        AccesoControladoresDispositivos::$ctrlVisorDocumentos->encender();
        AccesoGui::$guiPantallas->pantallaEntradaVisorDocumentos();
        AccesoGui::$guiDispositivos->seleccionarCamaraDocumentos();

    }

    /**
     * Metodo para mostrar en la pantalla de la entrada el pc de la sala, para
     * ello enrutara el video y el audio del pc a la pantalla de la entrada, si
     * la pantalla no esta dividida activaremos la entrada vga de la pantalla.
     *
     * @access public
     */
    public function entradaPCSuelo() {

        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(1, 6);
        if (! AccesoControladoresDispositivos::$ctrlPantallas->isPIPEntrada()) {
            AccesoControladoresDispositivos::$ctrlPantallas->verEntradaEntradaVGA();
        }
	AccesoControladoresDispositivos::$ctrlPantallas->verEntradaEntradaVGA();
        AccesoGui::$guiPantallas->pantallaEntradaPCSuelo();
        AccesoGui::$guiDispositivos->seleccionarPCSuelo();
    }

      /**
     * Metodo para mostrar en la pantalla de la entrada la imagen de camara1, si
     * la pantalla no esta dividida activaremos la entrada vga de la pantalla.
     *
     * @access public
     */


    public function entradaKamara1() {

	if (! AccesoControladoresDispositivos::$ctrlPantallas->isPIPEntrada ()) {
            AccesoControladoresDispositivos::$ctrlPantallas->verEntradaEntradaVGA();
        }
	AccesoControladoresDispositivos::$ctrlPantallas->verEntradaEntradaAV2();
        AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_CAMARA_3,MatrizVideo::$OUTPUT_MONITOR_PASILLO);
        AccesoGui::$guiPantallas->pantallaEntradaKamara1();
    }


    /**
     * Metodo para mostrar en la pantalla de la entrada el portatil 1,
     * para ello enrutara el video y el audio del portatil1 a la pantalla de la
     * entrada y si esta no esta dividida activara la entrada VGA.
     *
     * @access public
     */
    public function entradaPortatil1() {
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(2, 6);
        if (! AccesoControladoresDispositivos::$ctrlPantallas->isPIPEntrada()) {
            AccesoControladoresDispositivos::$ctrlPantallas->verEntradaEntradaVGA();
        }
        AccesoGui::$guiPantallas->pantallaEntradaPortatil1();
    }
    /**
     * Metodo para mostrar en la pantalla de la entrada el portatil 2,
     * para ello enrutara el video y el audio del portatil2 a la pantalla de la
     * entrada y si esta no esta dividida activara la entrada VGA.
     *
     * @access public
     */
    public function entradaPortatil2() {
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(3, 6);
        if (! AccesoControladoresDispositivos::$ctrlPantallas->isPIPEntrada()) {
            AccesoControladoresDispositivos::$ctrlPantallas->VerEntradaEntradaVGA();
        }
        AccesoGui::$guiPantallas->pantallaEntradaPortatil2();
    }
    /**
     * Metodo para mostrar en la pantalla de la entrada el portatil 3,
     * para ello enrutara el video y el audio del portatil3 a la pantalla de la
     * entrada y si esta no esta dividida activara la entrada VGA.
     *
     * @access public
     */
    public function entradaPortatil3() {
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(4, 6);
        if (! AccesoControladoresDispositivos::$ctrlPantallas->isPIPEntrada()) {
            AccesoControladoresDispositivos::$ctrlPantallas->verEntradaEntradaVGA();
        }
        AccesoGui::$guiPantallas->pantallaEntradaPortatil3();

    }

    /**
     * Metodo para mostrar en la pantalla de la entrada el atril,
     * para ello enrutara el video y el audio del atril a la pantalla de la
     * entrada y si esta no esta dividida activara la entrada VGA.
     *
     * @access public
     */
    public function entradaAtril() {
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(9, 6);
        if (! AccesoControladoresDispositivos::$ctrlPantallas->isPIPEntrada()) {
            AccesoControladoresDispositivos::$ctrlPantallas->verEntradaEntradaVGA();
        }
        AccesoGui::$guiPantallas->pantallaEntradaAtril();
    }
    /**
     * Metodo para mostrar en la pantalla de la entrada el la pantalla del
     * redThinkClient seleccionado, para ello enrutara el video y el audio de este
     * a la pantalla de la entrada y si esta no esta dividida activara la
     * entrada VGA.
     *
     * @access public
     */
    public function entradaRedThinkClient() {
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(5, 6);
        if (! AccesoControladoresDispositivos::$ctrlPantallas->isPIPEntrada()) {
            AccesoControladoresDispositivos::$ctrlPantallas->verEntradaEntradaVGA();
        }

        AccesoGui::$guiPantallas->pantallaEntradaRedThinkClient();
        AccesoGui::$guiDispositivos->seleccionarRedThinkClient();
    }

    /**
     * Metodo para mostrar en la pantalla de la entrada el pc de la sala, para
     * ello enrutara el video y el audio del pc a la pantalla de la entrada, si
     * la pantalla no esta dividida activaremos la entrada vga de la pantalla.
     *
     * @access public
     */
    public function pantallaEntradaPCSuelo( ) {
	AccesoControladoresDispositivos::$ctrlPantallas->verEntradaEntradaVGA();
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(1,6);
        if(!AccesoControladoresDispositivos::$ctrlPantallaPresidencia->isPIP("PANTALLA_ENTRADA"))
            AccesoControladoresDispositibos::$ctrlPantallaEntrada->verEnPantallaVGA("PANTALLA_ENTRADA");

    } // end of member function pantallaEntradaPCSuelo
    

    /**
     * Metodo para examinar la accion del comando recivido por la pelicula flash
     * para seleccionar la funcion adecuada de la pantalla de la presidencia
     *
     * @param ComandoFlash $cmd
     */
    public function getComandoFlashPresidencia($cmd) {

        if (strcmp($cmd->getAccion(),"MOSTRAR_CONTRAPARTE_Y_NUESTRA_IMAGEN")==0) {
            $this->presidenciaMezcla();
        }else if (strcmp($cmd->getAccion(),"MOSTRAR_NUESTRA_IMAGEN")==0) {
            $this->presidenciaNuestra();
        }else if (strcmp($cmd->getAccion(),"MOSTRAR_CONTRAPARTE")==0) {
            $this->presidenciaContraparte();
        }else if (strcmp($cmd->getAccion(),"PCSUELO")==0) {
            $this->presidenciaPCSuelo();
        }else if (strcmp($cmd->getAccion(),"DVD")==0) {
            $this->presidenciaDVD();
        }else if (strcmp($cmd->getAccion(),"DVDGRAB")==0) {
            $this->presidenciaDVDGrab();
        }else if (strcmp($cmd->getAccion(),"CAMARA_DE_DOCUMENTOS")==0) {
            $this->presidenciaVisorDocumentos();
        }else if (strcmp($cmd->getAccion(),"PORTATIL1")==0) {
            $this->presidenciaPortatil1();
        }else if (strcmp($cmd->getAccion(),"PORTATIL2")==0) {
            $this->presidenciaPortatil2();
        }else if (strcmp($cmd->getAccion(),"PORTATIL3")==0) {
            $this->presidenciaPortatil3();
        }else if (strcmp($cmd->getAccion(),"ATRIL")==0) {
            $this->presidenciaAtril();
        }else if (strcmp($cmd->getAccion(),"THINK_CLIENT")==0) {
            $this->presidenciaRedThinkClient();
        }else if (strcmp($cmd->getAccion(),"ENCENDER")==0) {
            $this->presidenciaEncender();
        }else if (strcmp($cmd->getAccion(),"APAGAR")==0) {
            $this->presidenciaApagar();
	}else if (strcmp($cmd->getAccion(),"ERDIBITUA")==0) {
            $this->pipEnPantallaPresi();
	}else if (strcmp($cmd->getAccion(),"BAKARRA")==0)  {
            $this->KenduPipEnPantallaPresidencia();
	}else if (strcmp($cmd->getAccion(),"KAMARA1")==0 || strcmp($cmd->getAccion(),"CAMARA")==0 ) {
            $this->presidenciaCamara();
        }

    }

    /**
     * Metodo para examinar la accion del comando recivido por la pelicula flash
     * para seleccionar la funcion adecuada de la pantalla de la entrada
     *
     * @param ComandoFlash $cmd
     */
    public function getComandoFlashEntrada($cmd) {
        if (strcmp($cmd->getAccion(),"ENCENDER")==0) {
            $this->entradaEncender();
        }else if (strcmp($cmd->getAccion(),"APAGAR")==0) {
            $this->entradaApagar();
        }else if (strcmp($cmd->getAccion(),"DVD")==0) {
            $this->entradaDVD();
        }else if (strcmp($cmd->getAccion(),"DVDGRAB")==0) {
            $this->entradaDVDGrab();
        }else if (strcmp($cmd->getAccion(),"PCSUELO")==0) {
            $this->entradaPCSuelo();
        }else if (strcmp($cmd->getAccion(),"CAMARA_DE_DOCUMENTOS")==0) {
            $this->entradaVisorDocumentos();
        }else if (strcmp($cmd->getAccion(),"PORTATIL1")==0) {
            $this->entradaPortatil1();
        }else if (strcmp($cmd->getAccion(),"PORTATIL2")==0) {
            $this->entradaPortatil2();
        }else if (strcmp($cmd->getAccion(),"PORTATIL3")==0) {
            $this->entradaPortatil3();
        }else if (strcmp($cmd->getAccion(),"ATRIL")==0) {
            $this->entradaAtril();
        }else if (strcmp($cmd->getAccion(),"THINK_CLIENT")==0) {
            $this->entradaRedThinkClient();
        }else if (strcmp($cmd->getAccion(),"ERDIBITUA")==0) {
            $this->pipEnPantallaEntrada();
        }else if (strcmp($cmd->getAccion(),"KAMARA1")==0 || strcmp($cmd->getAccion(),"CAMARA")==0 ) {
            $this->entradaKamara1();
	 }else if (strcmp($cmd->getAccion(),"BAKARRA")==0)  {
            $this->KenduPipEnPantallaEntrada();
        }




    }

    /**
     * Metodo para examinar la accion del comando recivido por la pelicula flash
     * para seleccionar la funcion adecuada de la pantalla electrica
     *
     * @param ComandoFlash $cmd
     */
    public function getComandoFlashElectrica($cmd) {
        if (strcmp($cmd->getAccion(),"SUBIR")==0) {
            $this->subirPantallaElectrica();
        }
        else if (strcmp($cmd->getAccion(),"BAJAR")==0) {
                $this->bajarPantallaElectrica();
            }

    }


} // end of ControladorPantallas
?>
