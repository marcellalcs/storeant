
<!DOCTYPE HTML>
<html lang="en" dir="ltr">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<head>
		<link type="text/css" rel="stylesheet" href="<?php echo BOOTSTRAP_DIR . 'css/bootstrap.css'; ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo BOOTSTRAP_DIR . 'css/bootstrap-responsive.css'; ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo CSS_DIR . 'global.css'; ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo CSS_DIR . 'about.css'; ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo CSS_DIR . 'contact.css'; ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo CSS_DIR . 'topo.css'; ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo CSS_DIR . 'index.css'; ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo CSS_DIR . 'barra_busca.css'; ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo CSS_DIR . 'resultado_busca.css'; ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo CSS_DIR . 'metodo_descricao.css'; ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo CSS_DIR . 'styles.css'; ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo JQUERY_DIR . 'css/jquery-ui-1.9.2.custom.css'; ?>" />
		
		<script type="text/javascript" src="<?php echo JQUERY_DIR . 'jquery-1.8.3.min.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo JQUERY_DIR . 'jquery-ui-1.9.2.custom.min.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo BOOTSTRAP_DIR . 'js/bootstrap.min.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo JQUERY_DIR . 'jquery.validate.min.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo JQUERY_DIR . 'jquery.maskedinput-1.3.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo JQUERY_DIR.'jquery.maskmoney.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo JQUERY_DIR . 'jquery.ui.touch-punch.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo JQUERY_DIR . 'jquery.loading.js' ?>"></script>
		<script type="text/javascript" src="<?php echo JQUERY_DIR . 'jquery.FirstFormFocus.js' ?>"></script>
		<script type="text/javascript" src="<?php echo JQUERY_DIR.'jquery.regras-validate.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo JQUERY_DIR.'additional-methods.min.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo JQUERY_DIR.'underscore-min.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo JQUERY_DIR.'jquery.combobox.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo JQUERY_DIR.'jquery.flexslider-min.js'; ?>"></script>
				
	</head>
	<body>

			<div id="topo">
				<div id="conteiner-topo" class="row">
					<div id="logo-topo" class="span2"> <img src="<?php echo IMAGENS_DIR.'w_logo.png'; ?>" alt="logo storeant"></div>
					<div id="menu-topo" class="navbar span7 offset3">
						<ul class="nav">
							<li><a href="<?php echo RAIZ_DIR."index.php" ?>">Home</a></li>
							<li><a href="<?php echo RAIZ_DIR."about.php" ?>">About</a></li>
							<li><a href="<?php echo RAIZ_DIR."contact.php" ?>.php">Contact</a></li>
							<li><a href="<?php echo RAIZ_DIR."help.php" ?>">Help</a></li>
							<?php if(!isset($_SESSION['nome-u'])): ?>
								<li><a href=<?php echo MODULOS_DIR . 'login/login.php'?>>Login</a></li>
							<?php elseif(isset($_SESSION['tipo-u']) && $_SESSION['tipo-u'] == 2): ?>
								<li><a href="<?php echo RAIZ_DIR.'meus_metodos.php'?>"> Meus Métodos (<?php echo $_SESSION['nome-u']; ?>)</a></li>
							<?php else: ?>
								<li><a href="<?php echo MODULOS_DIR.'administracao/administracao.php'?>"> Painel Administrativo</a></li>
							<?php endif; ?>
								<!-- <li><a class="btn btn-neon-orange" href="<?php echo RAIZ_DIR.'sair.php'?>"> Sair</a></li> -->
						</ul>
					</div>
					<!-- <div id="lang-bar" class="span1">
						<div id="pt-br" class="bandeira">
							
						</div>
						<div id="en-us" class="bandeira">
							
						</div>
					</div> -->
				</div>
			</div>
			<div id="topo-decor"></div>
