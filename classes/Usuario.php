<?php
	class Usuario {
		
		/* Atributos */
		protected $_bd;
		public $_sys_log;
		
		//Tabela do usuário
		public $_tabela = "usuarios";
		public $_tabela_conta = "usuarios_conta";
		
		//infos do usuário
		public $id = NULL;
		public $nome = NULL;
		public $email = NULL;
		public $senha = NULL;
		public $funcao = NULL;
		public $filiacao = NULL;
		public $tipo = NULL;
		public $data_cadastro = NULL;


		/* Construtor da classe */
		public function __construct(Bd $bd, SysLog $sys_log){
			$this->_bd = $bd;
			$this->_sys_log = $sys_log;
		}
		
		/* Salva o objeto na sessão */
		public function save() {
			if (!isset($_SESSION)){
				session_start();
			}
			$_SESSION['sys_user'] = serialize($this);
		}
		
		
		/* Cadastra um novo usuário no banco de dados */
		public function cadastrar(){
			//Verifica se o email já está cadastrado no banco de dados
			$tabela = $this->_tabela;
			$colunas = '*';
			$condicao = "Email='".addslashes($this->email)."'";
			$dados = $this->_bd->Select($colunas, $tabela, $condicao);
			//Insere os dados do usuário no banco de dados caso o email não esteja cadastrado
			if($dados == NULL){
				//Determina a data e a hora do cadastro
				$this->data_cadastro = new DateTime();
				//Tenta cadastrar o usuário na tabela lo_usuario
				$tabela = $this->_tabela;
				$colunas = 'Nome, Email, Senha, Funcao, Filiacao, Tipo, Data_Cadastro, Ativo';
				$valores = "'".addslashes($this->nome)."','".addslashes($this->email)."', '".addslashes($this->senha)."', '".addslashes($this->funcao)."', '".addslashes($this->filiacao)."', '$this->tipo', '".$this->data_cadastro->format('Y-m-d H:i:s')."', '0'";
				
				$cadastro_usuario = $this->_bd->Insert($tabela, $colunas, $valores);
				if($cadastro_usuario){
					$this->selecionar(mysql_insert_id()); //seleciona para o objeto as infos do usuário recém-criado
					$this->_sys_log->DefineLog("Seu cadastro foi completamente realizado! Você receberá um email de confirmação para iniciar o uso do sistema");
					$this->_sys_log->SetClasse('sucesso');
					return TRUE;
				}
				else {
					$this->_sys_log->DefineLog("Erro ao realizar cadastro. Por favor, tente novamente.");
					$this->_sys_log->SetClasse('erro');
					return FALSE;
				}
			}
			else {
				$this->_sys_log->DefineLog("Este email já está cadastrado!");
				$this->_sys_log->SetClasse('erro');
				return FALSE;
			}
		}
		
		
		/* Executa o login do usuário */
		public function login($email, $senha){
			//Busca os dados do usuário no banco de dados
			$tabela = $this->_tabela;
			$colunas = '*';			
			$condicao = "Email='".addslashes($email)."' AND Senha='".addslashes($senha)."' AND Ativo = '1'";
			$dados = $this->_bd->Select($colunas, $tabela, $condicao);
			
			
			if($dados != NULL){
				var_dump($dados);
					//Determina os dados do usuário
					$this->id = $dados[0]['ID'];
					$this->nome =  $dados[0]['Nome'];
					$this->email =  $dados[0]['Email'];
					$this->senha =  $dados[0]['Senha'];
					$this->tipo = $dados[0]['Tipo'];
					
					if(!isset($_SESSION)){
						session_start();
					}
					$_SESSION['nome-u'] = $this->nome;
					$_SESSION['email-u'] = $this->email;
					$_SESSION['tipo-u'] = $this->tipo;
					
					return TRUE;
			}
			else{
				$this->_sys_log->DefineLog("Email e senha não conferem! Por favor, tente novamente.");
				$this->_sys_log->SetClasse("erro");
				return FALSE;
			}
		}
		
		/* Confirma o cadastro do usuário */
		public function confirmar_cadastro($cod_ativacao) {
			//Ativa o usuário no banco de dados caso o código de ativação esteja correto
			if ($this->verificar_token($cod_ativacao)) {
				$tabela = $this->_tabela;
				$colunas = "Ativo='1'";
				$condicao = "ID_Usuario='$this->id'";
				$sucesso = $this->_bd->Update($tabela, $colunas, $condicao);
				if($sucesso){
					$this->ativo = 1;
				}
				
				return $sucesso;
			}
			else {
				$this->_sys_log->DefineLog("Desculpe, mas este código de ativação não é válido!");
				$this->_sys_log->SetClasse('erro');
				return FALSE;
			}
		}

		
		/* Executa o login do usuário */
		public function login_old($email, $senha){
			//Busca os dados do usuário no banco de dados
			$tabela = $this->_tabela;
			$colunas = '*';			
			$condicao = "Email='".addslashes($email)."' AND Senha='".addslashes($senha)."'";
			$dados = $this->_bd->Select($colunas, $tabela, $condicao);
			if($dados != NULL){
					//Determina os dados do usuário
					$this->id = $dados[0]['ID_Usuario'];
					$this->nome =  $dados[0]['Nome'];
					$this->email =  $dados[0]['Email'];
					$this->senha =  $dados[0]['Senha'];
					$this->tipo = $dados[0]['Tipo'];
					return TRUE;
			}
			else{
				$this->_sys_log->DefineLog("Email e senha não conferem! Por favor, tente novamente.");
				$this->_sys_log->SetClasse("erro");
				return FALSE;
			}
		}
		
		/* Executa o logout do usuário */
		public function logout(){
			if(!isset($_SESSION)){
				session_start();
			}
			session_destroy();
		}
		
		/* Lista todos os usuários */
		public function listar(){
			$tabela = $this->_tabela;
			$colunas = '*';
			$condicao = "1";
			$dados = $this->_bd->Select($colunas, $tabela, $condicao);
			if($dados != NULL){
				return $dados;
			}
			else {
				return FALSE;
			}
		}
		
		/* Lista todos os usuários ativos */
		public function listar_ativos(){
			$tabela = $this->_tabela;
			$colunas = '*';
			$condicao = "Ativo='1' AND Deletado='0'";
			$dados = $this->_bd->Select($colunas, $tabela, $condicao);
			if($dados != NULL){
				return $dados;
			}
			else {
				return FALSE;
			}
		}
		
		/* Lista todos os usuários deletados */
		public function listar_deletados(){
			$tabela = $this->_tabela;
			$colunas = '*';
			$condicao = "Ativo='0' AND Deletado='1'";
			$dados = $this->_bd->Select($colunas, $tabela, $condicao);
			if($dados != NULL){
				return $dados;
			}
			else {
				return FALSE;
			}
		}

		
		/* Seleciona um usuário no banco de dados */
		public function selecionar_por_email($email_usuario) {
			$tabela = $this->_tabela;
			$colunas = '*';
			$condicao = "Email='" .addslashes($email_usuario). "'";
			$dados = $this->_bd->Select($colunas, $tabela, $condicao);
			if ($dados != NULL){
				//Determina os dados do usuário	
				$this->carregar_dados($dados[0]);
				return TRUE;
			}
			else{
				return FALSE;
			}
		}


		// Carrega os dados a partir de uma linha do banco de dados
		public function carregar_dados($row) {
			$this->id = $row['ID_Usuario'];
			$this->nome =  $row['Nome'];
			$this->sobrenome =  $row['Sobrenome'];
			$this->foto =  $row['Foto'];
			$this->cro = $row['CRO'];
			$this->cpf = $row['CPF'];
			$this->email =  $row['Email'];
			$this->senha =  $row['Senha'];
			$this->primeiro_acesso =  $row['Primeiro_Acesso'];
			$this->ativo = $row['Ativo'];
			$this->deletado =  $row['Deletado'];
			$this->data_cadastro =  $row['Data_Cadastro'];
			$this->hora_cadastro =  $row['Hora_Cadastro'];
		}
		
		/* Edita um usuário no banco de dados */
		public function atualizar(){
			$tabela = $this->_tabela;
			$colunas = "Nome='" .addslashes($this->nome). "', Sobrenome='" .addslashes($this->sobrenome). "', Foto='$this->foto', Email='" .addslashes($this->email). "', Senha='$this->senha', ";
			$colunas .= "CRO='" .addslashes($this->cro). "', CPF='$this->cpf',";
			$colunas .= "Primeiro_Acesso='$this->primeiro_acesso', Ativo='$this->ativo', Deletado='$this->deletado', ";
			$colunas .= "Data_Cadastro='$this->data_cadastro', Hora_Cadastro='$this->hora_cadastro'"; 
			$condicao = "ID_Usuario='$this->id'";
			
			if($this->_bd->Update($tabela, $colunas, $condicao)){
				$this->_sys_log->DefineLog("Usuário atualizado com sucesso!");
				$this->_sys_log->SetClasse('sucesso');
				return TRUE;
			}else{
				$this->_sys_log->DefineLog("Ops... ocorreu um erro ao atualizar seus dados.");
				$this->_sys_log->SetClasse('erro');
				return FALSE;
			}
			
		}
		
		/* Altera a senha do usuário a partir da recuperação de senha */
		public function alterar_senha_recuperacao($cod_verificacao, $novasenha) {
			//Altera a senha do usuário no banco de dados caso o código de verificação esteja correto
			if ($this->verificar_token($cod_verificacao)) {
				$tabela = $this->_tabela;
				$colunas = "Senha='$novasenha'";
				$condicao = "ID_Usuario='$this->id'";
				if($this->_bd->Update($tabela, $colunas, $condicao)){
					$this->senha = $novasenha;
					$this->_sys_log->DefineLog("Pronto! A senha foi alterada com sucesso.");
					$this->_sys_log->SetClasse('sucesso');
					return TRUE;
				}
				else{
					$this->_sys_log->DefineLog("Poxa, tivemos algum problema.");
					$this->_sys_log->SetClasse("erro");
					return FALSE;
				}
			}
			else {
				$this->_sys_log->DefineLog("Desculpe, mas este código não é válido!");
				$this->_sys_log->SetClasse("erro");
				return FALSE;
			}
		}
		
		/* Retorna o endereço url da foto do usuário ou nulo se ela não existe */
		public function obter_url_logo(){
			return ($this->logo != NULL) ? CONSULTORIOS_DIR."$this->id/$this->logo" : NULL;
        }
		
	}
?>