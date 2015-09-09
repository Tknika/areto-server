//<?php
//require_once './dispositivos/DispositivoIP.php';
//
//
//
///**
// * class PantallaElectrica
// *
// */
//class PantallaElectrica extends DispositivoIP {
//
//
//
///**
// *
// * @static
// * @access private
// */
//    private static $ARRIBA = "PANTALLA ELECTRICA ARRIBA";
//
//    /**
//     *
//     * @static
//     * @access private
//     */
//    private static $ABAJO = "PANTALLA ELECTRICA ABAJO";
//
//    /**
//     *
//     * @access private
//     */
//    private $abajo;
//
//    /**
//     *
//     * @access private
//     */
//
//    function  __construct($dispositivo) {
//        $this->abajo=false;
//        $this->estado="";
//        $this->tipoDispositivo="PantallaElectrica";
//        parent::__construct($dispositivo);
//        //echo($this->propiedades);
//        echo($this->ip."-".$this->modeloIPLT."-".$this->strMarca."-".$this->strModelo."-".$this->id_disp."-".$this->tipoPuerto."-".$this->numeroPuerto."-".$this->baudRate."-".$this->timeOut."-".$this->puerto."-".$this->password);
//
//
//    }
//
//
//    /**
//     *
//     *
//     * @return
//     * @access public
//     */
//    public function bajarPantallaYActivar( ) {
//      /* if (this.bajada == false) {
//      this.enviarComando(ds.obtenerCadenaComando("bajarpanactivar"));
//      this.bajada = true;
//      this.setEstado(this.ABAJO);
//    }*/
//        if($this->abajo==false) {
//            $comando=$this->comandos1[DaoControl::$BAJARPANACTIVAR];
//            $this->enviarComando($comando);
//            $this->abajo=true;
//            $this->setEstado(self::$ABAJO);
//        }
//
//    } // end of member function bajarPantallaYActivar
//
//    /**
//     *
//     *
//     * @return
//     * @access public
//     */
//    public function subirPantallaYActivar( ) {
//        if($this->abajo==true) {
//            $comando=$this->comandos1[DaoControl::$SUBIRPANACTIVAR];
//            $this->enviarComando($comando);
//            $this->abajo=false;
//            $this->setEstado(self::$ARRIBA);
//        }
//    } // end of member function subirPantallaYActivar
//
//    /**
//     *
//     *
//     * @return
//     * @access public
//     */
//    public function bajarPantallaYDesactivar( ) {
//        $comando=$this->comandos1[DaoControl::$BAJARPANDESACTIVAR];
//        $this->enviarComando($comando);
//    } // end of member function bajarPantallaYDesactivar
//
//    /**
//     *
//     *
//     * @return
//     * @access public
//     */
//    public function subirPantallaYDesactivar( ) {
//        $comando=$this->comandos1[DaoControl::$SUBIRPANDESACTIVAR];
//        $this->enviarComando($comando);
//    } // end of member function subirPantallaYDesactivar
//
//
//
//
//
//    public function procesarComando($comando,$parametro) {
//    }
//} // end of PantallaElectrica
//?>
