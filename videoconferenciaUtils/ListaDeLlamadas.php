<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ListaDeLlamadas
 *
 * @author amaia
 */
class ListaDeLlamadas {
    private $llamadas;
    public function  __construct() {
        $this->llamadas=array();
    }
    public function addLlamada($num,$tipollamada,$selec) {
        $lista=array();
        $tipo=$tipollamada;
        $numero=$num;
        $seleccindado=1;
        $i=0;
        $llamada=new Llamada($numero, $tipo, $selec);
        $lista[$i]=$llamada;
        $i++;
        //falta codigo
    }
    public function borrarListaLlamadas() {
        $this->llamadas=array();
    }
    public function getListaDeLlamadas(){
        return $this->llamadas;

    }
    public function getListaLlamadasString(){
        //????????????
    }
    public function getLlamada($numero){
        $encontrado=false;
        for ($i = 0; $i< count($this->llamadas) && !$encontrado; $i++) {
			if ( $this->llamadas[i]->getNumero() === $numero) {
				$encontrado=true;
			}
		}
        return $this->llamadas[$i];
    }
    public function seleccionarLlamada($nombre){
        $encontrado=false;
        for ($i = 0; $i< count($this->llamadas) && !$encontrado; $i++) {
			if ( $this->llamadas[i]->getNumero() === $numero) {
				$encontrado=true;
                                $this->llamadas[$i]->setSeleccionado(1);
			}
		}
    }
    public function desSeleccionarLlamada($nombre){
        $encontrado=false;
        for ($i = 0; $i< count($this->llamadas) && !$encontrado; $i++) {
			if ( $this->llamadas[i]->getNumero() === $numero) {
				$encontrado=true;
                                $this->llamadas[$i]->setSeleccionado(0);
			}
		}
    }
}
?>
