<?php
require_once './dispositivos/Videoconferencia.php';
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControlVideoconferencia
 *
 * @author amaia
 */
class ControlVideoconferencia {

    private $videoconferencia;
    private $listaLlamadaEnCurso;
     
    
    function  __construct() {
        $this->videoconferencia=new Videoconferencia("Videoconferencia");
        
    }
    
    public function getListaLlamadasEnCurso() {
        echo "llamadas activas en control videoconf\n";
        print_r($this->videoconferencia->getListaLlamadasEnCurso());
        return $this->videoconferencia->getListaLlamadasEnCurso();
    }
    
    public function getListaLlamadas() {
        return $this->videoconferencia->getListaLlamadas();
    }
    
    public function getListaDeContactos() {
        return $this->videoconferencia->getListaDeContactos();
    }
    public function getListaDeContactosString() {
        return $this->videoconferencia->getListaDecontactosString();
    }
    public function getListaLlamadasEnCursoString() {
        return $this->videoconferencia->getLlamadasActivasString();
    }
    public function conectar() {
        $this->videoconferencia->conectar();
    }
    
    public function desconectar() {
        $this->videoconferencia->desconectar();
    }
    
    public function reiniciarVideoconferencia() {
        $this->videoconferencia->reiniciarVideoconferencia();
        
    }
    
    public function colgarVideoconferencia() {
        $this->videoconferencia->colgarVideoconferencia();
    }
    
    public function colgarLlamada($llamada) {
    
        $this->videoconferencia->colgarLlamada($llamada);
    }
    
    public function contactos() {
        $this->videoconferencia->contactos();
    }
   
    public function llamadasActivas() {
        $this->videoconferencia->idLlamada();
    }
    
    public function llamadas($llamada,$tipoLlamada) {
        $this->videoconferencia->llamadas($llamada, $tipoLlamada);
    }
    public function llamarVideoconferencia() {
        $this->videoconferencia->llamarVideoconferencia();
        
    }
    
    public function llamarVideoconferenciaIP($numeroIP) {
        $this->videoconferencia->llamarVideoconferenciaIP($numeroIP);
        
    }
    
    public function llamarVideoconferenciaNombre($nombre) {
        $this->videoconferencia->llamarVideoconferenciaNombre($nombre);
        
    }
    
    
//    public function videoconferenciaIP() {
//        $this->videoconferencia->videoconferenciaIP();
//
//    }
//
//    public function videoconferenciaRDSI() {
//        $this->videoconferencia->videoconferenciaRDSI();
//    }
//
//    public function homeVideoconferencia() {
//        $this->videoconferencia->homeVideoconferencia();
//
//    }
    public function graficosVideoconferencia() {
        $this->videoconferencia->graficosVideoconferencia();
    }
    
    public function marcarNumero($numero) {
        $this->videoconferencia->marcarNumero($numero);
    } // end of member function marcarNumero
    
   
    public function borrarUltimo( ) {
        $this->videoconferencia->borrarUltimo();
    } // end of member function borrarUltimo
    
    public function borrarTodo( ) {
        $this->videoconferencia->borrarTodo();
        
    } // end of member function borrarTodo
    
    public function noMolestar( ) {
        $this->videoconferencia->noMolestar();
        
    } // end of member function noMolestar
    
    public function noMolestarOff( ) {
        $this->videoconferencia->noMolestarOff();
    } // end of member function noMolestarOff
}
?>
