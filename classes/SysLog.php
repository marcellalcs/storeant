<?php
	class SysLog {
	
		/* Atributos */
		public $flag = "";
		public $mensagem = "";
		public $classe = "";
		
		/* Construtor da classe */
		public function __construct(){
			$this->flag = 0;
			$this->mensagem = "";
			$this->classe = "";
		}
		
		/* Gets */
		public function GetFlag() {
			return $this->flag;
		}
		
		public function GetMensagem() {
			return $this->mensagem;
		}
		
		public function GetClasse() {
			return $this->classe;
		}
		
		/* Sets */
		public function SetFlag($flag) {
			$this->flag = $flag;
		}
		
		public function SetMensagem($mensagem) {
			$this->mensagem = $mensagem;
		}
		
		public function SetClasse($classe) {
			switch($classe){
				case 'alerta':	$this->classe = 'alert'; break;
				case 'erro':	$this->classe = 'alert alert-error'; break;
				case 'sucesso':	$this->classe = 'alert alert-success'; break;
				case 'info':	$this->classe = 'alert alert-info'; break;
			}
		}
		
		/* Salva o objeto na sessão */
		public function Save() {
			if (!isset($_SESSION)){
				session_start();
			}
			$_SESSION['sys_log'] = serialize($this);
		}
		
		/* Define a mensagem de sistema */
		public function DefineLog($mensagem) {
			$this->SetMensagem($mensagem);
			$this->SetFlag(1);
		}
		
		/* Imprime uma mensagem de sistema */
		public function Imprime() {
			if ($this->flag == 1){
				echo $this->mensagem;
				echo "<script type='text/javascript'>insereSysLog();</script>";
				$this->SetFlag(0);
			}
		}
		
	}
?>