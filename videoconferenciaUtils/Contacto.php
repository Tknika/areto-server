<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Contacto
 *
 * @author amaia
 */
class Contacto {
//put your code here
    private $nombre;
    private $speed;
    private $numero;
    private $seleccinado;

    public function  __construct($nombre,$speed,$numero,$seleccionado) {
        $this->nombre=$nombre;
        $this->speed=$speed;
        $this->numero=$numero;
        $this->seleccinado=$seleccionado;
    }
    public function setNombre($nombre) {
        $this->nombre=$nombre;
    }
    public function setSpeed($speed) {
        $this->speed=$speed;
    }
    public function setNumero($numero) {
        $this->numero=$numero;
    }
    public function setSeleccionado($seleccionado) {
        $this->seleccinado=$seleccionado;
    }
    public function getNombre() {
        return $this->nombre;
    }
    public function getSpeed() {
        return $this->speed;
    }
    public function getNumero() {
        return $this->numero;
    }
    public function getSeleccionado() {
        return $this->seleccinado;
    }

}
?>
