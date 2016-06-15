<?php
	class Recurso {
		public $_bd;
		public $_sys_log;
		public $_tabela = 'metodo_recursos';

		/* Atributos Metodo */
		public $id;
		public $id_metodo;
		public $tipo_recurso; //obj
		
		/* Construtor da classe */
		public function __construct($bd, $sys_log){
			$this->_bd = $bd;
			$this->_sys_log = $sys_log;
		}
		
		public function criar_recurso($id_metodo, $tipo_recurso){
			$tabela = $this->_tabela;
			$colunas = 'ID_Metodo, Tipo_Recurso';
			$valores = "'$id_metodo', '$tipo_recurso'";
			
			if($this->_bd->Insert($tabela, $colunas, $valores)){
				$this->id = mysql_insert_id();
				$this->id_metodo = $id_metodo;
				$this->tipo_recurso = $tipo_recurso;
				return TRUE;
			}else{
				$this->_sys_log->DefineLog("Ops, ocorreu um erro ao criar este tipo de coleta. Tente novamente");
				$this->_sys_log->SetClasse('erro');
				return FALSE;
			}
		}
		
		public function selecionar(){
			$tabela = $this->_tabela;
			$colunas = '*';
			$condicao = "ID_Metodo_Recurso = '$this->id'";
			$resultado = $this->_bd->Select($colunas, $tabela, $condicao);
			if(count($resultado) > 0){
				$this->id_metodo = $resultado[0]['ID_Metodo'];
				$this->tipo_recurso = $resultado[0]['Tipo_Recurso']; //obj
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		public function selecionar_por_metodo($id_metodo){
			$tabela = $this->_tabela;
			$colunas = 'Tipo_Recurso';
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