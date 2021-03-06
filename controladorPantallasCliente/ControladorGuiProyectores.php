<?php
/**
 * @package PHP::controladoresGuiDispositivos
 */
/**
 * Clases necesarias para el control
 */
/**
 * Description of ControladorGuiProyectores
 *
 * Clase que se encargara de enviar los comandos necesarios a los proyectores
 *  y a sus pantallas
 *
 * @author amaia
 *
 * @package PHP::controladoresGuiDispositivos
 */
class ControladorGuiProyectores {

/**
 * Metodo para desmutear el proyector central y marcar el boton en su pantalla
 *
 * @access public
 */
    public function activarCentral( ) {

        $error=AccesoControladoresDispositivos::$ctrlProyectores->activarCentral();
	if($error!=1){
       		AccesoGui::$guiProyectores->activarProyectorCentral();
}

    } // end of member function activarCentral

    /**
     * Metodo para mutear el proyector central y marcar el boton en su pantalla
     *
     * @access public
     */
    public function desactivarCentral() {

        $error=AccesoControladoresDispositivos::$ctrlProyectores->desactivarCentral();
	if($error!=1){
        	AccesoGui::$guiProyectores->desactivarProyectorCentral();
}

    } // end of member function desactivarCentral


     /**
     * Metodo para conocer el estado del proyector central 
     * @access public
     */
    public function estadoCentral() {
	$error=AccesoControladoresDispositivos::$ctrlProyectores->estadoCentral();
	
	
    } // end of member function encenderCentral



    /**
     * Metodo para encender el proyector central y marcar el boton encendido en
     * su pantalla
     *
     * Tambien se encargara de bajar la pantalla electrica y marcar el boton
     * BAJADA de la pantalla electrica
     *
     * @access public
     */
    public function encenderCentral() {
	$error=AccesoControladoresDispositivos::$ctrlProyectores->encenderCentral();       
	if($error!=1){
       		AccesoControladoresDispositivos::$ctrlAutomata->bajarPantalla();
        	AccesoGui::$guiProyectores->encenderProyectorCentral();
        	AccesoGui::$guiPantallas->bajarPantallaElectrica( );
	}
    } // end of member function encenderCentral

    /**
     * Metodo para apagar el proyector central y marcar el boton apagado en
     * su pantalla
     *
     * Tambien se encargara de subir la pantalla electrica y marcar el boton
     * SUBIDA de la pantalla electrica
     *
     * @access public
     */
    public function apagarCentral() {

        $error=AccesoControladoresDispositivos::$ctrlProyectores->apagarCentral();
	if($error!=1){
        	AccesoControladoresDispositivos::$ctrlAutomata->subirPantalla();
        	AccesoGui::$guiPantallas->subirPantallaElectrica();
        	AccesoGui::$guiProyectores->apagarProyectorCentral();
	}

    } // end of member function apagarCentral

