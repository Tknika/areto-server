<?php
require_once './dispositivos/DispositivoTelnet.php';
require_once './comunication/PHPTelnet.php';
require_once './videoconferenciaUtils/Contacto.php';
require_once './videoconferenciaUtils/ListaDeContactos.php';
require_once './videoconferenciaUtils/ListaDeLlamadas.php';
require_once './videoconferenciaUtils/ListaDeLlamadasEnCurso.php';
require_once './videoconferenciaUtils/Llamada.php';
require_once './videoconferenciaUtils/LlamadaEnCurso.php';

/**
 * Description of Videoconferencia
 *
 * @author amaia
 */
class Videoconferencia extends DispositivoTelnet {


    private  $listaDeLlamadas;
    private $listaDeContactos;
    private  $listaDeLlamadasEnCurso;
    private $listaCargada=0;
    private $llamadasCargada = false;
    private $borrartodo=false;



    function  __construct($dispositivo) {
        $this->tipoDispositivo="Videoconferencia";
        parent::__construct($dispositivo);
        $this->listaDeContactos=new ListaDeContactos();
        $this->listaDeLlamadas=new ListaDeLlamadas();
        $this->listaDeLlamadasEnCurso=new ListaDeLlamadasEnCurso();
        echo($this->ip."-".$this->modeloIPLT."-".$this->strMarca."-".$this->strModelo."-".$this->id_disp."-".$this->tipoPuerto."-".$this->numeroPuerto."-".$this->baudRate."-".$this->timeOut."-".$this->puerto."-".$this->password);

    }

    public function getListaLlamadasEnCurso() {
        echo "llamadas activas en  videoconf\n";
        print_r($this->listaDeLlamadasEnCurso);
        return $this->listaDeLlamadasEnCurso;
    }
    public function getListaDeContactos() {
        return $this->listaDeContactos;
    }
    public function getListaDeContactosString() {
        return $this->listaDeContactos->obtenerContactosEnString();
    }
    public function getLlamadasActivasString() {
        return $this->listaDeLlamadasEnCurso->getLlamadasEnCursoString();
    }

    public function getListaLlamadas() {
        return $this->listaDeLlamadas;
    }

    public function conectar() {
        $this->connect();
        sleep(5);
        $this->contactos();
    }

    public function desconectar() {

        $this->disconnect();

    }

    public function reiniciarVideoconferencia() {

        $comando=$this->comandos1[DaoControl::$REINICIAR];
        $this->enviarComando($comando);

    }

    public function colgarVideoconferencia() {

        $comando=$this->comandos1[DaoControl::$COLGARVIDEOCONFERENCIA];
        $this->enviarComando($comando);

    }
    
    public function colgarLlamada($idLlamada) {

        $this->borrartodo=false;
        $comando=$this->comandos1[DaoControl::$COLGARID];
        $comando=$this->procesarComando($comando, $idLlamada);
        $this->enviarComando($comando);

    }

    public function contactos() {
        echo "contactos funtzioaren barruan listacargada= ".$this->listaCargada."\n";
        print_r($this->listaDeContactos);
        echo "\n";
        if($this->listaCargada==0) {
            $comando=$this->comandos1[DaoControl::$CONTACTOS];
            echo "\nINICIO LISTA CONTACTOS\n";
            print_r($comando);
            echo "\nFIN LISTA CONTACTOS\n";
            $lista=$this->enviarComando($comando);
            $this->listaDeContactos->anadirContactos($lista);
            print_r($this->listaDeContactos);
            $this->listaCargada=1;
        }
    }
//    public function enviarComando($comando) {
//
//        echo "videoconferentzia comandoa ".$comando."\r\n";
//        $lista=$this->telnetConnection->DoCommand($comando, $r);
//        return $lista;
//    }

    public function idLlamada() {

        $comando=$this->comandos1[DaoControl::$INFOLLAMADA];
        $llamadasEnActivas=$this->enviarComando($comando);
        if(strpos($llamadasEnActivas, "callinfo end")!=0) {
            $this->listaDeLlamadasEnCurso->addLlamadas($llamadasEnActivas);
            $hayLlamadas=1;
        }
        if ($hayLlamadas==0)
            $this->listaDeLlamadasEnCurso=new ListaDeLlamadasEnCurso();

    }

    public function llamadas($llamada,$tipoLlamada) {

        $this->listaDeLlamadas=$this->getListaLlamadas();
        $this->listaDeLlamadas->addLLamada($llamada,$tipoLlamada,1);
        $this->llamadasCargada=true;

    }

    public function llamarVideoconferencia() {

        $comando=$this->comandos1[DaoControl::$LLAMAR];
        $this->enviarComando($comando);

    }

    public function llamarVideoconferenciaIP($numeroIP) {
 
        $comando=$this->comandos1[DaoControl::$LLAMARIP];
        $comando=$this->procesarComando($comando, $numeroIP);
        $this->enviarComando($comando);

    }

    public function llamarVideoconferenciaNombre($nombre) {
        
        $comando=$this->comandos1[DaoControl::$LLAMARCONTACTO];
        $nombre=ucfirst(strtolower($nombre));
        $comando=$this->procesarComando($comando, $nombre);
        $this->enviarComando($comando);

    }

    public function videoconferenciaIP() {
        $comando=$this->comandos1[DaoControl::$IPVIDEOCONF];
        $this->enviarComando($comando);

    }

    public function videoconferenciaRDSI() {
        $comando=$this->comandos1[DaoControl::$RDSIVIDEOCONF];
        $this->enviarComando($comando);

    }

    public function homeVideoconferencia() {
        $comando=$this->comandos1[DaoControl::$HOME];
        $this->enviarComando($comando);

    }

    public function graficosVideoconferencia() {
        $comando=$this->comandos1[DaoControl::$GRAFICOS];
        $this->enviarComando($comando);

    }

    public function marcarNumero($numero) {
        $comando=$this->comandos1[DaoControl::$MARCARBORRAR];
        $comando=$this->procesarComando($comando, $numero);
        $this->enviarComando($comando);
    } // end of member function marcarNumero


    public function borrarUltimo( ) {
        $comando=$this->comandos1[DaoControl::$BORRARULTIMO];
        $this->enviarComando($comando);
    } // end of member function borrarUltimo

    public function borrarTodo( ) {
    //kodea
        $this->borrartodo=true;
        $comando="";
        $comando=$this->procesarComando($comando, "");
        $this->enviarComando($comando);

    } // end of member function borrarTodo

    public function noMolestar( ) {
        $this->enviarComando($this->comandos1[DaoControl::$NOMOLESTAR]);

    } // end of member function noMolestar

    public function noMolestarOff( ) {
        $this->enviarComando($this->comandos1[DaoControl::$NOMOLESTAROFF]);
    } // end of member function noMolestarOff

    public function procesarContactos($contactos) {
        if ( (!$this->listaCargada)) {
            $this->listaDeContactos->anadirContactos($contactos);
        }

    }

    public function procesarComando($comando,$parametro) {

        if ($this->borrartodo) {
            $comando="button delete";
            $i=0;
            while($i<19) {
                $comando=$comando."\r\nbutton delete";
                $i++;
            }
        }
        else {
            $comando=str_replace("\$param$", $parametro, $comando);
        }
        $this->borrartodo=false;
        return $comando;
    }
}
?>
