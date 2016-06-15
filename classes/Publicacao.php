<?php
	class Publicacao {
		public $_bd;
		public $_sys_log;
		public $_tabela = 'publicacoes_metodo';
		
		
		/* Atributos Metodo */
		public $id;
		public $id_metodo;
		public $nome;
		public $tipo;
		public $autores;
		public $resumo; 
		public $link_publi;
		public $evento;
		public $data; 

		
		
		/* Construtor da classe */
		public function __construct($bd, $sys_log){
			$this->_bd = $bd;
			$this->_sys_log = $sys_log;
		}
		
		public function criar(){
			$tabela = $this->_tabela;
			$colunas = 'ID_Metodo, Nome, Tipo, Autores, Resumo, Link_Publicacao, Evento_Publicacao, Data_Publicacao';
			$valores = "'$this->id_metodo','". addslashes($this->nome) . "', '$this->tipo', '". addslashes($this->autores) . "', '". addslashes($this->resumo) ."', '". addslashes($this->link_publi) ."',
			'". addslashes($this->evento) ."', '$this->data'";
			
			if($this->_bd->Insert($tabela, $colunas, $valores)){
				$this->id = mysql_insert_id();
				$this->_sys_log->DefineLog("Método publicação criado com sucesso");
				$this->_sys_log->SetClasse('sucesso');
				return TRUE;
			}else{
				$this->_sys_log->DefineLog("Ops, ocorreu um erro ao criar esta publicação. Tente novamente");
				$this->_sys_log->SetClasse('erro');
				return FALSE;
			}
		}
		public function selecionar(){
			$tabela = $this->_tabela;
			$colunas = '*';
			$condicao = "ID_Publicacao = '$this->id'";
			$resultado = $this->_bd->Select($colunas, $tabela, $condicao);
			if(count($resultado) > 0){
				$this->id_metodo = $resultado[0]['ID_Metodo'];
				$this->nome = $resultado[0]['Nome'];
				$this->tipo = $resultado[0]['Tipo'];
				$this->autores = $resultado[0]['Autores'];
				$this->resumo = $resultado[0]['Resumo']; 
				$this->link_publi = $resultado[0]['ID_Metodo'];
				$this->evento = $resultado[0]['Evento_Publicacao'];
				$this->data = $resultado[0]['Data_Publicacao']; 	
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		public function selecionar_por_metodo($id_metodo){
			$tabela = $this->_tabela;
			$colunas = '*';
			$condicao = "ID_Metodo = '$id_metodo'";
			$resultado = $this->_bd->Select($colunas, $tabela, $condicao);
			if(count($resultado) > 0){
				return $resultado;
			}else{
				return FALSE;
			}
		}
		
	}
		
?>	