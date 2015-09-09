<?




class system_class{
	function system_class(){
		
	}
	static function execute($cmd){
		$result=array();
		$value='';
		exec($cmd,$result,$value);
		return $result;
	}

	static function interactive_execute($cmd, $subcmds=array()){
		if(!is_array($subcmds)) $subcmd=array($subcmds);
		$espec_descriptor = array(
			0 => array("pipe", "r"),  // stdin es un pipe usado por el hijo para lectura
			1 => array("pipe", "w"),  // stdout es un pipe usado por el hijo para escritura
			2 => array("pipe", "w") // stderr es un archivo para escritura
		);
		$pipes=array();
		$proceso = proc_open($cmd, $espec_descriptor, $pipes);
		
		if (is_resource($proceso)) {
			// $pipes ahora luce de esta forma:
			// 0 => gestor de escritura conectado con la entrada estandar del hijo
			// 1 => gestor de lectura conectado con la salida estandar del hijo
			// 2 => Cualquier mensaje de salida de error
			foreach($subcmds as $subcmd){
				fwrite($pipes[0], $subcmd);
			}
			fclose($pipes[0]);
			
			if ($pipes[1]) {
				while (!feof($pipes[1])) {
					$bufer = fgets($pipes[1], 4096);
				}
				fclose ($pipes[1]);
			}
			if ($pipes[2]) {
				while (!feof($pipes[2])) {
					$bufer .= fgets($pipes[2], 4096);
				}
				fclose ($pipes[2]);
			}
			$retval = proc_close($proceso);
			if(!empty($subcmd)) $rr=print_r($subcmd,1); else $rr='';
			$this->log_message ("cmd: $cmd out: $buffer ");
		}
	}
	
	static function shell_execute($cmd, $wait=true ){
		if($wait) $wait='&';else $wait='';
		$cmd= $cmd." $wait";
		shell_exec($cmd." $wait");
	}
		
	static function log_message($msg, $level = LOG_NOTICE){
		if(SYSLOG=='true'){
			openlog("paraninfo ", LOG_PID | LOG_PERROR, LOG_LOCAL0);
			syslog( LOG_NOTICE, "".date('Y-m-d h:i:s').': '.$msg);
			closelog();
		}else{
			echo "\n**".date('Y-m-d h:i:s').': '.$msg;
		}
	}
	
	static function create_file($file_name,$content, $mode='w'){
		$file_name=$this->filesystem_filename($file_name);
		
		$f = @fopen($file_name , 'w');
		
		if ($f === false) {
			$this->log_message("fitxategia ezin ireki: $file_name ");
			return 0;
		} else {
			$this->log_message("fitxategia irekia: $file_name ");
			if (is_array($content)) $content = implode($content);
			$bytes_written = fwrite($f, $content);
			fclose($f);
		}
	}
	
	static function create_dir($dir_name){
		$dir_name=$this->filesystem_filename($dir_name);
		exec('mkdir -p '. $dir_name);
	}

	function filesystem_filename($file_name){
		//$this->log_message("filename11: $file_name ");
		$bilatu=array(' ','//','"','ñ');
		$ordezkoa=array('_','/','','n');
		$file_name= str_replace($bilatu,$ordezkoa,$file_name);
		//$this->log_message("filename22: $file_name ");
		return $file_name;
	}
}
?>