<?php
	class Coleta {
		public $_bd;
		public $_sys_log;
		public $_tabela = 'coleta_metodo';

		/* Atributos Metodo */
		public $id;
		public $id_metodo;
		public $tipo_coleta; //obj
		
		/* Construtor da classe */
		public function __construct($bd, $sys_log){
			$this->_bd = $bd;
			$this->_sys_log = $sys_log;
		}
		
		public function criar_coleta($id_metodo, $tipo_coleta){
			$tabela = $this->_tabela;
			$colunas = 'ID_Metodo, Tipo_Metodo';
			$valores = "'$id_metodo', '$tipo_coleta'";
			
			if($this->_bd->Insert($tabela, $colunas, $valores)){
				$this->id = mysql_insert_id();
				$this->id_metodo = $id_metodo;
				$this->tipo_coleta = $tipo_coleta;
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
			$condicao = "ID_Coleta_Metodo = '$this->id'";
			$resultado = $this->_bd->Select($colunas, $tabela, $condicao);
			if(count($resultado) > 0){
				$this->id_metodo = $resultado[0]['ID_Metodo'];
				$this->tipo_coleta = $resultado[0]['Tipo_Coleta']; //obj
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		public function selecionar_por_metodo($id_metodo){
			$tabela = $this->_tabela;
			$colunas = 'Tipo_Coleta';
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