<?php
require_once './AccesoControladoresDispositivos.php';
require_once './status/status_class.php';
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of Sistema
 *
 * @author amaia
 */
class Sistema {

    /*
     * Prepara el sistema para iniciar la sesion. Enciende las luces del techo y del suelo,...
    */
    public function iniciarSistema() {
        //$status = new status_class();
        //$status->checkStatus();

        AccesoGui::$guiSistema->esperarInicioSistema();
        AccesoControladoresDispositivos::$ctrlLuzTecho->encenderLucesTecho();
        AccesoControladoresDispositivos::$ctrlAutomata->iniciar();
        //  try {
        //    videocon = new Videoconferencia(this.conf, "Videoconferencia");
        //    /*
        //     * TODO: aquí se esperan 3 segundos. Creo que era porque sino la
        //     * videoconferencia no se enganchaba bien. Parece algún bug de alguna
        //     * libreria Java o de la propia videoconferencia.
        //     */
        //    Thread.sleep(3000);
        //    }    catch (Exception e) {
        //    }
        //    videocon.ReiniciarVideoconferencia();
        //    this.conectar();
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(1,1);// Enrutamos el audio del PC
        AccesoControladoresDispositivos::$ctrlCamaras->presetCamaraPresidencia(10);
        //para preparar la imagen istitucional. Se va ha grabar lo que se emite por el PIP.
        //Generador Ventanas se envia a escalador para escalar la imagen
        AccesoControladoresDispositivos::$ctrlGeneradorMultiventanas->preset(1);
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarVideo(7,8);//PIP --> Escalador
        AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_CAMARA_3,MatrizVideo::$OUTPUT_PIP2);
        AccesoControladoresDispositivos::$ctrlGeneradorMultiventanas->input2Ventana2();
        AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_CAMARA_1,MatrizVideo::$OUTPUT_PIP1);
        AccesoControladoresDispositivos::$ctrlGeneradorMultiventanas->input3Ventana1();
        //y del escalador a la grabacion
        AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarVideo(MatrizVideo::$INPUT_ESCALADOR,MatrizVideo::$OUTPUT_SERVIDOR_VIDEOCONFERENCIA);
        AccesoControladoresDispositivos::$ctrlMesaMezclas->preset90();
        AccesoControladoresDispositivos::$ctrlMesaMezclas->desactivarMicPresidencia("M1");
        AccesoControladoresDispositivos::$ctrlDvdGrabador->pararGrabacionGrab();
        AccesoControladoresDispositivos::$ctrlDvd->stopDVD();
        if(AccesoControladoresDispositivos::$ctrlAutomata->isLucesBloqueadas()==false)
            AccesoControladoresDispositivos::$ctrlAutomata->bloquearLuces();
        //CAMARA OPACOS. Izorratua dagoelako
	//AccesoControladoresDispositivos::$ctrlVisorDocumentos->apagarCamaraDocumentos();
        
	//AccesoControladoresDispositivos::$ctrlDvdGrabador->sourceGrab();
        //AccesoControladoresDispositivos::$ctrlDvdGrabador->sourceGrab();
        //AccesoControladoresDispositivos::$ctrlDvdGrabador->sourceGrab();

	AccesoControladoresDispositivos::$ctrlProyectores->estadoPizarra();
	AccesoControladoresDispositivos::$ctrlProyectores->estadoCentral();

        ConexionServidorCliente::$ctrlGuiPantallas->pipEnPantallaEntrada();
        AccesoGui::$guiMenus->inicioMenu(true);

    }

    /**
     * Metodo para salir del sistema de automatizacion de Sinta, apagando todos los dispositivos
     */
    public function salir() {

        AccesoGui::$guiSistema->esperarSalirSistema();
        ////videocon.desconectar();
        AccesoControladoresDispositivos::$ctrlVideoconferencia->desconectar();
        AccesoControladoresDispositivos::$ctrlMatrizVGA->asignarAudio(1,1);
        AccesoControladoresDispositivos::$ctrlFoco->apagar();
        //AccesoControladoresDispositivos::$ctrlDvdGrabador->pararGrabacionGrab();
        //try {
        //    usleep(30);
        //}
        //catch (Exception $e) {
        //}
        AccesoControladoresDispositivos::$ctrlDvd->stopDVD();
        //AccesoControladoresDispositivos::$ctrlDvdGrabador->pararGrabacionGrab();
        $this->apagarDispositivos();
        try {
            usleep(3000);
        }
        catch (Exception $e) {
        }
        if(AccesoControladoresDispositivos::$ctrlAutomata->isLucesBloqueadas()==true)
            AccesoControladoresDispositivos::$ctrlAutomata->desbloquearLuces();
        try {
            usleep(3000);
        }
        catch (Exception $e) {
        }
        // mandar al automata comando para que desactive los bit que
        // corresponden a las filas de los ThienClient y Linea de
        // luces y  subir Panntalla electrica
        AccesoControladoresDispositivos::$ctrlAutomata->principio();
        AccesoControladoresDispositivos::$ctrlLuzTecho->encenderLucesTecho();
        AccesoControladoresDispositivos::$ctrlAutomata->subirPantalla();
        AccesoControladoresDispositivos::$ctrlMesaMezclas->reiniciarValores();
        AccesoGui::$guiSistema->salirSistema();
        AccesoGui::$guiSistema->esperarSalirSistema();

        try {
            usleep(3000);
        }
        catch (Exception $e) {
        }
        AccesoGui::$guiSistema->bienvenidaSistema(true);
        AccesoGui::$guiSistema->dibujarPantalla();
    }

    /**
     * Metodo para apagar todos los dispositivos del sistema
     */
    public function apagarDispositivos() {

        AccesoControladoresDispositivos::$ctrlDvdGrabador->pararGrabacionGrab();
        
	//CAmara de opacos EZ dabil!!!
	//AccesoControladoresDispositivos::$ctrlVisorDocumentos->apagarCamaraDocumentos();
        AccesoControladoresDispositivos::$ctrlPantallas->apagarEntrada();
        AccesoControladoresDispositivos::$ctrlPantallas->apagarPresidencia();
        AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarvideo(3,1);
        //grabatu behar bada
        //AccesoControladoresDispositivos::$ctrlMatrizVideo->asignarvideo(3,3);
        AccesoControladoresDispositivos::$ctrlPlasma->verCamara3EnPlasma( );
        AccesoControladoresDispositivos::$ctrlPlasma->apagar();

        AccesoControladoresDispositivos::$ctrlProyectores->apagarCentral();
        AccesoControladoresDispositivos::$ctrlDvd->apagarDVD();
        //AccesoControladoresDispositivos::$ctrlDvdGrabador->apagar();
        //usleep(50000);
        AccesoControladoresDispositivos::$ctrlProyectores->apagarPizarra();

    }
    public function getEstadoSistema() {
        $status = new status_class();
        $status->checkStatus();

        $properties=new Properties();
        $properties->load(file_get_contents("./sinta.properties"));

        $dispositivos=array();
        foreach ($properties->propertyNames() as $property) {
            $pos=stripos($property,".");
            $disp=substr($property, 0,$pos);

            $parent=$properties->getProperty($disp.".parent");
            $parentStatus=$properties->getProperty($parent.".status");

            if(!in_array($disp, $dispositivos) && $properties->getProperty($disp.".status")==1 && ( empty($parent) || $parentStatus==0 ) )
                $dispositivos[]=$disp;
        }

      echo "\nOKERRAK ".print_r($dispositivos,1);
      
        if(count($dispositivos)==0) return '';

        $alert_messages=array();
       // $dispositivos=array("CamaraPresidencia","CamaraAlumnos1","CamaraAlumnos2","FocoMovil","Dvd","DvdGrabador","GeneradorMultiventanas","MatrizVGA","MatrizVideo","MesaMezclas","Pantalla","PantallaPresidencia","PantallaEntrada","Plasma","ProyectorCentral","ProyectorPizarra","Videoconferencia","VisorOpacos","Luces","Automata");
        foreach ($dispositivos as $dispositivo) {

            $errorMsg=$properties->getProperty($dispositivo.".error");
            
            if( empty($errorMsg) ){
                $alert_messages[]="ERROR $dispositivo";
            }else{
                $alert_messages[]=$properties->getProperty($dispositivo.".error");
            }
        }
        $alert_message=implode("\n",$alert_messages);
        echo "ALERT::: " .$alert_message ;
        $alert_message=str_replace('"', '', $alert_message);
        return $alert_message;
    }


}
?>
