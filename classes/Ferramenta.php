<?php
	class Ferramenta {
		public $_bd;
		public $_sys_log;
		public $_tabela = 'ferramentas_metodo';

		/* Atributos Metodo */
		public $id;
		public $id_metodo;
		public $nome;
		public $descricao;
		public $id_publicacao;
		public $link_tool;
		
		/* Construtor da classe */
		public function __construct($bd, $sys_log){
			$this->_bd = $bd;
			$this->_sys_log = $sys_log;
		}
		
		public function criar(){
			$tabela = $this->_tabela;
			$colunas = 'ID_Metodo, Nome, Descricao, ID_Publicacao, Link_Ferramenta';
			$valores = "'$this->id_metodo', '$this->nome', '$this->descricao', '$this->id_publicacao', '$this->link_tool'";
			if($this->_bd->Insert($tabela, $colunas, $valores)){
				$this->id = mysql_insert_id();
				return TRUE;
			}else{
				$this->_sys_log->DefineLog("Ops, ocorreu um erro ao criar essa ferramenta. Tente novamente");
				$this->_sys_log->SetClasse('erro');
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