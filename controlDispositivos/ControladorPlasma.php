<?php
/**
 * @package PHP::controladoresDispositivos
 */
/**
 * includes
 */
require_once './dispositivos/Plasma.php';

/**
 * Description of ControladorPlasma
 *
 * @author amaia
 *
 * @package PHP::controladoresDispositivos
 */
class ControladorPlasma {

    /**
     * Atributo que guardara la instancia de la clase Plasma
     *
     * @var Plasma
     * @access private
     * @static
     */
    private static $plasma;

    function  __construct() {

        self::$plasma=new Plasma("Plasma");

    }

    public function estadoPlasma(){
      $respuesta=self::$plasma->estadoPlasma();

    }

    /**
     * Metodo para encender el plasma
     *
     * @access public
     */
    public function encender() {
        $respuesta=self::$plasma->estadoPlasma();
	if ( $respuesta == 'OFF' ){
	  echo "plasma->encender\n";
	  $respuesta=self::$plasma->encender();
	}

	/*
	$respuesta=self::$plasma->estadoPlasma();
	if($respuesta==1){
	  echo "error al preguntar por el estado del plasma\n";
	  return 1;
	}
	else if(strpos($respuesta,"QPW:0")!==false){
	  $respuesta=self::$plasma->encender();
	  if($respuesta==1){
	    echo "error al encender el plasma\n";
	    return 1;
	  }else
	    return 0;		
	  }//si ya esta encendido no hace falta encender
	    else return 0;

	  */
    } // end of member function encender

    /**
     * Metodo para apagar el plasma
     *
     *@access public
     */
    public function apagar() {

	$respuesta=self::$plasma->estadoPlasma();
	if ( $respuesta == 'ON' ){
	  echo "plasma->apagar\n";
	  $respuesta=self::$plasma->apagar();
	}

	/*
	$respuesta=self::$plasma->estadoPlasma();
	if($respuesta==1){
	  echo "error al preguntar por el estado del plasma\n";
	  return 1;
	}
	else if(strpos($respuesta,"QPW:1")!==false){
	$respuesta=self::$plasma->apagar();
	if($respuesta==1){
	  echo "error al encender el plasma\n";
	  return 1;
	}else
	  return 0;		
	}//si ya esta encendido no hace falta encender
	else return 0;*/



    } // end of member function apagar

    /**
     * Metodo para ver el pc de la sala en el plasma
     *
     * @access public
     */
    public function verPcSalaEnPlasma( ) {

        $respuesta=self::$plasma->verEnPantallaVGA();
        return $this->isError($respuesta, "ver el PC de la sala en");
    } // end of member function verPcSalaEnPlasma

    /**
     * Metodo para ver el portatil1 en el plasma
     *
     * @access public
     */
    public function verPortatil1EnPlasma( ) {

        $respuesta=self::$plasma->verEnPantallaVGA();
        return $this->isError($respuesta, "ver el portatil1 en");
    } // end of member function verPortatil1EnPlasma

    /**
     * Metodo para ver el portatil2 en el plasma
     *
     * @access public
     */
    public function verPortatil2EnPlasma( ) {

        $respuesta=self::$plasma->verEnPantallaVGA();
        return $this->isError($respuesta, "ver el portatil2 en");
    } // end of member function verPortatil2EnPlasma

    /**
     * Metodo para ver el portatil3 en el plasma
     *
     * @access public
     */
    public function verPortatil3EnPlasma( ) {

        $respuesta=self::$plasma->verEnPantallaVGA();
        return $this->isError($respuesta, "ver el portatil3 en");
    } // end of member function verPortatil3EnPlasma

    /**
     * Metodo para ver el portatil4 en el plasma
     *
     * @access public
     */
    public function verPortatil4EnPlasma( ) {

        $respuesta=self::$plasma->verEnPantallaVGA();
        return $this->isError($respuesta, "ver el portatil4 en");
    } // end of member function verPortatil4EnPlasma

    /**
     * Metodo para ver el atril en el plasma
     *
     * @access public
     */
    public function verAtrilEnPlasma( ) {

        $respuesta=self::$plasma->verEnPantallaVGA();
        return $this->isError($respuesta,"ver el pc del atril en");
    } // end of member function verAtrilEnPlasma

    /**
     * Metodo para ver la camara de documentos en el plasma
     *
     * @access public
     */
    public function verVisorDocumentosEnPlasma( ) {

        $respuesta=self::$plasma->verEnPantallaVGA();
        return $this->isError($respuesta,"ver el visor de documentos en");

    } // end of member function verVisorDocumentosEnPlasma

    /**
     * Metodo para ver el dvd en el plasma
     *
     * @access public
     */
    public function verDVDEnPlasma( ) {

        $respuesta=self::$plasma->verEntradaPantallaAV2();
        return $this->isError($respuesta,"ver el lector de dvd en");
    } // end of member function verDVDEnPlasma

    /**
     * Metodo para ver el grabador de dvd en el plasma
     *
     * @access public
     */
    public function verGrabadorDVDEnPlasma( ) {

        $respuesta=self::$plasma->verEntradaPantallaAV2();
        return $this->isError($respuesta,"ver el grabador de dvd en");
    } // end of member function verGrabadorDVDEnPlasma

    /**
     * Metodo para ver la camara1 en el plasma
     *
     * @access public
     */
    public function verCamara1EnPlasma( ) {

        $respuesta=self::$plasma->verEntradaPantallaAV2();
        return $this->isError($respuesta,"ver la camara1 en");
    } // end of member function verCamara1EnPlasma

    /**
     * Metodo para ver la camara2 en el plasma
     *
     * @access public
     */
    public function verCamara2EnPlasma( ) {

        $respuesta=self::$plasma->verEntradaPantallaAV2();
        return $this->isError($respuesta,"ver la camara2 en");
    } // end of member function verCamara2EnPlasma

    /**
     * Metodo para ver la camara3 en el plasma
     *
     * @access public
     */
    public function verCamara3EnPlasma( ) {

        $respuesta=self::$plasma->verEntradaPantallaAV2();
        return $this->isError($respuesta,"ver la camara3 en");
    } // end of member function verCamara3EnPlasma

    /**
     * Metodo para ver redthinkClient en el plasma
     *
     * @access public
     */
    public function verRedThinkClientEnPlasma( ) {

        $respuesta=self::$plasma->verEnPantallaVGA();
        return $this->isError($respuesta,"ver el redthinkclient en");
    } // end of member function verRedThinkClientEnPlasma

    /**
     * Metodo para ver la videoconferencia en el plasma
     *
     * @access public
     */
    public function verVideoconferenciaEnPlasma( ) {

        $respuesta=self::$plasma->verEntradaPantallaAV2();
        return $this->isError($respuesta,"ver la videoconferencia en");
    } // end of member function verVideoconferenciaEnPlasma

    /**
     * Metodo para ver el video de la sala en el plasma
     *
     * @access public
     */
    public function verVideoSalaEnPlasma( ) {

        $respuesta=self::$plasma->verEntradaPantallaAV2();
        return $this->isError($respuesta,"ver el video de la sala en");
    } // end of member function verVideoSalaEnPlasma
    public function isError($respuesta,$mensaje) {
        if(!empty ($respuesta)) {
            if (strcmp($respuesta,"ER401")==0) {
                echo "Error al intentar ".$mensaje." el plasma\n";
                return 1;
            }
            else return 0;

        }else
            return 1;
    }
}
?>