    /**
     * Metodo para mostrar el reproductor de dvd a traves del proyector central.
     * Para ello, seleccionara la entrada de video directo del proyector y enrutara
     * el video del reproductor al proyector central.
     *
     * En la pantalla quedaran marcador el proyector central y a la derecha
     * aparecera la pantalla con las funciones del reproductor de dvd
     *
     * @access public
     */
    public function verDVDEnCentral( ) {

        $error=AccesoControladoresDispositivos::$ctrlProyectores->entradaVCCentral();
	if($error!=1){
        	AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_DVD_REPRODUCTOR,MatrizVideo::$OUTPUT_PROYECTOR_CENTRAL);
        	AccesoGui::$guiProyectores->verDVDEnProyectorCentral();
        	AccesoGui::$guiDispositivos->seleccionarDVD();
	}
    } // end of member function verDVDEnCentral

    /**
     * Metodo para mostrar el grabador de dvd a traves del proyector central.
     * Para ello, seleccionara la entrada de video directo del proyector y enrutara
     * el video del grabador al proyector central.
     *
     * En la pantalla quedaran marcador el proyector central y a la derecha
     * aparecera la pantalla con las funciones del grabador de dvd
     *
     * @access public
     */
    public function verGrabadorDVDEnCentral( ) {

        $error=AccesoControladoresDispositivos::$ctrlProyectores->entradaVCCentral();
	if($error!=1){
        	AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_DVD_GRABADOR,MatrizVideo::$OUTPUT_PROYECTOR_CENTRAL);
        	AccesoGui::$guiProyectores->verDVDGrabEnProyectorCentral();
        	AccesoGui::$guiDispositivos->seleccionarDVDGrab();
	}
    } // end of member function verGrabadorDVDEnCentral


    /**
     * Metodo para mostrar el visor de documentos a traves del proyector central.
     * Para ello, seleccionara la entrada de video VGA del proyector y enrutara
     * el video del visor de documentos al proyector central.
     *
     * En la pantalla quedaran marcador el proyector central y a la derecha
     * aparecera la pantalla con las funciones del visor de documentos
     *
     * @access public
     */
    public function verVisorDocumentosEnCentral( ) {

	$error=AccesoControladoresDispositivos::$ctrlProyectores->entradaVGAEnCentral();
	if($error!=1){        
		AccesoControladoresDispositivos::$ctrlVisorDocumentos->encender();
	        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(8,2);
       	 	AccesoGui::$guiProyectores->verVisorDocumentosEnProyectorCentral();
        	AccesoGui::$guiDispositivos->seleccionarCamaraDocumentos();
}
    } // end of member function verVisorDocumentosEnCentral

    /**
     * Metodo para mostrar el PC de la sala a traves del proyector central.
     * Para ello, seleccionara la entrada de video VGA del proyector y enrutara
     * el video del PC al proyector central y el audio al canal7???
     *
     * En la pantalla quedaran marcador el proyector central y en la derecha se
     * marcara el boton del PC
     *
     * @access public
     */
    public function verPCSalaEnCentral( ) {

        $error=AccesoControladoresDispositivos::$ctrlProyectores->entradaVGAEnCentral();
	if($error!=1){
        	AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(1,2);
	        usleep(100000);
	        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(1,1);
	        AccesoGui::$guiProyectores->verPCSalaEnProyectorCentral();
	        AccesoGui::$guiDispositivos->seleccionarPCSuelo();	
	}

    } // end of member function verPCSalaEnCentral

    /**
     * Metodo para mostrar el portatil1 a traves del proyector central.
     * Para ello, seleccionara la entrada de video VGA del proyector y enrutara
     * el video del portatil1 al proyector central y el audio al canal7???.
     *
     * En la pantalla quedaran marcador el proyector central y en la derecha se
     * marcara el boton del portatil1
     *
     * @access public
     */
    public function verPortatil1EnCentral( ) {

        $error=AccesoControladoresDispositivos::$ctrlProyectores->entradaVGAEnCentral();
	if($error!=1){
        	AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(2,2);
                usleep(100000);
        	AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(2,1);
        	AccesoGui::$guiProyectores->verPortatilEnProyectorCentral(1);
	}
    } // end of member function verPortatil1EnCentral

    /**
     * Metodo para mostrar el portatil2 a traves del proyector central.
     * Para ello, seleccionara la entrada de video VGA del proyector y enrutara
     * el video del portatil2 al proyector central y el audio al canal7???.
     *
     * En la pantalla quedaran marcador el proyector central y en la derecha se
     * marcara el boton del portatil2
     *
     * @access public
     */
    public function verPortatil2EnCentral( ) {

        $error=AccesoControladoresDispositivos::$ctrlProyectores->entradaVGAEnCentral();
	if($error!=1){
        	AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(3,2);
            	usleep(100000);
                AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(3,1);
      		AccesoGui::$guiProyectores->verPortatilEnProyectorCentral(2);
	}

    } // end of member function verPortatil2EnCentral

    /**
     * Metodo para mostrar el portatil3 a traves del proyector central.
     * Para ello, seleccionara la entrada de video VGA del proyector y enrutara
     * el video del portatil3 al proyector central y el audio al canal7???.
     *
     * En la pantalla quedaran marcador el proyector central y en la derecha se
     * marcara el boton del portatil3
     *
     * @access public
     */
    public function verPortatil3EnCentral( ) {
  	$error=AccesoControladoresDispositivos::$ctrlProyectores->entradaVGAEnCentral();
	if($error!=1){
        	AccesoControladoresDispositivos::$ctrlProyectores->entradaVGAEnCentral();
        	AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(4,2);
        	usleep(100000);
		AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(4,1);
        	AccesoGui::$guiProyectores->verPortatilEnProyectorCentral(3);
	}

    } // end of member function verPortatil3EnCentral

    /**
     * Metodo para mostrar el portatil4 a traves del proyector central.
     * Para ello, seleccionara la entrada de video VGA del proyector y enrutara
     * el video del portatil4 al proyector central y el audio al canal7???.
     *
     * En la pantalla quedaran marcador el proyector central y en la derecha se
     * marcara el boton del portatil4
     *
     * @access public
     */
    public function verPortatil4EnCentral( ) {

        $error=AccesoControladoresDispositivos::$ctrlProyectores->entradaVGAEnCentral();
	if($error!=1){
        	AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(9,2);
        	usleep(100000);
       		AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(9,1);
        	AccesoGui::$guiProyectores->verPortatilEnProyectorCentral(4);
	}

    } // end of member function verPortatil4EnCentral

    /**
     * Metodo para mostrar el Atril a traves del proyector central.
     * Para ello, seleccionara la entrada de video VGA del proyector y enrutara
     * el video del atril al proyector central y el audio al canal7???.
     *
     * En la pantalla quedaran marcador el proyector central y en la derecha se
     * marcara el boton del atril
     *
     * @access public
     */
    public function verAtrilEnCentral( ) {

        $error=AccesoControladoresDispositivos::$ctrlProyectores->entradaVGAEnCentral();
	if($error!=1){
		AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(9,2);
		usleep(100000);
		AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(9,1);
		AccesoGui::$guiProyectores->verAtrilEnProyectorCentral();
	}	
    } // end of member function verAtrilEnCentral

    /**
     * Metodo para mostrar un RedThinkClient a traves del proyector central.
     * Para ello, seleccionara la entrada de video VGA del proyector y enrutara
     * el video del RedThinkClient al proyector central y el audio al canal7???.
     *
     * En la pantalla quedaran marcador el proyector central y en la derecha se
     * marcara el boton del RedThinkClient
     *
     * @access public
     */
    public function verRedThinkClientEnCentral( ) {
          
	$error=AccesoControladoresDispositivos::$ctrlProyectores->entradaVGAEnCentral();
	if($error!=1){
		AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(5,2);
		usleep(100000);
		AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(5,1);
		AccesoGui::$guiProyectores->verRedThinkClientEnProyectorCentral();
		AccesoGui::$guiDispositivos->seleccionarRedThinkClient();
	}

    } // end of member function verRedThinkClientEnCentral

    /**
     * Metodo para mostrar la videoconferencia a traves del proyector central.
     * Para ello, seleccionara la entrada de video directo del proyector y enrutara
     * el video de la videoconferencia al proyector central.
     *
     * En la pantalla quedaran marcador el proyector central y en la derecha se
     * marcara el boton del RedThinkClient
     *
     * @access public
     */
    public function verVideoConferenciaEnCentral( ) {

        $error=AccesoControladoresDispositivos::$ctrlProyectores->entradaVCCentral();
	if($error!=1)
        	AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_VIDEOCONFERENCIA,MatrizVideo::$OUTPUT_PROYECTOR_CENTRAL);

    } // end of member function verVideoConferenciaEnCentral



    ////////////////////////////////////////////////////
    /////////////////FUNCIONES PIZARRA//////////////////
    ////////////////////////////////////////////////////


    /**
     * Metodo para conocer el estadp del proyector de la pizarra 
     * 
     *
     * @access public
     */
    public function estadoPizarra( ) {
        $error=AccesoControladoresDispositivos::$ctrlProyectores->estadoPizarra();

    } // end of member function estado

    /**
     * Metodo para encender el proyector de la pizarra y marcar el boton
     * encendido en su pantalla
     *
     * @access public
     */
    public function encenderPizarra( ) {
        $error=AccesoControladoresDispositivos::$ctrlProyectores->encenderPizarra();
	if($error!=1)
        	AccesoGui::$guiProyectores->encenderPizarra();

    } // end of member function encenderPizarra


    /**
     * Metodo para apagar el proyector de la pizarra y marcar el boton
     * apagar en su pantalla
     *
     * @access public
     */
    public function apagarPizarra( ) {
        $error=AccesoControladoresDispositivos::$ctrlProyectores->apagarPizarra();
	if($error!=1)
        	AccesoGui::$guiProyectores->apagarPizarra();
    } // end of member function apagarPizarra

    /**
     * Metodo para mutear el proyector de la pizarra y marcar el boton en su pantalla
     *
     * @access public
     */
    public function desactivarPizarra( ) {
        $error=AccesoControladoresDispositivos::$ctrlProyectores->desactivarPizarra();
	if($error!=1)
        	AccesoGui::$guiProyectores->desactivarPizarra();
    } // end of member function desactivarPizarra

    /**
     * Metodo para desmutear el proyector de la pizarra y marcar el boton en su pantalla
     *
     * @access public
     */
    public function activarPizarra( ) {
        $error=AccesoControladoresDispositivos::$ctrlProyectores->activarPizarra();
	if($error!=1)
        	AccesoGui::$guiProyectores->activarPizarra();
    } // end of member function activarPizarra

    /**
     * Metodo para mostrar el reproductor de dvd a traves del proyector de la
     * pizarra. Para ello, seleccionara la entrada de video directo del proyector y enrutara
     * el video del reproductor al proyector de la pizarra.
     *
     * En la pantalla quedaran marcador el proyector de la pizarra y a la derecha
     * aparecera la pantalla con las funciones del reproductor de dvd
     *
     * @access public
     */
    public function verDvdEnPizarra( ) {
        $error=AccesoControladoresDispositivos::$ctrlProyectores->entradaVCPizarra();
	if($error!=1){
		AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_DVD_REPRODUCTOR,MatrizVideo::$OUTPUT_PROYECTOR_PIZARRA);
		AccesoGui::$guiProyectores->verDVDEnPizarra();
		AccesoGui::$guiDispositivos->seleccionarDVD();
	}

    } // end of member function dvdPizarra

    /**
     * Metodo para mostrar el grabador de dvd a traves del proyector de la
     * pizarra. Para ello, seleccionara la entrada de video directo del proyector y enrutara
     * el video del grabador al proyector de la pizarra.
     *
     * En la pantalla quedaran marcador el proyector de la pizarra y a la derecha
     * aparecera la pantalla con las funciones del grabador de dvd
     *
     * @access public
     */
    public function verGrabadorDVDEnPizarra( ) {
        $error=AccesoControladoresDispositivos::$ctrlProyectores->entradaVCPizarra();

	if($error!=1){
		AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_DVD_GRABADOR,MatrizVideo::$OUTPUT_PROYECTOR_PIZARRA);
		AccesoGui::$guiProyectores->verDVDGrabEnPizarra();
		AccesoGui::$guiDispositivos->seleccionarDVDGrab();
	}
    } // end of member function verGrabadorDVDEnPizarra


    /**
     * Metodo para mostrar el visor de documentos a traves del proyector de la
     * pizarra. Para ello, seleccionara la entrada de video VGA del proyector y
     * enrutara el video del visor de documentos al proyector de la pizarra.
     *
     * En la pantalla quedaran marcador el proyector de la pizarra y a la derecha
     * aparecera la pantalla con las funciones del reproductor de dvd
     *
     * @access public
     */
    public function verVisorDocumentosEnPizarra( ) {
	$error=AccesoControladoresDispositivos::$ctrlProyectores->entradaVGAEnPizarra();
	if($error!=1){
		AccesoControladoresDispositivos::$ctrlVisorDocumentos->encender();
		AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(8,3);
		AccesoGui::$guiProyectores->verVisorDocumentosEnPizarra();
		AccesoGui::$guiDispositivos->seleccionarCamaraDocumentos();
	}
    } // end of member function verVisorDocumentosEnPizarra

    /**
     * Metodo para mostrar el PC de la sala a traves del proyector de la
     * pizarra. Para ello, seleccionara la entrada de video VGA del proyector y
     * enrutara el video del PC al proyector de la pizarra y el audio al canal7.
     *
     * En la pantalla quedaran marcador el proyector de la pizarra
     *
     * @access public
     */
    public function verPCSalaEnPizarra( ) {
        $error=AccesoControladoresDispositivos::$ctrlProyectores->entradaVGAEnPizarra();
	if($error!=1){
		AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(1,3);
		usleep(100000);
		AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(1,1);
		AccesoGui::$guiProyectores->verPCSalaEnPizarra();
		AccesoGui::$guiDispositivos->seleccionarPCSuelo();
	}
    } // end of member function verPCsalaEnPizarra

    /**
     * Metodo para mostrar el Portatil1 a traves del proyector de la
     * pizarra. Para ello, seleccionara la entrada de video VGA del proyector y
     * enrutara el video del portatil1 al proyector de la pizarra y el audio al
     * canal7.
     *
     * En la pantalla quedaran marcador el proyector de la pizarra
     *
     * @access public
     */
    public function verPortatil1EnPizarra( ) {
        $error=AccesoControladoresDispositivos::$ctrlProyectores->entradaVGAEnPizarra();
	if($error!=1){
		AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(2,3);
		usleep(100000);
		AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(2,1);
		AccesoGui::$guiProyectores->verPortatilEnPizarra(1);
	}

    } // end of member function verPortatil1EnPizarra

    /**
     * Metodo para mostrar el portatil2 de la sala a traves del proyector de la
     * pizarra. Para ello, seleccionara la entrada de video VGA del proyector y
     * enrutara el video del portatil2 al proyector de la pizarra y el audio al
     * canal7.
     *
     * En la pantalla quedaran marcador el proyector de la pizarra
     *
     * @access public
     */
    public function verPortatil2EnPizarra( ) {

        $error=AccesoControladoresDispositivos::$ctrlProyectores->entradaVGAEnPizarra();
	if($error!=1){
		AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(3,3);
		usleep(100000);
		AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(3,1);
		AccesoGui::$guiProyectores->verCamaraEnPizarra(2);
	}

    } // end of member function verPortatil2EnPizarra

    /**
     * Metodo para mostrar el portatil3 de la sala a traves del proyector de la
     * pizarra. Para ello, seleccionara la entrada de video VGA del proyector y
     * enrutara el video del portatil3 al proyector de la pizarra y el audio al
     * canal7.
     *
     * En la pantalla quedaran marcador el proyector de la pizarra
     *
     * @access public
     */
    public function verPortatil3EnPizarra( ) {
        $error=AccesoControladoresDispositivos::$ctrlProyectores->entradaVGAEnPizarra();
	if($error!=1){
		AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(4,3);
	      	usleep(100000);
		AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(4,1);
		AccesoGui::$guiProyectores->verCamaraEnPizarra(3);
	}

    } // end of member function verPortatil3EnPizarra

    /**
     * Metodo para mostrar el portatil4 de la sala a traves del proyector de la
     * pizarra. Para ello, seleccionara la entrada de video VGA del proyector y
     * enrutara el video del portatil4 al proyector de la pizarra y el audio al
     * canal7.
     *
     * En la pantalla quedaran marcador el proyector de la pizarra
     *
     * @access public
     */
    public function verPortatil4EnPizarra( ) {
        $error=AccesoControladoresDispositivos::$ctrlProyectores->entradaVGAEnPizarra();
	if($error!=1){
		AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(9,3);
		usleep(100000);
		AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(9,1);
		AccesoGui::$guiProyectores->verCamaraEnPizarra(4);
	}

    } // end of member function verPortatil4EnPizarra

    /**
     * Metodo para mostrar el atril de la sala a traves del proyector de la
     * pizarra. Para ello, seleccionara la entrada de video VGA del proyector y
     * enrutara el video del atril al proyector de la pizarra y el audio al
     * canal7.
     *
     * En la pantalla quedaran marcador el proyector de la pizarra
     *
     * @access public
     */
    public function verAtrilEnPizarra( ) {
        $error=AccesoControladoresDispositivos::$ctrlProyectores->entradaVGAEnPizarra();
	if($error!=1){
		AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(9,3);
		usleep(100000);
		AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(9,1);
		AccesoGui::$guiProyectores->verAtrilEnPizarra();
	}

    } // end of member function verAtrilEnPizarra

    /**
     * Metodo para mostrar un RedThinkClient a traves del proyector de la pizarra.
     * Para ello, seleccionara la entrada de video VGA del proyector y enrutara
     * el video del RedThinkClient al proyector de la pizarra y el audio al
     * canal7???.
     *
     * En la pantalla quedaran marcador el proyector central y en la derecha se
     * marcara el boton del RedThinkClient
     *
     * @access public
     */
    public function verRedThinkClientEnPizarra( ) {
        $error=AccesoControladoresDispositivos::$ctrlProyectores->entradaVGAEnPizarra();
	if($error!=1){
		AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(5,3);
		usleep(100000);
		AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(5,1);
		AccesoGui::$guiProyectores->verRedThinkClientEnPizarra();
		AccesoGui::$guiDispositivos->seleccionarRedThinkClient();
	}
    } // end of member function verRedThinkClientEnPizarra

    /**
     * Metodo para mostrar la videoconferencia a traves del proyector de la pizarra.
     * Para ello, seleccionara la entrada de video directo del proyector y enrutara
     * el video de la videoconferencia al proyector de la pizarra.
     *
     * En la pantalla quedaran marcador el proyector de la pizarra y en la derecha
     * se marcara el boton del RedThinkClient
     *
     * @access public
     */
    public function verVideoconferenciaEnPizarra( ) {
        $error=AccesoControladoresDispositivos::$ctrlProyectores->entradaVCPizarra();
	if($error!=1)
	        AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_VIDEOCONFERENCIA,MatrizVideo::$OUTPUT_PROYECTOR_CENTRAL);
    } // end of member function verVideoconferenciaEnPizarra

    /**
     * Metodo para examinar la accion del comando recivido por la pelicula flash para
     * seleccionar la funcion del proyector de la pizarra
     *
     * @param ComandoFlash $cmd
     */
    public function getComandoPizarraFlash($cmd) {
        if (strcmp($cmd->getAccion(),"ENCENDER")==0) {
            $this->encenderPizarra();
        
	}else if (strcmp($cmd->getAccion(),"APAGAR")==0) {
            $this->apagarPizarra();

        }else if (strcmp($cmd->getAccion(),"STATUS")==0) {
            $this->estadoPizarra();

	} else if (strcmp($cmd->getAccion(),"DESMUTEAR")==0) {
            $this->activarPizarra();
        
        } else if (strcmp($cmd->getAccion(),"MUTEAR")==0) {
            $this->desactivarPizarra();
        
        } else if (strcmp($cmd->getAccion(),"PCSUELO")==0) {
            $this->verPCSalaEnPizarra();
         
        } else if (strcmp($cmd->getAccion(),"PORTATIL1")==0) {
            $this->verPortatil1EnPizarra();

        } else if (strcmp($cmd->getAccion(),"PORTATIL2")==0) {
            $this->verPortatil2EnPizarra();
        
        } else if (strcmp($cmd->getAccion(),"PORTATIL3")==0) {
            $this->verPortatil3EnPizarra();

        } else if (strcmp($cmd->getAccion(),"PORTATIL4")==0) {
            $this->verPortatil4EnPizarra();

        } else if (strcmp($cmd->getAccion(),"ATRIL")==0) {
            $this->verAtrilEnPizarra();
        
	} else if (strcmp($cmd->getAccion(),"THINK_CLIENT")==0) {
            $this->verRedThinkClientEnPizarra();
        
	} else if (strcmp($cmd->getAccion(),"DVD")==0) {
            $this->verDVDEnPizarra();

        } else if (strcmp($cmd->getAccion(),"DVDGRAB")==0) {
            $this->verGrabadorDVDEnPizarra();
        
        } else if (strcmp($cmd->getAccion(),"CAMARA_1")==0) {
            $this->verCamara1EnPizarra();
        
        } else if (strcmp($cmd->getAccion(),"CAMARA_2")==0) {
            $this->verCamara2EnPizarra();
        
        } else if (strcmp($cmd->getAccion(),"CAMARA_3")==0) {
            $this->verCamara3EnPizarra();
         
        } else if (strcmp($cmd->getAccion(),"CAMARA_DE_DOCUMENTOS")==0) {
            $this->verVisorDocumentosEnPizarra();
        
	}

    }

    /**
     * Metodo para examinar la accion del comando recivido por la pelicula flash para
     * seleccionar la funcion del proyector central
     *
     * @param ComandoFlash $cmd
     */
    public function getComandoCentralFlash($cmd) {
        if (strcmp($cmd->getAccion(),"ENCENDER")==0) {
            $this->encenderCentral();
        
	}else if (strcmp($cmd->getAccion(),"APAGAR")==0) {
            $this->apagarCentral();

        }else if (strcmp($cmd->getAccion(),"STATUS")==0) {
            $this->estadoCentral();

	}else if (strcmp($cmd->getAccion(),"DESMUTEAR")==0) {
            $this->activarCentral();
        
        }else if (strcmp($cmd->getAccion(),"MUTEAR")==0) {
            $this->desactivarCentral();
        
        }else if (strcmp($cmd->getAccion(),"PCSUELO")==0) {
            $this->verPCSalaEnCentral();
        
        }else if (strcmp($cmd->getAccion(),"PORTATIL1")==0) {
            $this->verPortatil1EnCentral();
        
        }else if (strcmp($cmd->getAccion(),"PORTATIL2")==0) {
            $this->verPortatil2EnCentral();
         
        }else if (strcmp($cmd->getAccion(),"PORTATIL3")==0) {
            $this->verPortatil3EnCentral();
         
        }else if (strcmp($cmd->getAccion(),"PORTATIL4")==0) {
            $this->verPortatil4EnCentral();
         
        }else if (strcmp($cmd->getAccion(),"ATRIL")==0) {
            $this->verAtrilEnCentral();
        
        }else if (strcmp($cmd->getAccion(),"THINK_CLIENT")==0) {
            $this->verRedThinkClientEnCentral();
         
        }else if (strcmp($cmd->getAccion(),"DVD")==0) {
            $this->verDVDEnCentral();
        
        }else if (strcmp($cmd->getAccion(),"DVDGRAB")==0) {
            $this->verGrabadorDVDEnCentral();
         
        }else if (strcmp($cmd->getAccion(),"CAMARA_1")==0) {
            $this->verCamara1EnCentral();
         
        }else if (strcmp($cmd->getAccion(),"CAMARA_2")==0) {
            $this->verCamara2EnCentral();
        
	}else if (strcmp($cmd->getAccion(),"CAMARA_3")==0) {
            $this->verCamara3EnCentral();
         
        }else if (strcmp($cmd->getAccion(),"CAMARA_DE_DOCUMENTOS")==0) {
            $this->verVisorDocumentosEnCentral();
        }

    }


} // end of ControladorGuiProyectores
?>
