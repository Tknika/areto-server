<?php

/**
 * @package PHP::controladoresDispositivos
 */
/**
 * includes
 */
require_once './dispositivos/Proyector.php';

/**
 * Description of ControladorProyectores
 *
 * @author amaia
 *
 * @package PHP::controladoresDispositivos
 */
class ControladorProyectores {

    /**
     * Atributo que guardara la instancia de la clase Proyector, para el
     * proyector de la pizarra
     *
     * @var Proyector
     * @access private
     * @static
     */
    private static $pizarra;
    /**
     * Atributo que guardara la instancia de la clase Proyector, para el
     * proyector de la central
     *
     * @var Proyector
     * @access private
     * @static
     */
    private static $central;

    /**
     * Metodo constructor de la clase, se instancian los proyectores que vaya a
     * controlar la clase
     *
     * @access public
     */
    public function  __construct() {

        self::$central=new Proyector("ProyectorCentral");
        self::$pizarra=new Proyector("ProyectorPizarra");

    }

    /////////////////////////////////////////////////////
    //////////Funciones del proyector central////////////
    /////////////////////////////////////////////////////

    /**
     * Metodo para desmutear el proyector central
     *
     * @access public
     */
    public function activarCentral( ) {

        $respuesta=self::$central->desmutear();
	$cmd2 = new ComandoFlash("PROYECTOR_CENTRAL", "NO_MUTE");
	$bb=$cmd2->getComando();
	SocketClass::client_reply($bb);

	  
        /*if(!empty ($respuesta)) {
            if(strcmp($respuesta,"?")==0) {
                echo "ERROR al enviar el comando ".$comando." al proyector central, para activarlo\n";
                return 1;
            }
            else return 0;

        }else return 1;*/
    } // end of member function activarProyector

    /**
     * Metodo para mutear el proyector central
     *
     * @access public
     */
    public function desactivarCentral( ) {

        $respuesta=self::$central->mutear();
	$cmd2 = new ComandoFlash("PROYECTOR_CENTRAL", "MUTE");
	$bb=$cmd2->getComando();
	SocketClass::client_reply($bb);

        /*if(!empty ($respuesta)) {
            if(strcmp($respuesta,"?")==0) {
                echo "ERROR al enviar el comando ".$comando." al proyector central, para desactivarlol\n";
                return 1;
            }
            else return 0;

        }else return 1;*/
    } // end of member function desactivarProyector

    /**
     * Metodo para encender el proyector central
     *
     * @access public
     */
    public function encenderCentral( ) {
        $error=0;
        $respuesta=self::$central->estado();

        if(!empty ($respuesta)) {
            if($respuesta!=1) {
                if((strcmp($respuesta,"00")!=0)&&(strcmp($respuesta,"40")!=0)) {
                    while(strcmp($respuesta, "20")==0) {
                        echo "LA LAMPARA DEL PROYECTOR SE ESTA ENFRIANDO\n";
                        sleep(20);
                        $respuesta=self::$central->estado();
                        if(strcmp($respuesta,"?")==0) {
                            $error=1;
                        }
                    }
                    $respuesta=self::$central->estado();
                    if(strcmp($respuesta,"?")==0) {
                        echo "Error al intentar encender el proyector central\n";
                        $error=1;
                    }
		    $error=self::$central->encender();
		    if(strcmp($respuesta,"?")==0) {
			$error=1;
		    }else $error=0;

                }
            }else $error=1;
            return  $error;
        }else return 1;

        ////////////////////////////
        //        $error=self::$central->encender();
        //        if($error==1) {
        //            echo "ERROR al enviar el comando ".$comando." al proyector central, para encenderlo\n";
        //        }
        //        return $error;
    } // end of member function encenderProyector

    /**
     * Metodo para apagar el proyector central
     *
     * @access public
     */
    public function apagarCentral( ) {
        $respuesta=self::$central->apagar();
        if(!empty ($respuesta)) {
            if(strcmp($respuesta,"?")==0) {
                echo "ERROR al enviar el comando ".$comando." al proyector central, para apagarlo\n";
                return 1;
            }
            else return 0;
        }else return 1;

    } // end of member function apagarProyector



    /**
     * Metodo para conocer el estado del proyector central
     *
     * @access public
     */
    public function estadoCentral( ) {
	$respuesta=self::$central->estado();
	$cmd = new ComandoFlash("PROYECTOR_CENTRAL", "$respuesta");
	$aa=$cmd->getComando();
	SocketClass::client_reply($aa);

    } // end of member function estadoCentral




    /**
     * Metodo para seleccionar la entrada vc del proyector central
     *
     * @access public
     */
    public function entradaVCCentral( ) {

        $respuesta=self::$central->entradaVC();
        if($respuesta !=="" ) {
            if(strcmp($respuesta,"?")==0) {
                echo "ERROR al enviar el comando ".$comando." al proyector central, para seleccionar la entrada vc\n";
                return 1;
            }
            else return 0;
        }else return 1;
    } // end of member function verDVDEnElProyector


    /**
     * Metodo para seleccional la entrada vga del proyector central
     *
     * @access public
     */
    public function entradaVGAEnCentral( ) {
	
        $respuesta=self::$central->entradaVGA();
        if(!empty ($respuesta)) {
            if(strcmp($respuesta,"?")==0) {
                echo "ERROR al enviar el comando ".$comando." al proyector central, para seleccionar la entrada vga\n";
                return 1;
            }
            else return 0;
        }else return 1;
    } // end of member function verVisorDocumentosEnProyector

