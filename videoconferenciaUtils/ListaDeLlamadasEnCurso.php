<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ListaDeLlamadasEnCurso
 *
 * @author amaia
 */
class ListaDeLlamadasEnCurso {
    private $llamadasEnCurso=array();
    private $identificador;
    public function  __construct() {
        //
    }
    public function getLlamadasEnCurso(){
        return $this->llamadasEnCurso;
    }
    public function getLlamadasEnCursoString(){
        $llamadas="";

        foreach ($this->llamadasEnCurso as $llamada){
            $llamadas=$llamadas.$llamada->getNombre()."=0,";
        }
           if(strlen($llamadas)>0)
            $llamadas=substr($llamadas, 0, strlen($llamadas)-1);
        return $llamadas;
    }
    public function addLlamadas($llamada) {
        $id;
        $nombre;
        $resto;
        $resto1;
        $resto2;
        $resto3;
        $informacion;
        $pos;
        $pos1;
        $pos2;
        $i=0;
        $pos=strpos($llamada, "callinfo begin");
        if ($pos>0)
            $llamada=substr($llamada, $pos+14);
        while (strpos($llamada, "callinfo end")>0){
            $pos=strpos($llamada, ":");
            $resto=substr($llamada, $pos+1);
            $pos1=strpos($resto,":");
            $id=substr($resto, 0,$pos1);
            $resto1=substr($resto, $pos1+1);
            $pos=strpos($resto1, ":");
            $nombre=substr($resto1, 0,$pos);
            $resto2=substr($resto1, $pos1+1);
            $pos=strpos($resto2, ":");
            $ip=substr($resto2, 0,$pos);
            $resto3=substr($resto2, $pos+1);
            $informacion=$informacion.$id.",".$nombre.",".$ip."#";
            $llamadaActiva=new LlamadaEnCurso($id, $nombre, 0);
            $this->llamadasEnCurso[$i]=$llamadaActiva;
            $pos2=strpos($resto3, "callinfo");
            $llamada=substr($resto3, $pos2);
            $i++;
        }
    }
    public function getId($nombre) {
        if(strcmp($nombre, "")==0){
            return "";
        }
        else{
            $nombre2=ucfirst($nombre);
            $llamada=$this->buscarLlamada($nombre2);
            $llamada->getId();
        }
    }
    public function getNombres(){
        //kodea
    }
    public function seleccionarLlamada($nombre){
        //kodea
    }
    public function desSeleccionarLlamada($nombre){
        //kodea
    }
    public function buscarLlamada($nombre){
        $res="";
        echo $nombre."\n";
        foreach ($this->llamadasEnCurso as $llamada){
            $nom=$llamada->getNombre();
            if(strcmp($nom, $nombre)==0){
                $res=$llamada->getId();
            }
        }
        return $res;
    }
}
?>
