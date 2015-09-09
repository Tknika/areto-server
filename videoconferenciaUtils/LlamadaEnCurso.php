<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LlamadaEnCurso
 *
 * @author amaia
 */
class LlamadaEnCurso {
    private $id;
    private $nombre;
    private $seleccionado;

    public function  __construct($id,$nombre,$seleccionado) {
        $this->id=$id;
        $this->nombre=$nombre;
        $this->seleccionado=$seleccionado;
    }
    public function setId($id) {
        $this->id=$id;
        }
    public function setNombre($nombre) {
        $this->nombre=$nombre;
        }
    public function setSeleccionado($seleccionado) {
        $this->seleccionado=$seleccionado;
        }
    public function getId() {
        return $this->id;
        }
    public function getNombre() {
        return $this->nombre;
        }
    public function getSeleccionado() {
        return $this->seleccionado;
        }
}
?>
