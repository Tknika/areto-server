<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ComandoFlash
 *
 * @author amaia
 */
class ComandoFlash {
    private $entorno = "";

	private $accion = "";

	private $atributo = "";

	private $comando = "";
        public function __construct($entorno, $accion=null, $atributo=null) {
           
            //lehenengo kasuan entorno berez bezeroak bidalitako komandoa izango da
            if(func_num_args()==1){
             $comandoHasiera=0;
                if (strcmp($comandoHasiera, "<sinta")!=0) {
			/*
			 * Ez da baliozko XML komandoa, gestore zaharrak kudea dezala.
			 */
			$this->legacy_parser($entorno);
		} else {
			/*
			 * "XML" komando bat da atera "sarr" atributuak duena eta kudeatu lehengo erara
			 * TODO: Hau fundamentuzko parser batekin egin beharko litzateke.
			 */

//			$start;
//                        $end;
//
//			$start = stripos($entorno, "\"")+1;
//                        $end=strpos($entorno, "\"",$start);
//
//                        $oldcmd=substr($entorno, $start,$end-$start);

			$this->legacy_parser($oldcmd);
		}

            }
            else{

		$this->entorno = strtoupper($entorno);
		$this->accion = strtoupper($accion);
		$this->atributo = strtoupper($atributo);
		$this->comando = $this->entorno;
              
                if (strcmp($this->accion, "")!=0) {
			$this->comando = $this->comando.":".$this->accion;
			if (strcmp($this->atributo, "")!=0) {
				$this->comando = $this->comando.":".$this->atributo;
			}
		}
              
                }
               
	}

         /* Esta era la forma antigüa de parsear los comandos una vez que el demonio PHP los había 
	 * desencapsulado del formato "XML" que genera el flash.
	 */
	private function legacy_parser($comando){
		
		$this->comando=strtoupper($comando);
                
		$pos=strpos($comando, ":");
               
             		if($pos > -1) {
                    
			$this->entorno = substr($this->comando,0,$pos);
                
			$pos = $pos + 1;

                       
			$pos1 =strpos($comando, ":",$pos);
                    
			if ($pos1 > -1) {
                            
                           
				$this->accion = substr($this->comando,$pos, $pos1-$pos);
                                
				$pos = $pos1 + 1;
                                
				
				$this->atributo = substr($this->comando,$pos);
                               
                    } else {

				$this->accion = substr($this->comando,$pos);
                             
                               
			}
		} else {
			
			$this->entorno = "DESCONOCIDO";
			$this->accion = "DESCONOCIDO";
			$this->atributo = "DESCONOCIDO";
                        
		}
        }

        

	public function getEntorno() {
		return $this->entorno;
	}

	public function getAccion() {
		return $this->accion;
	}

	public function getAtributo() {
		return $this->atributo;
	}

	public function getComando() {
		return $this->comando;
	}


	
	

	
	
}
?>
