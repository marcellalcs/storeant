<?php
	class Bd {
	
		/* Atributos */
		protected $_host;
		protected $_user;
		protected $_password;
		protected $_bd;
		protected $_prefix;

		// Apenas para debugar
		public $ultima_query;
		
		/* Construtor da classe */
		public function __construct($host, $user, $password, $bd, $prefix){
			$this->_host = $host;
			$this->_user = $user;
			$this->_password = $password;
			$this->_bd = $bd;
			$this->_prefix = $prefix;
		}
		
		/* Gets */
		public function GetHost() {
			return $this->_host;
		}
		
		public function GetUser() {
			return $this->_user;
		}
		
		public function GetBd() {
			return $this->_bd;
		}
		
		public function GetPrefix() {
			return $this->_prefix;
		}
		
		public function GetMaxValue($tabela, $campo) {
			$tabela = $this->_prefix . $tabela;
			$query = "SELECT MAX($campo) FROM $tabela";
			$result = mysql_query($query);
			return $result;
		}
		
		/* Cria conexão com o banco de dados */
		public function Connect() {
			$con = mysql_connect($this->_host, $this->_user, $this->_password);
			mysql_select_db($this->_bd);
			mysql_set_charset('utf8', $con);
		}
		
		/*Fecha a conexão com o banco de dados */
		public function Disconnect() {
			mysql_close();
		}
		
        /**
         * Faz uma query inserção no Banco de Dados
         * @param string Tabela
         * @param string Colunas
         * @param string Valores
         * @return array TRUE|FALSE
        */
		public function Insert($tabela, $colunas, $valores) {
			$sucess = TRUE;
			$tabela = $this->_prefix . $tabela;
			$query = "INSERT INTO $tabela ($colunas) VALUES ($valores)";
			mysql_query($query) or die ($sucess = FALSE);
			return $sucess;
		}
		
		/**
         * Faz uma query select no Banco de Dados
         * @param string Colunas
         * @param string Tabela
         * @param string Condiçoes
         * @return array Dados|NULL
         */
		public function Select($colunas, $tabela, $condicao) {
			$tabela = $this->_prefix . $tabela;
			$query = "SELECT $colunas FROM $tabela WHERE $condicao";
			$this->ultima_query = $query;
			$result = mysql_query($query);
			$dados = array();
			if ($result != null) {
				if (mysql_num_rows($result) > 0){
					for ($i = 0; $i < mysql_num_rows($result); $i++){
						$dados[] = mysql_fetch_array($result);
					}
				}
			}
			return $dados;
		}
		

		public function SelectNoPrefix($colunas, $tabela, $condicao) {
			$tabela =  $tabela;
			$query = "SELECT $colunas FROM $tabela WHERE $condicao";

			$this->ultima_query = $query;
			$result = mysql_query($query);
			$dados = array();
			if ($result != null) {
				if (mysql_num_rows($result) > 0){
					for ($i = 0; $i < mysql_num_rows($result); $i++){
						$dados[] = mysql_fetch_array($result);
					}
				}
			}
			return $dados;
		}

        
        /**
         * Faz uma query de Update no Banco de Dados
         * @param string Tabela
         * @param string Colunas
         * @param string Condiçoes
         * @return array Dados|NULL
         */
		public function Update($tabela, $colunas, $condicao) {
			$sucess = TRUE;
			$tabela = $this->_prefix . $tabela;
			$query = "UPDATE $tabela SET $colunas WHERE $condicao";
			mysql_query($query) or die ($sucess = FALSE);
			return $sucess;
		}

		/* SQL DELETE */
		public function Delete($tabela, $condicao) {
			$sucess = TRUE;
			$tabela = $this->_prefix . $tabela;
			$query = "DELETE FROM $tabela WHERE $condicao";
			mysql_query($query) or die ($sucess = FALSE);
			return $sucess;
		}

		/**
		 * Faz uma query select join no banco de dados
		 *
		 * @param string $tabela Nome da tabela original
		 * @param array $join Array com as seguintes chaves: tabela, condicao, tipo
		 * @param string $condicao
         * @return array Dados|NULL
		 */
		public function Join($tabela, array $join, $colunas = '*', $condicao = '') {
			if (count($join) == 0) return NULL;

			$query = "SELECT $colunas FROM $tabela ";

			$str_join = is_array(current($join)) ? 
						implode(' ', array_map(array($this, 'montar_join'), $join)) :
						$this->montar_join($join);

			$query .= $str_join;
			
			if ($condicao != '') $query .= " WHERE $condicao";

			$result = mysql_query($query);
			$dados = array();

			if ($result != null) {
				if (mysql_num_rows($result) > 0) {
					for ($i = 0; $i < mysql_num_rows($result); $i++){
						$dados[] = mysql_fetch_array($result);
					}
				}
			}
			return $dados;
		}

		/**
		 * Adiciona o prefixo da coluna ao nome dos campos
		 *
		 * @param string $tabela
		 * @param array $colunas
		 * @return array|string
		 */
		public function adicionar_prefixo($tabela, array $colunas = array()) {
			if (count($colunas) == 0) return $this->_prefix . $tabela;
			return array_map(create_function('$col', 'return "'. $this->_prefix . $tabela .'.$col";'), $colunas);
		}

		/**
		 * Monta uma query de condição de consulta
		 *
		 * @param array $condicao Pode conter 3 ou 2 elementos
		 * @param string $tabela
		 * @param $tipo AND ou OR
		 * @return string
		 */
		public function montar_condicao(array $condicao, $tabela = '', $tipo = 'AND') {
			if (count($condicao) == 0) return '';

			if (is_array(current($condicao))) {
				foreach ($condicao as $c) $condicoes[] = $this->montar_condicao($c, $tabela, $tipo);
				return implode(" $tipo ", $condicoes);
			}

			/* Pega os valores necessários de acordo com o tamnho de elementos do array
			   Ex: 
			   		$condicao = array('Idade', '>', 20) => 'Idade > 20'
			   		$condicao = array('Nome', 'Hugo') => 'Nome = 20' */
			list($col, $sinal, $valor) = count($condicao) == 3 ? $condicao : array($condicao[0], '=', $condicao[1]);

			if ($tabela != '') {
				$col = $this->_prefix . $tabela .'.'. $col;
			}

			return "$col $sinal $valor";
		}

		/**
		 * Monta a string a partir de um array com os dados
		 *
		 * @param array $join Deve conter as seguintes chaves: tabela, condicao, tipo
		 * @return string
		 */
		private function montar_join(array $join) {
			if (!array_key_exists('tipo', $join)) $join['tipo'] = 'INNER';

			$str = $join['tipo'] ." JOIN ". $join['tabela'];
			if (strtoupper($join['tipo']) == 'NATURAL') return $str;

			return $str ." ON ". $join['condicao'];
		}
		
	}
?>