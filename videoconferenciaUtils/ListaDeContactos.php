<?php
require_once './videoconferenciaUtils/Contacto.php';
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ListaDeContactosphp
 *
 * @author amaia
 */
class ListaDeContactos {
//put your code here
    private $contactos;
    public function  __construct() {
        $this->contactos=array();
    }
    public function anadirContactos($abk) {
        $lista=array();
        $contacto;
        $nombre;
        $speed;
        $numero;
        $seleccionado=0;
        $pos;
        $i=0;
        while(strpos($abk, "abk all done")>0) {
            $pos=strpos($abk, ". ");
            if($pos>0) {
                $abk=substr($abk, $pos+2);
                echo $abk."\n";
                $pos=strpos($abk, " spd:");
                $nombre=substr($abk, 0,$pos);
                echo "nombre ".$nombre."\n";
                $abk=substr($abk, $pos+5);
                echo $abk."\n";
                $pos=strpos($abk, " num:");
                $speed=substr($abk,0, $pos);
                echo "speed ".$speed."\n";
                $abk=substr($abk, $pos+5);
                echo $abk."\n";
                $pos=strpos($abk, "\r\n");
                if ($pos<0) {
                    $pos=strpos($abk, "abk ");
                }
                $numero=substr($abk, 0,$pos);
                echo "numero ".$numero."\n";
                $abk=substr($abk, $pos+2);
                echo $abk."\n";
                $contacto=new Contacto($nombre, $speed, $numero, $seleccionado);
                $this->contactos[$i]=$contacto;
                $i++;

            }

        }

    }
    public function borrarContactos() {
        $this->contactos=array();
    }
    public function getContactos() {
        return $this->contactos;
    }
    public function obtenerContactosEnString() {
        $lista="";


        print_r($this->contactos);
        foreach ($this->contactos as $contacto) {
            $lagun=$contacto->getNombre()."=".$contacto->getSeleccionado().",";
            $lista=$lista.$lagun;
        }
        if(strlen($lista)>0)
            $lista=substr($lista, 0, strlen($lista)-1);
        return $lista;
    }
    public function getContacto($nombre) {
        $encontrado=false;
        $i=0;
        while(strlen($this->contactos)>$i || !$encontrado) {
            if(strcmp($this->contactos[$i]->getNombre(),$nombre)==0) {
                $encontrado=true;
            }
            $i++;
        }
        return $this->contactos[$i-1];
    }
    public function seleccionarContacto($nombre) {
        for($i=0;$i<strlen($this->contactos);$i++) {
            if(strcmp($this->contactos[$i]->getNombre(),$nombre)==0) {
                $this->contactos[$i]->setSeleccionado(1);
            }
        }
    }
    public function desSeleccionarContacto($nombre) {
        for($i=0;$i<strlen($this->contactos);$i++) {
            if(strcmp($this->contactos[$i]->getNombre(),$nombre)==0) {
                $this->contactos[$i]->setSeleccionado(0);
            }
        }
    }
    public function addIdLlamada($llamada) {
        $id;
        $nombre;
        $ip;
        $pos;
        $i=0;
        while (strpos($llamada, "callinfo begin ")>0 && strpos($llamada, "callinfo end")>0) {
            $pos=strpos($llamada, ":");
            if($pos>0) {
                $id=substr($llamada, $pos+1);
                $pos=strpos($llamada, " spd:");
                $nombre=substr($llamada,0, $pos);
                $llamada=substr($llamada, $pos+5);
                $pos=strpos($llamada," num:");
                $llamada=substr($llamada, $pos+5);
                $pos=strpos($llamada, "\r\n");
                if($pos<0)
                    $pos=strpos($llamada, "abk ");
                $llamada=substr($llamada, $pos+2);
            }
            $i++;
        }
        $numElementos=strlen($this->contactos);
    

    }
}
?>
