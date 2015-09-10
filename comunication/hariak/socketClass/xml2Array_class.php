<?php
class xml2Array {
	 function parse_cmd($strInputXML) {
	 	/* <pulse volume=[up][do][0-10] /> 
	 	 * <pulse channel=[0-3] />
	 	 *
	 	 *  */
	 	 $strInputXML=trim($strInputXML);
	 	 	 	 
	 	 if(! $this->validateXML($strInputXML)){
	 	 	//XML egitura okerra.
	 	 	return false;
	 	 }
	 	 $resultXML=array();
	 	 $strInputXML=str_replace('<','',$strInputXML);
	 	 $strInputXML=str_replace('/>','',$strInputXML);
	 	 
	 	 
	 	 
	 	 $zati=split(' ',$strInputXML);
	 	 if($zati[0]=='sinta'){
	 	 	$strInputXML=str_replace('sinta case=','',$strInputXML);
	 	 	$resultXML['where']='sinta';
			$resultXML['cmd']='case';
			$resultXML['parameters']=array();
			$resultXML['value']=trim(str_replace('"','',$strInputXML));
			 		
	 	 } 	else{ 
			for($i=0; $i<=count($zati)-1;$i++){
			 		if($i==0){
			 	 		$resultXML['where']=$zati[$i];
			 	 	}elseif($i==1){
			 	 		 $args=split('=',$zati[$i]);
			 	 		 $resultXML['cmd']=str_replace('"','',$args[0]);
			 	 		 $resultXML['value']=str_replace('"','',$args[1]);
			 	 	}elseif(strpos($zati[$i],'=')){
			 	 		 $args=split('=',$zati[$i]);
			 	 		 $resultXML['parameters'][$args[0]]=str_replace('"','',$args[1]);
			 	 	}
			}
			if(!isset($resultXML['parameters'])) $resultXML['parameters']=array();
	 	}
	 	return $resultXML;
 	 		 
	}
	function validateXML($strInputXML){
		 //<policy-file-request />
		 $zati=split(' ',$strInputXML);
		 
		if( strpos($zati[count($zati)-1],'/>') ===false ){
	 	 	//echo "\n".'ERROR XML11: '. $zati[count($zati)-1]. ' '.$strInputXML;
	 	 	return false;
	 	 }
	 	 
	 	 return true;
		
	}

		
	function parse($data){
		$data=trim($data);
		
		if(strpos($data,'/>')==strlen($data)-2){
			return $this->parse_cmd($data);
		}
		$xml_parser = xml_parser_create();
		$xml_type=xml_parse_into_struct($xml_parser, $data, $vals, $index);
		xml_parser_free($xml_parser);
		if($xml_type==0){
			return $this->parse_cmd($data);
		}
		$result=array();
		
		foreach ($vals as $xml_elem) {
			if( $xml_elem['type']=='open'){
				if($xml_elem['level']==1){

					$result['where']=strtolower($xml_elem['tag']);
					$a_keys=array_keys($xml_elem['attributes']);
					$result['cmd']=strtolower($a_keys[0]);
					$result['value']=strtolower($xml_elem['attributes'][$a_keys[0]]);
					for($i=1;$i<count($a_keys);$i++){
						//$result['parameters'][strtolower($a_keys[$i])]=strtolower($xml_elem['attributes'][$a_keys[$i]]);
						$result['parameters'][strtolower($a_keys[$i])]=$xml_elem['attributes'][$a_keys[$i]];
					}
								
				}else{

				}


			}elseif($xml_elem['type']=='complete' ){
				$tag=strtolower($xml_elem['tag']);
				$i=count($result['parameters'][$tag]);
				
				foreach($xml_elem['attributes'] as $k => $v){
					$result['parameters'][$tag][$i][strtolower($k)]=$v;
				}
				
			}elseif($xml_elem['type']=='close'){
			
			}

		}
		return $result;
		
	}
}
 
	

class Simple_Parser2 {
	var $parser;
	var $error_code;
	var $error_string;
	var $current_line;
	var $current_column;
	var $data = array();
	var $datas = array();
    
	function parse($data){
		$this->parser = xml_parser_create('UTF-8');
        xml_set_object($this->parser, $this);
        xml_parser_set_option($this->parser, XML_OPTION_SKIP_WHITE, 1);
        xml_set_element_handler($this->parser, 'tag_open', 'tag_close');
        xml_set_character_data_handler($this->parser, 'cdata');
        if (!xml_parse($this->parser, $data)){
            $this->data = array();
            $this->error_code = xml_get_error_code($this->parser);
            $this->error_string = xml_error_string($this->error_code);
            $this->current_line = xml_get_current_line_number($this->parser);
            $this->current_column = xml_get_current_column_number($this->parser);
        }else{
            $this->data = $this->data['child'];
        }
        xml_parser_free($this->parser);
    }
 
    function tag_open($parser, $tag, $attribs){
        $this->data['child'][$tag][] = array('data' => '', 'attribs' => $attribs, 'child' => array());
        $this->datas[] =& $this->data;
        $this->data =& $this->data['child'][$tag][count($this->data['child'][$tag])-1];
    }
 
    function cdata($parser, $cdata){
        $this->data['data'] .= $cdata;
    }
 
    function tag_close($parser, $tag){
        $this->data =& $this->datas[count($this->datas)-1];
        array_pop($this->datas);
    }
 }
 
 ?>
 