    /**
     * Metodo que nos devolvera si el proyector central esta apagado o encendido
     *
     * @access public
     * @return bit 1 si esta encendido y 0 si esta apagado
     */
    public function isEncendidoCentral( ) {

        return self::$central->estado();

    } // end of member function isEncendido

    
    public function forzarEstadoOnCentral() {
	echo "ProyectorCentral debería estar encendido. Actualizando estadoDispositivos.properties ...";
	return self::$central->forzarEstadoOn();
    }


    /////////////////////////////////////////////
    //////////Funciones de la pizarra////////////
    /////////////////////////////////////////////

    /**
     * Metodo para encender el proyector de la pizarra
     *
     * @access public
     */
    public function encenderPizarra( ) {
        $error=0;
        $respuesta=self::$pizarra->estado();
        if(!empty ($respuesta)) {
            if($respuesta!=1) {
                if((strcmp($respuesta,"00")!=0)&&(strcmp($respuesta,"40")!=0)) {
                    while(strcmp($respuesta, "20")==0) {
                        echo "LA LAMPARA DEL PROYECTOR SE ESTA ENFRIANDO\n";
                        sleep(20);
                        $respuesta=self::$pizarra->estado();
                        if(strcmp($respuesta,"?")==0) {
                            $error=1;
                        }
                    }
		    $respuesta=self::$central->estado();
                    if(strcmp($respuesta,"?")==0) {
                        echo "Error al intentar encender el proyector central\n";
                        $error=1;
                    }
		   
                    $respuesta=self::$pizarra->estado();
                    if(strcmp($respuesta,"?")==0) {
                        echo "Error al intentar encender el proyector central\n";
                        $error=1;
                    }
		    $error=self::$pizarra->encender();
		    if(strcmp($respuesta,"?")==0) {
			$error=1;
		    }else $error=0;
                    
                }

            }
            else $error=1;

            return  $error;
        }else return 1;
    } // end of member function encenderPizarra

    /**
     * Metodo para apagar el proyector de la pizarra
     *
     * @access public
     */
    public function apagarPizarra( ) {
        $respuesta=self::$pizarra->apagar();
        if(!empty ($respuesta)) {
            if(strcmp($respuesta,"?")==0) {
                echo "ERROR al enviar el comando ".$comando." al proyector de la pizarra, para apagarla\n";
                return 1;
            }
            else return 0;
        }else {
            return 1;
        }
    } // end of member function apagarPizarra


    /**
     * Metodo para conocer el estado del proyector pizarra
     *
     * @access public
     */
    public function estadoPizarra( ) {


	$respuesta=self::$pizarra->estado();
	$cmd = new ComandoFlash("PIZARRA_DIGITAL", "$respuesta");
	$aa=$cmd->getComando();
	SocketClass::client_reply($aa);

    } // end of member function estadoPizarra



    /**
     * Metodo para mutear el proyector de la pizarra
     *
     * @access public
     */
    public function desactivarPizarra( ) {

        $respuesta=self::$pizarra->mutear();
	$cmd2 = new ComandoFlash("PIZARRA_DIGITAL", "MUTE");
	$bb=$cmd2->getComando();
	SocketClass::client_reply($bb);

        /*if(!empty ($respuesta)) {
            if(strcmp($respuesta,"?")==0) {
                echo "ERROR al enviar el comando ".$comando." al proyector de la pizarra, para desactivarla\n";
                return 1;
            }
            else return 0;
        }else {
            return 1;
        }*/
	

    } // end of member function desactivarPizarra

    /**
     * Metodo para desmutear el proyector de la pizarra
     *
     * @access public
     */
    public function activarPizarra( ) {

        $respuesta=self::$pizarra->desmutear();
	$cmd2 = new ComandoFlash("PIZARRA_DIGITAL", "NO_MUTE");
	$bb=$cmd2->getComando();
	SocketClass::client_reply($bb);

        /*if(!empty ($respuesta)) {
            if(strcmp($respuesta,"?")==0) {
                echo "ERROR al enviar el comando ".$comando." al proyector de la pizarra, para activarla\n";
                return 1;
            }
            else return 0;
        }else return 1;*/

	

    } // end of member function activarPizarra

    /**
     * Metodo para seleccionar la entrada vc el proyector de la pizarra
     *
     * @access public
     */
    public function entradaVCPizarra( ) {

        $respuesta=self::$pizarra->entradaVC();

        if($respuesta !== "") {
            if(strcmp($respuesta,"?")==0) {
                echo "ERROR al enviar el comando ".$comando." al proyector de la pizarra, para seleccionar la entrada vc\n";
                return 1;
            }else{
		 return 0;
	    }
        }else{
	    return 1;
	}
    } // end of member function dvdPizarra


    /**
     * Metodo para seleccionar la entrada vga del proyector de la pizarra
     *
     * @access public
     */
    public function entradaVGAEnPizarra( ) {

        $respuesta=self::$pizarra->entradaVGA();
        if(!empty ($respuesta)) {
            if(strcmp($respuesta,"?")==0) {
                echo "ERROR al enviar el comando ".$comando." al proyector de la pizarra, para seleccionar la entrada vga\n";
                return 1;
            }
            else return 0;
            
        }
        else return 1;

    } // end of member function verVisorDocumentosEnPizarra

    /**
     * Metodo que nos devolvera si el proyector de la pizarra esta apagado o encendido
     *
     * @access public
     * @return bit 1 si esta encendido y 0 si esta apagado
     */
    public function isEncendidoPizarra( ) {

        return self::$pizarra->estado();

    } // end of member function isEncendido

    public function forzarEstadoOnPizarra() {
	echo "ProyectorPizarra debería estar encendido. Actualizando estadoDispositivos.properties ...";
        return self::$pizarra->forzarEstadoOn();
    }
}
?>
