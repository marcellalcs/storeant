<?php

class Comment{
	
	public $_bd;
	public $_sys_log;
	public $_tabela = 'comentarios';
	private $data = array();
	
	public function __construct($row, $bd, $sys_log){
		$this->data = $row;
		$this->_bd = $bd;
		$this->_sys_log = $sys_log;
	}
	
	public function create_comment($name, $email, $msg, $id_method){
		$tabela = $this->_tabela;
		$colunas = 'Nome, Email, Mensagem, ID_Metodo, Ativo';
		$valores = "'$name', '$email', '$msg', '$id_method', '0'";
				
		if($this->_bd->Insert($tabela, $colunas, $valores))
			return TRUE;
		else
			return FALSE;
	}
	
	public function list_comments($id_meth){
		$tabela = $this->_tabela;
		$colunas = '*';
		$condicao = "ID_Metodo = $id_meth AND Ativo = '1'";
		$resultado = $this->_bd->Select($colunas, $tabela, $condicao);
			if(count($resultado) > 0){
				$comments[] = new Comment($resultado, $this->_bd, $this->_sys_log);
				return $comentarios;
			}else{
				return FALSE;
			}
	}
	
	//This method outputs the XHTML markup of the comment
	public function markup(){
		// Setting up an alias, so we don't have to write $this->data every time:
		$d = &$this->data;
		$link_open = '';
		$link_close = '';
		
		
		
		// Converting the time to a UNIX timestamp:
		$d['Data_Comentario'] = strtotime($d['Data_Comentario']);
		// Needed for the default gravatar image:
		$url = 'http://'.dirname($_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]).'/img/default_avatar.gif';
		
		return '
			<div class="comment">
				<div class="avatar">
					'.$link_open.'
					<img src="'.IMAGENS_DIR.'avatar.png" />'.$link_close.'
				</div>
				<div class="name">'.$link_open.$d['Nome'].$link_close.'</div>
				<div class="date" title="Added at '.date('H:i \o\n d M Y',$d['Data_Comentario']).'">'.date('d M Y',$d['Data_Comentario']).'</div>
				<p>'.$d['Mensagem'].'</p>
			</div>
		';

		
		 
	}
	
	/*
		/	This method is used to validate the data sent via AJAX.
		/
		/	It return true/false depending on whether the data is valid, and populates
		/	the $arr array passed as a paremter (notice the ampersand above) with
		/	either the valid input data, or the error messages.
	*/
		
	public static function validate(&$arr){
		$errors = array();
		$data	= array();
		
		// Using the filter_input function introduced in PHP 5.2.0
		
		if(!($data['Email'] = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL))){
			$errors['Email'] = 'Please enter a valid Email.';
		}
		
		if(!($data['url'] = filter_input(INPUT_POST,'url',FILTER_VALIDATE_URL))){
			// If the URL field was not populated with a valid URL,
			// act as if no URL was entered at all:
			
			$url = '';
		}
		
		// Using the filter with a custom callback function:
		
		if(!($data['Mensagem'] = filter_input(INPUT_POST,'body',FILTER_CALLBACK,array('options'=>'Comment::validate_text')))){
			$errors['Mensagem'] = 'Please enter a comment body.';
		}
		
		if(!($data['Nome'] = filter_input(INPUT_POST,'name',FILTER_CALLBACK,array('options'=>'Comment::validate_text')))){
			$errors['Nome'] = 'Please enter a name.';
		}
		if(!($data['ID_Metodo'] = filter_input(INPUT_POST,'id-meth',FILTER_DEFAULT))){
			$errors['ID_Metodo'] = 'Please enter a id method.';
		}
		
		if(!empty($errors)){
			
			// If there are errors, copy the $errors array to $arr:
			
			$arr = $errors;
			return false;
		}
		
		// If the data is valid, sanitize all the data and copy it to $arr:
		
		foreach($data as $k=>$v){
			//$arr[$k] = mysql_real_escape_string($v);
			$arr[$k] = $v;
		}
		
		// Ensure that the email is lower case:
		
		$arr['Email'] = strtolower(trim($arr['Email']));
		
		return true;
		
	}

	private static function validate_text($str){
		/*
		/	This method is used internally as a FILTER_CALLBACK
		*/
		
		if(mb_strlen($str,'utf8')<1)
			return false;
		
		// Encode all html special characters (<, >, ", & .. etc) and convert
		// the new line characters to <br> tags:
		
		$str = nl2br(htmlspecialchars($str));
		
		// Remove the new line characters that are left
		$str = str_replace(array(chr(10),chr(13)),'',$str);
		
		return $str;
	}

}

?>