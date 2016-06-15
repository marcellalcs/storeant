<?php
	class Tools {
	
		/* Atributos */
		protected $_bd;
		public $_sys_log;
		
		/* Construtor da classe */
		public function __construct($bd, $sys_log){
			$this->_bd = $bd;
			$this->_sys_log = $sys_log;
		}
		
		/*Mostra as informacoes do (print_r / var_dump) de forma organizada, facilita o debug*/
		public function debug() {
		    $trace = debug_backtrace();
		    $rootPath = dirname(dirname(__FILE__));
		    $file = str_replace($rootPath, '', $trace[0]['file']);
		    $line = $trace[0]['line'];
		    $var = $trace[0]['args'][0];
		    $lineInfo = sprintf('<div><strong>%s</strong> (line <strong>%s</strong>)</div>', $file, $line);
		    $debugInfo = sprintf('<pre>%s</pre>', print_r($var, true));
		    print_r($lineInfo.$debugInfo);
		}

		/* Carrega um arquivo para o servidor */
		public function CarregarArquivo($nomeInput, $nomeArquivo, $destino, $config){
			if(!isset($_FILES["$nomeInput"]) || ($_FILES["$nomeInput"]["error"])){
				$this->_sys_log->DefineLog("Arquivo não determinado ou campo vazio!");
				$this->_sys_log->SetClasse("erro");
				
				return NULL;
			}
			$arquivo = $_FILES["$nomeInput"];
			//Verifica se o tipo do arquivo é válido
			$tipoArquivo = explode("/", $arquivo["type"]);
			if(!in_array($tipoArquivo[1], $config["extensoes"])){
				$this->_sys_log->DefineLog("Extensão do arquivo inválida!");
				$this->_sys_log->SetClasse("erro");
				
				return NULL;
			}
			
			//Verifica se o tamanho do arquivo é permitido
			if($arquivo["size"] > $config["tamanho"]){
				$tamanhoEmMegaByte = $config["tamanho"]/(1024*1024);
				$this->_sys_log->DefineLog("Tamanho do arquivo superou o limite de $tamanhoEmMegaByte MB!");
				$this->_sys_log->SetClasse("erro");
				
				return NULL;
			}
			
			//Verifica as dimensões caso seja uma imagem
			if($tipoArquivo[0] == 'image'){
				$tamanhos = getimagesize($arquivo["tmp_name"]);
				if(($tamanhos[0] > $config["largura"]) || ($tamanhos[1] > $config["altura"])){
					$largura = $config["largura"];
					$altura = $config["altura"];
					$this->_sys_log->DefineLog("Dimensões da imagem superiores a $largura x $altura pixels");
					$this->_sys_log->SetClasse("erro");
					
					return NULL;
				}
			}
			
			//Cria o destino se ele não existe dando as permissões necessárias
			if (!is_dir($destino)){
				mkdir($destino, 0755, true);
			}
			
			//Renomeia o arquivo caso desejado
			$nomeArquivo = ($nomeArquivo == NULL) ? $arquivo["name"] : $nomeArquivo.'.'.$tipoArquivo[1];
			
			//Move o arquivo para o destino desejado, finalizando o upload
			$caminho = $destino.$nomeArquivo;
			move_uploaded_file($arquivo["tmp_name"], $caminho);
			
			return $nomeArquivo;
		}
		
		/* Retorna os dados de uma unidade federativa */
		public function get_uf($id_uf) {
			$tabela = 'uf';
			$colunas = '*';
			$condicao = "ID_UF='$id_uf'";
			$dados = $this->_bd->Select($colunas, $tabela, $condicao);
			if ($dados != NULL){
				return $dados;
			}
		}
		
		/* Retorna os nome da cidade do usuário */
		public function get_cidade($id_cidade) {
			$tabela = 'cidades';
			$colunas = '*';
			$condicao = "ID_Cidade='$id_cidade'";
			$dados = $this->_bd->Select($colunas, $tabela, $condicao);
			if ($dados != NULL){
				return $dados;
			}
		}
		
		/* Retorna o nome do mês por extenso */
		public function mes_por_extenso($mes) {
			switch ($mes) {
				case 1: $mes = 'janeiro'; break;
				case 2: $mes = 'fevereiro'; break;
				case 3: $mes = 'março'; break;
				case 4: $mes = 'abril'; break;
				case 5: $mes = 'maio'; break;
				case 6: $mes = 'junho'; break;
				case 7: $mes = 'julho'; break;
				case 8: $mes = 'agosto'; break;
				case 9: $mes = 'setembro'; break;
				case 10: $mes = 'outubro'; break;
				case 11: $mes = 'novembro'; break;
				case 12: $mes = 'dezembro'; break;
			}
			
			return $mes;
		}
		
		/* Converte a data em um formato pré-determinado para um formato desejado */
		public function converter_data($formato, $separador, $data, $novoFormato, $novoSeparador) {
			if ($data == '' || $data == NULL) {
				$return = NULL;
			}
			else{
				$formatoArray = explode($separador, $formato);
				$dataArray = explode($separador, $data);
				for($i=0; $i<3; $i++){
					switch($formatoArray[$i]){
						case 'd':
							$dia = $dataArray[$i];
							break;
						case 'm':
							$mes = $dataArray[$i];
							break;
						case 'y':
							$ano = $dataArray[$i];
							break;
						case 'Y':
							$anoCompleto = $dataArray[$i];
							break;
					}
				}
				$novoFormatoArray = explode($novoSeparador, $novoFormato);
				$novaDataFormatoArray = array();
				for($i=0; $i<3; $i++){
					switch($novoFormatoArray[$i]){
						case 'd':
							$novaDataFormatoArray[$i] = $dia;
							break;
						case 'm':
							$novaDataFormatoArray[$i] = $mes;
							break;
						case 'y':
							$novaDataFormatoArray[$i] = ($ano != "") ? $ano : substr($anoCompleto, 2);
							break;
						case 'Y':
							$novaDataFormatoArray[$i] = ($anoCompleto != "") ? $anoCompleto : '20'.$ano;
							break;
					}
				}
				$return = implode($novoSeparador, $novaDataFormatoArray);
			}
			
			return $return;
		}
		
		/* Exibir hora no formato desejado. Padrão do formato de $hora: h:m:s */
		public function converter_hora($hora, $formato) {
			switch ($formato) {
				case "h:m:s":
					 $hora = $hora;
					 break;
				case "h:m":
					 $hora = substr($hora, 0, 5);
					 break;
				 case "h":
					$hora = substr($hora, 0, 2);
					 break;
			}
			return $hora;
		}
		
		/* Compara datas e retorna -1, 0 ou 1, se a primeira data é anterior, igual ou posterior a segunda data, respectivamente */
		public function comparar_data($dia1, $mes1, $ano1, $dia2, $mes2, $ano2) {
			if($ano1 < $ano2){
				return -1;
			}
			elseif($ano1 > $ano2){
				return 1;
			}
			else{
				if($mes1 < $mes2){
					return -1;
				}
				elseif($mes1 > $mes2){
					return 1;
				}
				else{
					if($dia1 < $dia2){
						return -1;
					}
					elseif($dia1 > $dia2){
						return 1;
					}
					else{
						return 0;
					}
				}
			}
		}

		/* Formata um numero em string monetario em R$ */
		public function formatar_monetario($valor)
		{
			return "R$ ".number_format($valor, 2, ',', '.');
		}

		/* Converte valor do padrão brasileiro para float(no padrão americano) */
		public function formatar_valor($x) {
			//Remove o símbolo monetário
			$valor = substr($x, 3);
			//Retira os '.' de milhares do número
			$valor = explode(".", $valor);
			$valor = implode("", $valor);
			//Subtitui a ',' por '.'
			$pos = strpos($valor, ",");
			$valor[$pos] = '.';
			
			return $valor;
		}
        
        // Converte uma cor de HEX (#nnnnnn ou #nnn) para RGB (r,g,b)
        function HexToRGB($hex) 
        {
            // $hex = preg_replace("#", "", $hex); 
			$hex = str_replace("#", "", $hex);
			$hex = trim($hex);
            $color = array();
            if(strlen($hex) == 3) 
            {
                $color['r'] = hexdec(substr($hex, 0, 1) . $r);
                $color['g'] = hexdec(substr($hex, 1, 1) . $g);
                $color['b'] = hexdec(substr($hex, 2, 1) . $b);
            }
            else if(strlen($hex) == 6) 
            {
                $color['r'] = hexdec(substr($hex, 0, 2));
                $color['g'] = hexdec(substr($hex, 2, 2));
                $color['b'] = hexdec(substr($hex, 4, 2));
            }
            $color['rgb'] = $color['r'] .',' .$color['g'] .',' .$color['b']; 
            return $color;
        }
 
        // Converte uma cor de RGB (r,g,b) para HEX (#nnnnnn ou #nnn)
        function RGBToHex($r, $g, $b) 
        {
            //String padding bug found and the solution put forth by Pete Williams (http://snipplr.com/users/PeteW)
            $hex = "#";
            $hex.= str_pad(dechex($r), 2, "0", STR_PAD_LEFT);
            $hex.= str_pad(dechex($g), 2, "0", STR_PAD_LEFT);
            $hex.= str_pad(dechex($b), 2, "0", STR_PAD_LEFT);
            return $hex;
        }


         //obter genero
        function obter_genero_string($genero)
        {
        	$g = strtolower($genero);
        	$g = trim($g);

        	switch ($g[0]) {
        		case 'm':
        			return "Masculino";
        			break;

        		case 'f':
        			return "Feminino";
        			break;
        		
        		default:
        			return "";
        			break;
        	}
        }

        //criar horario 
        public function criar_data($dia, $mes, $ano, $formato='Y-m-d', $hora=0, $minuto=0, $segundo=0)
        {
        	return date("Y-m-d", mktime(intval($hora),intval($minuto),intval($segundo),intval($mes),intval($dia),intval($ano), -1));
        }

		//obter url da foto do usuario
		public function obter_url_foto_usuario($id_usuario)
		{
			$usuario = new Usuario($this->_bd, $this->_sys_log);
			$usuario->selecionar($id_usuario);

			if($usuario->foto != NULL)
				return USUARIOS_DIR."$usuario->id/".$usuario->foto;
			else
				return IMAGENS_DIR."foto_quadrada_gigante.png";
		}
	}
?>
