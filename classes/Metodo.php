<?php
	class Metodo {
		public $_bd;
		public $_sys_log;
		public $_tabela = 'metodo';
		public $_tabela_coleta_metodo = 'coleta_metodo';
		public $_tabela_recursos_metodo = 'metodo_recursos';
		public $_tabela_publicacoes = 'publicacoes_metodo';
		
		
		/* Atributos Metodo */
		public $id;
		public $nome;
		public $coleta; //obj
		public $analise;
		public $momento;
		public $recurso; //obj
		public $geral_especifico;
		public $origem;
		public $artigo_original; //obj
		public $descricao;
		
		
		/* Construtor da classe */
		public function __construct($bd, $sys_log){
			$this->_bd = $bd;
			$this->_sys_log = $sys_log;
		}
		
		public function criar_publicacao(){
			$tabela = $this->_tabela_publicacoes;
			$colunas = 'Nome, Tipo, Autores, Resumo, Link_Publicacao, Evento_Publicacao, Data_Publicacao';
			$valores = "'". addslashes($this->nome) ."', '$this->tipo','". addslashes($this->autores)."', '".addslashes($this->resumo)."', '".addslashes($this->link_publicacao)."', '".addslashes($this->evento_publicacao).
			"', '$this->data_publicacao'";
			
			if($this->_bd->Insert($tabela, $colunas, $valores)){
				$this->id = mysql_insert_id();
				$this->_sys_log->DefineLog("Método publicação criado com sucesso");
				$this->_sys_log->SetClasse('sucesso');
				$this->selecionar();
				return TRUE;
			}else{
				$this->_sys_log->DefineLog("Ops, ocorreu um erro ao criar este método. Tente novamente");
				$this->_sys_log->SetClasse('erro');
				return FALSE;
			}
		}

		public function criar(){
			$tabela = $this->_tabela;
			$colunas = 'Nome, Analise, Momento, Geral_Especifico, Origem, Descricao';
			$valores = "'".addslashes($this->nome)."', '$this->analise', '$this->momento', '$this->geral_especifico', '$this->origem', '".addslashes($this->descricao)."'";
			
			if($this->_bd->Insert($tabela, $colunas, $valores)){
				$this->id = mysql_insert_id();
				$this->_sys_log->DefineLog("Método criado com sucesso");
				$this->_sys_log->SetClasse('sucesso');
				$this->selecionar();
				return TRUE;
			}else{
				$this->_sys_log->DefineLog("Ops, ocorreu um erro ao criar este método. Tente novamente");
				$this->_sys_log->SetClasse('erro');
				return FALSE;
			}
		}
		
		public function selecionar(){
			$tabela = $this->_tabela;
			$colunas = '*';
			$condicao = "ID_Metodo = '$this->id'";
			$resultado = $this->_bd->Select($colunas, $tabela, $condicao);
			if(count($resultado) > 0){
				$this->nome = $resultado[0]['Nome'];
				$this->analise = $resultado[0]['Analise'];
				$this->momento = $resultado[0]['Momento'];
				$this->geral_especifico = $resultado[0]['Geral'];
				$this->origem = $resultado[0]['Origem'];
				$this->descricao = $resultado[0]['Descricao'];
				$this->artigo_original = $resultado[0]['ID_Publicacao_Original'];
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		public function atualizar(){
			$tabela = $this->_tabela;
			$condicao = "ID_Metodo = '$this->id'";
			$colunas = "Nome = '".addslashes($this->nome)."', Coleta = '$this->coleta', Analise = '$this->analise', Momento = '$this->momento',
						Geral_Especifico = '$this->geral_especifico', Origem = '$this->origem', ID_Publicacao_Original = '$this->artigo_original'";
			if($this->_bd->Update($tabela, $colunas, $condicao)){
				$this->_sys_log->DefineLog("Método atualizado com sucesso");
				$this->_sys_log->SetClasse('sucesso');
				return TRUE;
			}else{
				$this->_sys_log->DefineLog("Ops, ocorreu um erro ao atualizar este método. Tente novamente");
				$this->_sys_log->SetClasse('erro');
				return FALSE;
			}
		}
		
		public function atualizar_publicacao_original($id_publicacao){
			$tabela = $this->_tabela;
			$condicao = "ID_Metodo = '$this->id'";
			$colunas = "ID_Publicacao_Original = '$id_publicacao'";
			if($this->_bd->Update($tabela, $colunas, $condicao)){
				$this->_sys_log->DefineLog("Método atualizado com sucesso");
				$this->_sys_log->SetClasse('sucesso');
				return TRUE;
			}else{
				$this->_sys_log->DefineLog("Ops, ocorreu um erro ao atualizar este método. Tente novamente");
				$this->_sys_log->SetClasse('erro');
				return FALSE;
			}
		}
		
		public function deletar(){
			$tabela = $this->_tabela;
			$condicao = "ID_Metodo = '$this->id'";
				
			if($this->_bd->delete($tabela, $condicao)){
				$this->_sys_log->DefineLog("Método excluído com sucesso");
				$this->_sys_log->SetClasse('sucesso');
				return 	TRUE;
			}else{
				$this->_sys_log->DefineLog("Ops, ocorreu um erro ao excluir este método. Tente novamente");
				$this->_sys_log->SetClasse('erro');
				return FALSE;
			}
		}

	//Funções para a criação de cada categoria de um método
	public function definir_coleta($array_coleta){
			if(count($array_coleta) >= 1){
				$tabela = $this->_tabela_coleta_metodo;	
				$colunas = 'ID_Metodo, Tipo_Coleta';	
				
				foreach ($array_coleta as $tipo_coleta) {
					$valores = "'$this->id', '$tipo_coleta'";
					if($this->_bd->Insert($tabela, $colunas, $valores)){
						$this->_sys_log->DefineLog("Método criado com sucesso");
						$this->_sys_log->SetClasse('sucesso');
					}else{
						$this->_sys_log->DefineLog("Ops, ocorreu um erro ao criar este método. Tente novamente");
						$this->_sys_log->SetClasse('erro');
					}
				}
			}else{
				return FALSE;
			}
			
		}
	
		//Funções para a criação de cada categoria de um método
	public function definir_recursos($array_recursos){
			
			if(count($array_recursos) >= 1){
				$tabela = $this->_tabela_recursos_metodo;	
				$colunas = 'ID_Metodo, Tipo_Recurso';	
				
				foreach ($array_recursos as $tipo_recurso) {
					$valores = "'$this->id', '$tipo_recurso'";
					if($this->_bd->Insert($tabela, $colunas, $valores)){
						$this->_sys_log->DefineLog("Método criado com sucesso");
						$this->_sys_log->SetClasse('sucesso');
					}else{
						$this->_sys_log->DefineLog("Ops, ocorreu um erro ao criar este método. Tente novamente");
						$this->_sys_log->SetClasse('erro');
					}
				}
			}else{
				return FALSE;
			}
			
		}
	
	
	public function criar_metodo($array_coleta, $array_recursos){
			$tabela = $this->_tabela;
			$colunas = 'Nome, Analise, Momento, Descricao';
			$valores = "'$this->nome', '$this->analise', '$this->momento', '".addslashes($this->descricao)."'";
			
			if($this->_bd->Insert($tabela, $colunas, $valores)){
				$this->id = mysql_insert_id();
				$this->definir_coleta($array_coleta);
				$this->definir_recursos($array_recursos);

				$this->_sys_log->DefineLog("Método criado com sucesso");
				$this->_sys_log->SetClasse('sucesso');
				$this->selecionar();
				return TRUE;
			}else{
				$this->_sys_log->DefineLog("Ops, ocorreu um erro ao criar este método. Tente novamente");
				$this->_sys_log->SetClasse('erro');
				return FALSE;
			}
		}
	
	
	
	
	
	}
?>
