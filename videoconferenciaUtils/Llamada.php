<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Llamada
 *
 * @author amaia
 */
class Llamada {
    private $numero;
    private $tipo;
    private $seleccionado;

    public function  __construct($numero,$tipo,$seleccionado) {
        $this->numero=$numero;
        $this->tipo=$tipo;
        $this->seleccionado=$seleccionado;
    }

    public function setNumero($numero){
        $this->numero=$numero;
    }
     public function setTipo($tipo){
        $this->tipo=$tipo;
    }
     public function setSeleccionado($seleccionado){
        $this->seleccionado=$seleccionado;
    }
     public function getNumero(){
        return $this->numero;
    }
     public function getTipo(){
        return ;$this->tipo;
    }
     public function getSeleccionado(){
        return ;$this->seleccionado;
    }
}
?>
