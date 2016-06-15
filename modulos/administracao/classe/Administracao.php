<?php
	class Administracao {
		
		/* Atributos */
		protected $_bd;
		public $_sys_log;
	
	/* Construtor da classe */
	public function __construct(Bd $bd, SysLog $sys_log){
		$this->_bd = $bd;
		$this->_sys_log = $sys_log;
	}	
	
	function listar_usuarios_pendentes(){
			$tabela = 'usuarios';
			$colunas = '*';			
			$condicao = "Ativo = '0'";
			$dados = $this->_bd->Select($colunas, $tabela, $condicao);
			if($dados != NULL){
				return $dados;
			}
			else{
				$this->_sys_log->DefineLog("Erro ao selecionar usuarios");
				$this->_sys_log->SetClasse("erro");
				return FALSE;
			}
	}
	
	function listar_comentarios_pendentes(){
			$tabela = 'comentarios';
			$colunas = '*';			
			$condicao = "Ativo = '0'";
			$dados = $this->_bd->Select($colunas, $tabela, $condicao);
			if($dados != NULL){
				return $dados;
			}
			else{
				$this->_sys_log->DefineLog("Nenhum Comentário para mostrar");
				$this->_sys_log->SetClasse("erro");
				return FALSE;
			}
	}
	
	function permitir_comentario($id_coment){
			$tabela = 'comentarios';
			$colunas = "Ativo = '1'";			
			$condicao = "ID = '$id_coment'";
			
			if ($this->_bd->Update($tabela, $colunas, $condicao)){
				$this->_sys_log->DefineLog("Comentário moderado com sucesso!");
				$this->_sys_log->SetClasse("sucesso");
				return TRUE;
			}
			else{
				$this->_sys_log->DefineLog("Ocorreu um erro ao moderar o conmentário");
				$this->_sys_log->SetClasse("erro");
				return FALSE;
			}
	}
	
	}
	?>